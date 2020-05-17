<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class welcomeemail extends Model
{
     protected $table="welcomeemail";

     protected $fillable=['from','subject','body'];
}
