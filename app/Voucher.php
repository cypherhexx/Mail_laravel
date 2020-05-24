<?php

namespace App;
use DB;
use Auth;
use Response;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','voucher_code','total_amount','balance_amount','2005-12-1','2005-12-1'];

    public static function getAllVouchers(){
       $user_id = Auth::user()->id;
       $all_vouchers =  DB::table('vouchers')->where('user_id', $user_id)->get();
       return $all_vouchers;
    }

    public static function getEpinAmount($epin_id){
      return DB::table('vouchers')->where('voucher_code', $epin_id)->pluck('total_amount');
    }

    
    public static function updateVoucherBalance($epin_id,$amount){
        $total_balance = Self::getEpinAmount($epin_id);
        $update_amount = $total_balance - $amount;         ;
        DB::table('vouchers')
            ->where('voucher_code', $epin_id)
            ->update(['balance_amount' => $update_amount]);
    }
    public static function perVoucher(){
        $total_amount = DB::table('voucher_request')->sum('amount');
        $total_released_amount = DB::table('payout_request')->where('status','released')->sum('amount');
        $per_amount = 0;
        if($total_amount>0)
        $per_amount = ($total_released_amount/$total_amount)*100;
        return $per_amount;
    }

    /*AJAX validation for Authenticated users  to use voucher */
     public static function getVoucher($voucher){
        $voucher_detail = SELF::where('voucher_code', $voucher)->where('balance_amount','>',0)->first(); 

        if($voucher_detail){
            return Response::json($voucher_detail);
        }else{
             return Response::json(['error'=>'voucher code not available']);
        }


    }
}
