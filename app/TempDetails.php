<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempDetails extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $table = 'temp_details' ;

    protected $fillable = ['regdetails','paystatus','token'];

}
