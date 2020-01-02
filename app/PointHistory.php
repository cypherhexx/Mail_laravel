<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{
    

    protected $table = 'point_history';


    protected $fillable = ['user_id','from_id','pv','leg','commision_type'] ;



    public static function addPointHistoryTable($user_id,$from_id,$pv,$leg,$commision_type){


		return  self::create([
			    'user_id'=>$user_id,
			    'from_id'=>$from_id,
			    'pv'=>$pv,
			    'leg'=>$leg,
			    'commision_type'=>$commision_type,
			]);
    }






}
