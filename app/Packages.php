<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model
{
    //

    use SoftDeletes;

    protected $table = 'packages' ;

    protected $fillable = ['package','pv','rs','amount','code'];

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
