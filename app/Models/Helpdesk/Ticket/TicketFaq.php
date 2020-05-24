<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TicketFaq extends Model
{
   use SoftDeletes;

     protected $table = 'ticket_faqs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['faq','description'];

}
