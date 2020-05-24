<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PairingHistory extends Model
{
    

    use SoftDeletes;

    protected $table = 'pairing_history';


    protected $fillable = ['user_id','left_carry','right_carry','pairing_carry','percent','amount'];
}
