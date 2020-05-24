<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
      protected $table = 'user_balance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['user_id','balance'];

      public static function getTotalBalance($user_id){
    	return DB::table('user_balance')->where('user_id', $user_id)->value('balance');
    }
    public static function updateBalance($user_id,$amount){
        $total_balance = Self::getTotalBalance($user_id);
        $update_amount = $total_balance - $amount;
        DB::table('user_balance')
            ->where('user_id', $user_id)
            ->update(['balance' => $update_amount]);
    }
}
