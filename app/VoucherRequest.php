<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class VoucherRequest extends Model
{
     protected $table = 'voucher_request';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','amount', 'count','total_amount','status','sponsor','2005-12-1','2005-12-1'];
}
