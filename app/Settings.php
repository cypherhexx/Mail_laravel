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

public static function upadteMatrix()
{
        DB::table('settings')->where('user_id',$user_id)->increment('matrix');

   }

   public static function upadteTrader()
{
        DB::table('settings')->where('user_id',$user_id)->increment('trader');

   }
   public static function upadtestar()
{
        DB::table('settings')->where('user_id',$user_id)->increment('star');

   }

   public static function upadtesuperstar()
{
        DB::table('settings')->where('user_id',$user_id)->increment('superstar');

   }
   }