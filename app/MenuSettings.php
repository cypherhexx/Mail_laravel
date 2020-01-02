<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MenuSettings extends Model
{
    protected $table="menu_settings";
    protected $fillable=['menu_name','status'];
}
