<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;

class VoucherHistory extends Model
{
    protected $table = 'voucher_history';
    protected $fillable = ['voucher_id','used_by','used_for','used_amount'];

}
