<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    protected $table = 'app_settings';

     protected $fillable = ['email_address','company_name','company_address','logo','logo_ico','theme','currency','site_mode'];
}
