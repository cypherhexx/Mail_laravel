<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{

     protected $table="welcomeemail";

     protected $fillable=['to_email','subject','body'];
}
