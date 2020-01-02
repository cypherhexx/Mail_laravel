<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Activity extends Model
{
    use SoftDeletes;
    protected $table = 'activity_log';
    protected $fillable = ['user_id','title','description'];
    
    public static function add($title,$description,$user_id=""){

    	//Activity::add('test title','test description');
    	//
		if($user_id==""){
			$user_id = Auth::id();
		}
		self::create([
    		'user_id'=>$user_id,
    		'title'=>$title,
    		'description'=>$description,
		]);
   	}

    public static function deleteById($id){
		self::destroy($id);
   	}
    
    public static function deleteByUserId($user_id){
		self::where('user_id',$user_id);		
   	}
   

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
