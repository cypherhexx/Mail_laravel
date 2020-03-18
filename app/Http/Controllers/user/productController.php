<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\LeadershipBonus;
use App\PurchaseHistory;
use App\VoucherHistory;
use App\Transactions;
use App\Sponsortree;
use App\AppSettings;
use App\Commission;
use App\PointTable;
use App\Tree_Table;
use App\RsHistory;
use App\UserDebit;
use App\Packages;
use App\Balance;
use App\Voucher;
use App\User;
use App\PaypalDetails;
use App\ProfileInfo;
use App\Ranksetting;
use App\IpnResponse;

use Validator;
use Session;
use Crypt;
use Auth;
use Redirect;
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
use App\ProfileModel;



use App\Http\Controllers\user\UserAdminController;


class productController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
                
        $title = trans('products.purchase_plan');
        $sub_title =  trans('products.purchase_plan');       
        $rules = ['count' => 'required|min:1'];
        $base =  trans('products.purchase_plan');
        $method =  trans('products.purchase_plan');
        $package=ProfileModel::where('user_id',Auth::user()->id)->value('package');
        $products = Packages::where('id','>',$package)->get();  
        $balance =  Balance::where('user_id',Auth::user()->id)->value('balance');
        $min_amount =  Packages::min('amount');
        $pac_am= Packages::find($package)->amount;  
        return view('app.user.product.index',compact('title','products','rules','base','method','sub_title','balance','min_amount','pac_am'));    
    }




     public function purchasehistory()
    {
          $data = PurchaseHistory::join('packages','packages.id','=','purchase_history.package_id')
                  ->where('user_id',Auth::user()->id)
                  ->where('purchase_user_id',Auth::user()->id)
                  ->select('purchase_history.id','packages.package','count','packages.amount','total_amount','purchase_history.created_at','purchase_history.pv','purchase_history.pay_by','purchase_history.pay_type')
                  ->orderBy('purchase_history.id','DESC')
                  ->paginate(10);
           
        $title = trans('products.purchase_history');
        $sub_title = trans('products.purchase_history'); 
        $base = trans('products.purchase_history');  
        $method = trans('products.purchase_history');     
        return view('app.user.product.purchase-history',compact('title','data','base','method','sub_title'));
    
    }


    public function purchase(Request $request){
        // dd($request->all());
        
        $title = trans('products.purchased_plan');
        $sub_title = trans('products.purchased_plan'); 
        $base = trans('products.purchase_plan');  
        $method = trans('products.purchase_plan'); 

        $validator = Validator::make($request->all(), [
            'steps_plan_payment'=>'required|min:1' ,
            'plan'=>'required|exists:packages,id' ,
            ]);
       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{

            $package = Packages::find($request->plan); 
            $fee=$package->amount;
            $cur_package=ProfileModel::where('user_id',Auth::user()->id)->value('package');

            $cur_amount=Packages::find($cur_package)->amount;
            $diff_amount=$fee-$cur_amount;

            $sponsor_id =Sponsortree::where('user_id',Auth::user()->id)->value('sponsor');
            $orderid ='Atmor-'. mt_rand();
            if($cur_package > 1){
              $cur_pack_order=PendingTransactions::where('package',$cur_package)
                                                 ->where('user_id',Auth::user()->id)
                                                 ->where('payment_status','complete')
                                                 ->where('payment_type','upgrade')
                                                 ->first();
            }


                                                // dd($cur_pack_order);


            //   if($cur_pack_order->payment_method == 'paypal' && $cur_package > 1){

            //     $agreementId = $cur_pack_order->paypal_agreement_id;                 
            //     $agreement = new Agreement();  
            //     $agreement->setId($agreementId);
            //     $agreementStateDescriptor = new AgreementStateDescriptor();
            //     $agreementStateDescriptor->setNote("Cancel the agreement");

            //     try {
            //         $agreement->cancel($agreementStateDescriptor, $this->apiContext);
            //         $cancelAgreementDetails = Agreement::get($agreement->getId(), $this->apiContext); 
                          
            //     } catch (Exception $ex) {                  
            //     }
            //   }
            if($request->payment_type == 'month'){

                if($cur_package > 1){
                    $thirty_days= date('Y-m-d 00:00:00',strtotime('+30 days',strtotime($cur_pack_order->created_at)));
                 if($cur_pack_order->payment_period == 'month'){
                    if($cur_pack_order->payment_method == 'paypal')
                       
                        $pay_amount=$fee;
                    elseif($cur_pack_order->payment_method == 'bitcoin'){
                      
                        if(date('Y-m-d H:i:s') < $thirty_days)
                             $pay_amount=$fee;
                        else
                            $pay_amount=$diff_amount;

                    }else{
                        
                        if(date('Y-m-d H:i:s') > $thirty_days)
                             $pay_amount=$fee;
                        else
                            $pay_amount=$diff_amount;
                    }
                 }
                 else{
                    $pay_amount=$fee;
                 }
                }else{
                    $pay_amount=$fee;
                }

            }else{
                $pay_amount=$fee*10;
            }

           

            $purchase=PendingTransactions::create([
             'order_id' =>$orderid,
             'package' => $request->plan,
             'user_id'=>Auth::user()->id,
             'username' =>Auth::user()->username,
             'email' =>Auth::user()->email,
             'sponsor' => $sponsor_id,
             'request_data' =>json_encode($request->all()),
             'payment_method'=>$request->steps_plan_payment,
             'payment_period'=>$request->payment_type,
             'payment_type' =>'upgrade',
             'amount' => $pay_amount,
            ]);

            if($request->payment_type == 'month')
                $period='Month';
            else
                $period='Year';
           
       

             // packages::levelBonus(Auth::user()->id,$package);


            if($request->steps_plan_payment == 'paypal'){

              $plan = new Plan();
              $plan->setName('Atmor Monthly Billing')
                  ->setDescription('Monthly Subscription to the Atmor Track Purchase')
                  ->setType('infinite');

                if($cur_package > 1 && $request->payment_type == 'month'){
                  $trialPaymentDefinition = new PaymentDefinition();
                  $trialPaymentDefinition->setName('One-off Trial Payment')
                   ->setType('TRIAL')
                   ->setFrequency($period)
                   ->setFrequencyInterval('1')
                   ->setCycles('1')
                   ->setAmount(new Currency(array('value' => $diff_amount, 'currency' => 'EUR')));
                }

                // Set billing plan definitions

                  $paymentDefinition = new PaymentDefinition();
                  $paymentDefinition->setName($package->amount.' Subscriptions')
                                    ->setType('REGULAR')
                                    ->setFrequency($period)
                                    ->setFrequencyInterval('1')
                                    ->setCycles('0')
                                    ->setAmount(new Currency(array('value' => $pay_amount, 'currency' => 'EUR')));


                // Set merchant preferences
                  $merchantPreferences = new MerchantPreferences();
                  $merchantPreferences->setReturnUrl(url('/user/paypalupgrade/paypalsuccess',$purchase->id))
                                      ->setCancelUrl(url('/user/purchase-plan'))
                                      ->setAutoBillAmount('yes')
                                      ->setInitialFailAmountAction('CONTINUE')
                                      ->setMaxFailAttempts('0');

                // $plan->setPaymentDefinitions(array($paymentDefinition,$trialPaymentDefinition));
                  if($cur_package > 1 && $request->payment_type == 'month'){
                    $plan->setPaymentDefinitions(array($paymentDefinition,$trialPaymentDefinition));
                  }else{
                    $plan->setPaymentDefinitions(array($paymentDefinition));
                  }
                  $plan->setMerchantPreferences($merchantPreferences);

                //create the plan
                  try {
                    $createdPlan = $plan->create($this->apiContext);

                    try {
                        $patch = new Patch();
                        $value = new PayPalModel('{"state":"ACTIVE"}');
                        $patch->setOp('replace')
                          ->setPath('/')
                          ->setValue($value);
                        $patchRequest = new PatchRequest();
                        $patchRequest->addPatch($patch);
                        $createdPlan->update($patchRequest, $this->apiContext);
                        $plan = Plan::get($createdPlan->getId(), $this->apiContext);

                        // Output plan id
                        // echo 'Plan ID:' . $plan->getId();
                    } catch (PayPal\Exception\PayPalConnectionException $ex) {
                        echo $ex->getCode();
                        echo $ex->getData();
                        die($ex);
                    } catch (Exception $ex) {
                        die($ex);
                    }
                  } catch (PayPal\Exception\PayPalConnectionException $ex) {
                    echo $ex->getCode();
                    echo $ex->getData();
                    die($ex);
                  } catch (Exception $ex) {
                    die($ex);
                }

                $cur_plan_id=$plan->getId();
                PendingTransactions::where('id',$purchase->id)->update(['paypal_plan_id' => $cur_plan_id]);
                 // $next_day=\Carbon\Carbon::now()->addDays(1)->addMinutes(5)->toIso8601String();
            // $thirty_day=\Carbon\Carbon::now()->addDays(30)->addMinutes(5)->toIso8601String();

                $agreement = new Agreement();
                $agreement->setName('Algolight Track '.$period.'ly Subscription Agreement')
                  ->setDescription($package->package.' Subscription')
                  ->setStartDate(\Carbon\Carbon::now()->addMinutes(5)->toIso8601String());

                // Set plan id
                $plan = new Plan();
                $plan->setId($cur_plan_id);
                $agreement->setPlan($plan);

                // Add payer type
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');
                $agreement->setPayer($payer);
                try {
                    // Create agreement
                    $agreement = $agreement->create($this->apiContext);
                    PendingTransactions::where('id',$purchase->id)->update(['payment_recurring_data' => json_encode($agreement)]);

                    // Extract approval URL to redirect user
                    $approvalUrl = $agreement->getApprovalLink();

                    return redirect($approvalUrl);
                  } catch (PayPal\Exception\PayPalConnectionException $ex) {
                    echo $ex->getCode();
                    echo $ex->getData();
                    die($ex);
                  } catch (Exception $ex) {
                    die($ex);
                  }

            }
            
                
            /*  payment validation and update balance */

            if($request->steps_plan_payment == 'cheque'){

               return redirect()->action('user\productController@banktransferPreview', ['id' =>$purchase->id]);
            }

             if($request->steps_plan_payment == 'bitcoin'){

                $title='Bitaps Payment';
                $sub_title='Bitaps Payment';
                $base='Bitaps Payment';
                $method='Bitaps Payment';
                $url ='https://api.bitaps.com/btc/v1//create/payment/address' ;
                $payment_details = $this->url_get_contents($url,[
                                        'forwarding_address'=>'1GwyMojNcB6yoChGy8KeAyEXfDLKxVQg1G',
                                        'callback_link'=>url('purchasebitaps/paymentnotify'),
                                        'confirmations'=>3
                                        ]);

                $conversion = $this->url_get_contents('https://api.bitaps.com/market/v1/ticker/btceur',false);
                $diff=$pay_amount;
                $package_amount = $diff/$conversion->data->last;
                $package_amount=round($package_amount,8);

                PendingTransactions::where('id',$purchase->id)->update(['payment_code'=>$payment_details->payment_code,'invoice'=>$payment_details->invoice,'payment_address'=>$payment_details->address,'payment_data'=>json_encode($payment_details)]);
                 $trans_id=$purchase->id;

                return view('app.user.product.bitaps',compact('title','sub_title','base','method','payment_details','data','package_amount','setting','trans_id','pay_amount','package','period'));
            }

            if($flag){

                $package = Packages::find($request->plan); 
                $sponsor_id =Sponsortree::where('user_id',Auth::user()->id)->value('sponsor') ;
                $purchase_id=  PurchaseHistory::create([
                        'user_id'=>Auth::user()->id,
                        'purchase_user_id'=>Auth::user()->id,
                        'package_id'=>$package->id,
                        'count'=>$package->top_count,
                        'pv'=>$package->pv,
                        'total_amount'=>$package->amount,
                        'pay_by'=>'bank',
                        'rs_balance'=>$package->rs,
                        'sales_status'=>'yes',
                        'pay_type'  =>'Annual',

                    ]);

                  RsHistory::create([
                    'user_id'=>Auth::user()->id,                   
                    'from_id'=>Auth::user()->id,
                    'rs_credit'=>$package->rs,
                  ]);
                /*  Commissions calculation and point distributione */

                Tree_Table::getAllUpline(Auth::user()->id);
                PointTable::updatePoint($package->pv, Auth::user()->id);
                 Ranksetting::updateRank(Auth::user()->id);
                Transactions::sponsorcommission($sponsor_id,Auth::user()->id,$package->id);

                if($sponsor_id>1){
                    $second_sponsor = Sponsortree::where('user_id',$sponsor_id)->value('sponsor');
                    Transactions::indirectFaststart($second_sponsor,Auth::user()->id,$package->id);
                }

                ProfileInfo::where('user_id',Auth::user()->id)->update(['package'=>$package->id]); 
                $pur_user=PurchaseHistory::find($purchase_id->id);
                $user=User::join('profile_infos','profile_infos.user_id','=','users.id')
                          ->join('packages','packages.id','=','profile_infos.package')
                          ->where('users.id',$pur_user->user_id)
                          ->select('users.username','users.name','users.lastname','users.email','profile_infos.mobile','profile_infos.address1','packages.package')
                          ->get();
               $userpurchase=array();      
               $userpurchase['name']=$user[0]->name;
               $userpurchase['lastname']=$user[0]->lastname;
               $userpurchase['amount']=$purchase_id->total_amount;
               $userpurchase['payment_method']=$purchase_id->pay_by;
               $userpurchase['mail_address']=$user[0]->email;;
               $userpurchase['mobile']=$user[0]->mobile;
               $userpurchase['address']=$user[0]->address1;
               $userpurchase['invoice_id'] ='0000'.$purchase_id->id;
               $userpurchase['date_p']=$purchase_id->created_at;
               $userpurchase['package']=$user[0]->package;
               PurchaseHistory::where('id','=',$purchase_id->id)->update(['datas'=>json_encode($userpurchase)]);

               Session::flash('flash_notification',array('message'=>"You have purchased the plan succesfully ",'level'=>'success'));

               return  redirect("user/purchase/preview/".Crypt::encrypt($purchase_id->id));
            }
       }
}


    public function preview($idencrypt){
       
        $title = trans('products.purchased_plan');
        $sub_title = trans('products.purchased_plan'); 
        $base = trans('products.purchase_plan');  
        $method = trans('products.purchase_plan'); 
        $id = decrypt($idencrypt);
       
      
      $data = PurchaseHistory::where('id','=',$id)->value('datas');

      $datas = json_decode($data,true);
          

    return view('app.user.product.purchase-invoice',compact('title','datas','base','method','sub_title'));

    }

    public function invoice($id){
       
        $title = trans('products.purchased_plan');
        $sub_title = trans('products.purchased_plan'); 
        $base = trans('products.purchase_plan');  
        $method = trans('products.purchase_plan'); 
        // $id = decrypt($idencrypt);
       
      
      $data = PurchaseHistory::where('id','=',$id)->value('datas');

      $datas = json_decode($data,true);
          

    return view('app.user.product.purchase-invoice',compact('title','datas','base','method','sub_title'));

    }



    public function paypalSuccess(Request $request,$id){
      
        $token = $request->token;
        $agreement = new \PayPal\Api\Agreement();

        try {

            //cancelexisting
            $item = PendingTransactions::find($id);
            $package=ProfileModel::where('user_id',$item->user_id)->value('package');
             if($package > 1){
               $cur_pack_order=PendingTransactions::where('user_id',$item->user_id)->where('package',$package)->where('payment_status','complete')->first();
               if($cur_pack_order->payment_method == 'paypal'){
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
             //cancelexisting
            // Execute agreement
            $result = $agreement->execute($token, $this->apiContext);
            
            $item->role = 'subscriber';
            $item->paypal = 1;
            $item->paypal_recurring_reponse = json_encode($result);
            if(isset($result->id)){
                $item->paypal_agreement_id = $result->id;
            }
            $amount = $item->amount;
            $item->payment_status='complete';
            $item->save();
            $package=Packages::find($item->package);
            $purchase_id= PurchaseHistory::create([
                            'user_id'=>$item->user_id,
                            'purchase_user_id'=>$item->user_id,
                            'package_id'=>$item->package,
                            'count'=>1,
                            'pv'=>$package->pv,
                            'total_amount'=>$item->amount,
                            'pay_by'=>$item->payment_method,
                            'rs_balance'=>$package->rs,
                            'sales_status'=>'yes',
                          ]);

            /*edited by vincy on match 13 2020*/
            $check_in_matrix = Tree_Table::where('user_id',Auth::user()->id)->where('type','yes')->count();
            if($check_in_matrix == 0){

                Packages::DirectReferrals(Auth::user()->id,$item->package);
                $addtomatrixplan = Packages::Addtomatrixplan(Auth::user()->id);   
            }
            /*edited by vincy on match 13 2020*/
              RsHistory::create([
                'user_id'=>$item->user_id,                   
                'from_id'=>$item->user_id,
                'rs_credit'=>$package->rs,
              ]);

  
         //commsiiom
             $sponsor_id =User::where('id',Auth::user()->id)->value('sponsor') ;
             // dd($sponsor_id);
            $sponsor_id=Sponsortree::where('user_id',$item->user_id)->value('sponsor');
            $user_arrs=[];
            $results=Ranksetting::getthreeupline($item->user_id,1,$user_arrs);
          
            foreach ($results as $key => $value) {
                Packages::rankCheck($value);
            }

            Packages::levelCommission($item->user_id,$package->amount);
            // Packages::directReferral($sponsor_id,$item->user_id,$item->package);
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
             $userpurchase['amount']=$item->amount;
             $userpurchase['payment_method']=$purchase_id->pay_by;
             $userpurchase['mail_address']=$user[0]->email;;
             $userpurchase['mobile']=$user[0]->mobile;
             $userpurchase['address']=$user[0]->address1;
             $userpurchase['invoice_id'] ='0000'.$purchase_id->id;
             $userpurchase['date_p']=$purchase_id->created_at;
             $userpurchase['package']=$package->package;
             PurchaseHistory::where('id','=',$purchase_id->id)->update(['datas'=>json_encode($userpurchase)]);
             ProfileModel::where('user_id',$item->user_id)->update(['package' => $item->package]);
             Session::flash('flash_notification',array('message'=>"You have purchased the plan succesfully ",'level'=>'success'));
             return  redirect("user/purchase/preview/".Crypt::encrypt($purchase_id->id));
            // echo 'New Subscriber Created and Billed';

        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => 'Error In payment'));
                  return Redirect::to('user/purchase-plan');
        }
    }

