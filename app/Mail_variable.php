<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mail_variable extends Model
{
    protected $table = 'mail_variable' ;

    protected $fillable = ['var_name','comment','mail_type'] ;

}
