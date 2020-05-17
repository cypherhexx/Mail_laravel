<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autoresponder extends Model
{
    use SoftDeletes;

    protected $table = ['email_marketing_autoresponders'] ;

    protected $fillable = ['title','campaign','contact','content','unique_clicks','total_clicks','days','hours','status'];
}
