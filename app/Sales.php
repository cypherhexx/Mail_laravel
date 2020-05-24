<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    
     use SoftDeletes;

     protected $table = 'sales' ;

     protected $fillable = ['user_id','sale_id','amount','description','type','status','redeem_pv','pv','pay_by','master'] ;


     public static function addToSales($user_id,$product_id,$count){
	
     	          $user_info   = User::find($user_id);

     		     $product = 	Products::find($product_id);

                    $amount = $product->member_amount * $count ; 
     			
                    $pv = $product->pv * $count ; 

                    $pv = $product->pv * $count ; 

     			$description = " {$user_info->username} purchased {$product->product}" ;

                 

                    
     		    		

	     	self::create([
	     		'user_id'=>$user_id,
	     		'amount'=>$amount,
	     		'description'=>$description,
                    'type'=>'purchased',
                    'redeem_pv'=>$pv,
                    'pv'=>$pv,
                    'master'=>1,
                    'pay_by'=>'cash',
	     		'sale_id'=>$user_id,
	     	]);


     }
}
