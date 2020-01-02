<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseHistory extends Model
{
    //
	use SoftDeletes ; 

    protected $table = 'purchase_history' ;

    protected $fillable = ['user_id','package_id','count','total_amount','pv','pay_by','purchase_user_id','sales_status','rs_balance','created_at','datas'] ;

    public static function getMonthlyTotal($id,$date){

    		return  self::whereYear('purchase_history.created_at','=',date('Y',strtotime($date)))
                        ->whereMonth('purchase_history.created_at','=',date('m',strtotime($date)))
                        ->where('purchase_history.status','=','approved')
                        ->where('purchase_history.user_id','=',$id)
                        ->sum('BV');
    }



    //RELATIONSHIPS - Added By Aslam
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function package()
    {
        return $this->hasOne('App\Packages','id','package_id');
    }


}
