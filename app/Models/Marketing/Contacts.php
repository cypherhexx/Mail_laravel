<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
		
		use SoftDeletes ;

		protected $table = 'email_marketing_contacts';


		protected $fillable = ['email','firstname','lastname','address','group_id','mobile'];
}
