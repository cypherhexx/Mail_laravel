<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyRole extends Model
{
    protected $table = 'my_roles' ;
    protected $fillable = ['user_id','role_id'];
}
