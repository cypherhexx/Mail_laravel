<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RsHistory extends Model
{
    //
    use SoftDeletes;

    protected $table = 'rs_history';

    protected $fillable = ['user_id','from_id','rs_debit','rs_credit'] ;

    
}
