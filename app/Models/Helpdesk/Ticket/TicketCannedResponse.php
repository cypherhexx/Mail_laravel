<?php

namespace App\Models\Helpdesk\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCannedResponse extends Model
{
     use SoftDeletes;
     protected $table = 'ticket_canned_responses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','subject','message'];

    
}
