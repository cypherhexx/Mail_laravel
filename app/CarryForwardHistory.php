<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarryForwardHistory extends Model
{
    use SoftDeletes;


    protected $table = 'carry_forward_history' ;

    protected $fillable = ['user_id','total_left','total_right','left','right'] ;
}
