<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
      use SoftDeletes;

    protected $table = 'news' ;

    protected $fillable = ['title','description','image'];
}
