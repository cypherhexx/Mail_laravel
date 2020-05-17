<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Crypt;
use DB;
use Auth;
use Html;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsortree extends Model
{
    use SoftDeletes;

    protected $table="sponsortree";  

    public static  $downline=array(); 
    public static  $downlineIDArray=array(); 

    public static  $upline_users=array(); 

    protected $dates = ['deleted_at'];

    protected $fillable=['user_id','sponsor','position','type'];

    public static function createVaccant($user_id,$position){

    	return self::create([
    		'user_id'=>0,
    		'sponsor'=>$user_id,
    		'position'=>$position +1 ,
    		'type'=>'vaccant'
    		]);
    }




     public static function getAllDownlines($root=TRUE , $sponsor=""){

        if ($root) {
             $data= self::where('sponsortree.user_id', $sponsor)
             ->join('users','sponsortree.user_id','=','users.id')
             ->select('sponsortree.id','sponsortree.user_id','sponsortree.type','users.username','users.username as userid')
             ->get();            
        } else {
             $data= self::where('sponsortree.sponsor',$sponsor)->where('type','yes')->orderBy('position','ASC')
             ->join('users','sponsortree.user_id','=','users.id')
             ->select('sponsortree.id','sponsortree.user_id','sponsortree.type','users.username','users.username as userid')
             ->get();           
        }

        foreach ($data as $value) {
          if($value->type=="yes"){  
               self::$downline[$value->id]['user_id'] =$value->userid;
               self::$downline[$value->id]['username'] =$value->username;
               self::$downline[$value->id]['id'] =$value->user_id;
               self::getDownlines(FALSE,$value->user_id);             
             
             
          }else{
              self::$downline[$value->id]['user_id'] =$value->userid;
              self::$downline[$value->id]['username'] =$value->username;
              self::$downline[$value->id]['id'] =$value->user_id;
                        
          }     
      }
      return  1 ;
         

    }


     public static function getDownlines($root=TRUE , $sponsor="" ,$treearray=array(),$level=0){


      $max_level = 2 ;
     

         // if($level == $max_level) {
         //  return  ;
         // }
        if ($root) {
             $data= self::where('sponsortree.user_id', $sponsor)
             ->join('users','sponsortree.user_id','=','users.id')
             ->select('sponsortree.id','sponsortree.user_id','sponsortree.type','users.username','users.username as userid')
             ->get();            
        } else {
             $data= self::where('sponsortree.sponsor',$sponsor)
             ->where('type','!=','vaccant')
             ->orderBy('position','ASC')
             ->join('users','sponsortree.user_id','=','users.id')
             ->select('sponsortree.id','sponsortree.user_id','sponsortree.type','users.username','users.username as userid')
             ->get();           
        }
        foreach ($data as $value) {
          if($value->type =="yes"  || $value->type =="no"){  
               self::$downline[$value->id]['user_id'] =$value->userid;
               self::$downline[$value->id]['username'] =$value->username;
               self::$downline[$value->id]['id'] =$value->user_id;
               self::$downlineIDArray[] =$value->user_id;
               self::getDownlines(FALSE,$value->user_id,$treearray,$level+1);             
          }else{
              self::$downline[$value->id]['user_id'] =$value->userid;
              self::$downline[$value->id]['username'] =$value->username;
              self::$downline[$value->id]['id'] =$value->user_id;
              self::$downlineIDArray[] =$value->user_id;                        
          }     
      }
      return  1 ;
         

    }


     public static function getTree($root=TRUE , $sponsor="" ,$treedata=array(),$level=0){

         if($level == 3) {
          return false ;
         }
            if ($root) {
             $data= self::where('sponsortree.user_id', $sponsor)
                         ->leftJoin('users','sponsortree.user_id','=','users.id')
                         ->leftJoin('point_table','sponsortree.user_id','=','point_table.user_id') 
                         ->leftjoin('profile_infos','profile_infos.user_id','=','sponsortree.user_id')
                         ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
                         ->select('sponsortree.*','users.username','users.name','users.lastname','profile_infos.image','point_table.pv','profile_infos.package', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name','users.active') 
                         ->get();            
             } else {
             $data= self::where('sponsortree.sponsor',$sponsor)
                        ->where('type','!=','vaccant')
                        ->orderBy('position','ASC')
                        ->leftJoin('users','sponsortree.user_id','=','users.id')
                        ->leftJoin('point_table','sponsortree.user_id','=','point_table.user_id')
                        ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
                        ->leftjoin('profile_infos','profile_infos.user_id','=','sponsortree.user_id')
                        ->select('sponsortree.*','users.username','users.name','users.lastname','profile_infos.image','point_table.pv','profile_infos.package', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name','users.active')
                        ->get();           
            }

                $currentuserid = Auth::user()->id;
                $treearray=array();

                foreach ($data as $value) {
                      if($value->type =="yes" || $value->type =="no" ){  
                        $push = SELF::getTree(false, $value->user_id, $treearray, $level + 1);
                        if ($root) {
                            $class = 'up';
                            $usertype = 'root';
                              $user_active_class = 'active';
                        } else {
                            $class='down';
                            $usertype = 'child';

                              if($value['active']=='yes'){                        
                        $user_active_class = 'active';
                    }
                    elseif($value['active']=='no'){
                        $user_active_class = 'inactive';
                    }
                        } 
                        $username         = $value->username;
                        $id               = $value->user_id;
                         $name= $value->name;
                        $lastname= $value->lastname;

                        
                        $accessid         = Crypt::encrypt($value->user_id); 
                        $package_name = Packages::where('id','=',$value->package)->value('package');
                       if($value->package == 1)
                        $package_name='No Track';

                   
                       if($value->rank_name == 'Member')
                        $rank_nm='No Rank';
                       else
                         $rank_nm=$value->rank_name;

                        
                        $content = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('class'=>$class.' tree-user','style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';

                        $coverPhoto = '' . Html::image(route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]), $username, array('class'=>$class.' tree-user','style' => '','data-accessid'=>$accessid)) . '';

                         $count=User::where('id',$value->user_id)->value('dowlinecount'); 
                       
                       $url="userprofiles/".$value->username;
                       $viewprofile=NULL;
                      if(Auth::user()->id==1)
                      $viewprofile="<a href='{$url}'class=btn'>View Profile</a>";

                        $info    = "<div class='hoverouter'>
                                        <div class='hoverinner'>
                                            <div class='coverholder'>
                                              $coverPhoto
                                            </div>
                                            <div class='backgroundgd'>
                                            </div>
                                            <div class='primeinfo' >
                                                <div class='primeinfohold' >
                                                    <div class='ellipsis username'>
                                                        $value->username
                                                    </div>
                                                </div>
                                                <ul class='secondaryinfo'>
                            <li class='rankname'>
                                <span class='key'>Rank</span> :  <span class='value'>$rank_nm</span>
                            </li class='packagename'>    
                              <li class='rankname'>
                                <span class='key'>Total Count</span> :  <span class='value'>$count</span>
                            </li class='packagename'>                         
                            <li>
                                <span class='key'>Track</span> : <span class='value'>$package_name</span>
                            </li>  

                        </ul>
                                            </div>
                                        </div>

                                        <table cellpadding='0' cellspacing='0' class='profcontenttbl' >
                                            <tbody>
                                                <tr>
                                                    <td rowspan='2' valign='top'>
                                                       
                                                            <div class='profpicholder'>
                                                                $content
                                                            </div>
                                                      
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class='pillforholder'></div>
                                        <div class='details'>
             
                
                                        
      
                                        </div>
                                </div>".$viewprofile;

                $className = $user_active_class;
                $treearray[$value->id]['id']      =  $id;
                $treearray[$value->id]['name']      = $name.'&nbsp'.$lastname;
                $treearray[$value->id]['content']   = $content;
                $treearray[$value->id]['accessid']      =  $accessid;
                $treearray[$value->id]['currentuserid'] = $currentuserid;
                $treearray[$value->id]['info']      = $info;
                $treearray[$value->id]['className'] = $className;
                $treearray[$value->id]['usertype'] = $usertype;
                // echo "  <br/> start $value->id  -- " ;
                if (!empty(array_first($push)) || !empty(array_last($push))) {
                    $treearray[$value->id]['children'] = array_values($push);
                } 
            } else { 
                // $placement_accessid = Crypt::encrypt(Sponsortree::where('sponsor',$value->sponsor)->value('id'));                

                // $username      = "<span class='enroll'>Add here</span>";                
                // $content   = "<img class='' data-accessid='$placement_accessid' style='max-width:50px;cursor:pointer;' src='/files/images/users/profile_photos/thumbs/plus.png'>";
                // $info      = "<a href='/add'>Add</a>";
                // $className = "vacant";
                // $treearray[$value->id]['name']      = $username;
                // $treearray[$value->id]['content']   = $content;
                // $treearray[$value->id]['info']      = $info;
                // $treearray[$value->id]['className'] = $className;
                // $treearray[$value->id]['usertype'] = 'server';
                // $treearray[$value->id]['placement_accessid'] = $placement_accessid;
                // // $treearray[$value->id]['placement_username'] = $placement_username;
            }
        }
        $treedata = $treearray;
        return $treedata;
         

    }
    public static function userImage($user_name){
        $image =  DB::table('users')->where('username', $user_name)->pluck('image');
        return $image;
    }

      public static function generateTree($users,$level=0,$tree_structure=""){      
         
         $x = collect(collect($users)->first());
        return $x->toJson();
    }


        public static function getTreeJson($user_id){         

            

          $result_arr=[];
          $result=SELF::where('sponsortree.sponsor','=',$user_id)
                ->where('type','!=','vaccant')
                ->orderBy('position','ASC')
                ->leftJoin('users','sponsortree.user_id','=','users.id')
                ->select('sponsortree.*','users.username')
                ->get();
          foreach ($result as $key => $user) {
            
              $child_count = count(SELF::getMyReferals($user->user_id));
              
              if($child_count){
                  $children=true ;
                  $type="root";
              }else{
                  $type="folder";
                  $children=false ;
              }
             
              $icon="fa fa-user text-success";
              if($user->type == 'yes')
              {
                  
                  $icon="fa fa-user text-warning";
              }elseif ($user->type == 'no') {
                  $icon="fa fa-user text-danger";
              } else {
                 $icon="fa fa-plus-circle text-success";
              }             
              $user->username= (($user->username == null)?  "server"   :  $user->username);

            
            $result_arr[]=array(
              'id'=>Crypt::encrypt($user->user_id),
              'text'=>$user->username,
              'children'=>$children,
              'type'=>$type,
              'file'=>'treedata',
              'icon'=>$icon,
              "state"=> array("opened"=> false)
              );

          }

         return $result_arr;



        }

        public static function getSponsorID($user_id) {


          return self::where('user_id',$user_id)->value('sponsor');

          
        }

        public static function getSponsorUsername($user_id) {


          return self::where('user_id',$user_id)
                      ->join('users','users.id','=','sponsortree.sponsor')
                      ->value('username');

          
        }
public static function profilePhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
         $package = $user->profile_info->package;
        $img=Packages::find($package)->image;
        //if (!Storage::disk('images')->exists($image)){
         //   $image = 'avatar-big.png';
        //}
        // if(!$image){
        //     $image = 'avatar-big.png';
        // }

        return $img;
    }

    public static function coverPhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->cover;
        if (!Storage::disk('images')->exists($image)){
            $image = 'cover.jpg';
        }
        if(!$image){
            $image = 'cover.jpg';
        }
        return $image;
    }

        public static function getMyReferals($user_id) {
           return ProfileInfo::select('profile_infos.*','users.username as username','users.email as email','users.name as name','packages.package as packagename')
                        ->join('users', 'users.id', '=', 'profile_infos.user_id')
                        ->join('sponsortree', 'sponsortree.user_id', '=', 'profile_infos.user_id')
                        ->join('packages','packages.id','=','profile_infos.package')
                        ->where('sponsortree.sponsor',$user_id)
                        ->orderBy('created_at','desc')
                        ->get();
        }



        public static function getNearestGold($user_id){

         $variable =  self::join('users','users.id','=','sponsortree.sponsor')
                ->where('sponsortree.user_id','=',$user_id)
                ->select('sponsortree.*','users.package')
                ->take(1)
                ->get();

                foreach ($variable as $key => $value) {
                    if($value->package  == 4  && ( $value->type == 'yes' || $value->type == 'no')){
                      return $value->sponsor ;
                    }else{
                      return self::getNearestGold($value->sponsor);
                    }
                }

                return 1 ; 
        }

        public static function getAllUpline($user_id , $level = 0 ){ 

          if($level >= 4 )
            return true;

          $result = self::where('sponsortree.user_id',$user_id)
                        ->join('tree_table','tree_table.user_id','=','sponsortree.sponsor')
                        ->join('users','users.id','=','sponsortree.sponsor')
                          ->select('users.package','sponsortree.sponsor','tree_table.type')
                          ->take(1)
                          ->get();

                foreach ($result as $key => $value) {
                  self::$upline_users[]=['user_id'=>$value->sponsor,'type'=>$value->type,'package'=>$value->package];
                  if ($value->sponsor) {
                    self::getAllUpline($value->sponsor,$level++);
                  }
                }

                return true ;

    }


    //RELATIONSHIPS - Added By Aslam
    public function user()
    {
        return $this->belongsTo('App\User');
    }



    

}
