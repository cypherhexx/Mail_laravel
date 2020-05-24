<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaypalDetails extends Model
{
     use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'paypal_details' ;

    protected $fillable = ['regdetails','paystatus','token'];
}
