<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\welcomeemail;
use App\MenuSettings;
use App\AppSettings;
use App\PaymentType;
use App\Tree_Table;
use App\Packages;
use App\Activity;
use App\Settings;
use App\Voucher;
use App\Emails;
use App\User;
use App\PaypalDetails;
use App\ProfileInfo;

use Faker\Factory as Faker;
use Illuminate\Http\Request;
use CountryState;
use Validator;
use Redirect;
use Session;
use Crypt;
use Auth;
use Mail;
use Input;
use Response;
use DB;


//stripe

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Transfer;
use Stripe\Payout as StripePayout;
use Stripe\Balance as StripeBalance;

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
use App\PendingTransactions;
use App\Jobs\SendAllEmail;

use Carbon;

class RegisterController extends AdminController
{
    /*
    | Register Controller - Admin
    |--------------------------------------------------------------------------
    |
    | This controller handles registering users for the application and
    | redirecting them to preview screen.
    |
     */

    /**
     * View registration page.
     *
     * @var placement_id (Encrypted Placement Id) : if placement id is set, registration will be done under the-
     * specified placement id rather than authenticated user.
     * returns view page
     *
     */
     protected static  $provider;

     // private $_api_context;
    public function __construct()
    {
        // parent::__construct();
        
        // /** setup PayPal api context **/
        // $paypal_conf = \Config::get('paypal');
        // $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        // $this->_api_context->setConfig($paypal_conf['settings']);
      self::$provider = new ExpressCheckout;    
    }

