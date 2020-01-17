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

class RegisterController extends AdminController
{
    /*
    |--------------------------------------------------------------------------
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

     private $_api_context;
    public function __construct()
    {
        parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
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
            $countries = CountryState::getCountries();
            /**
             * [Get States from mmdb]
             * @var [collection]
             */
            $states = CountryState::getStates('US');
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

           /// dd($payment_type);
            /**
             * Generate a random string for the transation password for user
             * to keep in database for future use,
             * @var string
             */
            $transaction_pass = SELF::RandomString();
            /**
             * returns registration view with provided variables
             */
            return view('app.admin.register.index', compact('title', 'sub_title', 'base', 'method', 'requests', 'package', 'countries', 'states', 'user_details', 'placement_user', 'leg', 'joiningfee', 'voucher_code', 'payment_type', 'count', 'transaction_pass'));

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
        $data['package']          = $request->pack_new;
        $data['leg']              = 'L';
        $data['payment']          = $request->payment;
        /**
         * if placement user passed from form
         * (Which will be set as hidden input if placement_id specified and if it has vacant positions ),
         * it will set as placement_user, else the placement will be under sponsor
         *
         */
        if ($request->placement_user) {
            $data['placement_user'] = $request->placement_user;
        } else {
            $data['placement_user'] = $request->sponsor;
        }
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
            'email'            => 'required|unique:users,email|email|max:255',
            'username'         => 'required|unique:users,username|alpha_num|max:255',
            'password'         => 'required|min:6',
            'transaction_pass' => 'required|alpha_num|min:6',
            'package'          => 'required|exists:packages,id',
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


            $userPackage = Packages::find($data['package']);
            $fee=$userPackage->amount;
            if ($request->payment == "Stripe") {


                  try{
                        Stripe::setApiKey(config('services.stripe.secret'));
                        $customer=Customer::create([
                            'email' =>request('stripeEmail'),
                            'source' =>request('stripeToken')
                        ]);
            
                    $id = $customer->id;
                    $Charge=Charge::create([
                        'customer' =>$id,
                        'amount' => $fee * 100,
                        'currency' => 'USD'
                    ]);
                }
                catch(\Stripe\Error\Card $e) {
                    $body = $e->getJsonBody();
                    $err  = $body['error'];

                    echo 'Status is:' . $e->getHttpStatus() . "\n" ;
                    echo 'Type is:' . $err['type'] . "\n" ;
                    echo 'Code is:' . $err['code'] . "\n" ;die();

                } catch (Stripe_InvalidRequestError $e) {
                    return redirect()->back();
                } catch (Stripe_AuthenticationError $e) {
                  return redirect()->back();
                } catch (Stripe_ApiConnectionError $e) {
                   return redirect()->back();
                } catch (Stripe_Error $e) {
                   return redirect()->back();
                } catch (Exception $e) {
                   return redirect()->back();
                }
            }

             if ($request->payment == 'voucher') {      

                    $voucher_total = Packages::where('id','=',$data['package'])->value('amount');
                    foreach ($request->voucher as $key => $vouchervalue) {
                    $voucher = Voucher::where('voucher_code', $vouchervalue)->first();
                    $voucher_total = $voucher_total - $voucher->balance_amount ;
                        if($voucher_total <=0 ){
                        $flag = true;
                        }
                    }

                    if($flag){
                    $package_amount = Packages::where('id','=',$data['package'])->value('amount');
                        foreach ($request->voucher as $key => $vouchervalue) {
                        $voucher = Voucher::where('voucher_code', $vouchervalue)->first();                                 
                            if($package_amount > $voucher->balance_amount){
                            $package_amount = $package_amount -  $voucher->balance_amount ;
                            $used_amount =  $voucher->balance_amount;                                    
                            $voucher->balance_amount = 0 ;
                            $voucher->save();
                            }else{
                            // $package_amount =$voucher->balance_amount - $package_amount  ;
                            $used_amount =  $voucher->balance_amount - $package_amount;          
                            $voucher->balance_amount = $used_amount;
                            $voucher->save();                                    
                            }


                        }
                    } 
            }

            
            if ($request->payment == "paypal") {

                  $payer = new Payer();
                $payer->setPaymentMethod('paypal');
                $item_1 = new Item();
                $item_1->setName('Item 1')
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($fee); 

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));

                $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($fee);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Your transaction description');

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(url('admin/paypal/register')) 
                ->setCancelUrl(url('admin/register'));

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (\Config::get('app.debug')) {
                        Session::flash('flash_notification', array('level' => 'danger', 'message' => "Connection timeout"));
                          return redirect("admin/register");
                    } else {
                       Session::flash('flash_notification', array('level' => 'danger', 'message' => "Some error occur, sorry for inconvenient"));
                     return redirect("admin/register");
                    }   
                }

                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                /** add payment ID to session **/
                Session::put('paypal_payment_id', $payment->getId());

                $temp = PaypalDetails::create([
                        'regdetails'=>json_encode($data),
                        'paystatus'=>'paypal-reg',
                        'token'=>$payment->getId()
                        ]);

                if(isset($redirect_url)) {
                    return Redirect::away($redirect_url);
                }

               Session::flash('flash_notification', array('level' => 'danger', 'message' => "Unknown error occurred"));
                return redirect("admin/register");
              
            }
          
           
           
         

            $userresult = User::add($data,$sponsor_id,$placement_id);

            if(!$userresult){

                return redirect()->back()->withErrors(['Opps something went wrong'])->withInput();
                
            }

            
          

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


           
            return redirect("admin/register/preview/" . Crypt::encrypt($userresult->id));
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
        $sponsorUserName = \App\User::find($sponsorId)->username;


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

}
