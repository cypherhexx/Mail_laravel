<?php

namespace App\Http\Controllers\user;

use App\Helpers\paypal\Configuration;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;
use App\Http\Controllers\user\sum;
use App\Braintree_Configuration;
use Braintree\ClientToken;
use App\shippingaddress;
use App\productaddcart;
use App\ChoosePayment;
use App\orderproduct;
use App\TempDetails;
use App\AppSettings;
use App\ProfileInfo;
use App\searchstore;
use App\Tree_Table;
use App\PointTable;
use App\Onlinestore;
use App\category;
use App\Settings;
use App\product;
use App\Country;
use App\Voucher;
use App\Balance;
use App\Emails;
use App\order;
use App\User;
use Redirect;
use Response;
use Session;
use Assets;
use Crypt;
use Auth;
use Mail;
use DB;


class OnlineStoreController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function onlinestore()
    {

        $title=trans('admin/onlinestore.online_store'); 
        $product=product::select('id','name','price','image','pvprice','quantity')
                        ->where('product.quantity','>',0)
                        ->get();
        $cart= productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->where('product.quantity','>',0)
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->select('product.*','productaddcart.*')
                        ->get(); 

        $pay_status=User::where('id',Auth::user()->id)->pluck('paystatus');
        if ($pay_status=='0') {
           return Redirect::to('user\dashboard');
        }else{
        $image = Product::all(); 
    return view('app.user.onlinestore.onlinestore',compact('title','product','cart','image'));
    }
    }

    public function addtocart(Request $request)
    {
       
        $product=product::where('id', $request->id)
                        ->whereNull('deleted_at')
                        ->where('id','<>',0)
                        ->select('id','name','image','price','pvprice','quantity','description','category','status')
                        -> get();

        $productaddcart = productaddcart::firstOrNew(['product_id' => $request->id,'user_id'=>Auth::user()->id]);
        $productaddcart->cart_quantity +=1 ;
        $productaddcart->save();
        $reponse = productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->select('product.name','product.image','product.status','product.price','productaddcart.*')
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->get();

        return Response::json($reponse);
    }
   
    public function deletecart(Request $request)
    {
        $product=productaddcart::where('id', $request->id)->delete();
        
        return Response::json(1);  
    }

    public function viewcheckoutproduct()
    {
        $title=trans('admin/onlinestore.checkout_product');
        $data= productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->select('product.name','product.image','product.status','product.price','productaddcart.cart_quantity','productaddcart.product_id','productaddcart.id')
                        ->where('productaddcart.order_status','=','pending')
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->get();
        $total_pricee=productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                        ->where('productaddcart.order_status','=','pending')
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->get();
        $pay_status=User::where('id',Auth::user()->id)->pluck('paystatus');
        if ($pay_status=='0') {
           return Redirect::to('user\dashboard');
        }else{
        return view('app.user.onlinestore.checkoutproduct',compact('title','data','total_pricee')); 
        }      
    }

    public function checkout()
    {
        $title= trans('admin/onlinestore.checkout_paypal');

        return view('app.user.online.BraintreeHFPPDemo.checkout',compact('title'));        
    }    
    public function updatecart(Request $request)
    {
        productaddcart::where('id',$request->requestid)
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->update(['cart_quantity'=>$request->cart_quantity]);

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('admin/onlinestore.update_successfully')));

        return Redirect::action('user\OnlineStoreController@viewcheckoutproduct');
    }

    public function deletecheckoutproduct($id)
    {
        $items = productaddcart::find($id);
        $items->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('admin/onlinestore.deleted_successfully')));
    
        return Redirect::action('user\OnlineStoreController@viewcheckoutproduct');
    }

    public function removeproduct($id)
    {
        $items = productaddcart::find($id);
        $items->delete(); 

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('admin/onlinestore.deleted_successfully')));

        return Redirect::action('user\OnlineStoreController@viewcheckoutproduct');
    }

    public function shipping()
    {
        $title=trans('admin/onlinestore.order_confirmation');
        $Country = Country::all();
        $payment_type=ChoosePayment::where('status','yes')->get();
        $amount=productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                        ->where('productaddcart.order_status','=','pending')
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->get();
        $price=$amount[0]->total_price;

        return view('app.user.onlinestore.shippingaddress',compact('title','Country','payment_type','price'));
    }

    public function data(Request $request)
    {
    $key = $request->key;
        if(isset($key)){
        $voucher = $request->voucher ;
        $vocher=Voucher::where('voucher_code',$key)->get();
        
        return Response::json($vocher);
        } 
    }
    private $myresult;
    public function saveShippingRequest($id,$fname,$lname,$email,$contact,$ninumber,$country,$state,$city,$address,$pincode)
    {
        $address_details=shippingaddress::create([ 
                    'user_id'=>$id,
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'email'=>$email,
                    'contact'=>$contact,
                    'ninumber'=>$ninumber,
                    'country'=>$country,
                    'state'=>$state,
                    'city'=>$city,
                    'address'=>$address,
                    'pincode'=>$pincode,
                    ]);
        $product = product::join('productaddcart','product.id','=','productaddcart.product_id')
                                    ->select('productaddcart.*','product.*')
                                    ->where('productaddcart.product_id','<>',0)
                                    ->where('productaddcart.order_status','=','pending')
                                    ->whereNull('productaddcart.deleted_at')
                                    ->get();
            $sum=0;
            $total_count=0;
            $total_pv=0;

            foreach ($product as $key => $value) 
            {
                $sum =$sum +($value->price*$value->cart_quantity);
                $total_count=$total_count + ($value->cart_quantity);
                $total_pv=$total_pv + ($value->pvprice*$value->cart_quantity);
            }
            order::create([
                        'user_id'=>Auth::user()->id,
                        'total_amount'=>$sum,
                        'total_count'=>$total_count,
                        'total_pv'=>$total_pv,
            ]);
            $order=order::max('id');
            foreach ($product as $key2 => $value) 
            { 
                orderproduct::create([
                                    'order_id'=>$order,
                                    'product_id'=>$value->product_id,
                                    'count'=>$value->cart_quantity,
                                    'amount'=>($value->cart_quantity)*($value->price),
                                    'pv'=>($value->cart_quantity)*($value->pvprice),
                ]);         
            }  
            $decrement_quantity = product::join('orderproduct','product.id','=','orderproduct.product_id')
                                    ->select('product.*','orderproduct.*')
                                    ->get(); 
            foreach ($decrement_quantity as $key1 => $value1) 
                { 
                    $product_quantity=$value1->quantity;
                    $purchased_count=$value1->count;
                    $dec=$product_quantity - $purchased_count;
                    product::where('id','=',$value1->product_id)->update(['quantity'=>$dec]);
                }  
                productaddcart::where('user_id',Auth::user()->id)->update(['order_status'=>'complete']);

                productaddcart::where('user_id',Auth::user()->id)->  delete();
                return $address_details;
    } 

    public function shippingcreation(Request $request)
    {   
        $total_price=productaddcart::join('product','product.id','=','productaddcart.product_id')
                        ->select(DB::raw('sum(productaddcart.cart_quantity*product.price) AS total_price'))
                        ->where('productaddcart.order_status','=','pending')
                        ->where('productaddcart.user_id','=',Auth::user()->id)
                        ->get();     
        $select_payment=$request->payment;
        if($request->payment == 'cheque')
        {
            self::saveShippingRequest(Auth::user()->id,$request->fname,$request->lname,$request->email,$request->contact,$request->ninumber,$request->country,$request->state,$request->city,$request->address,$request->pincode); 
            $id = shippingaddress::where('user_id', Auth::user()->id)->max('id');
            return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.$select_payment);   
        }

        if ($request->payment == 'voucher') 
        {
        $vocher=$request['payable_vouchers']; 
        $count1=count($vocher);
        $count=$count1-1;
        $total=0;
         foreach ($vocher as $key => $value) { 
            $balance= Voucher::where('voucher_code','=',$value)->pluck('balance_amount');
            if ($key > 0 && $balance >= $request->total_amount) {
            Voucher::where('voucher_code','=',$value)->decrement('balance_amount',$request->total_amount);
               $request->total_amount=0;
            }
            if($key > 0 && $balance < $request->total_amount && $request->total_amount > 0){
            Voucher::where('voucher_code','=',$value)->update(['balance_amount' => 0]);
            $total_amount=$total_amount- $balance;

            }      
          }
        self::saveShippingRequest(Auth::user()->id,$request->fname,$request->lname,$request->email,$request->contact,$request->ninumber,$request->country,$request->state,$request->city,$request->address,$request->pincode);
        $id = shippingaddress::where('user_id', Auth::user()->id)->max('id');
        return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.$select_payment);

        }
        $balance=Balance::where('user_id',Auth::user()->id)->pluck('balance');
        if ($request->payment =="ewallet")
        {
            if($balance>=$request->total_amount){  
            Balance::where('user_id',Auth::user()->id)->decrement('balance',$request->total_amount);
            }
            else{
                Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('admin/onlinestore.insufficient_funds')));
                return Redirect::action('user\OnlineStoreController@onlinestore');
            }
            self::saveShippingRequest(Auth::user()->id,$request->fname,$request->lname,$request->email,$request->contact,$request->ninumber,$request->country,$request->state,$request->city,$request->address,$request->pincode);
            $id = shippingaddress::where('user_id', Auth::user()->id)->max('id');
            return  redirect("user/orderconfirm/".Crypt::encrypt($id).'/'.$select_payment);
        }

        if($request->payment == "paypal")
        {
            require_once("paypal_functions1.php");
            $returnURL =url('user/shippingcreation');
            $cancelURL = url();
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
            } 
            else 
            {
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
        require_once("paypal_functions1.php");
        $url = "";
        foreach($_GET as $key => $value){
            $url .= $key . '=' . $value . '&';
        }
        $tok="&" . $url;
        $resArray=hash_call("GetExpressCheckoutDetails",$tok);
        $ack = strtoupper($resArray["ACK"]);
        if($ack == "SUCCESS" || $ack=="SUCCESSWITHWARNING"){
            $myresult = ConfirmPayment( $resArray['L_PAYMENTREQUEST_0_AMT0'],$resArray);
        }
        if($myresult['PAYMENTINFO_0_PAYMENTSTATUS']== "Completed"){
            DB::table('temp_details')->where('token', $myresult['TOKEN'])      ->update(['paystatus' => 1]);
            $temp_details = TempDetails::all()->where('token',$myresult['TOKEN'])->pluck('regdetails');
            $str1 = $temp_details->first();
            $str = json_decode($str1, true);
            $settings = Settings::getSettings();
            DB::beginTransaction();
            $address_details=shippingaddress::create([ 
                        'user_id'=>Auth::user()->id,
                        'fname'=>$str['fname'],
                        'lname'=>$str['lname'],
                        'email'=>$str['email'],
                        'contact'=>$str['contact'],
                        'ninumber'=>$str['ninumber'],
                        'country'=>$str['country'],
                        'state'=>$str['state'],
                        'city'=>$str['city'],
                        'address'=>$str['address'],
                        'pincode'=>$str['pincode'],
                        ]);
            self::saveShippingRequest(Auth::user()->id,$str['fname'],$str['lname'],$str['email'],$str['contact'],$str['ninumber'],$str['country'],$str['state'],$str['city'],$str['address'],$str['pincode']);
            $email = Emails::find(1) ;
            $app_settings = AppSettings::find(1) ;
            DB::commit();
            $select_payment="paypal";
            return  redirect("user/orderconfirm/".Crypt::encrypt($address_details->id).'/'.$select_payment);
        }
    }

    public function orderconfirm($idencrypt,$payment)
    {
        $title=trans('admin/onlinestore.order_confirmation');
        $user=shippingaddress::find(Crypt::decrypt($idencrypt));                             
        $country  = Country::join('shoppingaddress','shoppingaddress.country','=','countries.id')->where('countries.id',$user->country)->pluck('name');
        // $total=order::join('shoppingaddress','shoppingaddress.user_id','=','order.user_id')
        //                 ->select('order.total_count','order.total_amount')
        //                 ->get();
        $max_id=order::where('user_id',Auth::user()->id)->max('id');
        $total = order::where('user_id', Auth::user()->id)
                        ->where('id',$max_id)->get();
        Session::flash('flash_notification', array('level' => 'success', 'message' =>trans('admin/onlinestore.your_order_placed')));
        
        return view('app.user.onlinestore.orderconfirm',compact('title','user','country','total'));   
    } 
    public function cancelreg()
    {}
    public function sales()
    {
        $title=trans('user/onlinestore.sales_report');
        $cart= order::paginate(5);
        $pay_status=User::where('id',Auth::user()->id)->pluck('paystatus');
        if ($pay_status=='0') {
           return Redirect::to('user\dashboard');
        }else{
        return view('app.user.onlinestore.sales',compact('title','cart'));
        }
    }
    public function viewmore($id)
    {
        Assets::AddCSS(asset('assets/globals/css/print.css'));

        $title="";
        $product=orderproduct::join('product','orderproduct.product_id','=','product.id')
                                ->select('product.*','orderproduct.*')
                                ->where('orderproduct.order_id','=',$id)
                                ->paginate(5);

        $category=category::select('id','name')->paginate(5);
        $pay_status=User::where('id',Auth::user()->id)->pluck('paystatus');
        if ($pay_status=='0') {
           return Redirect::to('user\dashboard');
        }else{   
        return view('app.user.onlinestore.viewmore',compact('title','product','category'));
        }  
    }
} 