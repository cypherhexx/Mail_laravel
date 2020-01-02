<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emailsetting extends Model
{
     protected $table="email_setting";

     protected $fillable=['username','password','incoming_server','incomig_port','outgoing_server','outgoing_port'];
}


  