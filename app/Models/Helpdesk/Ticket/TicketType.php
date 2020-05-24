<?php

namespace App\Models\Helpdesk\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketType extends Model
{
   use SoftDeletes;

     protected $table = 'ticket_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'id', 'name', 'description','status','color', 'ispublic','is_default','admin_note', 'created_at', 'updated_at',
    ];


    public function ticket()
    {
        return $this->belongsToMany('App\Models\Helpdesk\Ticket\Ticket');
    }


    
}
