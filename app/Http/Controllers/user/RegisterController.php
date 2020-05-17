<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\user\UserAdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\MenuSettings;
use App\welcomeemail;
use App\PaymentType;
use App\AppSettings;
use App\Tree_Table;
use App\Settings;
use App\Packages;
use App\Activity;
use App\Country;
use App\Balance;
use App\Voucher;
use App\Emails;
use App\User;
use App\PaypalDetails;
use App\ProfileInfo;


use Illuminate\Http\Request;
use CountryState;
use Response;
use Validator;
use Redirect;
use Session;
use Crypt;
use Mail;
use Auth;
use Input;

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

//stripe

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Account;
use Stripe\Transfer;
use Stripe\Payout as StripePayout;
use Stripe\Balance as StripeBalance;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\PendingTransactions;


class RegisterController extends UserAdminController
{   
      protected static  $provider;
    public function __construct()
    {
        // parent::__construct();
        
        // /** setup PayPal api context **/
        // $paypal_conf = \Config::get('paypal');
        // $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        // $this->_api_context->setConfig($paypal_conf['settings']);
        self::$provider = new ExpressCheckout;    
    }

    public function index($placement_id = null)
    {

        $title     = trans('all.register');
        $sub_title = trans('all.register');
        $base   = trans('all.register');
        $method = trans('all.register');          
       $oldcountries = CountryState::getCountries();
            // dd($oldcountries);
            $countries=[];
            foreach ($oldcountries as $key => $country) {
               if($key <> 'PS' && $key <> 'US')
                $countries[$key]=$country;
                }    
        $states = CountryState::getStates('IL');

        $status=MenuSettings::find(1);
        if($status->status=="no"){
            Session::flash('flash_notification', array('level' => 'danger', 'message' => 'Permission Denied'));
            return Redirect::to('user\dashboard');
        }else{
            if($placement_id){
                $placement_id = Crypt::decrypt($placement_id);
                $place_details = Tree_Table::find($placement_id);
                if($place_details->type != 'vaccant'){
                    return redirect()->back();
                }
                $placement_user = User::where('id',$place_details->placement_id)->value('username');
                $leg = $place_details->leg;
            }else{
                $leg = NULL;
                $placement_user = NULL;
            }
        $user_details = array();
        $user_details = User::where('username',Auth::user()->username)->get();
        $title = "Register new member";
        $rules = ['sponsor' => 'required|min:5','username' => 'unique:users,username|required|min:5','email' => 'unique:users,email|required','password' => 'required|same:password_confirmation'];
        $country = Country::all();
        $package = Packages::all();
        $joiningfee = Settings::value('joinfee');
        $voucher_code=Voucher::pluck('voucher_code');
        $payment_type=PaymentType::where('status','yes')->get();
        $transaction_pass=self::RandomString();
        $balance =  Balance::where('user_id',Auth::user()->id)->value('balance');
        return view('app.user.register.index',compact('title','sub_title','base','method','requests','rules','country','countries','states','user_details','package','placement_user','leg','joiningfee','voucher_code','payment_type','transaction_pass','balance'));
        }
    }
    public function register(Request $request){

       // dd($request->all());
       
        $data = array();
        $data['reg_by']=$request->payment;
        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['reg_type'] = $request->reg_type;
        $data['cpf'] = $request->cpf;
        $data['passport'] = $request->passport;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
        $data['country'] = $request->country;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['address'] = $request->address;
        $data['zip'] = $request->zip;
        $data['location'] = $request->location;
        $data['password'] = $request->password;
        $data['transaction_pass'] = $request->transaction_pass;
        $data['sponsor'] = $request->sponsor;
        $data['package'] = 1;
        $data['leg'] = 'L';
        $data['payment']          = $request->payment;
        $data['placement_user'] = $request->placement_user;
        // dd($data['placement_user']);
        if($data['placement_user'] != null){
            $data['placement_user'] = $data['placement_user'];
        }else{
            $data['placement_user'] = $data['sponsor'];
        }
        $messages = [
            'unique'    => 'The :attribute already existis in the system',
            'exists'    => 'The :attribute not found in the system',
        ];
        $validator = Validator::make($data, [
            'sponsor' => 'required|exists:users,username|max:255',
            'placement_user' => 'sometimes|exists:users,username|max:255',
            'email'            => 'required|unique:pending_transactions,email|email|max:255',
          'username'         => 'required|unique:pending_transactions,username|alpha_num|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'username' => 'required|unique:users,username|alpha_num|max:255',
            'password' => 'required|alpha_num|min:6',
            'transaction_pass' => 'required|alpha_num|min:6',
            'leg' => 'required'
            ]);
        if($validator->fails()){
             return redirect()->back()->withErrors($validator)->withInput();
        }else{

            
            $sponsor_id = User::checkUserAvailable($data['sponsor']);
           
            $placement_id =  User::checkUserAvailable($data['placement_user']);
            if (!$sponsor_id) {
               
                return redirect()->back()->withErrors(['The username not exist'])->withInput();
            }
            if (!$placement_id) {
               
                return redirect()->back()->withErrors(['The username not exist'])->withInput();
            }
           // $request->payment = "paypal";
           
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
                    $data['return_url'] = url('/user/paypal/success',$register->id);
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
                return redirect()->action('user\RegisterController@regTransferPreview', ['id' =>$register->id]);
            }
                


            //  if ($request->payment == 'voucher') {      

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

            //       if ($request->payment == "Stripe") {
            //       try{
            //             Stripe::setApiKey(config('services.stripe.secret'));
            //             $customer=Customer::create([
            //                 'email' =>request('stripeEmail'),
            //                 'source' =>request('stripeToken')
            //             ]);
            
            //         $id = $customer->id;
            //         $Charge=Charge::create([
            //             'customer' =>$id,
            //             'amount' => $fee * 100,
            //             'currency' => 'USD'
            //         ]);
            //     }
            //     catch(\Stripe\Error\Card $e) {
            //         $body = $e->getJsonBody();
            //         $err  = $body['error'];

            //         echo 'Status is:' . $e->getHttpStatus() . "\n" ;
            //         echo 'Type is:' . $err['type'] . "\n" ;
            //         echo 'Code is:' . $err['code'] . "\n" ;die();

            //     } catch (Stripe_InvalidRequestError $e) {
            //         return redirect()->back();
            //     } catch (Stripe_AuthenticationError $e) {
            //       return redirect()->back();
            //     } catch (Stripe_ApiConnectionError $e) {
            //        return redirect()->back();
            //     } catch (Stripe_Error $e) {
            //        return redirect()->back();
            //     } catch (Exception $e) {
            //        return redirect()->back();
            //     }
            // }

             
                $userresult = User::add($data,$sponsor_id,$placement_id);
                if(!$userresult){
                    return redirect()->back()->withErrors(['Opps something went wrong'])->withInput();
                }

                // $userPackage = Packages::find($data['package']);
          

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

            return  redirect("user/register/preview/".Crypt::encrypt($userresult->id));
            }
        }

         public function paypalReg(Request $request){

        $payment_id = Session::get('paypal_payment_id');
        $temp_data=PaypalDetails::where('token','=',$payment_id)->first();
        $data=json_decode($temp_data->regdetails,true);
        
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));

             return redirect("user/register");
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
            //Developd by Arslan - NetPower

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
		Log::debug('Register Controller User - Arslan');
	            return redirect("user/register/preview/" . Crypt::encrypt($userresult->id)); 
            }
        Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));
         return redirect("user/register");
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
        public function data(Request $request){
                    $key = $request->key;
                    if(isset($key)){
                        $voucher = $request->voucher ;
                        $vocher=Voucher::where('voucher_code',$key)->get();
                        return Response::json($vocher);
                    }
        }
        public function preview($idencrypt){
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
                return view('app.user.register.preview', compact('title', 'sub_title', 'method', 'base', 'userresult', 'sponsorUserName', 'country', 'state', 'sub_title','leg'));
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
            $sponsor_id = User::checkUserAvailable($details['sponsor']);
            $placement_id =  User::checkUserAvailable($details['placement_user']);
              if($username == null && $email == null){
                $userresult = User::add($details,$sponsor_id,$placement_id);
               
               return  redirect("user/register/preview/".Crypt::encrypt($userresult->id));
              }
              else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'User Already Exist'));
                return Redirect::to('user/register');

              }
          }
          else{
              Session::flash('flash_notification', array('level' => 'error', 'message' => 'Error In payment'));
                return Redirect::to('user/register');
          }


}

        public function regTransferPreview(Request $request){
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
            return view('app.user.register.bankpaydetails',compact('title', 'sub_title', 'base', 'method','orderid','bank_details','joiningfee','trans_id'));

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

                          
    }
