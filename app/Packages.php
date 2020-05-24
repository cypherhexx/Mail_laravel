<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Log;


class Packages extends Model
{
    //

    use SoftDeletes;

    protected $table = 'packages' ;

    protected $fillable = ['package','pv','rs','amount','code','level_percent','image','day_plan','month_plan'];

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
    return false ; 
    }
    }

     public static function levelCommission($user_id,$package_am,$package_id)
    {
       
       $user_arrs=[];
       $results=SELF::gettenupllins($user_id,1,$user_arrs);
          foreach ($results as $key => $upuser) {

            $puchase_status = User::where('id',$upuser)->value('active_purchase');
            if($puchase_status == "no"){
                continue;
            }
            Log::debug('Arslan debug: User: ' . $upuser);
            $package=ProfileInfo::where('user_id',$upuser)->value('package');
            $pack=Packages::find($package);
            Log::debug('Arslan debug: Package: ' . $package);
            $cat_id=User::where('id',$upuser)->value('category_id');
            Log::debug('Arslan debug: Category id: ' . $cat_id);
            $category=Category::find($cat_id)->percentage;
            $rank=User::where('id',$upuser)->value('rank_id');
            $rankgain=Ranksetting::find($rank)->gain;
            $matrix=Settings::find(1)->matrix;


            $total=$matrix+$pack->level_percent+$rankgain+$category;            
              // dd($pack->package,$matrix,$pack->level_percent,$rankgain,$category);
            $level_commission=$package_am*$total*0.01;
              if($level_commission > 0){ 

                $commision = Commission::create([
                'user_id'        => $upuser,
                'from_id'        => $user_id,
                'total_amount'   => $level_commission,
                'tds'            => 0,
                'service_charge' => 0,
                'payable_amount' => $level_commission,
                'payment_type'   => 'level_commission',
                'payment_status' => 'Yes',
                'matrix'         => $matrix,
                'level_percent'  => $pack->level_percent,
                'rankgain'       => $rankgain,
                'category'       => $category,
                'package'        => $package_id, 
                ]);
            /**
            * updates the userbalance
            */
            User::upadteUserBalance($upuser, $level_commission);
          }
        }
    }
    // public static function levelBonus($user_id,$package){



    

    

    //    $packs=Packages::find($package)->level_percent;
    
    //       $matrix=Settings::find(1)->matrix;
         
    //       $level_bonus=$packs+$matrix;
          // dd($level_bonus);
        //   $commision = Commission::create([
        //         'user_id'        => 'NA',
        //         'from_id'        => $from,
        //         'total_amount'   => $direct_referral,
        //         'tds'            => 0,
        //         'service_charge' =>0,
        //         'payable_amount' => $direct_referral,
        //         'payment_type'   => 'direct_referral',
        //         'payment_status' => 'Yes',
        //   ]);
        //   /**
        //   * updates the userbalance
        //   */
        // //   Settings::upadteMatrix($level_bonus);
        // }
         

   





    public static function checkRankbasedCommission($user,$amount,$from){
        $rank=User::find($user)->rank_id;

        if($rank > 1){
           $rankgain=Ranksetting::find($rank)->gain;
           $rank_commission=$amount*$rankgain*0.01;
           if($rank_commission > 0){
                    $commision = Commission::create([
                    'user_id'        => $user,
                    'from_id'        => $from,
                    'total_amount'   => $rank_commission,
                    'tds'            => 0,
                    'service_charge' =>0,
                    'payable_amount' => $rank_commission,
                    'payment_type'   => 'rank_level_commission',
                    'payment_status' => 'Yes',
              ]);
              User::upadteUserBalance($user, $rank_commission);
            }

          }
     }
    //  public static function directReferral($sponsor,$from,$package){
          
    //       $pack=Packages::find($package);
    //       $direct_ref=Settings::find(1)->direct_referral;
    //       $direct_referral=$pack->amount*$direct_ref*0.01;
    //       // dd( $direct_referral);
    //       $commision = Commission::create([
    //             'user_id'        => 'NA',
    //             'from_id'        => $from,
    //             'total_amount'   => $direct_referral,
    //             'tds'            => 0,
    //             'service_charge' =>0,
    //             'payable_amount' => $direct_referral,
    //             'payment_type'   => 'direct_referral',
    //             'payment_status' => 'Yes',
    //       ]);
    //       /**
    //       * updates the userbalance
    //       */
    //       User::upadteUserBalance($sponsor, $direct_referral);
    //       // self::checkRefreals($sponsor,$from,$package);

    // }

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

   public static function rankCheck($rankuser){
    // echo "user".$rankuser."<br>";
      $package=ProfileInfo::where('user_id',$rankuser)->value('package');
      $cur_rank=User::find($rankuser)->rank_id;
      $next_rank=$cur_rank+1;

      $rank_det=Ranksetting::find($next_rank);

        if($rank_det <> null && $package > 1){
          $referral_count=User::find($rankuser)->referral_count;
          $direct_ref1_users=Sponsortree::join('users','sponsortree.user_id','=','users.id')
                                        ->join('profile_infos','profile_infos.user_id','=','users.id')
                                        ->where('profile_infos.package','>',1)
                                        ->where('sponsortree.sponsor','=',$rankuser)
                                        ->where('sponsortree.type','=','yes')
                                        ->where('users.purchase_count','>=',$rank_det->minimum_ref_for_each1)
                                        ->where('users.referral_count','>=',$rank_det->minimum_ref_for_each1)
                                        ->pluck('users.id');
                                  // dd($direct_ref1_users);
   
                     
          $direct_ref1=count($direct_ref1_users);
            

          //start minimum_direct_ref1

            if($rank_det->minimum_direct_ref1 == 0)
              $flag_direct_ref1=1;
            else{
              if($direct_ref1 >= $rank_det->minimum_direct_ref1)
                $flag_direct_ref1=1;
              else
                $flag_direct_ref1=0;
            }
            //end minimum_direct_ref1

            //start minimum_ref_for_each1

            if($rank_det->minimum_ref_for_each1 == 0)
               $flag_ref_for_each1=1;
            else{
               if($direct_ref1 >= $rank_det->minimum_direct_ref1)
                $flag_ref_for_each1=1;
               else
                $flag_ref_for_each1=0;
            }

            //end  minimum_ref_for_each1

               //start minimum_direct_ref3

            if($rank_det->minimum_direct_ref3 == 0)
              $flag_direct_ref3=1;
            else{

              if($direct_ref1 >= $rank_det->minimum_direct_ref1){
                  $first_user=$direct_ref1_users;
                  $sum_three=0;
                
                    foreach ($first_user as $key => $suser) {
                   

                     
                      $ref_count=User::find($suser)->referral_count;
                      
                      $sum_users=Sponsortree::join('users','sponsortree.user_id','=','users.id')
                                            ->join('profile_infos','profile_infos.user_id','=','users.id')
                                            ->where('sponsortree.sponsor','=',$suser)
                                            ->where('sponsortree.type','=','yes')
                                            ->where('profile_infos.package','>',1)
                                            ->where('users.referral_count','>=',$rank_det->minimum_ref_for_each3)
                                             ->where('users.purchase_count','>=',$rank_det->minimum_ref_for_each3)
                                            ->pluck('users.username');
                      $s=count($sum_users);

                                 // dd($sum_users);
                                  
                                
                               
                      // $each_user_count=$rank_det->minimum_direct_ref3/$rank_det->minimum_ref_for_each1;
                                  
                        if(count($sum_users) >= $rank_det->minimum_direct_ref3)
                          $sum_three=$sum_three+1;
                     }


                   
                  if($sum_three >= $rank_det->minimum_direct_ref3)
                    $flag_direct_ref3=1;
                  else
                    $flag_direct_ref3=0;
              }
              else
                 $flag_direct_ref3=0;
             }
      

       
               //end minimum_direct_ref3

               //start minimum_ref_for_each3

            if($rank_det->minimum_ref_for_each3 == 0)
              $flag_ref_for_each3=1;
            else{
              if($direct_ref1 >= $rank_det->minimum_direct_ref1){
                if($sum_three >= $rank_det->minimum_direct_ref3)
                  $flag_ref_for_each3=1;
                else
                  $flag_ref_for_each3=0;
              }
              else
                 $flag_ref_for_each3=0;
             }
             //end minimum_ref_for_each3

          
             if($flag_direct_ref1 == 1  && $flag_direct_ref3 == 1 && $flag_ref_for_each1 == 1  && $flag_ref_for_each3 == 1){
         
              
               Ranksetting::insertRankHistory($rankuser,$next_rank,$cur_rank,'rank_updated');
               
             }
        }
      }
  


    public static function rankCheckold($rankuser){
      $cur_rank=User::find($rankuser)->rank_id;
      $next_rank=$cur_rank+1;
      $rank_det=Ranksetting::find($next_rank);
      if($rank_det <> null){
      $user_count=Sponsortree::where('sponsor',$rankuser)->where('type','yes')->count('user_id');
        if($rank_det->minimum_ref_for_each1 == 0 && $rank_det->minimum_direct_ref2 == 0 && $rank_det->minimum_direct_ref3 == 0 && $user_count >= $rank_det->minimum_direct_ref1){
            Ranksetting::insertRankHistory($rankuser,$next_rank,$cur_rank,'rank_updated');
        }

        if($rank_det->minimum_ref_for_each1 > 0){

          // dd($rank_det);
           
            $direct_ref_users1=Sponsortree::join('users','sponsortree.user_id','=','users.id')
                                          ->where('sponsortree.sponsor','=',$rankuser)
                                          ->where('sponsortree.type','=','yes')
                                          ->where('users.referral_count','>=',$rank_det->minimum_ref_for_each1)
                                          ->pluck('users.id');

                                          // dd($rank_det->minimum_ref_for_each1);
            $direct_ref1=count($direct_ref_users1);
                  // dd($direct_ref_users1);

              if($direct_ref1 >= $rank_det->minimum_direct_ref1 && $rank_det->minimum_direct_ref2 == 0 && $rank_det->minimum_direct_ref3 == 0){
                  Ranksetting::insertRankHistory($rankuser,$next_rank,$cur_rank,'rank_updated');
              }
              if($rank_det->minimum_ref_for_each2 > 0){
                  // dd("hello");

                  $direct_ref_users2=Sponsortree::join('users','sponsortree.user_id','=','users.id')
                                                ->where('sponsortree.sponsor','=',$rankuser)
                                                ->where('users.referral_count','>=',$rank_det->minimum_ref_for_each2)
                                                ->where('users.referral_count','<',$rank_det->minimum_ref_for_each1)
                                                ->whereNotIn('sponsortree.user_id',$direct_ref_users1)
                                                ->pluck('sponsortree.user_id');
                  $direct_ref2=count($direct_ref_users2);
                  // dd($direct_ref2);

              if($direct_ref1 >= $rank_det->minimum_direct_ref1 && $direct_ref2 >= $rank_det->minimum_direct_ref2 && $rank_det->minimum_direct_ref3 == 0){
                  Ranksetting::insertRankHistory($rankuser,$next_rank,$cur_rank,'rank_updated');
              }
        }
             

              if($rank_det->minimum_ref_for_each3 > 0 && $rank_det->minimum_direct_ref2 == 0){
                // dd($rank_det->minimum_direct_ref1);

                if($direct_ref1 >= $rank_det->minimum_direct_ref1){

                  $second_user=self::Levelcount($rankuser,2);
                  // dd($rank_det->minimum_direct_ref3);

                  if(count($second_user) >= $rank_det->minimum_direct_ref3){

                    $sum_three=0;
                    foreach ($second_user as $key => $suser) {
                     $ref_count=User::find($suser)->referral_count;
                   
                     if($ref_count >= $rank_det->minimum_ref_for_each3){
                      $sum_three=$sum_three+1;
                     }

                    }

                  if($sum_three >= $rank_det->minimum_direct_ref3){
                     Ranksetting::insertRankHistory($rankuser,$next_rank,$cur_rank,'rank_updated');
                  }
                }

                }

              }

      
      
    }
    }
    }

