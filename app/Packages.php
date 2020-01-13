<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Packages extends Model
{
    //

    use SoftDeletes;

    protected $table = 'packages' ;

    protected $fillable = ['package','pv','rs','amount','code','level_percent'];

    public static function TopUPAutomatic($user_id){
    	$user_detils = User::find($user_id);
    	$balance = Balance::where('user_id',$user_id)->pluck('balance');
    	$package = self::find($user_detils->package);

    	if($package->amount <= $balance){

    		Balance::where('user_id',$user_id)->decrement('balance',$package->amount);
    		PurchaseHistory::create([
                'user_id'=>$user_id,
    			'package_id'=>$user_detils->package,
    			'count'=>$package->top_count,
    			'total_amount'=>$package->amount,
    			]);
    		 User::where('id',$user_id)->increment('revenue_share',$package->rs);

             RsHistory::create([
                    'user_id'=> $user_id ,
                    'from_id'=> $user_id ,
                    'rs_credit'=> $package->rs ,
                    ]);


    		 /* Check for rank upgrade */

    		 Ranksetting::checkRankupdate($user_id,$user_detils->rank_id);

    		return true;

    	}else{
    		return flase ; 
    	}
    }

    public static function levelCommission($user_id,$package_am){

       $user_arrs=[];
       $results=SELF::gettenupllins($user_id,1,$user_arrs);
          foreach ($results as $key => $upuser) {
              $package=ProfileInfo::where('user_id',$upuser)->value('package');
              $pack=Packages::find($package);
              $level_commission=$package_am*$pack->level_percent*0.01;
                $commision = Commission::create([
                'user_id'        => $upuser,
                'from_id'        => $user_id,
                'total_amount'   => $level_commission,
                'tds'            => 0,
                'service_charge' =>0,
                'payable_amount' => $level_commission,
                'payment_type'   => 'level_commission',
                'payment_status' => 'Yes',
          ]);
          /**
          * updates the userbalance
          */
          User::upadteUserBalance($upuser, $level_commission);
          }

    }

     public static function directReferral($sponsor,$from,$package){
          
          $pack=Packages::find($package);
          $direct_ref=Settings::find(1)->direct_referral;
          $direct_referral=$pack->amount*$direct_ref*0.01;
          $commision = Commission::create([
                'user_id'        => $sponsor,
                'from_id'        => $from,
                'total_amount'   => $direct_referral,
                'tds'            => 0,
                'service_charge' =>0,
                'payable_amount' => $direct_referral,
                'payment_type'   => 'direct_referral',
                'payment_status' => 'Yes',
          ]);
          /**
          * updates the userbalance
          */
          User::upadteUserBalance($sponsor, $direct_referral);
          self::checkRefreals($sponsor,$from,$package);

    }

    public static function checkRefreals($sponsor,$from,$package){
      $usercount=Sponsortree::where('sponsor',$sponsor)->where('type','yes')->count('user_id');
      if($usercount > 3){
          $pack=Packages::find($package);
          $direct_ref=Settings::find(1)->three_friends;
          $direct_referral=$pack->amount*$direct_ref*0.01;
          $commision = Commission::create([
                'user_id'        => $sponsor,
                'from_id'        => $from,
                'total_amount'   => $direct_referral,
                'tds'            => 0,
                'service_charge' =>0,
                'payable_amount' => $direct_referral,
                'payment_type'   => 'three_referral',
                'payment_status' => 'Yes',
          ]);
          User::upadteUserBalance($sponsor, $direct_referral);

            if($usercount > 8){
              $eight_friends=Settings::find(1)->three_friends;
              $eight_referral=$pack->amount*$eight_friends*0.01;
              $commision = Commission::create([
                    'user_id'        => $sponsor,
                    'from_id'        => $from,
                    'total_amount'   => $eight_referral,
                    'tds'            => 0,
                    'service_charge' =>0,
                    'payable_amount' => $eight_referral,
                    'payment_type'   => 'eight_referral',
                    'payment_status' => 'Yes',
              ]);
              User::upadteUserBalance($sponsor, $eight_referral);
            }

      }
    }


    public static function gettenupllins($upline_users,$level=1,$uplines){
     if ($level > 10) 
        return $uplines;  
   
     $upline=Tree_Table::where('user_id',$upline_users)->where('type','=','yes')->value('placement_id'); 

      if ($upline > 0)
          $uplines[]=$upline;

     if ($upline == 1) 
       
        return $uplines;  
    
     return SELF::gettenupllins($upline,++$level,$uplines);
   }

   public static function rankCheck($user){
    
    $cur_rank=User::find($user)->rank_id;
    $next_rank=$cur_rank+1;
    $rank_det=Ranksetting::find($next_rank);
    $sponusers=Sponsortree::where('sponsor',$user)->where('sponsortree.type','yes')->pluck('user_id');
     $sponusers2=Sponsortree::join('users','users.id','=','sponsortree.user_id')->where('sponsor',$user)->where('sponsortree.type','yes')->pluck('referral_count','user_id');
    // dd($rank_det);
    // dd($sponusers2);
    $user_count=count($sponusers);
  
      if($user_count >= $rank_det->direct){

       
  
        if(($rank_det->sub_direct1 > 0)){
           $one=User::where('referral_count','>=',$rank_det->sub_direct1)
                    ->whereIn('id',$sponusers)
                    ->take(1)->get();
                    // $sub_direct[]=$one[0]->id;
                   // echo "one".$one[0]->id."<br>";

        }
    
        if($rank_det->sub_direct2 > 0 && (count($one) > 0)){
           $two=User::where('referral_count','>=',$rank_det->sub_direct2)
                    ->whereIn('id',$sponusers)
                    ->where('id','<>',$one[0]->id)
                    ->take(1)->get();
                 // echo "two".$two[0]->id."<br>";
               }
       
       if($rank_det->sub_direct3 > 0 && (count($one) > 0) && (count($two) > 0)){
           $three=User::where('referral_count','>=',$rank_det->sub_direct3)
                      ->whereIn('id',$sponusers)
                      ->where('id','<>',$two[0]->id)
                      ->where('id','<>',$one[0]->id)
                      ->take(1)->get();
                       // $sub_direct[]=$three[0]->id;
                    // dd($three);
                      // echo "three".$three[0]->id."<br>";
        }
              
        if($rank_det->sub_direct4 > 0 && (count($one) > 0) &&  (count($two) > 0) && (count($three) > 0)){
           $four=User::where('referral_count','>=',$rank_det->sub_direct4)
                     ->whereIn('id',$sponusers)
                     ->where('id','<>',$two[0]->id)
                     ->where('id','<>',$one[0]->id)
                     ->where('id','<>',$three[0]->id)
                     ->take(1)->get();
                      // $sub_direct[]=$four[0]->id;
                     // echo "four".$four[0]->id."<br>";
        }
        if($rank_det->sub_direct5 > 0 && (count($one) > 0) && (count($two) > 0) && (count($three) > 0) && (count($four) > 0)){
          $five=User::where('referral_count','>=',$rank_det->sub_direct5)
                    ->whereIn('id',$sponusers)->where('id','<>',$four[0]->id)
                    ->where('id','<>',$two[0]->id)
                    ->where('id','<>',$one[0]->id)
                    ->where('id','<>',$three[0]->id)
                    ->take(1)->get();
                    // $sub_direct[]=$five[0]->id;
                    // echo "five".$five[0]->id."<br>";
           
        }
        if($rank_det->sub_direct6 > 0 && (count($one) > 0) && (count($two) > 0) && (count($three) > 0) && (count($four) > 0) && (count($five) > 0)){
          $six=User::where('referral_count','>=',$rank_det->sub_direct6)
                    ->whereIn('id',$sponusers)->where('id','<>',$five[0]->id)
                    ->where('id','<>',$four[0]->id)
                    ->where('id','<>',$two[0]->id)
                    ->where('id','<>',$one[0]->id)
                    ->where('id','<>',$three[0]->id)
                    ->take(1)->get();
                    // dd($six);
                    // $sub_direct[]=$six[0]->id;
                    // echo "six".$six[0]->id."<br>";
        }

        // dd("done");

        if($next_rank < 4){
          if((count($one) > 0) && (count($two) > 0) &&  (count($three) > 0)){
          Ranksetting::insertRankHistory($user,$next_rank,$cur_rank,'rank_updated');
          }
        }

        if($next_rank > 3 && $next_rank < 7){
          // dd($sub_direct);
          if((count($one) > 0) && (count($two) > 0) &&  (count($three) > 0) && (count($four) > 0) && (count($five) > 0) && (count($six) > 0)){
             Ranksetting::insertRankHistory($user,$next_rank,$cur_rank,'rank_updated');
          }
        }

          if($next_rank == 7){
          
            // dd($next_rank);
          if((count($one) > 0) && (count($two) > 0) &&  (count($three) > 0) && (count($four) > 0) && (count($five) > 0) && (count($six) > 0)){
               $second_direct=array($one[0]->id,$two[0]->id,$three[0]->id,$four[0]->id,$five[0]->id,$six[0]->id);


            if(($rank_det->sub_junior_direct1 > 0)){
                $one=User::where('referral_count','>=',$rank_det->sub_junior_direct1)
                         ->whereIn('id',$second_direct)
                         ->take(1)->get();
                    // $sub_direct[]=$one[0]->id;
                   echo "one".$one[0]->id."<br>";

            }
            dd($one);
    
            if($rank_det->sub_direct2 > 0 && (count($one) > 0)){
               $two=User::where('referral_count','>=',$rank_det->sub_direct2)
                        ->whereIn('id',$sponusers)
                        ->where('id','<>',$one[0]->id)
                        ->take(1)->get();
                     // echo "two".$two[0]->id."<br>";
            }
       
           if($rank_det->sub_direct3 > 0 && (count($one) > 0) && (count($two) > 0)){
               $three=User::where('referral_count','>=',$rank_det->sub_direct3)
                          ->whereIn('id',$sponusers)
                          ->where('id','<>',$two[0]->id)
                          ->where('id','<>',$one[0]->id)
                          ->take(1)->get();
                           // $sub_direct[]=$three[0]->id;
                        // dd($three);
                          // echo "three".$three[0]->id."<br>";
            }
           
            dd($second_direct);


             // Ranksetting::insertRankHistory($user,$next_rank,$cur_rank,'rank_updated');
          }
        }
      
}
}

   

 
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profileinfo()
    {
        return $this->belongsTo('App\Profileinfo');
    }

    public function PurchaseHistoryR()
    {
        return $this->hasMany('App\PurchaseHistory', 'package_id', 'id');
    }

   
}
