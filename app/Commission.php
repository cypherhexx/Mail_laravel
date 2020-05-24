<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Commission extends Model
{
     

    use SoftDeletes;

    protected $table = 'commission';

    protected $fillable = ['user_id', 'from_id','total_amount','tds','service_charge','payable_amount','payment_type','payment_status','matrix','level_percent','rankgain','category','package'];


    public  function sponsorcommission($sponsor_id,$from_id){

         $settings = Settings::getSettings();    

         $sponsor_commisions = $settings[0]->sponsor_Commisions;

         $tds = $sponsor_commisions * $settings[0]->tds / 100;
         /**
         * calcuate service charge
         * @var [type]
         */
         $service_charge = $sponsor_commisions * $settings[0]->service_charge / 100;
         /**
         * Calculates payable amount
         * @var [type]
         */
         $payable_amount = $sponsor_commisions - $tds - $service_charge;
         /**
         * Creates entry for user in commission table and set payment status to yes
         * @var [type]
         */
         $commision = SELF::create([
                'user_id'        => $sponsor_id,
                'from_id'        => $from_id,
                'total_amount'   => $sponsor_commisions,
                'tds'            => $tds,
                'service_charge' => $service_charge,
                'payable_amount' => $payable_amount,
                'payment_type'   => 'sponsor_commision',
                'payment_status' => 'Yes',
          ]);
          /**
          * updates the userbalance
          */
          User::upadteUserBalance($sponsor_id, $payable_amount);




    }
    public static function binaryCommission($from_id, $placement_id, $total_amount, $amount_payable, $tds, $service_charge){
        
         $res = SELF::create([
                'user_id'=>$placement_id,
                'from_id'=>$from_id,
                'total_amount'=>$total_amount,
                'tds'=>$tds,
                'service_charge'=>$service_charge,
                'payable_amount'=>$amount_payable,
                'payment_type'=>'binary',
                ]);
        
         $user_type = self::checkUserType($placement_id);
         if($user_type == "user"){
             SELF::updateUserBalance($placement_id,$amount_payable);
             $placement_id = SELF::getUplineId($placement_id);
             SELF::binaryCommission($from_id, $placement_id, $total_amount, $amount_payable, $tds, $service_charge);
         }
   }

   public static function getUplineId($user_id){
         return DB::table('tree_table')->where('user_id', $user_id)->pluck('placement_id');
   }

   
   public static function updateUserBalance($user_id, $amount){

      return    Balance::where('user_id', $user_id)->increment('balance',$amount);

   }

  
 



}

