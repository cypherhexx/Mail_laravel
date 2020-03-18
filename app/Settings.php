<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
   protected $table = 'settings';

   public static function getSettings(){
   	return DB::table('settings')->get();
   }
}
