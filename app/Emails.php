<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emails extends Model
{
    use SoftDeletes;

    protected $table = 'emails' ;

    protected $fillable = ['from_email','from_name','subject','type','content'] ;
}