public function banktransferPreview(Request $request){
    
    $title     = "Payment Details";
    $sub_title = "Payment Details";
    $base      = "Payment Details";
    $method    = "Payment Details";
    $data=PendingTransactions::find($request->id);
    $bank_details = ProfileInfo::where('user_id',1)->first();
    $orderid=$data->order_id;
    $package=Packages::find($data->package);
    $package_amount=$data->amount;
    $period=$data->payment_period;
    
    $trans_id=$request->id;
    
    Session::flash('flash_notification', array('level' => 'success', 'message' => "The account will be activated once the payment has been processed!"));
    return view('app.user.product.bankpaydetails',compact('title', 'sub_title', 'base', 'method','orderid','bank_details','package_amount','period','package','trans_id'));

}

public function purchaseStatus($trans){
    

    $item = PendingTransactions::where('id',$trans)->first();

    
    if (is_null($item)) {
    return response()->json(['valid' => false]);
  }elseif($item->payment_status == 'complete'){
        
        $user_id=PurchaseHistory::max('id');
        if($user_id <> null){
        return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>Crypt::encrypt($user_id)]);
      }
    }else{
         return response()->json(['valid' => true,'status'=>$item->payment_status,'id'=>null]);
        
  }
    
    return response()->json(['valid' => false]);
}


