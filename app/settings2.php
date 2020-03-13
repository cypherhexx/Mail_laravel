<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class settings2 extends Model
{
   use SoftDeletes;

    protected $table = 'settings2' ;

    protected $fillable = ['matrixlevel','percent','cpercent'];
}
