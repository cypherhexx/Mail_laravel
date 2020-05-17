<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use Notifiable;
	protected $table = 'subscribers';

	public $timestamps = true;

    protected $fillable = [
	    'email',	
	    'ip_address',
    ];
    
}