public function getplanid(){

  


    // $packages=Packages::where('id','>',1)->get();
    // foreach ($packages as $key => $package) {
    //      $plan = new Plan();
    // $plan->setName('Atmor Monthly Billing')
    //   ->setDescription('Monthly Subscription to the Atmor Track Purchase')
    //   ->setType('infinite');

    // // Set billing plan definitions
    // $paymentDefinition = new PaymentDefinition();
    // $paymentDefinition->setName('Atmor Track Subscriptions')
    //   ->setType('REGULAR')
    //   ->setFrequency('Day')
    //   ->setFrequencyInterval('1')
    //   ->setCycles('0')
    //   ->setAmount(new Currency(array('value' => $package->amount, 'currency' => 'EUR')));

    // // Set merchant preferences
    // $merchantPreferences = new MerchantPreferences();
    // $merchantPreferences->setReturnUrl(url('/user/paypalupgrade/paypalsuccess'))
    //   ->setCancelUrl(url('/user/purchase-plan'))
    //   ->setAutoBillAmount('yes')
    //   ->setInitialFailAmountAction('CONTINUE')
    //   ->setMaxFailAttempts('0');

    // $plan->setPaymentDefinitions(array($paymentDefinition));
    // $plan->setMerchantPreferences($merchantPreferences);

    // //create the plan
    // try {
    //     $createdPlan = $plan->create($this->apiContext);

    //     try {
    //         $patch = new Patch();
    //         $value = new PayPalModel('{"state":"ACTIVE"}');
    //         $patch->setOp('replace')
    //           ->setPath('/')
    //           ->setValue($value);
    //         $patchRequest = new PatchRequest();
    //         $patchRequest->addPatch($patch);
    //         $createdPlan->update($patchRequest, $this->apiContext);
    //         $plan = Plan::get($createdPlan->getId(), $this->apiContext);

    //         // Output plan id
    //         // echo 'Plan ID:' . $plan->getId();
    //     } catch (PayPal\Exception\PayPalConnectionException $ex) {
    //         echo $ex->getCode();
    //         echo $ex->getData();
    //         die($ex);
    //     } catch (Exception $ex) {
    //         die($ex);
    //     }
    // } catch (PayPal\Exception\PayPalConnectionException $ex) {
    //     echo $ex->getCode();
    //     echo $ex->getData();
    //     die($ex);
    // } catch (Exception $ex) {
    //     die($ex);
    // }

 
    // $cur_plan_id=$plan->getId();
    // echo "plan:".$cur_plan_id."<br>";
    // Packages::where('id',$package->id)->update(['day_plan' => $cur_plan_id]);
    // // Packages::where('id',$package->id)->update(['month_plan' => $cur_plan_id]);
   
    // }
    // dd("done");


     // $package=ProfileModel::where('user_id',$user)->value('package');
     //        $subscription_id=PendingTransactions::where('user_id',$user)->where('package',$package)->value('paypal_agreement_id');

    $params = array('page_size' => '11');
    $planList = Plan::all($params, $this->apiContext);
    dd($planList);
      

  
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
