<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\MenuSettings;
use App\welcomeemail;
use App\PaymentType;
use App\AppSettings;
use App\ProfileInfo;
use App\Tree_Table;
use App\Settings;
use App\Packages;
use App\Activity;
use App\Country;
use App\Voucher;
use App\Emails;
use App\User;
use App\PaypalDetails;
use App\PendingTransactions;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use CountryState;
use Storage;
use GeoIP;
use Crypt;
use Mail;
use Input;
use Session;
use Redirect;
use Auth;

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
use Srmklive\PayPal\Services\ExpressCheckout;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
        protected static  $provider;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    private $_api_context;
    public function __construct()
    {
        
        /** setup PayPal api context **/
        // $paypal_conf = \Config::get('paypal');
        // $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        // $this->_api_context->setConfig($paypal_conf['settings']);
        // $this->middleware('guest');
         self::$provider = new ExpressCheckout;    
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($sponsorname = null)
    {
         $block=MenuSettings::where('menu_name','=','Register new')->value('status');
          $active = User::where('username','=',$sponsorname)->value('active');
        if($block == 'no'|| $active == 'no')
          return redirect("/");

        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        if (User::where('username', '=',  $sponsorname)->count() > 0) {
            $sponsor_name = $sponsorname;  
        }else{

            $sponsor_name = User::find(1)->username;
        }



        // $location = GeoIP::getLocation();
        // $ip_latitude = $location['lat'];
        // $ip_longtitude = $location['lon'];
        $countries = CountryState::getCountries();
        $states = CountryState::getStates('IL');
        $leg = 'L';
        $placement_user ='admin';
        $country = Country::all();
        $package = Packages::all();
        $joiningfee = Settings::value('joinfee');
        $voucher_code=Voucher::pluck('voucher_code');
        $payment_type=PaymentType::where('status','yes')->get();
        $transaction_pass=self::RandomString();
        $sponsor = User::where('username','=',$sponsor_name)->get();
        $profile = ProfileInfo::where('user_id','=',$sponsor[0]->id)->get();
        $profile_photo = $profile[0]->profile;
        $app = AppSettings::find(1);
        $currency_sy = $app->currency;
        // dd($profile_photo);

        if (!Storage::disk('images')->exists($profile_photo)){
            $profile_photo = 'avatar-big.png';
        }
        if(!$profile_photo){
            $profile_photo = 'avatar-big.png';
        }
// dd($profile_photo);
        

      


        return view('auth.register',compact('sponsor_name','countries','states','ip_latitude','ip_longtitude','leg','placement_user','package','transaction_pass','package','sponsorname','sponsor','profile','profile_photo','currency_sy','payment_type','joiningfee'));

    }

     public function RandomString()
        {
                    $characters = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
                    $charactersLength = strlen($characters);
                    $randstring = '';
                    for ($i = 0; $i < 11; $i++) {
                        $randstring .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randstring;
        }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


        return Validator::make($data, [

            //Login information
            'sponsor_name' => 'exists:users,username',
            'username' => 'required|max:255|unique:pending_transactions',
            'email' => 'required|max:255|unique:pending_transactions',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
            
            // Network information
            // 'role_id' => 'required',
            // 'rank_id' => 'required|max:255',
            // 'sponsor_id' => 'required|max:255',
            // 'status' => 'required|max:255',



            //Identification
            'firstname' => 'required|max:255',
            'lastname' => 'max:255',//OPTIONAL
            'gender' => 'required|max:255',  
            // 'date_of_birth' => 'required|max:255',
            // 'job_title' => 'required|max:255',
            'tax_id' => 'max:255', //TAX ID //VAT// National Identification Number //OPTIONAL
     

            //Contact Information
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'post_code' => 'max:255',//OPTIONAL            
            // 'latitude' => 'required|max:255',
            // 'longitude' => 'required|max:255',
            'address' => 'required|max:255',        
            'email' => 'required|email|max:255|unique:users',            
            'phone' => 'max:255',//OPTIONAL
            

            //Media
            // 'profile_photo' => 'required|max:255',
            // 'profile_coverphoto' => 'required|max:255',

            //Social links
            'twitter_username' => 'max:255', //OPTIONAL
            'facebook_username' => 'max:255', //OPTIONAL
            'youtube_username' => 'max:255', //OPTIONAL
            'linkedin_username' => 'max:255', //OPTIONAL
            'pinterest_username' => 'max:255', //OPTIONAL
            'instagram_username' => 'max:255', //OPTIONAL
            'google_username' => 'max:255', //OPTIONAL
            

            //Instant Messaging Ids (IM)
            'skype_username' => 'max:255', //OPTIONAL
            'whatsapp_number' => 'max:255', //OPTIONAL

            //Profile  
            'bio' => 'max:600', //OPTIONAL


        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        return User::create([

         
            'username' => $data['username'],
            'password' => bcrypt($data['password']),

            //Network Information   
            'role_id' => '2',
            'sponsor_id' => User::findByUsernameOrFail($data['sponsor_name'])->id,
           
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'], 
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'job_title' => $data['job_title'],
            'tax_id' => $data['tax_id'],
           
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'post_code' => $data['post_code'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone' => $data['phone'],

            
            'twitter_username' => $data['twitter_username'],
            'facebook_username' => $data['facebook_username'],
            'youtube_username' => $data['youtube_username'],
            'linkedin_username' => $data['linkedin_username'],
            'pinterest_username' => $data['pinterest_username'],
            'instagram_username' => $data['instagram_username'],
            'google_username' => $data['google_username'],

            //Instant Messaging Ids (IM)
            'skype_username' => $data['skype_username'],
            'whatsapp_number' => $data['whatsapp_number'],

            //Profile  
            'bio' => $data['bio'],



            //App Specific



        ]);
    }


    public function register(Request $request)
    {

        // dd($request->all());
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }else{

            $data= $request->all();
            $data['reg_type']         = null;
            $data['cpf']              = null;
            $data['passport']         = null;
            $data['location']         = null;
            $data['reg_by']           = 'site';
            $data['package']          = 1;
            $data['country']   ='IL';

            $sponsor_id = User::checkUserAvailable($data['sponsor']);
            
            $placement_id =  $sponsor_id ;
            $data['placement_user'] =$data['sponsor'];
            if (!$sponsor_id) {
                
                return redirect()->back()->withErrors(['The sponsor not exist'])->withInput();
            }
            if (!$placement_id) {
                /**
                 * If placement_id validates as false, redirect back without registering , with errors
                 */
                return redirect()->back()->withErrors(['The sponsor not exist'])->withInput();
            }

            $joiningfee = Settings::value('joinfee');
            $orderid ='Atmor-'. mt_rand();

            $register=PendingTransactions::create([
                 'order_id' =>$orderid,
                 'username' =>$request->username,
                 'email' =>$request->email,
                 'sponsor' => $sponsor_id,
                 'request_data' =>json_encode($data),
                 'payment_method'=>$request->payment,
                 'payment_type' =>'register',
                 'amount' => $joiningfee,
                ]);
               if($request->payment == 'paypal'){ 
                    
                    Session::put('paypal_id',$register->id);
                    $data = [];
                    $data['items'] = [
                        [
                            'name' => Config('APP_NAME'),
                            'price' => $joiningfee,
                            'qty' => 1
                        ]
                    ];

                    $data['invoice_id'] = time();
                    $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
                    $data['return_url'] = url('/register/paypal/success',$register->id);
                    $data['cancel_url'] = url('register');

                    $total = 0;
                    foreach($data['items'] as $item) {
                        $total += $item['price']*$item['qty'];
                    }

                    $data['total'] = $total; 
                    $response = self::$provider->setExpressCheckout($data); 
                    PendingTransactions::where('id',$register->id)->update(['payment_data' => json_encode($response),'paypal_express_data' => json_encode($data)]);
                 
                    return redirect($response['paypal_link']);
                }

                if($request->payment == 'cheque'){
                 return redirect()->action('Auth\RegisterController@banktransferPreview', ['id' =>$register->id]);
                }


            //   if ($request->payment == 'voucher') {      

            //         $voucher_total = Packages::where('id','=',$data['package'])->value('amount');
            //         foreach ($request->voucher as $key => $vouchervalue) {
            //         $voucher = Voucher::where('voucher_code', $vouchervalue)->first();
            //         $voucher_total = $voucher_total - $voucher->balance_amount ;
            //             if($voucher_total <=0 ){
            //             $flag = true;
            //             }
            //         }

            //         if($flag){
            //         $package_amount = Packages::where('id','=',$data['package'])->value('amount');
            //             foreach ($request->voucher as $key => $vouchervalue) {
            //             $voucher = Voucher::where('voucher_code', $vouchervalue)->first();                                 
            //                 if($package_amount > $voucher->balance_amount){
            //                 $package_amount = $package_amount -  $voucher->balance_amount ;
            //                 $used_amount =  $voucher->balance_amount;                                    
            //                 $voucher->balance_amount = 0 ;
            //                 $voucher->save();
            //                 }else{
            //                 // $package_amount =$voucher->balance_amount - $package_amount  ;
            //                 $used_amount =  $voucher->balance_amount - $package_amount;          
            //                 $voucher->balance_amount = $used_amount;
            //                 $voucher->save();                                    
            //                 }


            //             }
            //         } 
            // }

            $userresult = User::add($data,$sponsor_id,$placement_id);

            if(!$userresult){

                return redirect()->back()->withErrors(['Opps something went wrong'])->withInput();
                
            }


            

             // $userPackage = Packages::find($data['package']);
          

            $sponsorname = $data['sponsor'];
            $placement_username = User::find($placement_id)->username;
            $legname = $data['leg'] == "L" ? "Left" : "right";            
            
            Activity::add("Added user $userresult->username","Added $userresult->username sponsor as $sponsorname ");

            Activity::add("Joined as $userresult->username","Joined in system as $userresult->username sponsor as $sponsorname ",$userresult->id);

            // Activity::add("Package purchased","Purchased package - $userPackage->package ",$userresult->id);


            $email = Emails::find(1);
         
            $welcome=welcomeemail::find(1);
            $app_settings = AppSettings::find(1);
           
            Mail::send('emails.register',
                ['email'         => $email,
                    'company_name'   => $app_settings->company_name,
                    'firstname'      => $data['firstname'],
                    'name'           => $data['lastname'],
                    'login_username' => $data['username'],
                    'password'       => $data['password'],
                    'welcome'        => $welcome,
                    'transaction_pass'=>$data['transaction_pass'],
                ], function ($m) use ($data, $email) {
                    $m->to($data['email'], $data['firstname'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
                });


            /**
             * redirects to preview page after successful registration
             */
            return redirect("register/preview/" . Crypt::encrypt($userresult->id));

            /***************************************************/
            /***************************************************/
            /**/

        }

       
    }

    public function paypalReg(Request $request){

        $payment_id = Session::get('paypal_payment_id');
        $temp_data=PaypalDetails::where('token','=',$payment_id)->first();
        $data=json_decode($temp_data->regdetails,true);
        
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));

             return redirect("/register");
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') { 

            $sponsor_id = User::checkUserAvailable($data['sponsor']);
            $placement_id =  User::checkUserAvailable($data['placement_user']);

            $userresult = User::add($data,$sponsor_id,$placement_id);
            if(!$userresult)
                return redirect('user/register')->withErrors(['Opps something went wrong'])->withInput();
             $userPackage = Packages::find($data['package']);
            $sponsorname = $userresult->sponsor ? $userresult->sponsor : $data['sponsor'];
            $placement_username = User::find($placement_id)->username;
            $legname = $data['leg'] == "L" ? "Left" : "right";            
            Activity::add("Added user $userresult->username","Added $userresult->username sponsor as $sponsorname ");
            Activity::add("Joined as $userresult->username","Joined in system as $userresult->username sponsor as $sponsorname ",$userresult->id);
            Activity::add("Package purchased","Purchased package - $userPackage->package ",$userresult->id);
            $email = Emails::find(1);
            $welcome=welcomeemail::find(1);
            $app_settings = AppSettings::find(1);
            Mail::send('emails.register',
               ['email'         => $email,
                    'company_name'   => $app_settings->company_name,
                    'firstname'      => $data['firstname'],
                    'name'           => $data['lastname'],
                    'login_username' => $data['username'],
                    'password'       => $data['password'],
                    'welcome'        =>$welcome,
                    'transaction_pass'=>$data['transaction_pass'],
                ], function ($m) use ($data, $email) {
                    $m->to($data['email'], $data['firstname'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
                });
            return redirect("register/preview/" . Crypt::encrypt($userresult->id)); 
            }
        Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));
         return redirect("/register");
        }

    public function preview($idencrypt)
    {
        $title     = trans('register.registration');
        $sub_title = trans('register.preview');
        $method    = trans('register.preview');
        $base      = trans('register.preview');
// echo Crypt::decrypt($idencrypt) ;
// die();
        $userresult      = User::with(['profile_info', 'profile_info.package_detail', 'sponsor_tree', 'tree_table', 'purchase_history.package'])->find(Crypt::decrypt($idencrypt));


        $userCountry = $userresult->profile_info->country;
        if ($userCountry) {
            $countries = CountryState::getCountries();
            $country   = array_get($countries, $userCountry);
        } else {
            $country = "A downline";
        }
        $userState = $userresult->profile_info->state;
        if ($userState) {
            $states = CountryState::getStates($userCountry);
            $state  = array_get($states, $userState);
        } else {
            $state = "unknown";
        }

        $sponsorId       = $userresult->sponsor_tree->sponsor;
        $sponsorUserName = \App\User::find($sponsorId)->username;
         $leg = Tree_Table::where('user_id','=',$userresult->id)->value('leg');
        if ($userresult) {
            // dd($user);
            return view('auth.preview', compact('title', 'sub_title', 'method', 'base', 'userresult', 'sponsorUserName', 'country', 'state', 'sub_title','leg'));
        } else {
            return redirect()->back();
        }
    }

    public function paypalRegSuccess(Request $request,$id){
        // dd($request->all());
          $response = self::$provider->getExpressCheckoutDetails($request->token);
          $item = PendingTransactions::find($id);
          $item->payment_response_data = json_encode($response);
          $item->save();
          $express_data=json_decode($item->paypal_express_data,true);
          $response = self::$provider->doExpressCheckoutPayment($express_data, $request->token, $request->PayerID);
          if($response['ACK'] == 'Success'){
            $item->payment_status='complete';
            $item->save();
            $details=json_decode($item->request_data,true);
            $username=User::where('username',$item->username)->value('id');
            $email=User::where('email',$item->email)->value('id');
              if($username == null && $email == null){
                $userresult = User::add($details,$item->sponsor,$item->sponsor);
                 return redirect("register/preview/" . Crypt::encrypt($userresult->id));
              }
              else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'User Already Exist'));
                return Redirect::to('register');

              }
          }
          else{
              Session::flash('flash_notification', array('level' => 'error', 'message' => 'Error In payment'));
                return Redirect::to('register');
          }

          

            // dd($details['firstname']);

           
          // }
          // else{
          //    Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('register.error_in_payment')));
          //   return Redirect::to('login');
          // }

    }

    public function banktransferPreview(Request $request){
    
        $title     = "Payment Details";
        $sub_title = "Payment Details";
        $base      = "Payment Details";
        $method    = "Payment Details";
        $bank_details = ProfileInfo::where('user_id',1)->first();
        $data=PendingTransactions::find($request->id);
        $joiningfee=$data->amount;
        $orderid=$data->order_id;
    Session::flash('flash_notification', array('level' => 'success', 'message' => "The account will be activated once the payment has been processed!"));
    return view('auth.bankpaydetails',compact('title', 'sub_title', 'base', 'method','orderid','bank_details','joiningfee'));

}
}