    public function index($placement_id = "")
    {

        $title     = trans('registration.register');
        $sub_title = trans('registration.register');
        $base      = trans('registration.register');
        $method    = trans('registration.register');

      

        $status = MenuSettings::find(1);
        if ($status->status == "no") {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => 'Permission Denied'));
            return Redirect::to('admin\dashboard');
        } else {
            if ($placement_id) {
                /**
                 * if placement id set ,will decrypt and check in tree_table to find it has vacant positions
                 */

                $placement_id  = urldecode(Crypt::decrypt($placement_id));
                $place_details = Tree_Table::find($placement_id);
                /**
                 * if no vacant positions available under specified placement id,
                 * redirect back without placement id param
                 */

                if ($place_details->type != 'vaccant') {
                    return redirect()->back();
                }
                $placement_user = User::where('id', $place_details->placement_id)->value('username');
                $leg            = $place_details->leg;
            } else {
                $leg            = null;
                $placement_user = Auth::user()->username;
            }

            $user_details = array();
            $user_details = User::where('username', Auth::user()->username)->get();
            $title        = $sub_title        = trans('register.register_new_member');
            /**
             * Get Countries from mmdb
             * @var [collection]
             */
            $oldcountries = CountryState::getCountries();
            // dd($oldcountries);
            $countries=[];
            foreach ($oldcountries as $key => $country) {
               if($key <> 'PS' && $key <> 'US')
                $countries[$key]=$country;
            }
            // dd($countries);


            /**
             * [Get States from mmdb]
             * @var [collection]
             */
            $states = CountryState::getStates('IL');
            /**
             * Get all packages from database
             * @var [collection]
             */
            $package = Packages::all();
            /**
             * Get joining fee from settings table
             * @var int
             */
            $joiningfee = Settings::value('joinfee');
            /**
             * Get Voucher code from Voucher table
             * @var [type]
             */
            $voucher_code = Voucher::value('voucher_code');
            /**
             * Get all active payment methods from database [payment_type]
             * @var [collection]
             */
            $payment_type = PaymentType::where('status', 'yes')->get();

            // dd($payment_type);
            /**
             * Generate a random string for the transation password for user
             * to keep in database for future use,
             * @var string
             */
            $transaction_pass = SELF::RandomString();
            /**
             * returns registration view with provided variables
             */
            return view('app.admin.register.index', compact('title', 'sub_title', 'base', 'method', 'package', 'countries', 'states', 'user_details', 'placement_user', 'leg', 'joiningfee', 'voucher_code', 'payment_type', 'transaction_pass'));

        }
    }

  
    public function register(Request $request)
    {
// dd($request->all());
        
        $data                     = array();
        $data['reg_by']           = $request->payment;
        $data['firstname']        = $request->firstname;
        $data['lastname']         = $request->lastname;
        $data['phone']            = $request->phone;
        $data['email']            = $request->email;
        $data['reg_type']         = $request->reg_type;
        $data['cpf']              = $request->cpf;
        $data['passport']         = $request->passport;
        $data['username']         = $request->username;
        $data['gender']           = $request->gender;
        $data['country']          = $request->country;
        $data['state']            = $request->state;
        $data['city']             = $request->city;
        $data['address']          = $request->address;
        $data['zip']              = $request->zip;
        $data['location']         = $request->location;
        $data['password']         = $request->password;
        $data['transaction_pass'] = $request->transaction_pass;
        $data['sponsor']          = $request->sponsor;
        $data['package']          = 1;
        $data['leg']              = 'L';
        $data['payment']          = $request->payment;
        /**
         * if placement user passed from form
         * (Which will be set as hidden input if placement_id specified and if it has vacant positions ),
         * it will set as placement_user, else the placement will be under sponsor
         *
         */
        // if ($request->placement_user) {
        //     $data['placement_user'] = $request->placement_user;
        // } else {
            $data['placement_user'] = $request->sponsor;
        // }
        /**
         * Validation custom messages
         * @var [array]
         */
        $messages = [
            'unique' => 'The :attribute already existis in the system',
            'exists' => 'The :attribute not found in the system',

        ];
        /**
         * Validating the incoming data we stored the $data variable
         * @var [boolean]
         */
        $validator = Validator::make($data, [
          'sponsor'          => 'required|exists:users,username|max:255',
          'placement_user'   => 'sometimes|exists:users,username|max:255',
          'email'            => 'required|unique:pending_transactions,email|email|max:255',
          'username'         => 'required|unique:pending_transactions,username|alpha_num|max:255',
          'email'            => 'required|unique:users,email|email|max:255',
          'username'         => 'required|unique:users,username|alpha_num|max:255',
          'password'         => 'required|min:6',
          'transaction_pass' => 'required|alpha_num|min:6',
          // 'package'          => 'required|exists:packages,id',
          'leg'              => 'required',
          'country'          => 'required|country',
        ]);
      /**
         * On fail, redirect back with error messages
         */
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {


            $sponsor_id = User::checkUserAvailable($data['sponsor']);
           
            // $placement_id =  $sponsor_id ;// 
            // User::checkUserAvailable($data['placement_user']);

            $placement_id =   User::checkUserAvailable($data['placement_user']);

          
            if (!$sponsor_id) {
               
                return redirect()->back()->withErrors(['The username not exist'])->withInput();
            }
            if (!$placement_id) {
               
                return redirect()->back()->withErrors(['The username not exist'])->withInput();
            }

            $joiningfee = Settings::value('joinfee');
            if($request->payment == 'cheque' && $joiningfee > 0){ 
                $request->payment='paypal';
            }

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
                $data['return_url'] = url('/admin/paypal/success',$register->id);
                $data['cancel_url'] = url('register');

                $total = 0;
                foreach($data['items'] as $item) {
                    $total += $item['price']*$item['qty'];
                }

                $data['total'] = $total; 
                self::$provider->setCurrency('EUR');
                $response = self::$provider->setExpressCheckout($data); 
                PendingTransactions::where('id',$register->id)->update(['payment_data' => json_encode($response),'paypal_express_data' => json_encode($data)]);
             
                return redirect($response['paypal_link']);
            }

            

               if($request->payment == 'bitcoin'){

                $title='Bitaps Payment';
                $sub_title='Bitaps Payment';
                $base='Bitaps Payment';
                $method='Bitaps Payment';
                $url ='https://api.bitaps.com/btc/v1//create/payment/address' ;
                $payment_details = $this->url_get_contents($url,[
                                        'forwarding_address'=>'1GwyMojNcB6yoChGy8KeAyEXfDLKxVQg1G',
                                        'callback_link'=>url('bitaps/paymentnotify'),
                                        'confirmations'=>3
                                        ]);

                $conversion = $this->url_get_contents('https://api.bitaps.com/market/v1/ticker/btceur',false);
                $package_amount = $joiningfee/$conversion->data->last;
                $package_amount=round($package_amount,8);
                PendingTransactions::where('id',$register->id)->update(['payment_code'=>$payment_details->payment_code,'invoice'=>$payment_details->invoice,'payment_address'=>$payment_details->address,'payment_data'=>json_encode($payment_details)]);
                 $trans_id=$register->id;

                return view('app.admin.register.bitaps',compact('title','sub_title','base','method','payment_details','data','package_amount','setting','trans_id'));
            }

             if($request->payment == 'cheque'){
                // return redirect()->action('Admin\RegisterController@banktransferPreview', ['id' =>$register->id]);


              $userresult = User::add($data,$sponsor_id,$placement_id);
                if(!$userresult){
                    return redirect()->back()->withErrors(['Opps something went wrong'])->withInput();
                }
                PendingTransactions::where('id',$register->id)->update(['payment_status' => 'complete']);
                $sponsorname = $data['sponsor'];

                
                $placement_username = User::find($placement_id)->username;
                $legname = $data['leg'] == "L" ? "Left" : "right";   

                
                Activity::add("Added user $userresult->username","Added $userresult->username sponsor as $sponsorname ");
                Activity::add("Joined as $userresult->username","Joined in system as $userresult->username sponsor as $sponsorname ",$userresult->id);

                // SendAllEmail::dispatch($data['firstname'],$data['lastname'],$data['username'],$data['password'],$data['email'])
                //         ->delay(Carbon::now()->addSeconds(10));
              
                $email = Emails::find(1);
                $welcome=welcomeemail::find(1);
                $app_settings = AppSettings::find(1);
               
                Mail::send('emails.register',
                    ['email'         => $email,
                        'company_name'   => $app_settings->company_name,
                        'logo'   => $app_settings->logo,
                        'firstname'      => $data['firstname'],
                        'name'           => $data['lastname'],
                        'login_username' => $data['username'],
                        'password'       => $data['password'],
                        'welcome'        => $welcome,
                        'transaction_pass'=>$data['transaction_pass'],
                    ], function ($m) use ($data, $email) {
                        $m->to($data['email'], $data['firstname'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
                    });
Log::debug('Register Controller Admin - Arslan');
                return redirect("admin/register/preview/" . Crypt::encrypt($userresult->id));
            }
             

   
           
         

            // $userresult = User::add($data,$sponsor_id,$placement_id);

            // if(!$userresult){

            //     return redirect()->back()->withErrors(['Opps something went wrong'])->withInput();
                
            // }

            
          

            // $sponsorname = $userresult->sponsor ? $userresult->sponsor : Auth::user()->username;
            // $placement_username = User::find($placement_id)->username;
            // $legname = $data['leg'] == "L" ? "Left" : "right";            
            
            // Activity::add("Added user $userresult->username","Added $userresult->username sponsor as $sponsorname ");

            // Activity::add("Joined as $userresult->username","Joined in system as $userresult->username sponsor as $sponsorname ",$userresult->id);

            // Activity::add("Package purchased","Purchased package - $userPackage->package ",$userresult->id);


          
            // $email = Emails::find(1);
            
            // $welcome=welcomeemail::find(1);
            // $app_settings = AppSettings::find(1);
           
            // Mail::send('emails.register',
            //     ['email'         => $email,
            //         'company_name'   => $app_settings->company_name,
            //         'firstname'      => $data['firstname'],
            //         'name'           => $data['lastname'],
            //         'login_username' => $data['username'],
            //         'password'       => $data['password'],
            //         'welcome'        =>$welcome,
            //         'transaction_pass'=>$data['transaction_pass'],
            //     ], function ($m) use ($data, $email) {
            //         $m->to($data['email'], $data['firstname'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
            //     });


           
            // return redirect("admin/register/preview/" . Crypt::encrypt($userresult->id));
        }
    }

     public function paypalReg(Request $request){

        $payment_id = Session::get('paypal_payment_id');
        $temp_data=PaypalDetails::where('token','=',$payment_id)->first();
        $data=json_decode($temp_data->regdetails,true);
        
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));

             return redirect("admin/register");
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
            $sponsorname = $userresult->sponsor ? $userresult->sponsor : Auth::user()->username;
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
Log::debug('Register Controller Admin - Arslan');
            return redirect("admin/register/preview/" . Crypt::encrypt($userresult->id)); 
            }
        Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));
         return redirect("user/register");
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
         $leg = Tree_Table::where('user_id','=',$userresult->id)->value('leg');

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
        $sponsorUserName = User::find($sponsorId)->username;


        if ($userresult) {
            // dd($user);
            return view('app.admin.register.preview', compact('title', 'sub_title', 'method', 'base', 'userresult', 'sponsorUserName', 'country', 'state', 'sub_title','leg'));
        } else {
            return redirect()->back();
        }
    } 
    

    public function RandomString()
    {
        $characters       = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randstring       = '';
        for ($i = 0; $i < 11; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randstring;
    }

     public function data(Request $request){
        $key = $request->key;
        if(isset($key)){
            $voucher = $request->voucher ;
            $vocher=Voucher::where('voucher_code',$key)->get();
            return Response::json($vocher);
        }
      }

       public function adminregister()
    {

        $title     = trans('registration.create_new_platform_manager');
        $sub_title = trans('registration.create_new_platform_manager');
        $base      = trans('registration.create_new_platform_manager');
        $method    = trans('registration.create_new_platform_manager');
            
        return view('app.admin.register.adminregister', compact('title', 'sub_title', 'base', 'method'));
    }

   public function admin_register(Request $request){

                $data = array();
                $data['firstname'] = $request->firstname;        
                $data['phone']     = $request->phone;
                $data['email']     = $request->email;
                $data['username']  = $request->username;
                $data['password']  = $request->password;
                $data['reg_type']  = 'adminregister';

                    
                $messages = [
                    'unique'    => 'The :attribute already existis in the system',
                    'exists'    => 'The :attribute not found in the system',   
                ];
                $validator = Validator::make($data, [
                    'email' => 'required|unique:users,email|email|max:255',
                    'username' => 'required|unique:users,username|alpha_num|max:255',
                    'password' => 'required|min:6',
                ]);

                if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                } else {

                        DB::beginTransaction();

                            $userresult=User::create([
                                'name'             => $data['firstname'],
                                'email'            => $data['email'],           
                                'username'         => $data['username'],
                                'phone'            => $data['phone'],  
                                'register_by'      => $data['reg_type'],
                                'password'         => bcrypt($data['password']), 
                                'admin'            => 1,
                                'active'           => 'yes',
                                'customer'         => '-',
                            ]);


                            $userProfile=ProfileInfo::create([
                                'user_id'   => $userresult->id,
                                'mobile'    => $data['phone'],  
                            ]);
           
                        DB::commit();
       
                        Session::flash('flash_notification', array('level' => 'success', 'message' =>'Your registration completed successfully'));
                        return redirect()->back();
                }
    }

    public function paypalRegSuccess(Request $request,$id){
        // dd($request->all());
          self::$provider->setCurrency('EUR');
          $response = self::$provider->getExpressCheckoutDetails($request->token);
          $item = PendingTransactions::find($id);
          $item->payment_response_data = json_encode($response);
          $express_data=json_decode($item->paypal_express_data,true);
          $response = self::$provider->doExpressCheckoutPayment($express_data, $request->token, $request->PayerID);
          $item->paypal_recurring_reponse = json_encode($response);
          
          $item->save();
          if($response['ACK'] == 'Success'){
            $item->payment_status='complete';
            $item->save();
            $details=json_decode($item->request_data,true);
            $username=User::where('username',$item->username)->value('id');
            $email=User::where('email',$item->email)->value('id');
            $sponsor_id = User::checkUserAvailable($details['sponsor']);
            $placement_id =  User::checkUserAvailable($details['placement_user']);
              if($username == null && $email == null){
                $userresult = User::add($details,$sponsor_id,$placement_id);
                $sponsorname = $details['sponsor'];
                $legname = $details['leg'] == "L" ? "Left" : "right";            
                
                Activity::add("Added user $userresult->username","Added $userresult->username sponsor as $sponsorname ");
                Activity::add("Joined as $userresult->username","Joined in system as $userresult->username sponsor as $sponsorname ",$userresult->id);
                $email = Emails::find(1);
                $welcome=welcomeemail::find(1);
                $app_settings = AppSettings::find(1);
               
                Mail::send('emails.register',
                    ['email'         => $email,
                        'company_name'   => $app_settings->company_name,
                        'logo'   => $app_settings->logo,
                        'firstname'      => $details['firstname'],
                        'name'           => $details['lastname'],
                        'login_username' => $details['username'],
                        'password'       => $details['password'],
                        'welcome'        => $welcome,
                        'transaction_pass'=>$details['transaction_pass'],
                    ], function ($m) use ($details, $email) {
                        $m->to($details['email'], $details['firstname'])->subject('Successfully registered')->from($email->from_email, $email->from_name);
                    });
		Log::debug('Register Controller Paypal Admin - Arslan');
                 return redirect("admin/register/preview/" . Crypt::encrypt($userresult->id));
              }
              else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'User Already Exist'));
                return Redirect::to('admin/register');

              }
          }
          else{
              Session::flash('flash_notification', array('level' => 'error', 'message' => 'Error In payment'));
                return Redirect::to('admin/register');
          }


}

