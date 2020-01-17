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
        return view('app.user.product.index',compact('title','products','rules','base','method','sub_title','balance','min_amount'));    
    }




     public function purchasehistory()
    {
          $data = PurchaseHistory::join('packages','packages.id','=','purchase_history.package_id')
                  ->where('user_id',Auth::user()->id)
                  ->where('purchase_user_id',Auth::user()->id)
                  ->select('packages.package','count','packages.amount','total_amount','purchase_history.created_at','purchase_history.pv','purchase_history.pay_by')
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
            // 'username'=>'required|exists:users,username' ,
            'steps_plan_payment'=>'required|min:1' ,
            'plan'=>'required|exists:packages,id' ,
            ]);
        $app=AppSettings::get();
        // dd($app->all());

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{

                    

            $package = Packages::find($request->plan); 
            $fee=$package->amount;
            $cur_package=ProfileModel::where('user_id',Auth::user()->id)->value('package');
            $cur_amount=Packages::find($cur_package)->amount;
            $diff_amount=$fee-$cur_amount;
            $sponsor_id =Sponsortree::where('user_id',Auth::user()->id)->value('sponsor') ;
           


            // $falg =false;

             if($request->steps_plan_payment == 'paypal'){ 

                    $orderid = mt_rand();
                    $purchase=PendingTransactions::create([
                         'order_id' =>$orderid,
                         'package' => $request->plan,
                         'user_id'=>Auth::user()->id,
                         'username' =>Auth::user()->username,
                         'email' =>Auth::user()->email,
                         'sponsor' => $sponsor_id,
                         'request_data' =>json_encode($request->all()),
                         'payment_method'=>$request->steps_plan_payment,
                         'payment_type' =>'upgrade',
                         'amount' => $diff_amount,
                        ]);
                    
                    Session::put('paypal_id',$purchase->id);

                    $data = [];
                    $data['items'] = [
                        [
                            'name' => Config('APP_NAME'),
                            'price' => $diff_amount,
                            'qty' => 1
                        ]
                    ];

                    $data['invoice_id'] = time();
                    $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
                    $data['return_url'] = url('/user/upgrade/success',$purchase->id);
                    $data['cancel_url'] = url('register');

                    $total = 0;
                    foreach($data['items'] as $item) {
                        $total += $item['price']*$item['qty'];
                    }

                    $data['total'] = $total; 
                    $response = self::$provider->setExpressCheckout($data); 
                    PendingTransactions::where('id',$purchase->id)->update(['payment_data' => json_encode($response),'paypal_express_data' => json_encode($data)]);
                 
                    return redirect($response['paypal_link']);
                }
              }
                
            /*  payment validation and update balance */

            // if($request->steps_plan_payment == 'cheque'){
            //     $flag = true;
            // }elseif($request->steps_plan_payment == 'voucher'){

            //         $voucher_total = $package->amount ;
            //         foreach ($request->voucher as $key => $vouchervalue) {
            //              $voucher = Voucher::where('voucher_code', $vouchervalue)->first();
            //              $voucher_total = $voucher_total - $voucher->balance_amount ;
            //              if($voucher_total <=0 ){
            //                  $flag = true;
            //               }
            //         }

            //         if($flag){
            //           $package_amount = $package->amount ;
            //           foreach ($request->voucher as $key => $vouchervalue) {
            //                $voucher = Voucher::where('voucher_code', $vouchervalue)->first();                                 
            //                if($package_amount > $voucher->balance_amount){
            //                   $package_amount = $package_amount -  $voucher->balance_amount ;
            //                   $used_amount =  $voucher->balance_amount;                                    
            //                   $voucher->balance_amount = 0 ;
            //                   $voucher->save();
            //                }else{
            //                   // $package_amount =$voucher->balance_amount - $package_amount  ;
            //                   $used_amount =  $voucher->balance_amount - $package_amount;          
            //                   $voucher->balance_amount = $used_amount;
            //                   $voucher->save();                                    
            //                }

            //           }
            //         }  
            // } 


            // elseif($request->steps_plan_payment == 'ewallet'){
            //     $userbalance =Balance::where('user_id',Auth::user()->id)->value('balance');  
            //     if($userbalance < $package->amount){
            //         return redirect()->back()->withErrors(["Ewallet doesn't have enough balance, "]); 
            //     }
            //       $userbalance = Balance::where('user_id',Auth::user()->id)->decrement('balance',$package->amount);
            //       UserDebit::create([
            //             'user_id'=>Auth::user()->id,
            //             'from_id'=>Auth::user()->id,
            //             'debit_total'=>$package->amount,
            //             'debit_amount'=>$package->amount,
            //             'payment_type'=>'plan_purchase',
            //             ]);
            //     $flag = true;
            // }elseif($request->steps_plan_payment == 'Stripe'){

            //            try{
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
            //          $flag = true;
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
           

            // elseif($request->steps_plan_payment == 'voucher'){

            //         $voucher_total = $package->amount ;
            //         foreach ($request->voucher as $key => $vouchervalue) {
            //              $voucher = Voucher::where('voucher_code', $vouchervalue)->first();
            //              $voucher_total = $voucher_total - $voucher->balance_amount ;
            //              if($voucher_total <=0 ){
            //                  $flag = true;
            //              }
            //         }

            //         if($flag){
            //              $package_amount = $package->amount ;
            //                 foreach ($request->voucher as $key => $vouchervalue) {
            //                      $voucher = Voucher::where('voucher_code', $vouchervalue)->first();                                 
            //                      if($package_amount > $voucher->balance_amount){
            //                         $package_amount = $package_amount -  $voucher->balance_amount ;
            //                         $used_amount =  $voucher->balance_amount;                                    
            //                         $voucher->balance_amount = 0 ;
            //                         $voucher->save();
            //                      }else{
            //                         // $package_amount =$voucher->balance_amount - $package_amount  ;
            //                         echo $used_amount =  $voucher->balance_amount - $package_amount;          
            //                         $voucher->balance_amount = $used_amount;
            //                         $voucher->save();                                    
            //                      }

            //                      // die();

            //                      VoucherHistory::create([
            //                         'voucher_id'=>$voucher->voucher_code,
            //                         'used_by'=>Auth::user()->id,
            //                         'used_for'=> "pacakge purchase",
            //                         'used_amount'=>$used_amount,
            //                     ])  ;                           
            //                 }
            //         }  
            // }   

            // if($flag){

            //       // dd($request->all());
            //    $purchase_id=  PurchaseHistory::create([
            //         'user_id'=>Auth::user()->id,
            //         'purchase_user_id'=>Auth::user()->id,
            //         'package_id'=>$package->id,
            //         'count'=>$package->top_count,
            //         'pv'=>$package->pv,
            //         'total_amount'=>$package->amount,
            //         'pay_by'=>$request->steps_plan_payment,
            //         'rs_balance'=>$package->rs,
            //         'sales_status'=>'yes',

            //     ]);

            //       RsHistory::create([
            //         'user_id'=>Auth::user()->id,                   
            //         'from_id'=>Auth::user()->id,
            //         'rs_credit'=>$package->rs,
            //       ]);
                /*  Commissions calculation and point distributione */

                // Tree_Table::getAllUpline(Auth::user()->id);
                // PointTable::updatePoint($package->pv, Auth::user()->id);
                // Transactions::sponsorcommission($sponsor_id,Auth::user()->id);
                // $sponsor_id
                // LeadershipBonus::allocateCommission($sponsor_id,Sponsortree::where('user_id',$sponsor_id)->value('sponsor'),$package->pv/10);

       //      }      
       //  }
       //     $pur_user=PurchaseHistory::find($purchase_id->id);
       //     $user=User::join('profile_infos','profile_infos.user_id','=','users.id')
       //      ->join('packages','packages.id','=','profile_infos.package')
       //      ->where('users.id',$pur_user->user_id)
       //      ->select('users.username','users.name','users.lastname','users.email','profile_infos.mobile','profile_infos.address1','packages.package')
       //      ->get();
            
       
       // $userpurchase=array();      
       // $userpurchase['name']=$user[0]->name;
       // $userpurchase['lastname']=$user[0]->lastname;
       // $userpurchase['amount']=$purchase_id->total_amount;
       // $userpurchase['payment_method']=$purchase_id->pay_by;
       // $userpurchase['mail_address']=$user[0]->email;;
       // $userpurchase['mobile']=$user[0]->mobile;
       // $userpurchase['address']=$user[0]->address1;
       // $userpurchase['invoice_id'] ='0000'.$purchase_id->id;
       // $userpurchase['date_p']=$purchase_id->created_at;
       // $userpurchase['package']=$user[0]->package;

       // PurchaseHistory::where('id','=',$purchase_id->id)->update(['datas'=>json_encode($userpurchase)]);

       //  Session::flash('flash_notification',array('message'=>"You have purchased the plan succesfully ",'level'=>'success'));

       //  return  redirect("user/purchase/preview/".Crypt::encrypt($purchase_id->id));
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

     public function paypalpurchase(Request $request){
      $payment_id = Session::get('paypal_payment_id');
      $temp_data=PaypalDetails::where('token','=',$payment_id)->first();
      $data=json_decode($temp_data->regdetails,true);
      Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));

             return redirect("user/purchase-plan");
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {
            $package = Packages::find($data['plan']); 
            $sponsor_id =Sponsortree::where('user_id',Auth::user()->id)->value('sponsor') ;
            $purchase_id=  PurchaseHistory::create([
                    'user_id'=>Auth::user()->id,
                    'purchase_user_id'=>Auth::user()->id,
                    'package_id'=>$package->id,
                    'count'=>$package->top_count,
                    'pv'=>$package->pv,
                    'total_amount'=>$package->amount,
                    'pay_by'=>'paypal',
                    'rs_balance'=>$package->rs,
                    'sales_status'=>'yes',

                ]);

                  RsHistory::create([
                    'user_id'=>Auth::user()->id,                   
                    'from_id'=>Auth::user()->id,
                    'rs_credit'=>$package->rs,
                  ]);
                /*  Commissions calculation and point distributione */

                // Tree_Table::getAllUpline(Auth::user()->id);
                // PointTable::updatePoint($package->pv, Auth::user()->id);
                 // Ranksetting::updateRank(Auth::user()->id);
                // Transactions::sponsorcommission($sponsor_id,Auth::user()->id,$package->id);

                if($sponsor_id>1){
                    $second_sponsor = Sponsortree::where('user_id',$sponsor_id)->value('sponsor');
                    Transactions::indirectFaststart($second_sponsor,Auth::user()->id,$package->id);
                }

                // ProfileInfo::where('user_id',Auth::user()->id)->update(['package'=>$package->id]); 

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
        Session::flash('flash_notification', array('level' => 'danger', 'message' => "Payment failed"));
         return redirect("user/purchase-plan");
    }

    public function productSuccess(Request $request,$id){

          $response = self::$provider->getExpressCheckoutDetails($request->token);
          $item = PendingTransactions::find($id);
          $item->payment_response_data = json_encode($response);
          $item->save();
          $express_data=json_decode($item->paypal_express_data,true);
          $response = self::$provider->doExpressCheckoutPayment($express_data, $request->token, $request->PayerID);
          if($response['ACK'] == 'Success'){
            $item->payment_status='complete';
            $item->save();
            $package=Packages::find($item->package);
            $purchase_id= PurchaseHistory::create([
                            'user_id'=>$item->user_id,
                            'purchase_user_id'=>$item->user_id,
                            'package_id'=>$item->package,
                            'count'=>1,
                            'pv'=>$package->pv,
                            'total_amount'=>$package->amount,
                            'pay_by'=>$item->payment_method,
                            'rs_balance'=>$package->rs,
                            'sales_status'=>'yes',
                          ]);
              RsHistory::create([
                'user_id'=>$item->user_id,                   
                'from_id'=>$item->user_id,
                'rs_credit'=>$package->rs,
              ]);

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
            }
            else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'Error In payment'));
                  return Redirect::to('user/purchase-plan');
            }

    }




}
