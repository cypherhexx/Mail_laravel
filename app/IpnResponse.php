<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpnResponse extends Model
{
    protected $table="ipn_response";

     protected $fillable=['response'];
}
