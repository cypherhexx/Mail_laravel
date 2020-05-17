<?php namespace App\Models\Helpdesk\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
  use SoftDeletes;

     protected $table = 'tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','subject','description','status','priority','type','category'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at','reopened_at','duedate','closed_at','last_message_at','last_response_at'];


    public function userR()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function statusR()
    {
        return $this->hasOne('App\Models\Helpdesk\Ticket\TicketStatus','id','status');
    }

    
    public function priorityR()
    {
        return $this->hasOne('App\Models\Helpdesk\Ticket\TicketPriority','id','priority');
    }

    public function categoryR()
    {
        return $this->hasOne('App\Models\Helpdesk\Ticket\TicketCategory','id','category');
    }

    public function departmentR()
    {
        return $this->hasOne('App\Models\Helpdesk\Ticket\TicketDepartment','id','department');
    }

    public function typeR()
    {
        return $this->hasOne('App\Models\Helpdesk\Ticket\TicketType','id','type');
    }



}
