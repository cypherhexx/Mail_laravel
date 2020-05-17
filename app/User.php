<?php

namespace App;
use DB;
use Commission;
use Auth;
use Cache;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Crypt;
use Html;
use Storage;
use Profileinfo;
use Illuminate\Notifications\Notifiable;
use App\Jobs\SendAllEmail;
use App\Jobs\SendSponsorEmail;
use Carbon;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use SoftDeletes, Notifiable;

    protected $dates = ['deleted_at'];
    

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','email', 'password','username','sponsor','rank_id','register_by','name','lastname','transaction_pass','created_at','admin','referral_count','document','verified','verification_number','sponsor','purchase_count','bitcoin_address','paypal_email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

  public function articles()
  {
    return $this->hasMany('App\Article');
  }

   //By Aslam
    public static function isOnline($id)
    {
        return Cache::get('user-is-online-' . $id);
    }


    //RELATIONSHIPS - Added By Aslam
    public function profile_info()
    {
        return $this->hasOne('App\ProfileInfo','user_id','id');
    }

 

    public function sponsor_tree()
    {
        return $this->hasOne('App\Sponsortree','user_id','id');
    }


    public function tree_table()
    {
        return $this->hasOne('App\Tree_Table','user_id','id');
    }


    public function purchase_history()
    {
        return $this->hasMany('App\PurchaseHistory','user_id','id');
    }

    public function packages()
    {
        return $this->hasOne('App\Packages','user_id','id');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity','user_id','id');
    }




    public function ticket()
    {
        return $this->hasMany('App\Models\Helpdesk\Ticket\Ticket','user_id','id');
    }

    public function reply()
    {
        return $this->hasMany('App\Models\Helpdesk\Ticket\TicketReply','user_id','id');
    }

    public function point()
    {
        return $this->hasOne('App\PointTable','user_id','id');
    }



    public static function createUserID(){

      $user_id = "ID". str_random(7);

      if(self::where('user_id',$user_id)->count()  == 0){
        return $user_id ;
      }
      return self::createUserID();
    }

     public static function checkUserAvailable($username){
      $users = DB::table('users')->where('username', $username)->get();
      // dd($users[0]->id);
      return $users[0]->id;
    }
    public function getSponsor($user_id){
         $user_id =  Tree_Table::where('sponsor', $sponsor_id)->where("leg",$leg)->value('user_id');
    }
    public static function getSponsorId($sponsor_name){
         return SELF::where('username', $sponsor_name)->value('id');
    }

    public static function takeUserId($user_name){
         return SELF::where('username', $user_name)->value('id');
    }

    public static function  getSponsorName($user_id){
        $sponsor_id =  Tree_Table::where('user_id', $user_id)->value('sponsor');
        return self::userIdToName($sponsor_id);
    }
    public static function userIdToName($user_id){
        $user_name =  SELF::where('id', $user_id)->value('username');
        return $user_name;
    }
    
    public static function userNameToId($username){
        $user_id =  SELF::where('username', $username)->value('id');
        return $user_id;
    } 

     public static function userEmailToId($email){
        $user_id =  SELF::where('email', $email)->value('id');
        return $user_id;
    }   
   public static function getStates($id){
          $countries = DB::select('select * from life_state where country_id = '+$id);
          
   }
   public static function countryIdToName($country_id){
          $country_name =  DB::table('countries')->where('id', $country_id)->value('name');
          return $country_name;
          
   }
    public static function stateIdToName($state_id){
          $state_name =  DB::table('life_state')->where('State_Id', $state_id)->value('State_Name');
          return $state_name;
          
   }
   public static function getPassword($user_id){
         $password = DB::table('users')->where('user_id',$user_id)->value('password');
         return $password;
   }
   public static function updatePassword($user_id,$new_password){
         DB::table('users')->where('id', $user_id)->update(array('password' => $new_password));
       
   }
   
   
   public static function checkUserType($user_id){
         $type_id = SELF::where('id', $user_id)->value('admin');
         if($type_id == 1)
              return "admin";
          else
            return "user";
   }
   public static function getNewUsers(){
        $user_type = SELF::checkUserType(Auth::user()->id);
        $admin_flag = 0;
        if($user_type == 'admin'){
          
        $new_users = DB::table('users')
                            ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                           ->where('admin', $admin_flag)
                           ->orderBy('created_at', 'desc')
                           ->limit(8)
                           ->get();
        }else{
          $new_users = DB::table('users')
                              ->join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
                              ->join('tree_table', 'tree_table.user_id', '=', 'users.id')
                              ->where('tree_table.sponsor', '=', Auth::user()->id)
                              ->limit(8)
                              ->get();
        }
        //print_r($new_users);die();
        $loop = count($new_users);
        for($i = 0;$i < $loop;$i ++){
          //echo $new_users[$i]->country;die();
         $new_users[$i]->country_name =  NULL ;//self::getCitizen($new_users[$i]->country);
        }
        return $new_users;
   }
   public static function getCitizen($id){
    return DB::table('countries')->where('id', $id)->pluck('citizenship');
   }
   public static function insertToBalance($user_id){
        DB::table('user_balance')->insert(array('user_id'=>$user_id,'balance' => 0));
   }
   public static function upadteUserBalance($user_id,$sponsor_commisions){
        DB::table('user_balance')->where('user_id',$user_id)->increment('balance',$sponsor_commisions);

   }

    public static function getUserDetails($id){
      return DB::table('users')->where('id', $id)->get();
    }
    public static function getAdminEmail(){
      return DB::table('users')->where('admin', 1)->pluck('email');
    }
    public static function getAdminId(){
      return DB::table('users')->where('admin', 1)->pluck('id');
    }
    public static function checkEmailAvailable($email){
      $user_email = DB::table('users')->where('email', $email)->pluck('email');
      if(!$user_email)
        return 'available';
    }
    public static function getUserId($username){
      $user_id = DB::table('users')->where('username',$username)->pluck('id');
      if(!$user_id){
        return 'available';
      }
    }
    public static function getUsersForDashboardGraph(){
      //return Self::getDownlineUsers(Auth::user()->id);
      $downline_users = array();
      return Self::getDownlineUsers(1,1,$downline_users);
      //return Auth::user()->id;
    }
    public static function getDownlineUsers($user_id,$index,$downline_users=array()){
      //$u = self::usersDownline(1,1);
      //print_r($u);die();
      $users = DB::table('tree_table')->where('sponsor',$user_id)->where('type','yes')->get();
      for($i=0;$i<count($users);$i++){
            $downline_users[$index]['user_id'] = $users[$i]->user_id;
            $downline_users[$index]['join_month'] = date("m", strtotime($users[$i]->created_at));
            $index++;
            //$d =date("m", strtotime($downline_users[$index-1]['join_date'] ));
    }
    $count_users = count($downline_users);
    $month_count;
    for($k=1;$k<13;$k++){$month_count[$k]=0;}
    for($j = 1; $j <= $count_users; $j++){
        if($downline_users[$j]['join_month'] == 1){$month_count[1] += 1;}
        else if($downline_users[$j]['join_month'] == 2){$month_count[2] += 1;}
        else if($downline_users[$j]['join_month'] == 3){$month_count[3] += 1;}
        else if($downline_users[$j]['join_month'] == 4){$month_count[4] += 1;}
        else if($downline_users[$j]['join_month'] == 5){$month_count[5] += 1;}
        else if($downline_users[$j]['join_month'] == 6){$month_count[6] += 1;}
        else if($downline_users[$j]['join_month'] == 7){$month_count[7] += 1;}
        else if($downline_users[$j]['join_month'] == 8){$month_count[8] += 1;}
        else if($downline_users[$j]['join_month'] == 9){$month_count[9] += 1;}
        else if($downline_users[$j]['join_month'] == 10){$month_count[10] += 1;}
        else if($downline_users[$j]['join_month'] == 11){$month_count[11] += 1;}
        else {$month_count[$j] += 1;}
    }
    print_r($downline_users);die();
    $month = $month_count[1].",".$month_count[2].",".$month_count[3].",".$month_count[4].",".$month_count[5].",".$month_count[6]
      .",".$month_count[7].",".$month_count[8].",".$month_count[9].",".$month_count[10].",".$month_count[11].",".$month_count[12];
    print_r($month);//die();
    } 
    public static function getUserPercentage(){
      $user_id = Auth::user()->id;
     $all_usercount = SELF::count();
      $ref_usercount = Tree_Table::where('sponsor',$user_id)->where('type','yes')->count();
      $per_user = ($ref_usercount/$all_usercount)*100;
      return $per_user;
    }
    #getmeber data
    public static function getAllMemberDetails($uname){
     return  DB::table('users')->select("*")->where('username','%like%',$uname)->get();
    }

    public static function addCredits($user_id){

      $user = self::find($user_id); 

      $package = Packages::find($user->package) ;

      $user->credits =  $package->stock_products ;

      return $user->save();

    }


    public static function getMonthUsers($user){
      $result = array();

      for($i=1;$i<=12;$i++){
       echo $count = self::whereMonth('created_at','=',$i)->whereYear('created_at', '=', date('Y'))->count();
       echo ",";
        // array_push($result,$count);
      }

      
    }

     public static function getPackagedUsers($package_id){
      
      return self::where('users.package',$package_id)
            ->join('sponsortree','sponsortree.user_id','=','users.id')
            ->join('packages','packages.id','=','users.package')
            ->join('users as sponsor','sponsor.id','=','sponsortree.sponsor')
            ->select('users.*','sponsor.username as sponsorusername','packages.package as packagename')
            ->get();

    }
    public static function categoryUpdate($sponsor_id)
    {

      $sponsor_package=ProfileModel::where('user_id',$sponsor_id)->value('package');
      $sponsor_category=User::where('id',$sponsor_id)->value('category_id');
      $next_cat=$sponsor_category+1;
      $cat_det=Category::find($next_cat);
        if($cat_det <> null && $sponsor_package > 1){

          $sponsor_count=Sponsortree::join('profile_infos','profile_infos.user_id','=','sponsortree.user_id')
                                      ->where('profile_infos.package','>',1)
                                    ->where('sponsortree.sponsor',$sponsor_id)
                                    ->where('sponsortree.type','=','yes')
                                    ->count();
            if($sponsor_count >= $cat_det->count){
              
               User::where('id',$sponsor_id)->update(['category_id'=>$cat_det->id]);
               self::insertCategoryHistory($sponsor_id,$cat_det->id,$sponsor_category,"categoryupdate");
            }
        }
     

    }

    public static function insertCategoryHistory($user_id,$category_id,$last_category,$remarks)
    {
       
        return CategoryHistory::create([
                "user_id"=>$user_id,
                "category_id"=>$last_category,
                "category_updated"=>$category_id,
                "remarks"=>$remarks,
                    ]);
    }


    public static function hoverCard($user_id)
    {

               
                $user =    User::where('id', $user_id)->with('point')->first();
                // dd($user);
                $username =   User::where('id', $user_id)->value('username');
                $accessid         = Crypt::encrypt($user_id);
                $package_id   = ProfileModel::where('user_id', $user_id)->value('package');
                $package_name = Packages::find($package_id)->value('package');

                $content = '' . Html::image(route('imagecache', ['template' => 'profile', 'filename' => self::profilePhoto($username)]), $username, array('style' => 'max-width:50px;','data-accessid'=>$accessid)) . '';

                $coverPhoto =  Html::image(route('imagecache', ['template' => 'large', 'filename' => self::coverPhoto($username)]), $username, array('style' => '','data-accessid'=>$accessid));

                

                $info    = "
                <div class='hovercardouter'>
                <div class='hovercardinner'>
                    
                            <div class='covercardholder'>
                                $coverPhoto
                                <div class='cardbackgroundgd'>
                            </div>
                            </div>
                            
                        
                    <div class='cardprimeinfo' >
                        <div class='cardprimeinfohold' >
                            
                                <div class='ellipsis cardusername'>
                                    {$user->username}
                                </div>
                           
                        </div>
                        <ul class='cardsecondaryinfo'>
                            <li class='cardrankname'>
                                <span class='cardkey'>Rank</span> :  <span class='cardvalue'>{$user->rank_name}</span>
                            </li class='cardpackagename'>                            
                            <li>
                                <span class='cardkey'>Package</span> : <span class='cardvalue'>{$package_name}</span>
                            </li>                            
                            <li class='cardtopupcount'>
                                <span class='cardkey'>Top Ups</span> : <span class='cardvalue'>".PurchaseHistory::where('user_id', '=', $user_id)->sum('count')."</span>
                            </li>                            
                            <li class='cardrsbalance'>
                                <span class='cardkey'>RS balance</span> : <span class='cardvalue'>{$user->revenue_share}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <table cellpadding='0' cellspacing='0' class='cardprofcontenttbl' >
                    <tbody>
                        <tr>
                            <td rowspan='2' valign='top'>
                               
                                    <div class='cardprofpicholder'>
                                        $content
                                    </div>
                              
                            </td>
                        </tr>
                        <tr valign='bottom'>
                            <td class='cardsecinfo-list-holder'>
                                <div class=''>
                                    <ul class='cardsecinfo-list'>
                                        <li>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class='cardpillforholder'>
                </div>
                <div class='carddetails'>
             
                
                <table class='table table-condensed'>
                <thead>
                <tr>
                    <td>Total left</td>
                    <td>Total right</td>
                    <td>Left point</td>
                    <td>Right point</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{$user->point->total_left}</td>
                    <td>{$user->point->total_right}</td>
                    <td>{$user->point->left_carry}</td>
                    <td>{$user->point->right_carry}</td>
                </tr>
                </tbody>
                </table>
      
                </div>
                </div>";


        return $info;
    }


    public static function profilePhoto($user_name)
    {
        $user  = User::where('username', $user_name)->with('profile_info')->first();
        $image = $user->profile_info->profile;
        if (!Storage::disk('images')->exists($image)){
            $image = 'avatar-big.png';
        }
        if(!$image){
            $image = 'avatar-big.png';
        }

        return $image;
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



    public static function add($data,$sponsor_id,$placement_id){

            DB::beginTransaction();

            try {



            /**
             * Creates a user with provided data and stores it for temperory usage
             * @var [type]
             */  
              
            $userresult = SELF::create([
                'name'             => $data['firstname'],
                'lastname'         => $data['lastname'],
                'email'            => $data['email'],
                'username'         => $data['username'],
                'rank_id'          => '1',
                'register_by'      => 'Card',
                'cpf'              => $data['cpf'],
                'transaction_pass' => bcrypt($data['transaction_pass']),
                'password'         => bcrypt($data['password']),
               // 'sponsor'=>$sponsor_id,

            ]);


            /**
             * Creates Profile info for the created User
             * @var [type]
             */
            $userProfile = ProfileModel::create([
                'user_id'  => $userresult->id,
                'passport' => $data['passport'],
                'mobile'   => $data['phone'],
                'gender'   => $data['gender'],
                'country'  => $data['country'],
                'state'    => $data['state'],
                'city'     => $data['city'],
                'address1' => $data['address'],
                'zip'      => $data['zip'],
                'location' => $data['location'],
                'package'  => $data['package'],
            ]);


            /**
             * Create purchase history for the user, as it is passed from form
             * Checks against the packages here for the amount and volumes
             * @var [collection]
             */


            // $userPackage = Packages::find($data['package']);
            
            // if(isset(Auth::user()->id)){
            //   if($data['payment'] == "ewallet" && $sponsor_id != Auth::user()->id)
            //     $purchase_user_id = $sponsor_id;
            //   else
            //     $purchase_user_id = Auth::user()->id;
            // }
            // else
            //   $purchase_user_id = $userresult->id;

            // PurchaseHistory::create([
            //     'user_id'          => $userresult->id,
            //     'purchase_user_id' => $purchase_user_id,
            //     'package_id'       => $data['package'],
            //     'pv'               => $userPackage->pv,
            //     'count'            => 1,
            //     'total_amount'     => $userPackage->amount,
            //     'pay_by'           => $data['payment'],
            //     'sales_status'     => 0,                
            // ]);

             /**
             * Get sponsor tree id where there is a vacant under specified sponsor
             * @var [string]
             */
            $sponsortreeid = Sponsortree::where('sponsor', $sponsor_id)->where('type', 'vaccant')->orderBy('id', 'desc')->take(1)->value('id');
            /**
             * Updates sponsor record linked the sponsor and user
             * @var [Function]
             */
         
            $sponsortree          = Sponsortree::find($sponsortreeid);
            $sponsortree->user_id = $userresult->id;
            $sponsortree->sponsor = $sponsor_id;
            $sponsortree->type    = "yes";
            $sponsortree->save();
            /**
             * Creates vacant for sponsor
             * @var [collection]
             */
            $sponsorvaccant = Sponsortree::createVaccant($sponsor_id, $sponsortree->position);
            /**
             * Creates vacants for user
             * @var [collection]
             */
            $uservaccant = Sponsortree::createVaccant($userresult->id, 0);
            $sponsor_ref=self::where('id',$sponsor_id)->value('referral_count');
            $sp_count=$sponsor_ref+1;
            self::where('id',$sponsor_id)->update(['referral_count' => $sp_count]);
           

            //treeee

            // $placement_id = Tree_Table::gettreePlacementId([$placement_id]); 
            // dd($placement_id);
            // $tree_id = Tree_Table::vaccantId($placement_id);
            // $tree          = Tree_Table::find($tree_id);
            // $tree->user_id = $userresult->id;
            // $tree->sponsor = $sponsor_id;
            // $tree->type    = 'yes';
            // $tree->save(); 
            // Tree_Table::where('user_id',$tree->placement_id)->increment('count',1);
            // $count=Tree_Table::where('user_id','=',$placement_id)->value('level');
            // Tree_Table::where('id',$tree_id)->update(['level'=>$count+1]);
            // Tree_Table::createVaccant($tree->user_id);

            //treee end
           
            
            $user_arrs=[];
            $results=Ranksetting::getTreeUplinePackage($userresult->id,1,$user_arrs);
          
            foreach ($results as $key => $value) {
                Packages::rankCheck($value);
            
            }
            // Packages::levelCommission($userresult->id,$userPackage->amount);
          
            // Packages::directReferral($sponsor_id,$userresult->id,$data['package']);
          
            // RsHistory::create([
            //         'user_id'=>$userresult->id,                   
            //         'from_id'=>$userresult->id,
            //         'rs_credit'=>$userPackage->amount,
            // ]);

            // $spon_det=User::find($sponsor_id);
           


            // Tree_Table::createVaccant($tree->user_id);
            $spomsor=User::find($sponsor_id)->username;
            /**
             * adding user to balance table
             */
            $balanceupdate = SELF::insertToBalance($userresult->id);

            // $category_update=SELF::categoryUpdate($sponsor_id);
            
              // Activity::add("Added user $userresult->username","Added $userresult->username sponsor as 
              //   $sponsor ");
                // Activity::add("Joined as $userresult->username","Joined in system as $userresult->username sponsor as $spomsor ",$userresult->id);
            // dd("00");

            // SendAllEmail::dispatch($data['firstname'],$data['lastname'],$data['username'],$data['password'],$data['email'])
            //             ->delay(Carbon::now()->addSeconds(10));
          

            DB::commit();

            return $userresult ;

              
            } catch (Exception $e) {

              DB::rollback();

              return false;
              
            }
           


    }

    public static function activeUser($user_id){

      $active = User::find($user_id)->active;

      if($active == 'yes')
        return 1;
      else
        return 0;

    }

    public static function checkrate($amount){
//       $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
//       $response_json = file_get_contents($req_url);

//       // Continuing if we got a result
//       if(false !== $response_json) {

//           // Try/catch for json_decode operation
//           try {

//         // Decoding
//         $response_object = json_decode($response_json);

//         // YOUR APPLICATION CODE HERE, e.g.
//         $base_price = $amount; // Your price in USD
//         $EUR_price = round(($base_price * $response_object->rates->EUR), 2);

//           }
//           catch(Exception $e) {
//               // Handle JSON parse error...
//           }

// }

      $url="https://api.exchangerate-api.com/v4/latest/USD";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      $data = curl_exec($ch);
      curl_close($ch);
      $datas=json_decode($data);
      $EUR_price = round(($amount * $datas->rates->EUR), 2);
      return $EUR_price;
    }




} 
