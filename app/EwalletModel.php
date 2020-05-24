<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class EwalletModel extends Model
{
    //
    public static function getTotalbalance($user_id){
        return DB::table('user_balance')->where('user_id', $user_id)->pluck('balance');
    }
}
