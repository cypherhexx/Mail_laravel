<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyUsers extends Model
{
    //

	use SoftDeletes ; 

    protected $table = 'loyalty_users' ;

    protected $fillable = ['user_id','month','pv'] ;


   

}
