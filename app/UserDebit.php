<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDebit extends Model
{
    

    use SoftDeletes;


    protected $table = 'user_debit';

    protected $guarded = ['delted_at'] ;
}
