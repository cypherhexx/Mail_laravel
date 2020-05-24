<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Level extends Model
{
     use SoftDeletes;


    protected $table = 'level' ;


    protected $fillable = ['level','bonus','extra_bonus'] ;
}
