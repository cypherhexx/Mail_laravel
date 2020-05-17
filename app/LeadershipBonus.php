<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadershipBonus extends Model
{
    
    use SoftDeletes;

    protected $table = 'leader_ship';

    protected $fillable = ['package_id','level_1','level_2','level_3'] ; 



    public static function allocateCommission($from_id,$user_id,$amount,$level=1){

        $level_bonus = [1 =>5,2=>4,3=>3] ;

            $package_id  =ProfileInfo::where('user_id','=',$user_id)->value('package');
    		  $column = 'level_'.$level ;
    		  $bonus_percent = $level_bonus[$level] ;//self::where('package_id',$package_id)->value("$column");
 
            // dd($bonus_percent );
    		 if($bonus_percent){
    		  	$total_amount = $amount *$bonus_percent/100 ;

                 $settings = Settings::getSettings();  
                 $sponsor_commisions =7;// $settings[0]->sponsor_Commisions;
                 $tds = $total_amount * $settings[0]->tds / 100;
                 $service_charge = $total_amount * $settings[0]->service_charge / 100;
                 $payable_amount = $total_amount - $tds - $service_charge;

                Commission::create([
                        'user_id'=>$user_id,
                        'from_id'=>$from_id,
                        'total_amount'=>$total_amount ,
                        'tds'            => $tds,
                        'service_charge' => $service_charge,
                        'payable_amount'=>$payable_amount ,
                        'payment_type'=>'Indirect_fast_start',
                        ]);
                Balance::where('user_id',$user_id)->increment('balance',$payable_amount);
                $sponsor_id = Sponsortree::where('user_id',$user_id)->value('sponsor');

                if($level <= 2 && $sponsor_id > 0){
                    return self::allocateCommission($from_id,$sponsor_id,$amount,++$level);
                }
            }
            return ;
        }
}
