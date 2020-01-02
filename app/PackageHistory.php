<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageHistory extends Model
{
     use SoftDeletes;


     protected $table = 'package_history' ;

     protected $fillable = ['user_id','package_id','new_package_id'] ;
}
