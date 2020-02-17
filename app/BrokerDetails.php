<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrokerDetails extends Model
{
     use SoftDeletes;

    protected $table = 'broker_details';

    protected $fillable = ['name', 'url','status'];
}
