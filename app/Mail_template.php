<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mail_template extends Model
{
    protected $table = 'mail_template' ;

    protected $fillable = ['text','subject'] ;


}
