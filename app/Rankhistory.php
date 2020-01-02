<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rankhistory extends Model
{
    protected $table="rank_history";

    protected $fillable=["user_id","rank_id","rank_updated","remarks"];
    
}
