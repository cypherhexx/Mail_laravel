<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use Mail;
use Assets;
use Crypt;
use Session;
use Validator;
use App\LeadershipBonus;
use App\PointTable;
use App\Commission;
use App\Sponsortree;
use App\MatchingBonus;
use App\LoyaltyUsers;
use App\LoyaltyBonus;
use App\PurchaseHistory;
use App\Tree_Table;
use App\PairingHistory;
use App\Balance;
use App\Payout;
use App\CarryForwardHistory;
use App\User; 
use App\AutoResponse;
use App\Emails;


class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $leadership_bonus = LeadershipBonus::all();

//where('point_table.left_carry','>',0)
// ->where('point_table.right_carry','>',0)
        $users_list = PointTable::where('point_table.user_id','>',1)
                            ->join('users','users.id','=','point_table.user_id')
                            ->select('point_table.left_carry','point_table.right_carry','point_table.user_id','users.package')
                            ->get();

        try{

           DB::beginTransaction();

              foreach ($users_list as $key => $value){           
            
                    $week_total = 0 ;
                    $total_bonus = 0 ;
                    $min_pv = min($value->left_carry,$value->right_carry);
                    $first_pv = $min_pv - $leadership_bonus[$value->package - 1]->first_limit ;
                    $second_pv = $min_pv - $leadership_bonus[$value->package - 1]->first_limit - $leadership_bonus[$value->package - 1]->second_limit ;
                    $third_pv = $min_pv - $leadership_bonus[$value->package - 1]->first_limit - $leadership_bonus[$value->package - 1]->second_limit - $leadership_bonus[$value->package - 1]->third_limit ;

                    CarryForwardHistory::create([
                      'user_id'=>$value->user_id,
                      'total_left'=>$value->left_carry,
                      'total_right'=>$value->right_carry,
                      'left'=>$value->left_carry - $min_pv ,
                      'right'=>$value->right_carry - $min_pv ,
                      ]);

// ECHO $value->package  ; 

                    if($min_pv == 0){
                      continue;
                    }
         
                    PointTable::where('user_id',$value->user_id)->decrement('left_carry',$min_pv);
                    PointTable::where('user_id',$value->user_id)->decrement('right_carry',$min_pv);

                    $pairing_history = PairingHistory::create([
                        'user_id'=>$value->user_id,
                        'total_left'=>$value->left_carry,
                        'total_right'=>$value->right_carry,
                        'left'=>$value->left_carry - $min_pv,
                        'right'=>$value->right_carry - $min_pv,
                      ]);

                    $pairing_history = PairingHistory::find($pairing_history->id);


                    if($first_pv > 0){
                        $amount = $leadership_bonus[$value->package - 1]->first_limit * $leadership_bonus[$value->package - 1]->first_percent  / 100 ;
                        $week_total += $amount ;

                        if($week_total >= $leadership_bonus[$value->package - 1]->week_limit ){
                            $amount =  $leadership_bonus[$value->package - 1]->week_limit ;
                        }

                          Commission::create([
                            'user_id'=>$value->user_id ,
                            'from_id'=>$value->user_id ,
                            'total_amount'=> $amount ,
                            'payable_amount'=> $amount ,
                            'payment_type'=>'pairing_bonus'
                          ]);
                        Commission::updateUserBalance($value->user_id, $amount);

                        $pairing_history->first_percent = $leadership_bonus[$value->package - 1]->first_percent;
                        $pairing_history->first_amount = $leadership_bonus[$value->package - 1]->first_limit;
                        $pairing_history->first_bonus = $amount;
                        $pairing_history->save();


                        $total_bonus = $total_bonus + $amount ;

                    }else{
                        $amount = $min_pv * $leadership_bonus[$value->package - 1]->first_percent  / 100 ;

                        $week_total += $amount ;

                        if($week_total >= $leadership_bonus[$value->package - 1]->week_limit ){
                            $amount =  $leadership_bonus[$value->package - 1]->week_limit ;
                        }

                          Commission::create([
                            'user_id'=>$value->user_id ,
                            'from_id'=>$value->user_id ,
                            'total_amount'=> $amount ,
                            'payable_amount'=> $amount ,
                            'payment_type'=>'pairing_bonus'
                          ]);
                        Commission::updateUserBalance($value->user_id, $amount); 
                        $total_bonus = $total_bonus + $amount ;


                        $pairing_history->first_percent = $leadership_bonus[$value->package - 1]->first_percent;
                        $pairing_history->first_amount = $min_pv;
                        $pairing_history->first_bonus = $amount;
                        $pairing_history->save();


                        Self::matchingbonus($value->user_id,$total_bonus);

                        continue;
                    }

                    if($second_pv > 0){


                        $amount = $leadership_bonus[$value->package - 1]->second_limit * $leadership_bonus[$value->package - 1]->second_percent  / 100 ;

                        if( ( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit ){
                            $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                        }
                          Commission::create([
                            'user_id'=>$value->user_id ,
                            'from_id'=>$value->user_id ,
                            'total_amount'=> $amount ,
                            'payable_amount'=> $amount ,
                            'payment_type'=>'pairing_bonus'
                          ]);
                        Commission::updateUserBalance($value->user_id, $amount);

                        $week_total += $amount ;

                        $total_bonus = $total_bonus + $amount ;


                        $pairing_history->second_percent = $leadership_bonus[$value->package - 1]->second_percent;
                        $pairing_history->second_amount = $leadership_bonus[$value->package - 1]->second_limit;
                        $pairing_history->second_bonus = $amount;
                        $pairing_history->save();


                    }else{

                         $pv = $min_pv  - $leadership_bonus[$value->package - 1]->first_limit ;
                         $amount = ( $pv )  * $leadership_bonus[$value->package - 1]->second_percent  / 100 ;

                          if( ( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit ){
                            $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                            }


                          Commission::create([
                            'user_id'=>$value->user_id ,
                            'from_id'=>$value->user_id ,
                            'total_amount'=> $amount ,
                            'payable_amount'=> $amount ,
                            'payment_type'=>'pairing_bonus'
                          ]);

                         Commission::updateUserBalance($value->user_id, $amount);

                          $week_total += $amount ; 

                          $total_bonus = $total_bonus + $amount ;

                           $pairing_history->second_percent = $leadership_bonus[$value->package - 1]->second_percent;
                        $pairing_history->second_amount = $pv;
                        $pairing_history->second_bonus = $amount;
                        $pairing_history->save();


                          Self::matchingbonus($value->user_id,$total_bonus);

                         continue;

                    }

                    if( $third_pv > 0){
                          $amount = $leadership_bonus[$value->package - 1]->third_limit * $leadership_bonus[$value->package - 1]->third_percent  / 100 ;

                            if( ( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit ){
                                $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                            }

                          Commission::create([
                            'user_id'=>$value->user_id ,
                            'from_id'=>$value->user_id ,
                            'total_amount'=> $amount ,
                            'payable_amount'=> $amount ,
                            'payment_type'=>'pairing_bonus'
                          ]);
                         Commission::updateUserBalance($value->user_id, $amount);
                          $week_total += $amount ;

                          $total_bonus = $total_bonus + $amount ;

                           $pairing_history->third_percent = $leadership_bonus[$value->package - 1]->third_percent;
                        $pairing_history->third_amount = $leadership_bonus[$value->package - 1]->third_limit;
                        $pairing_history->third_bonus = $amount;
                        $pairing_history->save();

                          Self::matchingbonus($value->user_id,$total_bonus);

                           continue ;
                    }else{

                        $pv = $min_pv  - $leadership_bonus[$value->package - 1]->second_limit - $leadership_bonus[$value->package - 1]->first_limit ;
                         $amount = ( $pv )  * $leadership_bonus[$value->package - 1]->third_percent  / 100 ;

                         if( ( $week_total + $amount ) >= $leadership_bonus[$value->package - 1]->week_limit ){
                            $amount =  $leadership_bonus[$value->package - 1]->week_limit - $week_total ;
                        }


                          Commission::create([
                            'user_id'=>$value->user_id ,
                            'from_id'=>$value->user_id ,
                            'total_amount'=> $amount ,
                            'payable_amount'=> $amount ,
                            'payment_type'=>'pairing_bonus'
                          ]);
                        Commission::updateUserBalance($value->user_id, $amount);

                         $week_total += $amount ;

                         $total_bonus = $total_bonus + $amount ;

                          $pairing_history->third_percent = $leadership_bonus[$value->package - 1]->third_percent;
                        $pairing_history->third_amount = $pv;
                        $pairing_history->third_bonus = $amount;
                        $pairing_history->save();

                         Self::matchingbonus($value->user_id,$total_bonus);

                        continue;
                    }




              }

               DB::commit();

          } catch (Exception $e) {
              
              DB::rollBack();
              echo 'Caught exception: ',  $e->getMessage(), "\n";

            } 

            Echo " Leader bonus and Matching bonus calculation completed " ;


      
    }


    public function matchingbonus($user_id,$amount){


        Sponsortree::$upline_users = array();

        Sponsortree::getAllUpline($user_id);

        $matching_bonus = MatchingBonus::all() ;

        $upline_users = Sponsortree::$upline_users;

        
        foreach ($upline_users as $key => $value) {
            if($value['type'] == 'yes'){

              $key = $key + 1 ;
              $index = $value['package'] - 1 ;
              $level = "level_$key";

              $payable_amount = $amount * $matching_bonus[$index]->$level / 100 ; 

              if($payable_amount  AND $value['user_id'] > 1){

                Commission::create([
                    'user_id'=>$value['user_id'] ,
                    'from_id'=>$user_id ,
                    'total_amount'=> $payable_amount ,
                    'payable_amount'=> $payable_amount ,
                    'payment_type'=>'matching_bonus'
                  ]);
                Commission::updateUserBalance($value['user_id'], $payable_amount);

              }               

            }
        }


    }


/**

Cron will run at the first day of every month with the details of last month 

*/

    public function makelist(){
  
/*
          $loyaltybonus_date = date('Y-m-d',strtotime("-1 days"));

           $loyalty_bonus_settings = LoyaltyBonus::find(1);

          $loop_limit = $loyalty_bonus_settings->bonus_duration / 3 ;

          $variable = PurchaseHistory::whereYear('created_at', '=', date('Y',strtotime("-1 days")))
                        ->whereMonth('created_at', '=', date('m',strtotime("-1 days")))
                        ->select('user_id',DB::raw('SUM(BV) as BV'))
                        ->having(DB::raw('SUM(BV)'), '>=', $loyalty_bonus_settings->personal_sales)
                        ->groupBY('user_id')
                        ->get();

         
          foreach ($variable as $key => $value) {
            for ($i=0; $i < $loop_limit; $i++) { 
                $index = $i*3 ; 
                $month = date('Y-m-d',strtotime("+$index months",strtotime($loyaltybonus_date)));
                if (LoyaltyUsers::where('month', '=', $month)->where('user_id', '=', $value->user_id)->exists()) {                    
                       LoyaltyUsers::where('month', '=', $month)
                                    ->where('user_id', '=', $value->user_id)
                                    ->increment('pv',$value->BV);
                }else{
                       LoyaltyUsers::create([
                        'user_id'=>$value->user_id,
                        'pv'=>$value->BV,
                        'month'=>$month
                        ]);
                }
            }               
               
          }


          */



          $loyaltybonus_date = date('Y-m-d H:i:00'); 
          $loyaltybonus_end_date =date('Y-m-d H:i:00');
          $loyaltybonus_start_date = date('Y-m-d H:i:00',strtotime("-10 minutes",strtotime($loyaltybonus_date)));

          $loyalty_bonus_settings = LoyaltyBonus::find(1);

          $loop_limit = $loyalty_bonus_settings->bonus_duration / 3 ;

          Echo " Taking sales from $loyaltybonus_start_date  to $loyaltybonus_end_date" ;

          $variable = PurchaseHistory::where('created_at','>',$loyaltybonus_start_date)
                        ->where('created_at','<=',$loyaltybonus_end_date)
                        ->where('status','=','approved')
                        ->select('user_id',DB::raw('SUM(BV) as BV'))
                        ->having(DB::raw('SUM(BV)'), '>=', $loyalty_bonus_settings->personal_sales)
                        ->groupBY('user_id')
                        ->get();

         
          foreach ($variable as $key => $value) {
            for ($i=0; $i < $loop_limit; $i++) { 
                $index = $i*3*10; 
                $month = date('Y-m-d H:i:00',strtotime("+$index minutes",strtotime($loyaltybonus_date)));
                if (LoyaltyUsers::where('month', '=', $month)->where('user_id', '=', $value->user_id)->exists()) {                    
                       LoyaltyUsers::where('month', '=', $month)
                                    ->where('user_id', '=', $value->user_id)
                                    ->increment('pv',$value->BV);
                }else{
                       LoyaltyUsers::create([
                        'user_id'=>$value->user_id,
                        'pv'=>$value->BV,
                        'month'=>$month
                        ]);
                }
            }               
               
          }

    }

    public function loyaltybonus(){


       // $loyaltybonus_date = date('Y-m-d',strtotime("-1 days"));
       // $loyaltybonus_date = date('Y-m-d H:i:00');

        $loyaltybonus_date = $loyaltybonus_end_date = date('Y-m-d H:i:00');
          $loyaltybonus_start_date = date('Y-m-d H:i:00',strtotime("-10 minutes",strtotime($loyaltybonus_date)));



         echo "   loyalty bonus for   " .$loyaltybonus_date ;
         echo "   <br/>  working now ----" ;

         // die('ssssss');



        $loyalty_bonus = LoyaltyBonus::find(1);
        // $list_users = LoyaltyUsers::where('month','=',$loyaltybonus_date)->get();
        $list_users = LoyaltyUsers::where('month','=',$loyaltybonus_date)->get();

         $loyalty_bonus_settings = LoyaltyBonus::find(1);

        $total_sale = PurchaseHistory::where('created_at','>',$loyaltybonus_start_date)
                                      ->where('created_at','<=',$loyaltybonus_end_date)
                                      ->where('status','=','approved')
                        // ->whereYear('created_at', '=', date('Y',strtotime("-1 days")))
                        // ->whereMonth('created_at', '=', date('m',strtotime("-1 days")))
                        ->sum('BV');

echo "total sale $total_sale" ;
       

          /*loyalty bonus for 2016-06-16 03:26:00 
working now ----total sale 3000.00 monthly_loaylty sale 6000 Completed loyalty bonus*/

          $monthly_loaylty=0;

         
          foreach ($list_users as $key => $value) {
           $monthly_loaylty += $value->pv;
          } 

          echo "   monthly_loaylty  sale $monthly_loaylty" ;
           

        foreach ($list_users as $key => $value) {
 
          $amount = round(( $total_sale *  $loyalty_bonus->bonus_percentage / 100 ) * ($value->pv / $monthly_loaylty),2) ;


// echo "  ---------- $$$$$$$$$   {$value->pv}"  ;
              if($amount){       
                      Commission::create([
                                'user_id'=>$value->user_id ,
                                'from_id'=>$value->user_id ,
                                'total_amount'=> $amount ,
                                'payable_amount'=> $amount ,
                                'payment_type'=>'loyalty_bonus'
                              ]);
                      Commission::updateUserBalance($value->user_id, $amount);

              }
             
        }


        echo " Completed loyalty bonus ";



    }

/* Every month starting minute ..*/
    public function checklastpurchase($id){
       return PurchaseHistory::where('purchase_history.created_at','>',date('Y-m-d H:i:00',strtotime('-10 minutes')))
                                  // ->select('purchase_history.user_id',DB::raw('SUM(BV) as BV'))
                                  ->where('purchase_history.user_id','=',$id)
                                  ->sum('BV');

    }
    public function monthly_maintenance()
    {
        $users = User::where('id','>',1)->get();
        foreach ($users as $key => $value) {
          Sponsortree::where('user_id','=',$value->id)->update(['type'=>'no']);
          Tree_Table::where('user_id','=',$value->id)->update(['type'=>'no']);
          User::where('id','=',$value->id)->update(['monthly_maintenance'=>0]);
        }
        Echo "monthly_maintenance completed <br>"  .date('Y-m-d H:i:00',strtotime('-10 minutes'));
    }

     public function trace_back()
    {

        $users = User::where('id','>',1)->get();
        foreach ($users as $key => $value) {
          Commission::traceBack($value->id);
        }
        
      Echo "trace back completed <br>"  ;
    }

    public function payout()
    {
        
        $variable = Balance::where('balance','>',0)->select('user_id','balance')->get();
        foreach ($variable as $users => $value) {
            Payout::create([
            'user_id'        => $value->user_id,            
            'amount'        => $value->balance,
            'status'   => 'released'
            ]);
             Balance::updateBalance($value->user_id, $value->balance);
        }



        Echo "Payout completed <br>" ;
    }


    

     public function autoresponse()
          {
             $response_date = date('d');
              $body = AutoResponse::where('date','=', $response_date)->select('subject','content')->get();
              $content = DB::table('auto_response')->lists('content');
              $res = AutoResponse::all();
              $users=User::all();
              $email = Emails::find(1) ;


              foreach($body as $bdy)
                          {
                                $content = $bdy->content;
                                $data = ['content' => $content
                                ];
                                
                              Mail::send(['html' => 'emails.autoresponse'],$data, function ($mail)use ($bdy,$email,$users)
                               {
                                 foreach($users as $user)
                                  {
                                      $mail->to($user['email'])->subject($bdy->subject);


                                  }

                              });

                          }
       


                Echo "Mail has been sent successfully" ; 
         }
       

              

             
     






}

