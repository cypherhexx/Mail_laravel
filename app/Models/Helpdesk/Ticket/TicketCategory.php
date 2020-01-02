<?php

namespace App\Models\Helpdesk\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{

	use SoftDeletes;

     protected $table = 'ticket_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category','description'];


    public function ticket()
    {
        return $this->belongsToMany('App\Models\Helpdesk\Ticket\Ticket');
    }

    
}
