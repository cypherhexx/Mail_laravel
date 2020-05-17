<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class TicketReply extends Model
{
    use SoftDeletes;

     protected $table = 'ticket_replies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','ticket_id','title','body'];

    
    public function userR()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
