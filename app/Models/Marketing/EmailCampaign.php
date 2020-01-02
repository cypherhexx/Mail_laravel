<?php

namespace App\Models\Marketing; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailCampaign extends Model
{
	
	use SoftDeletes;    

	protected $table = 'email_marketing_campaigns' ;

	protected $fillable =['name','customer_group','first_name','last_name','from_email','subject','datetime','campaign-email'];
}
