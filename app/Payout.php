<?php

namespace App;
use DB;
//use Balance;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    //
    protected $table = 'payout_request';

    protected $fillable = ['user_id', 'amount','status','2005-12-1','2005-12-1','released_amount','req_amount'];

    public static function getMyPayoutRequests(){
        $user_id = Auth::id();
        return DB::table('payout_request')->where('user_id', $user_id)->get();
    }
     public static function getMyTotalPayout($user_id){    	 
    	return SELF::where('user_id', $user_id)->sum('amount');
    }
    public static function getUserPayoutDetails(){
    	$request_array = array();
    	$request_array['request'] = 0;
    	$request_array['released'] = 0;
    	$user_id = Auth::id();
    	$requests = DB::table('payout_request')->where('user_id', $user_id)->get();
    	//print_r($requests[0]->status);die();
    	$num_requests = count($requests);
    	for($i = 0; $i < $num_requests; $i++){
    		if($requests[0]->status == 'pending'){
    			$request_array['request'] += $requests[0]->amount;
    		}
    		else{
    			$request_array['released'] += $requests[0]->amount;
    		}
    	}
    	$balance = Balance::getTotalBalance(Auth::user()->id);

        // dd($balance);

    	$request_array['balance'] = $balance + $request_array['request'];
        $request_array['per_balance'] = 0;
        $request_array['per_released'] = 0;
        if($request_array['balance'] > 0){
            $request_array['per_balance'] = ($request_array['balance'] * 100)/($request_array['balance']+$request_array['released']);
            $request_array['per_released'] = ($request_array['released'] * 100)/($request_array['balance']+$request_array['released']);
    	}
        $request = $request_array['per_released'].",".$request_array['per_balance'];
    	return $request;
    }
    public static function confirmPayoutRequest($req_id,$amount,$released){
        
        return DB::table('payout_request')
            ->where('id', $req_id)
            ->update(array('status' => 'released','amount'=>$amount,'released_amount' => $released));
    }
    public static function deletePayoutRequest($pay_reqid){
        
        self::getPayoutDatas($pay_reqid);
        return DB::table('payout_request')->where('id', '=', $pay_reqid)->delete();
    }
    public static function getPayoutDatas($pay_reqid){
        $requests = DB::table('payout_request')->where('id', $pay_reqid)->get();
        $user_id = $requests[0]->user_id;
        $amount = $requests[0]->amount;
        $balance = Balance::getTotalBalance($user_id);
        self::balanceUpdate($user_id,$amount,$balance);
    }
    public static function balanceUpdate($user_id,$amount,$balance){
        return DB::table('user_balance')
            ->where('user_id', $user_id)
            ->update(array('balance' => $amount+$balance));
    }
    public static function getPayoutAllDetails(){
        $index = 0;
        $all_payout = DB::table('payout_request')->orderBy('created_at','desc')->take(5)->get();//print_r($all_payout);die();
        foreach($all_payout as $payout){
            $all_payout[$index]->user_name = User::userIdToName($payout->user_id);
            $index ++;
        }
        return $all_payout;
    }
    public static function getPayoutPercentage(){
        $total_amount = DB::table('payout_request')->sum('amount');
        $total_released_amount = DB::table('payout_request')->where('status','released')->sum('amount');
        $per_amount = 0;
        if($total_amount > 0)
        $per_amount = ($total_released_amount/$total_amount)*100;
        return $per_amount;
    }
}