public function banktransferPreview(Request $request){
    
    $title     = "Payment Details";
    $sub_title = "Payment Details";
    $base      = "Payment Details";
    $method    = "Payment Details";
    $bank_details = ProfileInfo::where('user_id',1)->first();
    $data=PendingTransactions::find($request->id);
    $trans_id=$request->id;
    $joiningfee=$data->amount;
    $orderid=$data->order_id;
    Session::flash('flash_notification', array('level' => 'success', 'message' => "The account will be activated once the payment has been processed!"));
    return view('app.admin.register.bankpaydetails',compact('title', 'sub_title', 'base', 'method','orderid','bank_details','joiningfee','trans_id'));

}

public function checkStatus($trans){
    

    $item = PendingTransactions::where('id',$trans)->first();

    
    if (is_null($item)) {
    return response()->json(['valid' => false]);
  }elseif($item->payment_status == 'complete'){
        
        $user_id=User::where('username',$item->username)->value('id');
        if($user_id <> null){
        return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>Crypt::encrypt($user_id)]);
      }
    }else{
         return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>null]);
        
  }
    
    return response()->json(['valid' => false]);
}


        function url_get_contents ($Url,$params) {
        if (!function_exists('curl_init')){ 
            die('CURL is not installed!');
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($params){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($params));
        }

          

         $output = curl_exec($ch);

        curl_close($ch);
        return  json_decode($output);
        }

   
}
