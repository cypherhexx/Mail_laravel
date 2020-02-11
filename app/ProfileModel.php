<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProfileModel extends Model
{
     use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'profile_infos';

    protected $fillable = ['user_id','dateofbirth','address1','address2','gender','city','location','occupation','country','state','zip','image','mobile','passport','skype','twitter','facebook','gplus','linkedin','whatsapp','wechat','about','package','currency','account_number','account_holder_name','swift','sort_code','bank_code','paypal','profile','cover','bank_address','bank_name'];


}
