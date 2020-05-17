<?php
namespace App\Http\Controllers\admin;
use App\Balance;
use App\Commission;
use App\Country;
use App\DirectSposnor;
use App\Helpers\Thumbnail;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserRequest;
use App\LeadershipBonus;
use App\Mail;
use App\Packages;
use App\PointTable;
use App\ProfileInfo;
use App\PurchaseHistory;
use App\RsHistory;
use App\Sponsortree;
use App\Tree_Table;
use App\User;
use App\Voucher;
use App\TypeChange;
use App\News;
use App\EventVideos;
use App\PendingTransactions;
use App\ProfileModel;
use App\BrokerDetails;
use App\UserBrokerDetails;
use App\Emails;
use App\welcomeemail;
use App\AppSettings;
use Auth;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use Validator;
use App\Activity;
use App\Payout;
use Crypt;
use CountryState;
use App\Ranksetting;
use App\Settings;
use Storage;
use Hash;

//paypal

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

// use to process billing agreements
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Api\ShippingAddress;
use Srmklive\PayPal\Services\ExpressCheckout;

class UserController extends AdminController
{

    /*
     * Display a listing of the resource.
     *
     * @return Response
     */

       protected static  $provider;
    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;

   
    public function __construct()
    {
       
       self::$provider = new ExpressCheckout;  
        if(config('paypal.settings.mode') == 'live'){
            $this->client_id = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->client_id = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }
        
        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }
    
    public function index()
    {

        // Show the page
        $title     = trans('users.users');
        $sub_title = trans('users.profile');
        $base      = trans('users.base');
        $method    = trans('users.view_all');
        // $unread_count  = Mail::unreadMailCount(Auth::id());
        // $unread_mail  = Mail::unreadMail(Auth::id());
        // $userss = User::getUserDetails(Auth::id());

        // $user = $userss[0];

        // $userss = User::getUserDetails(Auth::id());


        //     $user = $userss[0];

    
        // return view('app.admin.users.index',  compact('title','user','sub_title','base','method','profile_infos'));
        $users_data = User::where('id','>',1)->get();
        $sponsor = User::all();
        $package = Packages::all();
        return view('app.admin.users.index',  compact('title','sub_title','base','method','users_data','package','sponsor'));


    }

    //online

    
       public function onlineUser()
    {
        
        // Show the page
        $title = trans('users.online_users');
        $sub_title = trans('users.active');
        $method = trans('users.pending_users');


        
        // $users = TempRegisterDetails::where('status','no')->get();
        return view('app.admin.users.onlineusers',  compact('title','users','sub_title','base','method','profile_infos','method'));
    }

    public function onlineUsersdata()
    {



         $var= User::pluck('id');
        $online=[];
        foreach ($var as $key => $value) {

         if(User::isOnline($value)== 1)     
          $online[]=$value;
       }


       $online=User::whereIn('id',$online)->select('name','lastname','username','email')->get();

       $user_count=count($online);

          return Datatables::of($online)                
           ->remove_column('id')

       
            ->setTotalRecords($user_count)
            ->escapeColumns([])
            ->make();


    }


   //user search

