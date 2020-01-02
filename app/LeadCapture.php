<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadCapture extends Model
{

	use SoftDeletes;

   	 protected $table="lead_capture";

     protected $fillable=['username','name','email','mobile'];
     
}
