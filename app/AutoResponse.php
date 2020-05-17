<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutoResponse extends Model
{

	use SoftDeletes;

	
     protected $table="auto_response";

    protected $fillable=["subject","content","date"];
}
