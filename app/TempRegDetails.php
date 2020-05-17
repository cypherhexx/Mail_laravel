<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempRegDetails extends Model
{
    //
      use SoftDeletes;

    protected $table = 'temp_reg_details' ;

    protected $fillable = ['regdetails','paystatus'];
}
