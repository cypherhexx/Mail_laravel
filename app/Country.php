<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

     public static function getCountry(){
          $countries = Self::all();
        return $countries;
   }
   
}
