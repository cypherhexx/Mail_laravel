<?php

namespace App;

use DB;
use Html;
use Auth;
use Crypt;
use Storage;

use Illuminate\Database\Eloquent\Model;

class Tree_Table extends Model
{
 
    public static $downline_users   = array();
    public static $downline_id_list = array();

    public static $upline_users    = array();
    public static $upline_id_list  = array();

    public static $MODEL_NOT_FOUND = '-1';

    protected $table = 'tree_table';

    protected $fillable = ['user_id', 'sponsor', 'placement_id', 'leg','type','level'];

    public static function getmaxid()
    {
        $users = DB::table('users')->max('user_id');
        return $users;
    }
    public static function getSponsorName($user_id)
    {
        return $sponsor_id = DB::table('tree_table')->where('user_id', $user_id)->value('sponsor');
    }


     public static function gettreePlacementId($sponsor_id,$level =1 )
    {


        if($level ==1 ){
            $down_line = Tree_Table::whereIn('placement_id',$sponsor_id)->where('type','vaccant')->orderBy('leg')->first();

             if($down_line){
                return $down_line->id;
            }else{
                $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->orderBy('leg')->pluck('user_id');
                return self::gettreePlacementId($sponsor_list,2);
            }
        }else{
            // dd($sponsor_id); 

            $down_line = Tree_Table::whereIn('placement_id',$sponsor_id)
                                    ->select('placement_id','leg',DB::raw('COUNT(`placement_id`) as CNT'))
                                    ->where('user_id','=',0)
                                    ->groupBy('placement_id')
                                    ->orderby('leg')
                                    ->get();

                                    // print_r($down_line->toArray()) ;
            if($down_line->count() ==0 ){
                 $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->orderBy('leg')->pluck('user_id');
                return self::gettreePlacementId($sponsor_list,++$level);
            }else{
                

                // dd($down_line->toArray());
                 $placement = $down_line[0]->placement_id ; 
                // echo  "  ...  " ;
                  $cnt = $down_line[0]->CNT ;

                foreach ($down_line as $key => $value) {
                             echo "</br> " .$value->placement_id .'   ... ' . $value->CNT ;
                     if($cnt < $value->CNT){

                        echo " replace value here " ;
                        $placement = $value->placement_id;
                        $cnt = $value->CNT;
                     }

                }



                // dd($placement);
                return $down_line = Tree_Table::where('placement_id',$placement)
                                            ->where('type','vaccant')
                                            ->orderby('leg')
                                            ->first()
                                            ->id; 

                    // dd($down_line) ;

            }



        }
      

    }

    //  public static function gettreePlacementId($sponsor_id)
    // {
     
    //    // $id =Tree_Table::where("type","=","vaccant")->whereIn('placement_id',$sponsor_id)->where('user_id','=',0)->value('placement_id');
    //     $id=Tree_Table::where("type","=","vaccant")->whereIn('placement_id',$sponsor_id)->orderBy('count','ASC')->where('user_id','=',0)->value('placement_id');
    //    echo "placement".$id."<br>";
    //    if(!isset($id)){   
    //        // $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->where("type","<>","vaccant")->value('user_id');
    //         $sponsor_list = Tree_Table::whereIn('placement_id',$sponsor_id)->where('user_id','!=',0)->orderBy('count','ASC')->pluck('user_id');
    //   print_r($sponsor_list);
    //   echo "<br>";
    //    return self::gettreePlacementId($sponsor_list);
           
    //   }

    //    return $id;         

    // }





    public static function vaccantId($placement_id)
    {

        $data = self::where('placement_id', $placement_id)->where("type", "=", "vaccant")->value('id');

        return $data;

    }


     public static function createVaccant($placement_id,$leg){
        $leg = $leg * 3 ;
        Tree_Table::create([
                'sponsor'      => 0,
                'user_id'      => '0',
                'placement_id' => $placement_id,
                'leg'          => $leg - 2,
                'type'         => 'vaccant',
            ]);

            Tree_Table::create([
                'sponsor'      => 0,
                'user_id'      => '0',
                'placement_id' => $placement_id,
                'leg'          => $leg - 1,
                'type'         => 'vaccant',
            ]);

             Tree_Table::create([
                'sponsor'      => 0,
                'user_id'      => '0',
                'placement_id' => $placement_id,
                'leg'          => $leg,
                'type'         => 'vaccant',
            ]);


    }

