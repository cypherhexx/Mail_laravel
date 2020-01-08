<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommissionType extends Model
{
    //
        use SoftDeletes;

    protected $table = 'commission_type';

    protected $fillable = ['commission_name','status'] ;
}
