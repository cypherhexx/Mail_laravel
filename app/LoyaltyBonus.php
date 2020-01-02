<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyBonus extends Model
{
    //

    use SoftDeletes ;

    protected $table = 'loyalty_bonus' ;

    protected $fillable = ['personal_sales','bonus_duration','bonus_percentage'];
}
