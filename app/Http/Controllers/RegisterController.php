<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Voucher;
use App\Settings;
use App\Tree_Table;
use App\Sponsortree;
use App\PointTable;
use App\Ranksetting;
use App\Commission;
use App\Packages;
use App\PointHistory;
use App\ProfileInfo;
use App\PurchaseHistory;
use App\Sales;
use App\Emails;
use App\welcomeemail;
use App\AppSettings;
use App\TempDetails;
use App\PaymentType;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use Auth;
use View;
use Crypt;
use Session;
use Validator;
use App\Jobs\ChangeLocale;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        self::defineglobals();
    }
    public function index()
    {
        if ($placement_id) {
            $placement_id = Crypt::decrypt($placement_id);
            $place_details = Tree_Table::find($placement_id);
            if($place_details->type != 'vaccant'){
                return redirect()->back();
            }
            $placement_user = User::where('id',$place_details->placement_id)->pluck('username');
            $leg = $place_details->leg;
        }else{
            $leg = NULL;
            $placement_user  = Auth::user()->username;
        }
        $user_details = array();
        $user_details = User::where('username',$user)->get();
        $rules = ['sponsor' => 'required|min:5','username' => 'unique:users,username|required|min:5','email' => 'unique:users,email|required','password' => 'required|same:password_confirmation'];
        return view('site.register.register',compact('rules','user_details','placement_user','leg'));
        echo "cfghfgh";
    }
    public function replication($user){
        $rules = [
        'sponsor' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'reg_type' => 'required',
        'cpf' => 'required',
        'passport' => 'required',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'username' => 'required',
        'password' => 'required',
        ];
        //\Form::setValidation($rules);
        $user_details = array();
        $user_details = User::where('username',$user)->get();
        if(count($user_details)==0){
            return redirect('auth/login');
        }
        $title = "View All requests";
        $rules = ['sponsor' => 'required|min:5','username' => 'unique:users,username|required|min:5','email' => 'unique:users,email|required','password' => 'required|same:password_confirmation'];
        $categories = Country::getcountry();
        $packages = Packages::all();
        $joiningfee = Settings::pluck('joinfee');
        $voucher_code=Voucher::pluck('voucher_code');
        $payment_type=PaymentType::where('status','yes')->get();
        return view('site.register.repli_reg',compact('title','requests','rules','categories','user_details','packages','joiningfee','voucher_code','payment_type'));
    }
    public function defineglobals(){
        

         // $unread_count = Mail::unreadMailCount(Auth::user()->id);
        // $unread_mail = Mail::unreadMail(Auth::user()->id);
        $app = AppSettings::find(1);
        View::share('GLOBAL_PACAKGE', '');
        // View::share('unread_count',  $unread_count);
        // View::share('unread_mail',  $unread_mail);
        View::share('logo',  $app->logo);
        View::share('logo_ico',  $app->logo_ico);
        View::share('company_name',  $app->company_name);
        View::share('theme',  $app->theme);
                if($app->theme == 'dark')
                Assets::addCss(asset('assets/globals/css/theme/bigdark.css'));
        
    }
    protected function checkusername(){
        $result = user::checkUserAvailable('dijil');
        print_r($result);
    }
    public function reg(){
        $title = "View All requests";
        $rules = ['sponsor' => 'required|min:5','username' => 'unique:users,username|required|min:5','email' => 'unique:users,email|required','password' => 'required|same:password_confirmation'];
        $categories = Country::getcountry();
        return view('site.register.register_user',compact('title','requests','rules','categories'));
    }
    public function confirm(Request $request){

        $data = array();
        $data['reg_by']="free_join";
        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['reg_type'] = $request->reg_type;
        $data['cpf'] = $request->cpf;
        $data['passport'] =  $request->passport;
        $data['package'] = $request->package;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
        $data['country'] = $request->country;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['address'] = $request->address;
        $data['zip'] = $request->zip;
        $data['location'] = $request->location;
        $data['password'] = $request->password;
        $data['sponsor'] = $request->sponsor;
        $data['leg'] = $request->leg;
        $messages = [
            'unique'    => 'The :attribute already existis in the system',
            'exists'    => 'The :attribute not found in the system',
             ];
             $validator = Validator::make($data, [
                'sponsor' => 'required|exists:users,username|max:255',
                'email' => 'required|unique:users,email|email|max:255',
                'username' => 'required|unique:users,username|alpha_num|max:255',
                'password' => 'required|alpha_num|min:6',
                'leg' => 'required'
                ]);
             if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }else{
                if($request->payment == 'voucher'){
                    $vocher=$request['payable_vouchers'];
                    $count=count($vocher);
                    $total=0;
                    for ($i=1; $i < $count-1; $i++) {
                        Voucher::where('voucher_code','=',$vocher[$i])->update(['balance_amount' => 0]);
                        $amount = Voucher::where('voucher_code','=',$vocher[$i])->pluck('total_amount');
                        $total+=$amount;
                    }
                    $last=last($vocher);
                    $last_amount=Voucher::where('voucher_code','=',$last)->pluck('total_amount');
                    $total_amount=$total+$last_amount;
                    $joiningfee = Settings::pluck('joinfee');
                    Voucher::where('voucher_code','=',$last)->update(['balance_amount' => $total_amount-$joiningfee]);
                }
                if($request->payment == "paypal"){
                    require_once("paypal_functions.php");
                    $returnURL ='http://wc-bin.cloudmlmdemo.com/repli/xpress';
                    $cancelURL = 'http://wc-bin.cloudmlmdemo.com';
                    $_POST["L_PAYMENTREQUEST_0_AMT0"]=$request->PAYMENTREQUEST_0_ITEMAMT;
                    if(!isset($_POST['Confirm']) && isset($_POST['checkout'])){
                        if($_REQUEST["checkout"] || isset($_SESSION['checkout'])) {
                            $_SESSION['checkout'] = $_POST['checkout'];
                        }
                        $_SESSION['post_value'] = $_POST;
                        $returnURL = RETURN_URL_MARK;
                        $_SESSION['post_value']['RETURN_URL'] = $returnURL;
                        $_SESSION['post_value']['CANCEL_URL'] = $cancelURL;
                        $_SESSION['EXPRESS_MARK'] = 'ECMark';
                    } else {
                        $resArray = CallShortcutExpressCheckout ($_POST, $returnURL, $cancelURL);
                        $out = json_encode($_SESSION['nvpReqArray']);
                        $tempreg=TempDetails::create([
                            'regdetails' => $out,
                            'token' => $_SESSION['TOKEN'],
                            ]);
                        $ack = strtoupper($resArray["ACK"]);
                        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
                            {
                                RedirectToPayPal ( $resArray["TOKEN"]);
                            }
                            else
                            {
                                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
                                echo "SetExpressCheckout API call failed. ";
                                echo "Detailed Error Message: " . $ErrorLongMsg;
                                echo "Short Error Message: " . $ErrorShortMsg;
                                echo "Error Code: " . $ErrorCode;
                                echo "Error Severity Code: " . $ErrorSeverityCode;
                            }
                        }
                    }
                    $sponsor_id = User::checkUserAvailable($data['sponsor']);
                    if(!$sponsor_id){
                        return redirect()->back()->withErrors(['The username not exist']);
                    }
                    $settings = Settings::getSettings();
                    $binary_commission = $settings[0]->point_value;
                    $point_value = $settings[0]->point_value;
                    $tds =  $settings[0]->tds;
                    $service_charge =  $settings[0]->service_charge;
                    $amount_payable = $binary_commission - ($tds + $service_charge);
                    DB::beginTransaction();
                    $userresult=User::create([
                        'name' => $data['firstname'],
                        'lastname' => $data['lastname'],
                        'email' => $data['email'],                       
                        'username' => $data['username'],
                        'rank_id' => '1',
                        'register_by' => $data['reg_by'],
                        'cpf' => $data['cpf'],            
                        'password' => bcrypt($data['password'])
                        ]);

                    $user_profile=ProfileInfo::create([
                        'user_id'   =>$userresult->id,
                        'mobile'    => $data['phone'],
                        'passport'  => $data['passport'],
                        'gender'    => $data['gender'],
                        'country'   => $data['country'],
                        'state'     => $data['state'],
                        'city'      => $data['city'],
                        'address1'  => $data['address'],
                        'zip'       => $data['zip'],
                        'location'  => $data['location'], 
                        'package'   => $data['package']
                        ]);
                     $package = Packages::find($request->package);
                        $userPackage = PurchaseHistory::create([
                                'user_id'          => $userresult->id ,
                                'purchase_user_id' => Auth::user()->id ,
                                'package_id'       => $data['package'] ,
                                'pv'               => $package->pv,
                                'count'            => 1,
                                'total_amount'     =>$package->amount,
                                'pay_by'           => 0 ,
                                'sales_status'     => 0 ,
                                'rs_balance'       => $package->rs,
                                ]);
                    $sponsortreeid=Sponsortree::where('sponsor',$sponsor_id)->orderBy('id', 'desc')->take(1)->pluck('id');
                    $sponsortree=Sponsortree::find($sponsortreeid);
                    $sponsortree->user_id=$userresult->id;  
                    $sponsortree->sponsor=$sponsor_id; 
                    $sponsortree->type="yes"; 
                    $sponsortree->save();
                    $sponsorvaccant = Sponsortree::createVaccant($sponsor_id,$sponsortree->position);
                    $uservaccant = Sponsortree::createVaccant($userresult->id,0);
                    $placement_id = Tree_Table::getPlacementId($sponsor_id,$data['leg']);
                    $user_id = Tree_Table::vaccantId($placement_id,$data['leg']);
                    $tree = Tree_Table::find($user_id);
                    $tree->user_id = $userresult->id;       
                    $tree->sponsor = $sponsor_id;
                    $tree->placement_id = $placement_id;
                    $tree->leg = $data['leg'];
                    $tree->type = 'yes';
                    $tree->save();
                    Tree_Table::getAllUpline($userresult->id); 
                    PointTable::addPointTable($userresult->id);                    
                    Tree_Table::createVaccant($tree->user_id); 


                    PointTable::updatePoint($userPackage->pv,$userresult->id);
                    User::insertToBalance($userresult->id);

                    $settings = Settings::getSettings();
                    $sponsor_commisions =$settings[0]->sponsor_Commisions;
                    $tds = $sponsor_commisions *$settings[0]->tds /100;
                    $service_charge = $sponsor_commisions *$settings[0]->service_charge / 100;
                    $payable_amount = $sponsor_commisions  -  $tds -  $service_charge;
                    $commision = Commission::create([
                        'user_id'=>$sponsor_id,
                        'from_id'=>$userresult->id,
                        'total_amount'=>$sponsor_commisions,
                        'tds'=>$tds ,
                        'service_charge'=>$service_charge ,
                        'payable_amount'=>$payable_amount ,
                        'payment_type'=>'sponsor_commision' ,
                        'payment_status'=>'Yes'
                        ]);
                    User::upadteUserBalance($sponsor_id,$payable_amount);

                    $email = Emails::find(1) ;
                    $app_settings = AppSettings::find(1) ;
                    $welcome=welcomeemail::find(1);
                    DB::commit();
                    Mail::send('emails.register', ['welcome'=>$welcome,'email'=>$email,'company_name'=>$app_settings->company_name,'firstname'=>$data['firstname'],'name'=>$data['lastname'],'login_username' => $data['username'],'password'=> $data['password']], function ($m) use ($data , $email) {
             $m->to($data['email'], $data['firstname'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
         });
		Log::debug('Register Controller - Arslan');
                    $encrypt_id = Crypt::encrypt($userresult->id);
                    return  redirect("registersucces/$encrypt_id");
                }
            }
            public function data(Request $request){
                $key = $request->key;
                if(isset($key)){
                    $voucher = $request->voucher ;
                    $vocher=Voucher::where('voucher_code',$key)->get();
                    return Response::json($vocher);
                }
            }
            public function registersucces(Request $request,$encrypt_id){
                $id = Crypt::decrypt($encrypt_id);
                $data = User::find($id);
                return view('site.register.success',compact('data'));
            }
            public function validatesponsor(Request $request){
                return User::getSponsorId($request->sponsor);
            }
            public function validatepassport(Request $request){
                return User::where('passport',$request->passport)->pluck('id');
            }
            public function validatepin(Request $request){
                echo Voucher::getEpinAmount($request->e_pin);
            }
            public function validatemail(Request $request){
                return User::checkEmailAvailable($request->email);
            }
            public function validateusername(Request $request){
                return User::getUserId($request->username);
            }

              public function validatevoucher(Request $request){
                return Voucher::getVoucher($request->voucher);
            }


            public function xpress(){
                require_once("paypal_functions.php");
                $url = "";
                foreach($_GET as $key => $value)
                    {
                        $url .= $key . '=' . $value . '&';
                    }
                    $tok="&" . $url;
                    $resArray=hash_call("GetExpressCheckoutDetails",$tok);
                    $ack = strtoupper($resArray["ACK"]);
                    if($ack == "SUCCESS" || $ack=="SUCCESSWITHWARNING")
                        {
                            $myresult = ConfirmPayment( $resArray['L_PAYMENTREQUEST_0_AMT0'],$resArray);
                        }
                        if($myresult['PAYMENTINFO_0_PAYMENTSTATUS']== "Completed")
                            {
                                DB::table('temp_details')->where('token', $myresult['TOKEN'])->update(['paystatus' => 1]);
                                $temp_details = TempDetails::all()->where('token',$myresult['TOKEN'])->pluck('regdetails');
                                $str1 = $temp_details->first();
                                $str = json_decode($str1, true);
                                $sponsor_id = User::checkUserAvailable($str['sponsor']);
                                if(!$sponsor_id){
                                    return redirect()->back()->withErrors(['The username not exist']);
                                }
                                $settings = Settings::getSettings();
                                $binary_commission = $settings[0]->point_value;
                                $point_value = $settings[0]->point_value;
                                $tds =  $settings[0]->tds;
                                $service_charge =  $settings[0]->service_charge;
                                $amount_payable = $binary_commission - ($tds + $service_charge);
                                DB::beginTransaction();
                                $userresult=User::create([
                                    'name' => $str['L_PAYMENTREQUEST_0_NAME0'],
                                    'lastname' => $str['lastname'],         
                                    'email' => $str['email'],           
                                    'username' => $str['username'],
                                    'rank_id' => '1',
                                    'register_by' => "PaypalExpress",
                                    'password' => bcrypt($str['password'])
                                    ]);
                                $user_profile=ProfileInfo::create([
                                    'mobile' => $str['phone'],
                                    'passport' => $str['L_PAYMENTREQUEST_0_PASSPORT0'],
                                    'gender' => $str['gender'],
                                    'country' => $str['country'],
                                    'state' => $str['state'],
                                    'city' => $str['city'],
                                    'address1' => $str['address'],
                                    'zip' => $str['zip'],
                                    'package' => '1'
                                    ]);
                                $sponsortreeid=Sponsortree::where('sponsor',$sponsor_id)->orderBy('id', 'desc')->take(1)->pluck('id');
                                $sponsortree=Sponsortree::find($sponsortreeid);
                                $sponsortree->user_id=$userresult->id;  
                                $sponsortree->sponsor=$sponsor_id; 
                                $sponsortree->type="yes"; 
                                $sponsortree->save();
                                $sponsorvaccant = Sponsortree::createVaccant($sponsor_id,$sponsortree->position);
                                $uservaccant = Sponsortree::createVaccant($userresult->id,0);
                                $placement_id = Tree_Table::getPlacementId($sponsor_id,$str['leg']);
                                $user_id = Tree_Table::vaccantId($placement_id,$str['leg']);
                                $tree = Tree_Table::find($user_id);
                                $tree->user_id = $userresult->id;       
                                $tree->sponsor = $sponsor_id;
                                $tree->placement_id = $placement_id;
                                $tree->leg = $str['leg'];
                                $tree->type = 'yes';
                                $tree->save();
                                Tree_Table::createVaccant($tree->user_id);        
                                PointTable::addPointTable($userresult->id);
                                Tree_Table::getAllUpline($userresult->id);
                                $key = array_search($sponsor_id, Tree_Table::$upline_id_list) ;
                                if($key >= 0   && $sponsor_id  != 1){
                                   
                                }
                                User::insertToBalance($userresult->id);        
                                User::addCredits($userresult->id); 
                                $email = Emails::find(1) ;
                                $app_settings = AppSettings::find(1) ;
                                $welcome=welcomeemail::find(1);
                                DB::commit();
                                Mail::send('emails.register', ['welcome'=>$welcome,'email'=>$email,'company_name'=>$app_settings->company_name,'firstname'=>$str['L_PAYMENTREQUEST_0_NAME0'],'name'=>$str['lastname'],'login_username' => $str['username'],'password'=> $str['password']], function ($m) use ($str , $email) {
             $m->to($str['email'], $str['L_PAYMENTREQUEST_0_NAME0'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
         });
         $emaill = Emails::find(2);
         Mail::send('emails.subscriptionemail',
         ['email'         => $emaill,
              'company_name'   => $app_settings->company_name,
              'firstname'      => $data['firstname'],
              'name'           => $data['lastname'],
              'login_username' => $data['username'],
              'welcome'        => $emaill->content,
          ], function ($m) use ($data, $emaill) {
              $m->to($data['email'], $data['firstname'])->subject('Package Activated!')->from($emaill->from_email, $emaill->from_name);
          });
          Log::debug($emaill);
         $encrypt_id = Crypt::encrypt($userresult->id);
                                return  redirect("registersucces/$encrypt_id");
                            }
                        }


         public function binary_calculate_demo(Request $request){
             PointTable::pairing();
        }


    public function store_sponsor(Request $request)
    {

        $validate = User::where('username',$request->username)->count();
        if($validate > 0){

            Session::put('replication', $request->username);
            $sponsor_value = Session::get('replication'); 
            
        }

         session_start();
//  echo 11111111111;
 $_SESSION['test']="ath";
        // echo  Session::get('replication');        

        return Response::json(['message'=>'succes','sponsor_value'=>$sponsor_value])->header('Content-Type','application/json');
   }
}