    public function searchuser(Request $request){

       
           
         // dd($request->all());

        $validator = Validator::make($request->all(), ["username" => 'required|exists:users,username']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['The username not exist']);
        } else {
             return redirect('/admin/userprofiles/'.$request->username);
        }


    }





    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        return view('app.admin.users.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(UserRequest $request)
    {

        $user                    = new User();
        $user->name              = $request->name;
        $user->username          = $request->username;
        $user->email             = $request->email;
        $user->password          = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->confirmed         = $request->confirmed;
        $user->save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit()
    {

        $title     = 'Edit Info';
        $sub_title = 'Edit Info';
        $base      = 'Edit Info';
        $method    = 'Edit Info';

        $userss   = User::getUserDetails(Auth::id());
        $user     = $userss[0];
        $users    = User::where('id', '>', 1)->get();
        $packages = Packages::all();

        return view('app.admin.users.create_edit', compact('title', 'base', 'method', 'User', 'sub_title', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit(UserEditRequest $request)
    {

     

        $user                 = User::find(User::userNameToId($request->username));
        $password             = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password) && $user->id > 1) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);
            }
        }
        $user->save();

        Session::flash('flash_notification', array('message' => "Password has been changed ", 'level' => 'success'));

        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function getDelete($id)
    {
        $user = User::find($id);
        // Show the page
        return view('app.admin.users.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete(DeleteRequest $request, $id)
    {
        $user = User::find($id);
        $user->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
 public function data(Request $request)
    {
// dd($request->all());
        $user_count = User::where('id', '>', 1)->count();
        // $users = User::select(array('users.id','users.name','users.username','packages.package','users.email', 'users.created_at'))
        // ->join('packages','packages.id','=','users.package')->where('admin','<>',1)
        $users = ProfileInfo::select(array('users.id', 'users.name', 'users.username', 'packages.package', 'users.email', 'users.created_at'))
            ->join('users', 'users.id', '=', 'profile_infos.user_id')
            ->join('packages', 'packages.id', '=', 'profile_infos.package')->where('admin', '<>', 1);
          
            // ->get();

        return Datatables::of($users)                
            // ->remove_column('id')
            // ->add_column('profile', '<a href="{{{ URL::to(\'/\' . $id) }}}">{{ trans("dfdf") }}</a>')
            ->add_column('profile view','<a href="{{{ URL::to(\'admin/userprofiles/\' . $username) }}}" class="btn btn-success btn-sm ">{{ trans("$username") }}</a>' )
            ->edit_column('created_at', '{{ date("D M Y",strtotime($created_at)) }}')
            // ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="fa fa-lock"></span>  {{ trans("admin/modal.changepassword") }}</a>
                    // <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.terminate") }}</a>
                // @endif')
            ->setTotalRecords($user_count)
             ->escapeColumns([])
             ->make();
// dd($users);
    }


      public function deactivateUser($user){
       // dd($user);
       User::where('username','=',$user)->update(['active'=>'no']);

        Session::flash('flash_notification', array('message' => "User deactivated succesfully", 'level' => 'success'));
            return redirect()->back();

    }

        public function activateUser($user){
       // dd($user);
       User::where('username','=',$user)->update(['active'=>'yes']);

        Session::flash('flash_notification', array('message' => "User activated succesfully", 'level' => 'success'));
            return redirect()->back();

    }

    public function viewprofile($user)
    {

        
        $title     = trans('users.member_profile');
        $sub_title = trans('users.view_all');
        $base = trans('users.view_all');
        $method = trans('users.view_all');

        
        // $user=User::where('id','=',1)->value('username');


        if ($user) {
            $user_id = User::where('username', $user)->value('id');
            if($user_id != NULL){
                Session::put('prof_username', $user);                
            }
        } else {
            $user_id = Auth::id();
            Session::put('prof_username', Auth::user()->username);
        }

        $user_id = $user_id;





        $selecteduser = User::with('profile_info')->find($user_id);
        // dd($selecteduser);
      
        $profile_infos = ProfileInfo::with('images')->where('user_id',$user_id)->first();
        $profile_photo = $profile_infos->profile;
        
        //if (!Storage::disk('images')->exists($profile_photo)){
        //    $profile_photo = 'avatar-big.png';
        //}

        if(!$profile_photo){
            $profile_photo = 'avatar-big.png';
        }

        $cover_photo = $profile_infos->cover;

        if (!Storage::disk('images')->exists($cover_photo)){
            $cover_photo = 'cover.jpg';
        }

        if(!$cover_photo){
            $cover_photo = 'cover.jpg';
        }
       

        $referals = User::select('users.*')->join('tree_table', 'tree_table.user_id', '=', 'users.id')
        ->join('profile_infos','profile_infos.user_id','=','users.id')
        ->join('packages','packages.id','=','profile_infos.package')
        ->where('tree_table.sponsor', $user_id)->get();
         // dd($referals);
      
        $total_referals = count($referals);
        $base           = trans('users.profile');
        $method         = trans('users.profile_view');

        $referrals      = Sponsortree::getMyReferals($user_id);

        $balance         = Balance::getTotalBalance($user_id);         
        $vouchers        = Voucher::getAllVouchers();
        $voucher_count   = count($vouchers);
        $mails           = Mail::getMyMail($user_id);
        $mail_count      = count($mails);
        $referrals_count = $total_referals;
        $sponsor_id      = Sponsortree::getSponsorID($user_id);
        $sponsor      = User::with('profile_info')->where('id',$sponsor_id)->first();
        // dd($sponsor);


        $left_bv         = PointTable::where('user_id', '=', $user_id)->value('left_carry');
        $right_bv = PointTable::where('user_id', '=', $user_id)->value('right_carry');
        $total_payout = Payout::where('user_id', '=', $user_id)->sum('amount');

        $user_package    = Packages::where('id', $selecteduser->profile_info->package)->value('package');
        $user_rank = Ranksetting::getUserRank($user_id);
        $user_rank_name = Ranksetting::idToRankname($user_rank);
    

        $countries = Country::all();


        $userCountry = $selecteduser->profile_info->country;
        if ($userCountry) {
        $countries = CountryState::getCountries();
        $country   = array_get($countries, $userCountry);
        } else {
        $country = "Unknown";
        }


        $userState = $selecteduser->profile_info->state;
        if ($userState) {
        $states = CountryState::getStates($userCountry);
        $state  = array_get($states, $userState);
        } else {
        $state = "unknown";
        }


        /**
         * Get Countries from mmdb
         * @var [collection]
         */
        $countries = CountryState::getCountries();
        /**
         * [Get States from mmdb]
         * @var [collection]
         */
        $states = CountryState::getStates('');
        /**
         * Get all packages from database
         * @var [collection]
         */
        $settings=Settings::first();
        $bitcon_address=$settings->bitcon_address;
        $paypal_email=$settings->paypal_email;
 

        return view('app.admin.users.profile', compact('title','sub_title', 'base', 'method', 'mail_count', 'voucher_count', 'balance', 'referrals', 'countries', 'selecteduser', 'sponsor', 'referals',  'left_bv', 'right_bv', 'user_package','profile_infos','countries','country','states','state','referrals_count','user_rank_name','profile_photo','cover_photo','total_payout','bitcon_address','paypal_email'));
    }
    public function profile(Request $request)
    {

        $validator = Validator::make($request->all(), ["user" => 'required|exists:users,username']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['The username not exist']);
        } else {
            Session::put('prof_username', $request->user);
            return redirect()->back();
        }

    }
    public function suggestlist(Request $request)
    {
        if ($request->input != '/' && $request->input != '.') {
            $users['results'] = User::where('username', 'like', "%" . trim($request->input) . "%")->select('id', 'username as value', 'email as info')->get();
        } else {
            $users['results'] = User::select('id', 'username as value', 'email as info')->get();
        }

        echo json_encode($users);

    }
    public function saveprofile(Request $request)
    {

        // die(Session::get('prof_username'));
        
        if (!Session::has('prof_username')) {
            return redirect()->back();
        }

        $id = User::where('username', Session::get('prof_username'))->value('id');

        $user = User::find($id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;




        $user->save();
        // dd($user);
// Role::with('users')->whereName($name)->first();
        $related_profile_info = ProfileInfo::where('user_id', $id)->first();
// dd($related_profile_info);
        $related_profile_info->location    = $request->location;
        $related_profile_info->occuption   = $request->occuption;
        $related_profile_info->gender      = $request->gender;
        $related_profile_info->dateofbirth = date('d/m/Y', strtotime($request->day . "-" . $request->month . "-" . $request->year));
        $related_profile_info->address1    = $request->address1;
        $related_profile_info->address2    = $request->address2;
        $related_profile_info->gender      = $request->gender;
        $related_profile_info->city        = $request->city;
        $related_profile_info->country     = $request->country;
        $related_profile_info->state       = $request->state;
        $related_profile_info->zip         = $request->zip;

        $related_profile_info->mobile      = $request->phone;

        $related_profile_info->skype       = $request->skype;
        $related_profile_info->facebook    = $request->fb;
        $related_profile_info->twitter     = $request->twitter;

        $related_profile_info->account_number      = $request->account_number;
        $related_profile_info->account_holder_name = $request->account_holder_name;
        $related_profile_info->iban                = $request->iban;
        $related_profile_info->swift               = $request->swift;
        $related_profile_info->bank_country        = $request->bank_country;
        $related_profile_info->bank_name           = $request->bank_name;
        $related_profile_info->bank_code           = $request->bank_code;
        $related_profile_info->branch_count        = $request->branch_count;
        $related_profile_info->bank_address        = $request->bank_address;

       
       
     
        $related_profile_info->sort_code           = $request->sort_code;
      
        $related_profile_info->paypal              = $request->paypal;
        $related_profile_info->about               = $request->about_me;
      
        // if ($request->hasFile('profile_pic')) {
        //     $destinationPath = base_path() . "\public\appfiles\images\profileimages";
        //     $extension       = Input::file('profile_pic')->getClientOriginalExtension();
        //     $fileName        = rand(11111, 99999) . '.' . $extension;
        //     Input::file('profile_pic')->move($destinationPath, $fileName);
        //     $new_user->image = $fileName;

        //     $path2 = public_path() . '/appfiles/images/profileimages/thumbs/';
        //     Thumbnail::generate_profile_thumbnail($destinationPath . '/' . $fileName, $path2 . $fileName);
        //     $path3 = public_path() . '/appfiles/images/profileimages/small_thumbs/';
        //     Thumbnail::generate_profile_small_thumbnail($destinationPath . '/' . $fileName, $path3 . $fileName);

        // }

        if ($related_profile_info->save()) {
            Session::flash('flash_notification', array('message' => "Profile updated successfully", 'level' => 'success'));
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['Whoops, looks like something went wrong']);
        }

    }
    public function allusers()
    {
        $users       = User::select('users.username')->get();
        $loop_end    = count($users);
        $user_string = '';
        for ($i = 0; $i < $loop_end; $i++) {
            $user_string = $user_string . $users[$i]->username;
            if ($i < ($loop_end - 1)) {
                $user_string = $user_string . ",";
            }

        }
        print_r($user_string);
    }

    public function validateuser(Request $request)
    {
        return User::takeUserId($request->sponsor);
    }

    public function activate()
    {

        $title     = trans('users.activate_user');
        $sub_title = trans('users.activate_user');
        $base      = trans('users.activate_user');
        $method    = trans('users.activate_user');




     

        $users = User::join('profile_infos', 'profile_infos.user_id', '=', 'users.id')
            ->join('tree_table', 'tree_table.user_id', '=', 'users.id')
            ->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')
            ->join('users as sponsors', 'sponsors.id', '=', 'sponsortree.sponsor')
            ->select('sponsors.username as sponsors', 'users.username', 'users.id', 'users.email', 'users.created_at', 'users.name', 'users.lastname', 'profile_infos.package')
            ->where('tree_table.type', '=', 'yes')
            ->paginate(10);
            // dd($users);

        return view('app.admin.users.activate', compact('title','sub_title','base','method', 'users'));
    }

    public function confirme_active(Request $request, $id)
    {

        $user_detail = User::find($request->user);

        if ($user_detail) {

            $sponsor_id   = Sponsortree::where('user_id', $user_detail->id)->pluck('sponsor');
            $sponsor_comm = DirectSposnor::where('package_id', $user_detail->package)->get();
            $package      = Packages::find($user_detail->package);

            Tree_Table::where('user_id', $user_detail->id)->update(['type' => 'yes']);
            Sponsortree::where('user_id', $user_detail->id)->update(['type' => 'yes']);
            User::where('id', $user_detail->id)->increment('revenue_share', $package->rs);

            RsHistory::create([
                'user_id'   => $user_detail->id,
                'from_id'   => $user_detail->id,
                'rs_credit' => $package->rs,
            ]);

            PurchaseHistory::create([
                'user_id'          => $user_detail->id,
                'purchase_user_id' => $user_detail->id,
                'package_id'       => $user_detail->package,
                'count'            => $package->top_count,
                'pv'               => $package->pv,
                'total_amount'     => $package->amount,
            ]);

            /* sposnor RS */
            RsHistory::create([
                'user_id'   => $sponsor_id,
                'from_id'   => $user_detail->id,
                'rs_credit' => $sponsor_comm[0]->rs,
            ]);
            PurchaseHistory::create([
                'user_id'          => $sponsor_id,
                'purchase_user_id' => $user_detail->id,
                'package_id'       => $user_detail->package,
                'count'            => $package->ref_top_count,
                'total_amount'     => $package->amount,
            ]);
            User::where('id', $sponsor_id)->increment('revenue_share', $sponsor_comm[0]->rs);

            /* sposnor commission */
            $sponsor_comm_amt = $package->pv * $sponsor_comm[0]->pv / 100;

            SPOSNSORCOMMISSION:

            if (User::where('id', $sponsor_id)->pluck('revenue_share') >= $sponsor_comm_amt) {
                Commission::create([
                    'user_id'        => $sponsor_id,
                    'from_id'        => $user_detail->id,
                    'total_amount'   => $sponsor_comm_amt,
                    'payable_amount' => $sponsor_comm_amt,
                    'payment_type'   => 'direct_sponsor_bonus',
                ]);
                Balance::where('user_id', $sponsor_id)->increment('balance', $sponsor_comm_amt);
                User::where('id', $sponsor_id)->decrement('revenue_share', $sponsor_comm_amt);
                RsHistory::create([
                    'user_id'  => $sponsor_id,
                    'from_id'  => $user_detail->id,
                    'rs_debit' => $sponsor_comm_amt,
                ]);
            } else if (User::where('id', $sponsor_id)->pluck('auto_rs') == 'yes') {

                $top_up = Packages::TopUPAutomatic($sponsor_id);

                if ($top_up) {
                    goto SPOSNSORCOMMISSION;
                }

            }

            /* Leadership bonus*/
            LeadershipBonus::allocateCommission($user_detail->id, $sponsor_id, $package->id, $package->pv);
            /* Ponit update and matching bonus*/
            Tree_Table::getAllUpline($user_detail->id);
            $key = array_search($sponsor_id, Tree_Table::$upline_id_list);
            if ($key >= 0) {
                if (Tree_Table::$upline_users[$key]['leg'] == 'L') {

                    User::where('id', $sponsor_id)->increment('left_count');

                } else if (Tree_Table::$upline_users[$key]['leg'] == 'R') {
                    User::where('id', $sponsor_id)->increment('right_count');
                }
            }
            PointTable::updatePoint($package->pv, $user_detail->id);
            PointTable::pairing($user_detail->id);

        } else {
            return redirect()->back()->withErrors(['Whoops, User not found ']);
        }

        Session::flash('flash_notification', array('message' => "Member activated succesfully", 'level' => 'success'));

        return redirect()->back();

    }
    public function search(Request $request)
    {
        $keywords    = $request->get('username');
        $suggestions = User::where('username', 'LIKE', '%' . $keywords . '%')->get();
        return $suggestions;
    }
    public function changeusername()
    {
        $title         = trans('adminuser.change_username');
        $sub_title     = trans('adminuser.change_username');
        $base          = trans('adminuser.change_username');
        $method        = trans('adminuser.change_username');


        return view('app.admin.users.changeusername', compact('title', 'sub_title', 'base', 'method'));

    }
    public function updatename(Request $request)
    {
        if (strtolower($request->username) == 'adminuser') {
            Session::flash('flash_notification', array('message' => "Username can not changed", 'level' => 'success'));
            return redirect()->back();
        }
        $username         = $request->username;
        $new_username     = $request->new_username;
        $data             = array();
        $user['username'] = $request->username;
        $validator        = Validator::make($user,
            ['username' => 'required|exists:users']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $data['username'] = $request->new_username;
            $validator        = Validator::make($data,
                ['username' => 'required|unique:users,username|alpha_num|max:255']);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                $update = DB::table('users')->where('username', $username)->update(['username' => $new_username]);
                Session::flash('flash_notification', array('message' => "Username Changed Successfully", 'level' => 'success'));

                return redirect('admin/userprofiles/'.$new_username);

            }
        }
    }

     public function updateadminpass(Request $request){
        $current_pass = $request->oldpass;
        $new_password = $request->newpass; 
        $pass= bcrypt($request->newpass);
        $repeat_password=$request->confpass;
        $user_id = 1;

        // dd($current_pass,Auth::user()->password);
        if (Hash::check($current_pass, Auth::user()->password))
        {    
            if($new_password === $repeat_password ){

         
            User::updatePassword($user_id,$pass);
            Session::flash('flash_notification',array('level'=>'success','message'=>'Password updated'));
                         return redirect()->back();
                     }
                     else{
                        
                        return redirect()->back()->withErrors(['Password conformation fails']);
                     }
       }
       else
       {       
         
          return redirect()->back()->withErrors(['Password mismatch']);


        
       }

}
// tree-delete
 public function delete_tree()
 {

        $title = trans("ticket_config.change_member_to_customer");
        $sub_title = trans("users.users");
        $method = trans("ticket_config.change_member_to_customer");
       
        return view('app.admin.users.delete_tree',  compact('title','sub_title','base','method'));


 }
 public function postdelete_tree(Request $request){

    // dd($request->all());
        $validator = Validator::make($request->all(), ["username" => 'required|exists:users,username']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['The username not exist']);
        }

      $user_id = User::where('username',$request->username)->value('id');
      $user = User::find($user_id);
      $table_id    = Tree_Table::where('user_id',$user_id)->value('id');
      $delete_user = Tree_Table::find($table_id);
      $user_count  = Tree_Table::where('placement_id',$user_id)->where('type','=','yes')->count('id');
      if($user_count<2){
          $child = Tree_Table::where('placement_id',$user_id)->where('type','<>','vaccant')->value('user_id');
   
          if($child!=null){
              $child_id = Tree_Table::where('user_id',$child)->value('id');
              Tree_Table::where('id',$child_id)->update([
                  'placement_id'=>$delete_user->placement_id,
                  'leg'=>$delete_user->leg
                ]);
              $child_del = Tree_Table::find($table_id);
              $child_del->delete();
              TypeChange::create([
                  'user_id'=>$user_id,
                  'placement'=>0,
                  'status'=>'customer',
              ]);

              // User::where('id',$user_id)->update([
              //     'tree_placement'=>'no',
              //     'customer'=>'yes' 
              // ]);

             
            }else{
              Tree_Table::create([
                        'sponsor'      => 0,
                        'user_id'      => '0',
                        'placement_id' => $delete_user->placement_id,
                        'leg'          => $delete_user->leg,
                        'type'         => 'vaccant',
              ]);
              $delete_user->delete();

              TypeChange::create([
                  'user_id'=>$user_id,
                  'placement'=>0,
                  'status'=>'customer',
              ]);

              // User::where('id',$user_id)->update([
              //     'tree_placement'=>'no',
              //     'customer'=>'yes' 
              // ]);
            }


        }else{
          DB::beginTransaction();
            $child = Tree_Table::where('placement_id',$user_id)
                    ->where('type','<>','vaccant')
                    ->where('leg','=','L')->value('user_id');
            $child_id = Tree_Table::where('user_id',$child)->value('id');
            Tree_Table::where('id',$child_id)->update([
                  'placement_id'=>$delete_user->placement_id,
                  'leg'=>$delete_user->leg,
                ]);
            $user_del = Tree_Table::find($table_id);
            $user_del->delete();
            TypeChange::create([
                  'user_id'=>$user_id,
                  'placement'=>0,
                  'status'=>'customer',
              ]);

            //   User::where('id',$user_id)->update([
            //       'tree_placement'=>'no',
            //       'customer'=>'yes' 
              // ]);

            $right_id = Tree_Table::where('placement_id',$user_id)
                    ->where('type','<>','vaccant')
                    ->where('leg','=','R')->value('user_id');
            
            SELF::placement_change($right_id,$child);
      }
      DB::commit();


     session::flash('flash_notification', array('message' => "Success", 'level' => 'success'));

        return redirect()->back();
 }
 Public static function placement_change($right_id,$left_id){
    $right_user = Tree_Table::where('placement_id',$left_id)
                    ->where('type','<>','vaccant')
                    ->where('leg','=','R')->value('user_id');
    $left_user = Tree_Table::where('placement_id',$left_id)
                    ->where('type','<>','vaccant')
                    ->where('leg','=','L')->value('user_id');
    Tree_Table::where('user_id',$right_id)->update(['placement_id'=>$left_id]); 
    if($left_user != NULL && $right_user != NULL)
        SELF::placement_change($right_user,$left_user);
    elseif($left_user == NULL && $right_user != NULL){
      Tree_Table::where('user_id',$right_user)->delete();
      Tree_Table::where('placement_id',$left_id)->where('leg','L')->update([
            'user_id'=>$right_user,
            'sponsor'=>Sponsortree::where('user_id',$right_user)->value('sponsor'),
            'type'   =>'yes'
          ]); 
    }
    else{
        $count=Tree_Table::where('placement_id',$left_id)->pluck('id');
        if(count($count)>2){
            $user_del=Tree_Table::where('placement_id',$left_id)
                    ->where('leg','R')
                    ->where('type','vaccant')->value('id');
            $user_del = Tree_Table::find($user_del);
            $user_del->delete();
        }
    }
  }

  public function purchaseHistory(){
    $data = PurchaseHistory::join('packages','packages.id','=','purchase_history.package_id')
                            ->join('users','users.id','=','purchase_history.user_id')
                           ->select('purchase_history.id','packages.package','count','packages.amount','total_amount','purchase_history.created_at','purchase_history.pv','purchase_history.pay_by','users.username')
                           ->orderBy('purchase_history.id','DESC')
                           ->paginate(10);
                           // dd($data);
           
        $title = trans('products.purchase_history');
        $sub_title = trans('products.purchase_history'); 
        $base = trans('products.purchase_history');  
        $method = trans('products.purchase_history');     
        return view('app.admin.products.purchase-history',compact('title','data','base','method','sub_title'));
  }

  public function viewInvoice($id){
    // dd("dd");

         
        $title = trans('products.purchased_plan');
        $sub_title = trans('products.purchased_plan'); 
        $base = trans('products.purchase_plan');  
        $method = trans('products.purchase_plan'); 
      
       
      
      $data = PurchaseHistory::where('id','=',$id)->value('datas');

      $datas = json_decode($data,true);
          

    // return view('app.user.product.purchase-invoice',compact('title','datas','base','method','sub_title'));
     return view('app.admin.products.purchaseinvoice',compact('title','datas','base','method','sub_title'));

  }

   public function refreshDatabase(){
       Artisan::call('migrate:refresh', [ '--force' => true, ]);
       Artisan::call('db:seed');
       
       Session::flash('flash_notification', array('message' => "Database cleared succesfully ", 'level' => 'success'));

        return redirect()->back();
    }


   public function createNews()
   {
    
       $title = 'Create News';
       $base = 'Create News';
       $method = 'Create News';
       $sub_title = 'Create News';

      $create_news = News::orderBy('created_at','desc')->take(5)->get(); 

      return view('app.admin.users.create_news',  compact('title','create_news','base','method','sub_title'));
    }

    public function News(Request $request){

        // dd($request->all());

       $news=News::create([
        'title' =>$request->title,
        'description' => $request->description,
        ]);

       // dd($news);
       
   
        Session::flash('flash_notification',array('message'=>'News created successfully','level'=>'success'));

        return redirect()->back();  
    }

    public function readNews()
    {

        $title = 'Read News';
        $sub_title='Read News';
        $base='Read News';
        $method='Read News';

      $read_news = News::orderBy('created_at','desc')->paginate(10);
      return view('app.admin.users.news',compact('title','read_news','sub_title','base','method'));

    }
    public function readMore($id)
    {

        $title = 'Read News';
        $sub_title='Read News';
        $base='Read News';
        $method='Read News';

        $read_news = News::where('id',$id)->get();   
        return view('app.admin.users.readnews',compact('title','read_news','sub_title','base','method'));

    }


    public function editNews($id){

    $title = 'Edit news';
    $sub_title = 'Edit news';
    $base = 'Edit news';
    $method = 'Edit news';

    $edit_news = News::where('id',$id)->get();
    return view('app.admin.users.edit_news',compact('title','edit_news','sub_title','base','method'));

   } 

   public function updateNews(Request $request){

    News::where('id',$request->id)->update(array('title'=>$request->title,'description'=>$request->description));
   Session::flash('flash_notification', array('level' => 'success','message' =>'News Updated Successfully'));

   return redirect('admin/read_news');
   }


  public function deleteNews($id){

     $delete_news= News::find($id);
     $delete_news->delete();
     Session::flash('flash_notification', array('level' => 'success', 'message' =>'news deleted successfully'));

      return redirect()->back();

   }

        public function getVideos(){

        $title     =  trans('users.videos');
        $sub_title =  trans('users.videos');
        $base      =  trans('users.videos');
        $method    =  trans('users.videos');
        $videos=EventVideos::all();
        $result=array();
        foreach ($videos as $key => $video) {
          $video_html=EventVideos::getVideoHtmlAttribute($video->url);
          $result[$video->id]['id']=$video->id;
          $result[$video->id]['title']=$video->title;
          $result[$video->id]['url']=$video_html;
          $result[$video->id]['created']=$video->created_at;
          # code...
        }

    
        return view('app.admin.users.videos', compact('title','sub_title','base','method','result'));

      }

      public function postVideos(Request $request){
       

          
               $url=$this::isValidURL(trim($request->videos));

                if($url<>0) {
               
                EventVideos::create([
                    'title'       =>$request->title,
                    'url'=>$request->videos,
                    'type'      =>'video', 
                ]);

                  Session::flash('flash_notification', array('level' => 'success', 'message' => 'Videos Added Successfully'));
            }
            else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'Please check the url'));
            }
    
      
        
           return redirect()->back();
      }

      public static function isValidURL($url){
      return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }
    public function editvideo($id){
      $title     =  trans('users.edit_video');
      $sub_title =  trans('users.edit_video');
      $base      =  trans('users.edit_video');
      $method    =  trans('users.edit_video');
      $editvideo=EventVideos::find($id);
    return view('app.admin.users.editvideo', compact('title','sub_title','base','method','editvideo'));

    }

    public function posteditvideo(Request $request){

      $video=EventVideos::find($request->id);
      $url=$this::isValidURL(trim($request->videos));

      if($url<>0){

        $video->title = $request->title;
        $video->url=$request->videos;
        $video->save();


        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Videos edited Successfully'));
      }
      else{
            Session::flash('flash_notification', array('level' => 'error', 'message' => 'Please check the url'));
        }
        
      return redirect('admin/addvideos');
    }

    public function deletevideo($id){
      $delete_video=EventVideos::find($id);
      $delete_video->delete();

       Session::flash('flash_notification', array('level' => 'success', 'message' => 'Video deleted Successfully'));
     return redirect()->back();
    }

    public function pendingTransactions(){

        $title     = 'Pending Transactions';
        $sub_title =  'Pending Transactions';
        $base      =  'Pending Transactions';
        $method    =  'Pending Transactions';
        $users = PendingTransactions::select('pending_transactions.id','pending_transactions.order_id','pending_transactions.username','pending_transactions.email','packages.package','pending_transactions.payment_type','pending_transactions.amount','pending_transactions.created_at')
           ->join('packages','pending_transactions.package','=','packages.id')
         ->where('payment_status','pending')
         ->where(function ($query) {
                  $query->orwhere('payment_method','cheque'); 
                  $query->orwhere('payment_method','bank');
          })
          ->get();
          
        return view('app.admin.users.pendingtransactions',  compact('title','sub_title','base','method','users'));

    }

    public function pendingTransData(){
         $users = PendingTransactions::select('pending_transactions.id','pending_transactions.order_id','pending_transactions.username','pending_transactions.email','packages.package','pending_transactions.payment_type','pending_transactions.amount','pending_transactions.created_at')
           ->join('packages','pending_transactions.package','=','packages.id')
         ->where('payment_status','pending')
          ->where('payment_method','cheque');
          
        return Datatables::of($users)                
            ->remove_column('id')
          
            ->edit_column('created_at', '{{ date("dS F Y",strtotime($created_at)) }}')
            ->edit_column('package', '@if($package == "member") NA @else {{$package}} @endif')
           
            ->add_column('action',  ' 
                <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$id}}"> <span class="fa fa-check "></span>   </button>

              <!-- Modal -->

                <div id="myModal{{$id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">

              <!-- Modal content-->

                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body" style="overflow: auto !important;">

               <center> 

               Do you want to confirm this payment??
              

                </center>

                
                </div>                 
                </form>
                <div class="modal-footer">
                <div class="row">
                <a href="{{{ URL::to(\'admin/activatependinguser/\' . $id) }}}" class="btn btn-success" ></span>Confirm </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
                </div>
                </div>
                </div>
                <script type="text/javascript">

                $("#myModal{{$id}}").on("hidden.bs.modal", function () {
                oTable.ajax.reload();
                })
                </script>')
             ->escapeColumns([])
             ->make();
    }


    public function activatePendingUser($id){

        // dd($id);
       $transaction= PendingTransactions::find($id);
       $pay_data=json_decode($transaction->request_data,true);
     
       if($transaction->payment_type == 'upgrade'){
       $package=ProfileModel::where('user_id',$transaction->user_id)->value('package');
       if($transaction->package > $package){

         $package=Packages::find($transaction->package);
         $purchase_id= PurchaseHistory::create([
                        'user_id'=>$transaction->user_id,
                        'purchase_user_id'=>$transaction->user_id,
                        'package_id'=>$transaction->package,
                        'count'=>1,
                        'pv'=>$package->pv,
                        'total_amount'=>$transaction->amount,
                        'pay_by'=>$transaction->payment_method,
                        'rs_balance'=>$package->rs,
                        'sales_status'=>'yes',
                        ]);
                        RsHistory::create([
                        'user_id'=>$transaction->user_id,                   
                        'from_id'=>$transaction->user_id,
                        'rs_credit'=>$package->rs,
                        ]);
                          

         /*edited by vincy on match 13 2020*/
         $rank_id=User::where('id',$transaction->user_id)->value('rank_id');
            $check_in_matrix = Tree_Table::where('user_id',$transaction->user_id)->where('type','yes')->count();
            if($check_in_matrix == 0){
               Packages::DirectReferrals($transaction->user_id,$transaction->package);
                $addtomatrixplan = Packages::Addtomatrixplan($transaction->user_id);   
            }
        /*edited by vincy on match 13 2020*/

            $old_package=ProfileModel::where('user_id',$transaction->user_id)->value('package');
             if($old_package > 1){
               $cur_pack_order=PendingTransactions::where('user_id',$transaction->user_id)->where('package',$old_package)->where('payment_status','complete')->first();
               if($cur_pack_order->payment_method == 'paypal'){
                $agreement = new \PayPal\Api\Agreement();
                $agreementId = $cur_pack_order->paypal_agreement_id;                 
                $agreement = new Agreement();  
                $agreement->setId($agreementId);
                $agreementStateDescriptor = new AgreementStateDescriptor();
                $agreementStateDescriptor->setNote("Cancel the agreement");

                try {
                    $agreement->cancel($agreementStateDescriptor, $this->apiContext);
                    $cancelAgreementDetails = Agreement::get($agreement->getId(), $this->apiContext); 
                          
                } catch (Exception $ex) {                  
                }
             }
           }

        
         //commsiiom
            $sponsor_id=Sponsortree::where('user_id',$transaction->user_id)->value('sponsor');
             if($old_package == 1){
                $pur_count=User::where('id',$sponsor_id)->value('purchase_count');
                $new_pur_count=$pur_count+1;
                User::where('id',$sponsor_id)->update(['purchase_count' => $new_pur_count]);
             }
            ProfileModel::where('user_id',$transaction->user_id)->update(['package' => $transaction->package]);
             User::where('id',$transaction->user_id)->update(['active_purchase' => 'yes']);
            $user_arrs=[];
            $results=Ranksetting::getTreeUplinePackage($transaction->user_id,1,$user_arrs);
            array_push($results, $transaction->user_id);

            foreach ($results as $key => $value) {
                Packages::rankCheck($value);
            }
            Packages::levelCommission($transaction->user_id,$package->amount,$transaction->package);
            // Packages::directReferral($sponsor_id,$transaction->user_id,$transaction->package);
             $category_update=User::categoryUpdate($sponsor_id);

            //comm

         $pur_user=PurchaseHistory::find($purchase_id->id);
         $user=User::join('profile_infos','profile_infos.user_id','=','users.id')
                   ->join('packages','packages.id','=','profile_infos.package')
                   ->where('users.id',$pur_user->user_id)
                   ->select('users.username','users.name','users.lastname','users.email','profile_infos.mobile','profile_infos.address1','packages.package')
                   ->get();
          $userpurchase=array();      
          $userpurchase['name']=$user[0]->name;
          $userpurchase['lastname']=$user[0]->lastname;
          $userpurchase['amount']=$transaction->amount;
          $userpurchase['payment_method']=$purchase_id->pay_by;
          $userpurchase['mail_address']=$user[0]->email;
          $userpurchase['mobile']=$user[0]->mobile;
          $userpurchase['address']=$user[0]->address1;
          $userpurchase['invoice_id'] ='0000'.$purchase_id->id;
          $userpurchase['date_p']=$purchase_id->created_at;
          $userpurchase['package']=$package->package;
          PurchaseHistory::where('id','=',$purchase_id->id)->update(['datas'=>json_encode($userpurchase)]);
          $transaction->payment_status ='complete';
          $transaction->save();

          //Developed By Arslan Malik - NetPower
          $email = Emails::find(3);
          $app_settings = AppSettings::find(1);
            
          \Mail::send('emails.upgrade',
                      ['email'         => $email,
                          'company_name'   => $app_settings->company_name,
                          'logo'   => $app_settings->logo,
                          'firstname'      => $user[0]->name,
                          'name'           => $user[0]->lastname,
                          'welcome'        => $email->content,
                     ], function ($m) use ($user, $email) {
              $m->to($user[0]->email, $user[0]->name)->subject('Successfully upgraded!')->from($email->from_email, $email->from_name);
                      });


          Session::flash('flash_notification',array('message'=>"You have purchased the plan successfully ",'level'=>'success'));
          return redirect()->back();
      }else{
          Session::flash('flash_notification',array('message'=>"Sorry You have already purchased this package",'level'=>'error'));
          return redirect()->back();
      }
       }
       else{
	
          // dd($pay_data);
          $sponsor_id = User::checkUserAvailable($pay_data['sponsor']);
          $placement_id =  User::checkUserAvailable($pay_data['placement_user']);
          $username=User::userNameToId($transaction->username);
          $email=User::userEmailToId($transaction->email);
          if($sponsor_id <> null && $placement_id <> null && $username == null && $email== null){
            $userresult=User::add($pay_data,$sponsor_id,$placement_id);
            $transaction->payment_status ='complete';
            $transaction->save();

            $email = Emails::find(1);
            $welcome=welcomeemail::find(1);
            $app_settings = AppSettings::find(1);

            //Developed By Arslan Malik - NetPower
            \Mail::send('emails.register',
                        ['email'         => $email,
                            'company_name'   => $app_settings->company_name,
                            'logo'   => $app_settings->logo,
                            'firstname'      => $pay_data['firstname'],
                            'name'           => $pay_data['lastname'],
                            'login_username' => $pay_data['username'],
                            'password'       => $pay_data['password'],
                            'welcome'        => $welcome,
                            'transaction_pass'=>$pay_data['transaction_pass'],
                       ], function ($m) use ($pay_data, $email) {
                $m->to($pay_data['email'], $pay_data['firstname'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
                        });

                $subemail = Emails::find(2);

                \Mail::send('emails.subscriptionemail',
                        ['email'         => $subemail,
                            'company_name'   => $app_settings->company_name,
                            'logo'   => $app_settings->logo,
                            'firstname'      => $pay_data['firstname'],
                            'name'           => $pay_data['lastname'],
                            'welcome'        => $subemail->content,
                       ], function ($m) use ($pay_data, $email) {
                            $m->to($pay_data['email'], $pay_data['firstname'])->subject('Package Activated Successfully!')->from($email->from_email, $email->from_name);
                        });


            Session::flash('flash_notification', array('level' => 'success', 'message' => 'User activated Successfully'));
            return redirect()->back();
          }else{
            Session::flash('flash_notification', array('level' => 'error', 'message' => 'User activation Is not possible'));
            return redirect()->back();
            }
       }
    }

    public function createBrokers(){

    $title     = 'Broker Details';
    $sub_title =  'Broker Details';
    $base      =  'Broker Details';
    $method    =  'Broker Details';
    $all_brokers=BrokerDetails::paginate(10);
        
      return view('app.admin.users.createbroker',  compact('title','sub_title','base','method','all_brokers'));

    }

     public function upCreateBrokers(Request $request){

        $url=$this::isValidURL(trim($request->url));
           if($url<>0){
                BrokerDetails::create([
                    'name' =>$request->name,
                    'url' => $request->url,
                    'status' =>$request->status,
                 ]);
                Session::flash('flash_notification', array('level' => 'success', 'message' => 'User added successfully'));
                return redirect()->back();
            }
            else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'Please check the url'));
                return redirect()->back();
            }
        
    }

     public function brokerRequest(){
        $title     = 'User Requests';
        $sub_title =  'User Requests';
        $base      = 'User Requests';
        $method    =  'User Requests';
        $all_req=UserBrokerDetails::join('users','user_broker_details.user_id','=','users.id')
                                  ->join('broker_details','broker_details.id','=','user_broker_details.broker_id')
                                  ->select('users.username','broker_details.name','user_broker_details.account','user_broker_details.password','user_broker_details.status','user_broker_details.created_at')->paginate(10);
        
      return view('app.admin.users.userbrokerrequest',  compact('title','sub_title','base','method','all_req'));
        
    }

    public function verifyusers(){
        $title     = 'Verify Users';
        $sub_title =  'Verify Users';
        $base      = 'Verify Users';
        $method    = 'Verify Users';

        $users=User::where('verified','no')->where('id','>',1)->paginate(10);


         return view('app.admin.users.verifyuserdoc',  compact('title','sub_title','base','method','all_req','users'));

    }

    public function verifyDocuser(Request $request){
        // dd($request->all());
        $ver_count=User::where('verification_number',$request->verification_number)->count();
        if($ver_count < 4){
        User::where('id',$request->user_id)->update(['verification_number' => $request->verification_number,'verified' => 'yes']);

         Session::flash('flash_notification', array('level' => 'success', 'message' => 'User Verified successfully'));
                return redirect()->back();
            }
            else{

         Session::flash('flash_notification', array('level' => 'error', 'message' => 'Verification Number is not valid'));
                return redirect()->back();
            }

    }

    public function editBroker($id){
         $title     = 'Edit Broker';
        $sub_title =  'Edit Broker';
        $base      = 'Edit Broker';
        $method    = 'Edit Broker';
        $broker=BrokerDetails::find($id);
        return view('app.admin.users.editbroker',  compact('title','sub_title','base','method','broker'));
    }

    public function saveeditBroker(Request $request){

        $url=$this::isValidURL(trim($request->url));
           if($url<>0){
                $broker_det=BrokerDetails::find($request->id);
                $broker_det->name =$request->name;
                $broker_det->url = $request->url;
                $broker_det->status =$request->status;
                $broker_det->save();
                
                Session::flash('flash_notification', array('level' => 'success', 'message' => 'Broker Details updated successfully'));
                return redirect('admin/createbrokers');
            }
            else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'Please check the url'));
                return redirect()->back();
            }
    }

    public function deleteBroker($id){
         $broker_det=BrokerDetails::find($id);
         $broker_det->delete();
          Session::flash('flash_notification', array('level' => 'success', 'message' => 'Broker details Deleted Successfully'));
                return redirect()->back();
    }



    public function deletependinguser($id)
    {
        
        $pending_trans = PendingTransactions::find($id);

        $pending_trans->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => ' Deleted Successfully'));
        return redirect()->back();
    }

    public function deleteusers()
     {

        $title     = 'Remove Users';
        $sub_title = 'Remove Users';
        $base      = 'Remove Users';
        $method    = 'Remove Users';

        return view('app.admin.users.deleteusers',  compact('title','sub_title','base','method'));
    }


    public function postdeleteusers(Request $request)
    {
        $validator = Validator::make($request->all(), ["username" => 'required|exists:users,username']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['The username not exist']);
        }

        $user_id = User::where('username',$request->username)->value('id');
      
        $check_spvaccancy = Sponsortree::where('sponsor',$user_id)->where('type','<>','vaccant')->count();
        
        if($check_spvaccancy > 0){
                
           Session::flash('flash_notification', array('level' => 'danger', 'message' => 'This user cant be deleted'));          
           return redirect()->back(); 
        }

        $placed_check = Tree_Table::where('user_id',$user_id)->count();

        if($placed_check > 0){

            $check_vaccancy = Tree_Table::where('placement_id',$user_id)->where('type','<>','vaccant')->count();

            if($check_vaccancy > 0){
                
                Session::flash('flash_notification', array('level' => 'danger', 'message' => 'This user can not be deleted'));    
                return redirect()->back(); 
            }

            #delete from tree table 
            $treeid = Tree_Table::where('user_id',$user_id)->value('id');

            $tree          = Tree_Table::find($treeid);
            $tree->user_id = 0;
            $tree->sponsor = 0;
            $tree->type    = 'vaccant';
            $tree->save();

            $delete_vaccant = Tree_Table::where('placement_id',$user_id)->delete();
       }
       #delete from sponsor table
       $sp_treeid = Sponsortree::where('user_id',$user_id)->value('id');
       $softdel_user = Sponsortree::find($sp_treeid)->delete();
       $delete_vac = Sponsortree::where('sponsor',$user_id)->delete();

       $userinfo = User::find($user_id);
       
       $user_name_update = User::where('id',$user_id)->update([
                                                              'username' => $userinfo->username.'deleted' , 
                                                              'email' => $userinfo->email.'deleted' ,
                                                     ]);

       $user_tbl_del = User::find($user_id)->delete();
       $profile_tbl_del = ProfileModel::where('user_id',$user_id)->delete();
       $purchase_tbl_del = PurchaseHistory::where('user_id',$user_id)->delete();

       Session::flash('flash_notification', array('level' => 'success', 'message' => 'User has been deleted'));   
       return redirect()->back();   
         
    }

  public function payplemail_settings(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'paypal_email' => 'required|email',
            
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }else{
             $user_info                 = User::where('id',$request->user_id)->first();
            $user_info->paypal_email = $request->paypal_email;
            if($user_info->save()) {
              Session::flash('flash_notification', array('level' => 'success', 'message' => 'Paypal Eamil Updated Successfully'));
            }else{
              Session::flash('flash_notification', array('level' => 'error', 'message' => 'Something went wrong'));
            }
            return redirect()->back();
        }
     
    }
    public function bitconaccount_settings(Request $request)
    {
       
       $validator = Validator::make($request->all(), [
            'bitcoin_address' => 'required',
            
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }else{
             
              $user_info                 = User::where('id',$request->user_id)->first();
              $user_info->bitcoin_address = $request->bitcoin_address;
              if ($user_info->save()) {
                  Session::flash('flash_notification', array('level' => 'success', 'message' => 'Bitcoin Account Updated Successfully'));
      
              }
            else{
              Session::flash('flash_notification', array('level' => 'error', 'message' => 'Something went wrong'));
            }
            return redirect()->back();
        }
    }

   

    
}
