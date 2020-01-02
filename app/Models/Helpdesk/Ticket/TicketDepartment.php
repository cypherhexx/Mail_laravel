<?php

namespace App\Models\Helpdesk\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketDepartment extends Model
{
     use SoftDeletes;
     protected $table = 'ticket_departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];

    public function ticket()
    {
        return $this->belongsToMany('App\Models\Helpdesk\Ticket\Ticket');
    }


}
