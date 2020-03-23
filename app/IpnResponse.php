<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpnResponse extends Model
{
    protected $table="ipn_response";

     protected $fillable=['payment_id','package_id','user_id','payment_cycle','payment_date','next_payment_date','initial_payment_amount','amount_per_cycle','payment_status','response'];
}