public static function Levelcount($user_id,$level)
  {
      $first_level = DB::table('sponsortree')
                       ->where('sponsor','=',$user_id)
                       ->where('type','<>',"vaccant")
                       ->select('user_id')
                       ->get(); 
      $first_count = count($first_level);
        if($first_count > 0 ){
          $first_array = [];
            foreach($first_level as $row){
              $first_array[] = $row->user_id;
              }
              $second_level = DB::table('sponsortree')
                                ->whereIn('sponsor',$first_array)
                                ->where('type','<>',"vaccant")
                                ->select('user_id')
                                ->get(); 
              $second_count = count($second_level);
              if($second_count > 0 ){
                $second_array = [];
                  foreach($second_level as $row){
                    $second_array[] = $row->user_id;
                  }
                    return $second_array; 
              }
              else{
                   return 0;
                 }
        }
        else{
                   return 0;
                 }
    }

    public static function cancelexisting($user){
      

          /*wordpress registration*/
            $package=ProfileModel::where('user_id',$user)->value('package');
            $subscription_id=PendingTransactions::where('user_id',$user)->where('package',$package)->value('paypal_agreement_id');
            $url =  'https://api.sandbox.paypal.com/v1/billing/subscriptions/'.$subscription_id.'/cancel'; 
            
         $fields = array(
          
              "username" =>1,
             

      );
      $headers = array (
 'Authorization' => 'Basic ' . base64_encode( 'ATEZyKWk27tSN71BQmrGzf7pQUbaT1Ko83MH1DFgtS1twWngdfCFFAcrzuNDosEOpX6sWk-frDWvXimE' . ':' . 'EJPtMQvMTNjMrlfPgmkSkuPl0aLjjvJdtj7ABIs9LtAvn1SkMSXuRazHyHgNZ93Cbva9vRXws8PMFzmC' ),
 'Content-Type'=> 'application/json'
);
            $fields_string = null;
      $ch = curl_init();
      curl_setopt($ch,CURLOPT_URL, $url);
      curl_setopt($ch,CURLOPT_POST, count($fields));
      curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($fields));
      curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
      // if(curl_exec($ch) === false)
      // {
      //     echo 'Curl error: ' . curl_error($ch);
      // }
      // else
      // {
      //     echo 'Operation completed without any errors';
      // }
      //       echo $result = curl_exec($ch);die();
      $result = curl_exec($ch);
      $result = json_decode($result,true);
      curl_close($ch);
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


    // public static function Addtomatrixplan($user_id){

    //     $sponsor_id = Sponsortree::where('user_id',$user_id)->value('sponsor');
    //     // dd($sponsor_id);

    //     $placement_id = Tree_Table::gettreePlacementId([$sponsor_id]); 
    //     $tree_id = Tree_Table::vaccantId($placement_id);
    //     $tree          = Tree_Table::find($tree_id);
    //     $tree->user_id = $user_id;
    //     $tree->sponsor = $sponsor_id;
    //     $tree->type    = 'yes';
    //     $tree->save(); 
    //     $count=Tree_Table::where('user_id','=',$placement_id)->value('level');
    //     Tree_Table::where('id',$tree_id)->update(['level'=>$count+1]);
    //     Tree_Table::createVaccant($tree->user_id);


    //     Tree_Table::$upline_users = [];
    //     Tree_Table::getAllUpline($user_id);
    //     $variable = Tree_Table::$upline_users;
    //     foreach ($variable as $key => $value) {
    //        // dd($value);
    //       $update_downlinecout=User::where('id',$value['user_id'])->increment('dowlinecount');
    //     }
    //     Tree_Table::$upline_users = [];
    //     return true;

    // }

    public static function Addtomatrixplan($user_id){

        $sponsor_id = Sponsortree::where('user_id',$user_id)->value('sponsor');
        // dd($sponsor_id);

        $placement_id = Tree_Table::gettreePlacementId([$sponsor_id]);

        // dd($placement_id);
        // $tree_id = Tree_Table::vaccantId($placement_id);
        $tree          = Tree_Table::find($placement_id);
        $tree->user_id = $user_id;
        $tree->sponsor = $sponsor_id;
        $tree->type    = 'yes';
        $tree->save();
        // $count=Tree_Table::where('user_id','=',$tree->placement_id)->value('level');
        Tree_Table::where('id',$tree->placement_id)->increment('level');
        Tree_Table::createVaccant($tree->user_id,$tree->leg);


        Tree_Table::$upline_users = [];
        Tree_Table::getAllUpline($user_id);
        $variable = Tree_Table::$upline_users;
        foreach ($variable as $key => $value) {
           // dd($value);
          $update_downlinecout=User::where('id',$value['user_id'])->increment('dowlinecount');
        }
        Tree_Table::$upline_users = [];
        return true;

    }
     public static function DirectReferrals($user_id,$package)
     {
         $sponsor_id=Sponsortree::where('user_id',$user_id)->value('sponsor');
         $puchase_status = User::where('id',$sponsor_id)->value('active_purchase');
         $package_amount=Packages::where('id',$package)->value('amount');
         $direct_referral=Settings::value('direct_referral');
         $amount=$package_amount * $direct_referral / 100;

         if($puchase_status != "no"){
            
              $commision = Commission::create([
                  'user_id'        => $sponsor_id,
                  'from_id'        => $user_id,
                  'total_amount'   => $amount,
                  'tds'            => 0,
                  'service_charge' => 0,
                  'payable_amount' => $amount,
                  'package'        =>$package,
                  'payment_type'   => 'direct_referral',
                  'payment_status' => 'Yes',
            ]);
            /**
            * updates the userbalance
            */
            User::upadteUserBalance($sponsor_id, $amount);
         }
      
     }

   
}


