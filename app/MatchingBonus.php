<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchingBonus extends Model
{
    //
    use SoftDeletes;


    protected $table = 'matching_bonus' ;


    protected $fillable = ['package_id','pv',] ;

    
}
