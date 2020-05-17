<?php

namespace App\Http\Controllers\user;
use App\Balance;
use App\Commission;
use App\Country;
use App\DirectSposnor;
use App\Helpers\Thumbnail;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\user\ProfileEditRequest;
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
use App\Payout;
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
use App\Note;
use Crypt;
use CountryState;
use App\Ranksetting;
use Storage;

class ProfileController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {

        
        $title     = trans('users.profile');
        $sub_title = trans('users.profile');
        $base = trans('users.profile');
        $method = trans('users.profile');

        $user_id = Auth::id();
        Session::put('prof_username', Auth::user()->username);
     


        $user_id = $user_id;



        $selecteduser = User::with('profile_info')->find($user_id);
         //dd($selecteduser->username);
      
        $profile_infos = ProfileInfo::with('images')->where('user_id',$user_id)->first();
        // dd($profile_infos);
        $profile_photo = $profile_infos->profile;
        if (!Storage::disk('images')->exists($profile_photo)){
            $profile_photo = 'avatar-big.png';
        }
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
       

        $referals = User::select('users.*')->join('tree_table', 'tree_table.user_id', '=', 'users.id')->where('tree_table.sponsor', $user_id)->limit(6)->get();

         
        $total_referals = count($referals);
        $base           = trans('users.profile');
        $method         = trans('users.profile_view');

        $referrals      = Sponsortree::getMyReferals($user_id);
        $total_referalz = count($referrals);
        $balance         = Balance::getTotalBalance($user_id);
        $total_payout    = Payout::getMyTotalPayout($user_id);         
        $vouchers        = Voucher::getAllVouchers();
        $voucher_count   = count($vouchers);
        $mails           = Mail::getMyMail($user_id);
        $mail_count      = count($mails);
        $referrals_count = $total_referals;
        $sponsor_id      = Sponsortree::getSponsorID($user_id);
        $sponsor      = User::with('profile_info')->where('id',$sponsor_id)->first();
          // dd($sponsor);


        $left_bv         = PointTable::where('user_id', '=', $user_id)
            ->value('left_carry');
        $right_bv = PointTable::where('user_id', '=', $user_id)
            ->value('right_carry');

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

