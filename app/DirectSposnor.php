<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectSposnor extends Model
{
    //
    use SoftDeletes;

    protected $table = 'direct_sponsor_bonus';

    protected $fillable = ['package_id','pv','rs'] ;
}
