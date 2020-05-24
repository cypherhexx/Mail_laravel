<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CategoryHistory extends Model
{
     protected $table="category_history";

    protected $fillable=["user_id","category_id","category_updated","remarks"];
}
