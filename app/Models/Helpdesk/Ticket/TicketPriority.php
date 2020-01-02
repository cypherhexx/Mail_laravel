<?php

namespace App\Models\Helpdesk\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketPriority extends Model
{
   use SoftDeletes;

     protected $table = 'ticket_priorities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'id', 'priority', 'status', 'user_priority_status', 'priority_desc', 'priority_color', 'priority_urgency', 'ispublic','admin_note', 'created_at', 'updated_at',
    ];


    public function ticket()
    {
        return $this->belongsToMany('App\Models\Helpdesk\Ticket\Ticket');
    }


    
}
