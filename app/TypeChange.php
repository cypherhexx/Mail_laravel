<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeChange extends Model
{
    use SoftDeletes;

    protected $table = 'type_change';

    protected $fillable = ['user_id','placement','status'];
}