    // public static function createVaccant($placement_id)
    // {

    // Tree_Table::create([
    //         'sponsor'      => 0,
    //         'user_id'      => '0',
    //         'placement_id' => $placement_id,
    //         'leg'          => '1',
    //         'type'         => 'vaccant',
    //     ]);

    //     Tree_Table::create([
    //         'sponsor'      => 0,
    //         'user_id'      => '0',
    //         'placement_id' => $placement_id,
    //         'leg'          => '2',
    //         'type'         => 'vaccant',
    //     ]);

    //      Tree_Table::create([
    //         'sponsor'      => 0,
    //         'user_id'      => '0',
    //         'placement_id' => $placement_id,
    //         'leg'          => '3',
    //         'type'         => 'vaccant',
    //     ]);

    // }
    public static function takeUserId($user_name)
    {
        return DB::table('users')->where('username', $user_name)->value('id');
    }


    public static function getTree($root = true, $placement_id = "", $treedata = array(), $level = 0, $levellimit)
    {


        if ($level == $levellimit) {
            return false;
        } 
        if ($root) {
            $data = self::where('tree_table.user_id', $placement_id)
                ->leftJoin('users', 'tree_table.user_id', '=', 'users.id')
                ->leftJoin('profile_infos', 'profile_infos.user_id', '=', 'tree_table.user_id')
                ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
                ->leftJoin('point_table', 'point_table.user_id', '=', 'tree_table.user_id')
                ->select('tree_table.*', 'users.username','users.name','users.lastname', 'users.active','profile_infos.image','profile_infos.package', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name')
                ->get();
        } else {
            $data = self::where('placement_id', $placement_id)->orderBy('leg', 'ASC')
                ->leftJoin('users', 'tree_table.user_id', '=', 'users.id')
                ->leftJoin('profile_infos', 'profile_infos.user_id', '=', 'tree_table.user_id')
                ->leftJoin('rank_setting', 'rank_setting.id', '=', 'users.rank_id')
                ->leftJoin('point_table', 'point_table.user_id', '=', 'tree_table.user_id')
                ->select('tree_table.*', 'users.username','users.name','users.lastname','users.active', 'profile_infos.image','profile_infos.package', 'point_table.left_carry', 'point_table.right_carry', 'point_table.total_left', 'point_table.total_right', 'rank_setting.rank_name')
                ->get();
        }

        $currentuserid = Auth::user()->id;
        $treearray = [];
        // print_r($data);
        foreach ($data as $key => $value) {
            if ($value->type == "yes" || $value->type == "no") {
                if ($root) {
                    $push = self::getTree(false, $value->user_id, $treearray, $level + 1,$levellimit);
                    $class = 'up';
                    $usertype = 'root';
                    $user_active_class = 'active';
                } else {
                    $push = self::getTree(false, $value->user_id, $treearray, $level + 1,$levellimit);
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
                $name= $value->name;
                $lastname= $value->lastname;
                $id         = $value->user_id;
                $accessid         = Crypt::encrypt($value->user_id);

                // $package_id   = Profileinfo::where('user_id', $value->user_id)->value('package');

                   $package_name = Packages::where('id','=',$value->package)->value('package');
                   if($value->package == 1)
                    $package_name='No Track';

               
                   if($value->rank_name == 'Member')
                    $rank_nm='No Rank';
                else
                    $rank_nm=$value->rank_name;

                // echo "  ---  $value->username   --- $value->package  ,   </br>";
                // $content = '' . Html::image('http://randomuser.me/api/portraits/men/'.$imgname.'.jpg', $username, array('class'=>$class.' tree-user','style' => 'max-width:50px;cursor:pointer;','data-accessid'=>$accessid)) . '';
                $content = '' . Html::image(route('imagecache', ['template' => 'original', 'filename' => self::profilePhoto($username)]), $username, array('class'=>$class.' tree-user','style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';
                // $content = 'aa';

                $coverPhoto = '' . Html::image(route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]), $username, array('class'=>$class.' tree-user','style' => '','data-accessid'=>$accessid)) . '';

                 Tree_Table::$downline_id_list =[];
                 $data=Tree_Table::getDownlineCount($value->user_id);

        
                 /*downline user count */
                $count=User::where('id',$value->user_id)->value('dowlinecount');  

                $sponsorid = Sponsortree::where('user_id',$value->user_id)->value('sponsor');

                $sponsor_name = User::where('id',$sponsorid)->value('username');



                $url="userprofiles/".$value->username;


                $viewprofile=NULL;
                if(Auth::user()->id==1)
                $viewprofile="<a href='{$url}'class=btn'>View Profile</a>";

                $info    = "
                <div class='hoverouter'>
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
                            <li>
                                <span class='key'>Sponsor</span> : <span class='value'>$sponsor_name</span>
                            </li>
                           <!-- <li class='topupcount'>
                            <span class='key'>Top Ups</span> : <span class='value'>".PurchaseHistory::where('user_id', '=', $value->user_id)->sum('count')."</span>
                          </li>-->
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
                <div class='pillforholder'>
                </div>
                <div class='details'>
             
                
               
      
                </div>
                </div>".$viewprofile;
                $className = $user_active_class;
                $treearray[$value->id]['name']      = $name.'&nbsp'.$lastname;
                $treearray[$value->id]['content']   = $content;
                $treearray[$value->id]['accessid']      =  $accessid;
                $treearray[$value->id]['id']      =  $id;
                $treearray[$value->id]['currentuserid'] = $currentuserid;
                $treearray[$value->id]['info']      = $info;
                $treearray[$value->id]['className'] = $className;
                $treearray[$value->id]['usertype'] = $usertype;
                    if (!empty(array_first($push)) || !empty(array_last($push))) {

                   $treearray[$value->id]['children'] = array_values($push);

                   // $treearray[$value->id]['children'] = [array_first($push), array_last($push)];
               }

            } else {
                // $placement_username = User::where('id',$placement_id)->value('username');
                // dd($value->placement_id);
                // $placement_accessid = Crypt::encrypt(Tree_Table::where('placement_id',$value->placement_id)->value('id'));
                $placement_accessid = Crypt::encrypt($value->id);
                // dd(urldecode(Crypt::decrypt($placement_accessid)));

                $username      = "<span class='enroll'>vacant</span>";                
                $content   = "<img class='' data-accessid='$placement_accessid' style='max-width:50px;cursor:pointer;' src='/img/cache/original/atmor.png'>";
                $info      = "";
                $className = "vacant";
                $treearray[$value->id]['name']      = $username;
                $treearray[$value->id]['content']   = $content;
                $treearray[$value->id]['info']      = $info;
                $treearray[$value->id]['className'] = $className;
                $treearray[$value->id]['usertype'] = 'vacant';
                $treearray[$value->id]['placement_accessid'] = $placement_accessid;
                // $treearray[$value->id]['placement_username'] = $placement_username;
            }
        }
        $treedata = $treearray;
        return $treedata;
    }


    public static function profilePhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $package = $user->profile_info->package;
        $img=Packages::find($package)->image;
        // dd($img);
        //if (!Storage::disk('images')->exists($image)){
        //    $image = 'avatar-big.png';
        //}
        // if(!$img){
        //     $img = 'avatar-big.png';
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


    public static function generateTree($users, $level = 0, $tree_structure = "")
    {
        $x = collect(collect($users)->first());
        return $x->toJson();
        
        
    }

    public static function getMyReferals($sponsor_id)
    {
        $users      = DB::table('tree_table')->where('sponsor', $sponsor_id)->get();
        $index      = 0;
        $user_array = array();
        foreach ($users as $user) {
            $user_array[$index] = Self::getUserDetails($user->user_id);
            $index++;
        }
        return $user_array;
    }

    public static function getUserDetails($user_id)
    {
        return DB::table('users')->where('id', $user_id)->get();
    }
        // Tree_Table::$downline_users =[];
        // Tree_Table::getDownlines($user_id);
        // $downline_users=Tree_Table::$downline_users;
    public static function getDownlines($placement_id){ 

            $data= self::where('placement_id',$placement_id)->get();
            
            foreach ($data as $value) {
               if($value->type=="yes"){
                    $rank=User::where('id',$value->user_id)->value('rank_id');

               SELF::$downline_id_list[] = $value->user_id;
          
               self::$downline_users[$value->id]['user_id'] =$value->user_id;
               self::$downline_users[$value->id]['leg'] =$value->leg;
               self::$downline_users[$value->id]['rank'] =$rank;
               self::$downline_users[$value->id]['sponsor'] =$value->sponsor;
               self::$downline_users[$value->id]['placement'] =$value->placement_id;
               self::getDownlines($value->user_id); 
                                   
               }              
           }
     } 

        // Tree_Table::$downline_id_list =[];
        // $data=Tree_Table::getDownlineCount($user_id);
    public static function getDownlineCount($placement_id)
    {
        $data= self::where('placement_id',$placement_id)->get();
        foreach ($data as $value) {
               if($value->type=="yes"){
                    SELF::$downline_id_list[] = $value->user_id;
                    self::getDownlineCount($value->user_id);        
               }              
        }
       return count(SELF::$downline_id_list);

    }
    public static function getDown()
    {
        $count_users = count(static::$downline_users);
        $month_count;
        for ($k = 1; $k < 13; $k++) {$month_count[$k] = 0;}
        for ($j = 1; $j <= $count_users; $j++) {
            if (!empty(static::$downline_users)) {
                if (static::$downline_users[$j]['join_month'] == 1) {$month_count[1] += 1;} else if (static::$downline_users[$j]['join_month'] == 2) {$month_count[2] += 1;} else if (static::$downline_users[$j]['join_month'] == 3) {$month_count[3] += 1;} else if (static::$downline_users[$j]['join_month'] == 4) {$month_count[4] += 1;} else if (static::$downline_users[$j]['join_month'] == 5) {$month_count[5] += 1;} else if (static::$downline_users[$j]['join_month'] == 6) {$month_count[6] += 1;} else if (static::$downline_users[$j]['join_month'] == 7) {$month_count[7] += 1;} else if (static::$downline_users[$j]['join_month'] == 8) {$month_count[8] += 1;} else if (static::$downline_users[$j]['join_month'] == 9) {$month_count[9] += 1;} else if (static::$downline_users[$j]['join_month'] == 10) {$month_count[10] += 1;} else if (static::$downline_users[$j]['join_month'] == 11) {$month_count[11] += 1;} else { $month_count[$j] += 1;}
            }
        }
        $month = $month_count[1] . "," . $month_count[2] . "," . $month_count[3] . "," . $month_count[4] . "," . $month_count[5] . "," . $month_count[6]
            . "," . $month_count[7] . "," . $month_count[8] . "," . $month_count[9] . "," . $month_count[10] . "," . $month_count[11] . "," . $month_count[12];
        // print_r($month);
    }

    // uplines without admin
    // to get uplines with admin -> remove "$value->placement_id > 1"
    public static function getAllUpline($user_id)
    {   
        $result = SELF::join('profile_infos', 'profile_infos.user_id', '=', 'tree_table.placement_id')
            ->where('tree_table.user_id', $user_id)
            ->select('tree_table.leg', 'tree_table.placement_id', 'tree_table.type', 'profile_infos.package')
            ->get();       
        foreach ($result as $key => $value) {
            if ($value->type != 'vaccant' && $value->placement_id > 1) {
                SELF::$upline_users[]   = ['user_id' => $value->placement_id, 'leg' => $value->leg, 'package' => $value->package];
                SELF::$upline_id_list[] = $value->placement_id;
            }

            if ($value->placement_id > 1) {
                SELF::getAllUpline($value->placement_id);
            }
        }
        return true;

    }
    //to get uplines including admin
       public static function getAllUplines($user_id)
    {   
        $result = SELF::join('profile_infos', 'profile_infos.user_id', '=', 'tree_table.placement_id')
            ->where('tree_table.user_id', $user_id)
            ->select('tree_table.leg', 'tree_table.placement_id', 'tree_table.type', 'profile_infos.package')
            ->get();       
        foreach ($result as $key => $value) {
            if ($value->type != 'vaccant') {
                SELF::$upline_users[]   = ['user_id' => $value->placement_id, 'leg' => $value->leg, 'package' => $value->package];
                SELF::$upline_id_list[] = $value->placement_id;
            }

            if ($value->placement_id >= 1) {
                SELF::getAllUplines($value->placement_id);
            }
        }
        return true;

    }
    public static function getUplineCount($user_id,$level)
    {   
        $result = SELF::where('user_id', $user_id)
                      ->select('type','placement_id')->get();                  
            foreach ($result as $key => $value) {
                if ($value->type != 'vaccant') 
                    $level=$level+1;
                if ($value->placement_id > 1) 
                  return SELF::getUplineCount($value->placement_id,$level);
            }
        return $level;
    }

    public static function getUserLeg($user_id)
    {

        return self::where('user_id', $user_id)->value('leg');
    }

    public static function getFatherID($user_id)
    {

        return self::where('user_id', $user_id)->value('placement_id');
    }

    //RELATIONSHIPS - Added By Aslam
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public static function getAllDownlinesAutocomplete($placement_id){ 

        
           $data= self::whereIn('placement_id',$placement_id)->get();
           
           $placement_id =[];
            foreach ($data as $value) {

             if($value->type=="yes" || $value->type=="no"){
               SELF::$downline_id_list[] = $value->user_id; 

                array_push($placement_id, $value->user_id);
                                               
               }              
           }

               if(count($placement_id)){
                   self::getAllDownlinesAutocomplete($placement_id);                     
               }
               return 1 ;
     } 

     // only list network users id 
     public static function getnetworkUsers($list,$downline_users){

        $list =SELF::whereIn('placement_id',$list)->where('type','=','yes')->where('user_id','<>',0)->pluck('user_id');    
         if (count($list)== 0) { 
               $users=[];

        for ($i=0; $i <count($downline_users) ; $i++) { 
          for ($j=0; $j <count($downline_users[$i]) ; $j++) {  
              $users[]=$downline_users[$i][$j]; 
            }
        }   
        return $users;  
     }
     $downline_users = array_merge([$list],$downline_users);
    
     return SELF::getnetworkUsers($list,$downline_users);

    }
    public static function getnetworkUsersCount($user_id)
    {  
        $count=0;
        $network=SELF::getnetworkUsers([$user_id],[]);
        if(isset($network))
            $count=count($network);
        return $count;
    }
    // to get left or right downlines
    // get user data return "$downlines"
    // to list user_id return "$downline_id"
    public static function DownlinesByLeg($user_id,$leg){
        $child=SELF::where('placement_id',$user_id)->where('leg',$leg)
                ->where('type','yes')->first();
        if(isset($child))
        {       
        $rank=User::where('id',$child->user_id)->value('rank_id');
        $data[$child->user_id]['user_id'] =$child->user_id;
        $data[$child->user_id]['leg'] =$child->leg;
        $data[$child->user_id]['rank'] =$rank;
        $data[$child->user_id]['sponsor'] =$child->sponsor;
        $data[$child->user_id]['placement'] =$child->placement_id;

        $id=$child->user_id;

        SELF::$downline_users   = [];
        SELF::$downline_id_list = [];
        SELF::getDownlines($child->user_id);
        $downline_users = SELF::$downline_users;
        $downline_id    = SELF::$downline_id_list;
        $downlines[]    = array_merge($data,$downline_users);
        array_push($downline_id, $id);

        return $downlines;
        }
    }
    public static function getLevelUsers($user_id,$level)
    {
        $user_level=SELF::where('user_id',$user_id)->value('level');
        if($user_level>0){
            $level=$user_level+$level;
            $users= SELF::where('level',$level)->pluck('user_id');
            
            return $users;  
        }
    }
}

