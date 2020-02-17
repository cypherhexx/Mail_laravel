<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBrokerDetails extends Model
{
     use SoftDeletes;

    protected $table = 'user_broker_details';

    protected $fillable = ['broker_id', 'account','password','status','user_id'];
}
