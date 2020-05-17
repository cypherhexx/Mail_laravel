<?php
namespace App;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProfileInfo extends Model 
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'profile_infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','dateofbirth','address1','address2','gender','city','location','occupation','country','state','zip','image','mobile','passport','skype','twitter','facebook','gplus','linkedin','whatsapp','wechat','about','package','currency','account_number','account_holder_name','swift','sort_code','bank_code','paypal','profile','cover','bank_address','bank_name','iban','bank_country','branch_count'];


    public static function getNewUsers(){
        $user_type = self::checkUserType(Auth::user()->id);
        $admin_flag = 0;
        if($user_type == 'admin')
        // $new_users = DB::table('users')->where('admin', $admin_flag)->orderBy('created_at', 'desc')->limit(8)->get();

        $new_users = DB::table('users')
         ->join('profile_infos', 'users.id', '=', 'profile_infos.user_id')
         ->select('users.*', 'profile_infos.image')
         ->get(); 

        else{
          $new_users = DB::table('users')->join('tree_table', 'tree_table.user_id', '=', 'users.id')->where('tree_table.sponsor', '=', Auth::user()->id)->limit(8)->get();
        }
        //print_r($new_users);die();
        $loop = count($new_users);
        for($i = 0;$i < $loop;$i ++){
          //echo $new_users[$i]->country;die();
         $new_users[$i]->country_name = self::getCitizen($new_users[$i]->country);
        }
        return $new_users;
   }

    public static function checkUserType($user_id){
         $type_id = DB::table('users')->where('id', $user_id)->pluck('admin');
         if($type_id == 1)
              return "admin";
          else
            return "user";
   }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function package_detail()
    {
        return $this->belongsTo('App\Packages','package', 'id');
    }

     public function images()
    {
        return $this->hasMany('App\Image','author', 'user_id');
    }

 



}