        $notes   = Note::where('user_id','=',Auth::user()->id)->get();


        
        return view('app.user.profile.index', compact('title','sub_title', 'base', 'method', 'mail_count', 'voucher_count', 'balance', 'referrals', 'countries', 'selecteduser', 'sponsor', 'referals',  'left_bv', 'right_bv', 'user_package','profile_infos','country','state','referrals_count','user_rank_name','profile_photo','cover_photo','total_payout','notes','states','total_referalz'));
    }

    // public function index()
    // {

       // $title=trans('profile.title');
       // $sub_title = trans('profile.sub_title');
       // $user = User::find(Auth::user()->id);
       // $profile_infos=ProfileInfo::find(Auth::user()->id);
       // $dateofbirth= explode('/',$profile_infos->dateofbirth);      
       // $ddArr=array();
       // $referals = ProfileInfo::select('profile_infos.*','packages.package as packagename')
       // ->join('sponsortree', 'sponsortree.user_id', '=', 'profile_infos.user_id')
       // ->join('packages','packages.id','=','profile_infos.package')
       // ->where('sponsortree.sponsor',Auth::user()->id)->get();
       // $total_referals = User::select('users.*')->join('sponsortree', 'sponsortree.user_id', '=', 'users.id')->where('sponsortree.sponsor',Auth::user()->id)->count();
       // $total_ewallet = Balance::getTotalBalance(Auth::user()->id);
       // $all_vouchers = Voucher::getAllVouchers();
       // $num_vouchers = count($all_vouchers);
       // $my_mails = Mail::getMyMail(Auth::user()->id);
       // $mail_count = count($my_mails);
       // for($i=01;$i<=31;$i++)
       // $ddArr[$i] =$i;
       // $categories = Country::getcountry();
       // $currencies = Currency::all();

       //  $left_bv =  PointTable::where('user_id','=',Auth::user()->id)->value('left_carry');
       //  $right_bv =  PointTable::where('user_id','=',Auth::user()->id)->value('right_carry');
       
       // $base = trans('profile.profile');
       // $method = trans('profile.title');
    //    return view('app.user.profile.index',compact('title','total_referals','left_bv','right_bv','total_ewallet','num_vouchers','currencies','user','mail_count','categories','ddArr','dateofbirth','referals','base','method','sub_title','profile_infos'));
    // }

   
    public function currency(Request $request)
    {
        $user=ProfileInfo::find(Auth::user()->id);
        $user->currency=$request->currency;
        $user->save();
          Session::flash('flash_notification',array('message'=>trans('profile.currency_saved'),'level'=>'success'));
          return redirect()->back(); 
    }

    public function legsetting(Request $request)
    {
        $user=User::find(Auth::user()->id);
        $user->default_leg=$request->leg;
        $user->save();
          Session::flash('flash_notification',array('message'=>trans('profile.default_leg'),'level'=>'success'));
          return redirect()->back(); 
    }
     public function rssetting(Request $request)
    {
        $user=ProfileInfo::find(Auth::user()->id);
        $user->auto_rs=$request->auto_rs;
        $user->save();
          Session::flash('flash_notification',array('message'=>trans('profile.rs_top_up'),'level'=>'success'));
          return redirect()->back(); 
    }
  public function getEdit() {
       
        $title = trans('profile.change_password');
        $sub_title =  trans('profile.change_password');
        $base = trans('profile.change_password');
        $method = trans('profile.change_password');

        Session::flash('flash_notification',array('message'=>trans('profile.password_changed'),'level'=>'success'));
          return redirect()->back(); 

        return view('app.user.users.index', compact('title','base','method','sub_title'));
    }

    public function postEdit(Request $request) {

       $user = User::find(Auth::user()->id ); 


   

        $password = $request->password;
       $passwordConfirmation = $request->change_password;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $user->password = bcrypt($password);

            }
        }


      
        $user -> save();

          Session::flash('flash_notification',array('message'=>trans('profile.password_has_been_changed'),'level'=>'success'));

            /*$password = Emails::find(1) ;

        $app_settings = AppSettings::find(1) ;

         Mail::send('emails.password', ['email'=>$email,'company_name'=>$app_settings->company_name,'login_username' => $data['username'],'password'=> $data['password']], function ($m) use ($data , $email) {
             $m->to($data['email'], $data['firstname'])->subject('Password changed')->from($email->from_email, $email->from_name);
        });*/
          return redirect()->back();  
    }

   


     public function update(ProfileEditRequest $request, $id)
    {
     
     // dd($request->all());
      $user=User::find($id);
    
      $user->name=$request->name;
      $user->lastname=$request->lastname;
      $user->email = $request->email;
      $user->save();

      $new_user=ProfileInfo::find(ProfileInfo::where('user_id',$id)->value('id'));
  // dd($user);
      $new_user->mobile=$request->phone;
      $new_user->address1=$request->address1;
      $new_user->address2=$request->address2;
      $new_user->city=$request->city;
      $new_user->country=$request->country;
      $new_user->state=$request->state;
      $new_user->zip=$request->zip;
      $new_user->gender=$request->gender;
      $new_user->dateofbirth=$request->dd.'/'.$request->mm.'/'.$request->year;
      $new_user->skype=$request->skype;
      $new_user->gplus=$request->gplus;
      $new_user->linkedin=$request->linkedin;
      $new_user->twitter=$request->twitter;
      $new_user->facebook=$request->facebook;
      $new_user->whatsapp=$request->whatsapp;
      $new_user->about=$request->prof_details;
      $new_user->wechat=$request->wechat;
      $new_user->passport=$request->passport;

        $new_user->account_holder_name=$request->account_holder_name;
        $new_user->account_number=$request->account_number;
        $new_user->swift=$request->swift;
        $new_user->sort_code=$request->sort_code;
        $new_user->bank_code=$request->bank_code;
        $new_user->iban=$request->iban;
        $new_user->bank_country=$request->bank_country;
        $new_user->branch_count=$request->branch_count;
        $new_user->paypal=$request->paypal;
          $new_user->bank_address               = $request->bank_address;
          $new_user->bank_name               = $request->bank_name;



      if ($request->hasFile('profile_pic')){
            $destinationPath = base_path()."\public\appfiles\images\profileimages"; 
            $extension = Input::file('profile_pic')->getClientOriginalExtension();
            $fileName = rand(11111,99999).'.'.$extension; 
            Input::file('profile_pic')->move($destinationPath, $fileName); 
            $new_user->image=$fileName;

             $path2 = public_path() . '/appfiles/images/profileimages/thumbs/';
            Thumbnail::generate_profile_thumbnail($destinationPath .'/'. $fileName, $path2 . $fileName);
            $path3= public_path() . '/appfiles/images/profileimages/small_thumbs/';
            Thumbnail::generate_profile_small_thumbnail($destinationPath .'/'. $fileName, $path3 . $fileName);
      
      }
       
       $new_user->save();


       Session::flash('flash_notification',array('level'=>'success','message'=>trans('profile.details_updated')));
              
     return Redirect::action('user\ProfileController@index');
    }
   
   
    public function getstates(getstaesRequest $request, $id){
      $data=DB::table('life_state')->where('country_id',$id)->get();
      $html2="";
      
       $count = count($data);
           for($i = 0;$i < $count;$i++){
             $html2 =  $html2 . "<option value='".$data[$i]->State_Id."'>".$data[$i]->State_Name."</option>";
             }
        $html1 = "<lablel for='state_id'>Select State:</lablel><select name='state_id' id='state_id' class='form-control'>".$html2."</select>";
         //  $html=$html1+$html2;
            return($html1);
    }

    public function saveDoc(Request $request){
      // dd($request->all());
           $validator = Validator::make($request->all(), [
            'savefile'   => 'mimes:doc,pdf,docx'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => trans('ticket_config.uploaded_failed')));
            return Redirect::back();
        }
        else{
      

            if (Input::hasFile('savefile')) {

            $destinationPath = public_path() . '/assets/uploads';
            $extension       = Input::file('savefile')->getClientOriginalExtension();
            $fileName        = rand(000011111, 99999999999) . '.' . $extension;
            Input::file('savefile')->move($destinationPath, $fileName);

            User::where('id',Auth::user()->id)->update(['document' => $fileName]);

           

            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.uploaded_success')));
            return Redirect::back();
        }

        }


        
        Session::flash('flash_notification', array('level' => 'error', 'message' => trans('ticket_config.no_file')));
       return Redirect::back();
    }
    public function payplemail_settings(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'paypal_email' => 'required|email',
            
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }else{
             $user_info               = User::where('id',Auth::user()->id)->first();
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

              $user_info               = User::where('id',Auth::user()->id)->first();
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
