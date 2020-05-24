<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Codes extends Model
{

	use SoftDeletes;

	protected $table = 'codes' ;

	protected $fillable =['user_id','email','identification','status'] ;
	
}
