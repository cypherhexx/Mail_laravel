<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debit extends Model
{
    use SoftDeletes;


    protected $table = 'debit_table';

    protected $fillable = ['user_id', 'to_userid','total_amount','tds','service_charge','payable_amount','payment_type','payment_status'];
}
