<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use App\EwalletModel;
use App\User;
use App\Mail;
use App\Commission;
use App\Sponsortree;
use App\Payout;
use App\Balance;
use App\Debit;
use App\UserDebit;
use Datatables;
use Session;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;

class Ewallet extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
         $title     = trans('ewallet.ewallet');
        $sub_title = trans('ewallet.ewallet');
        $base      = trans('ewallet.ewallet');
        $method    = trans('ewallet.ewallet'); 

        if (!session('wallet_type')) {
            Session::put('wallet_type', 'All');
        }

        $payout =payout::where('user_id', Auth::user()->id) 
                     ->where('status','=','released')->sum('amount');
        
        $balance = Balance::getTotalBalance(Auth::user()->id);

        $income = Commission::where('user_id','=',Auth::user()->id)
                  ->whereNotIn('payment_type',['fund_transfer','credited_by_admin'])
                  ->sum('payable_amount');

        $credit = Commission::where('user_id','=',Auth::user()->id)
                  ->whereIn('payment_type',['fund_transfer','credited_by_admin'])
                  ->sum('payable_amount');

     
        return view('app.user.ewallet.wallet',compact('title', 'user', 'sub_title', 'base', 'method','payout','balance','income','credit'));
    }

    
    public function data(Request $request)
    {         

        $amount = 0;
        $users1 = array();
        $users2 = array();
        //echo $user_id;die();
       $users1 = Commission::select('commission.id', 'user.username', 'fromuser.username as fromuser', 'commission.payment_type', 'commission.user_id', 'commission.payable_amount', 'commission.created_at','packages.package')
         ->join('users as fromuser', 'fromuser.id', '=', 'commission.from_id')
         ->join('users as user', 'user.id', '=', 'commission.user_id')
         ->join('packages', 'packages.id', '=','commission.package')
         ->where('commission.user_id','=',Auth::user()->id)
         ->orderBy('commission.id', 'desc');
        $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.user_id', 'payout_request.amount as payable_amount', 'payout_request.created_at','payout_request.created_at as payout_created')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->where('payout_request.user_id','=',Auth::user()->id)
            ->orderBy('payout_request.id', 'desc');

        $users3 = UserDebit::select('user_debit.id', 'fromuser.username as fromuser', 'user.username', 'user_debit.payment_type', 'user_debit.user_id', 'user_debit.debit_amount', 'user_debit.created_at','user_debit.created_at as debit_created')
            ->join('users as fromuser', 'fromuser.id', '=', 'user_debit.from_id')
            ->join('users as user', 'user.id', '=', 'user_debit.user_id')
            ->where('user_debit.user_id','=',Auth::user()->id)
            ->orderBy('user_debit.id', 'desc');

        $ewallet_count = $users1->union($users2)->union($users3)->orderBy('created_at', 'DESC')->get()->count();
        $users = $users1->union($users2)->union($users3)->orderBy('created_at', 'DESC')

            // ->offset($request->start)
            // ->limit($request->length)
            ->get();

      // die();

        return Datatables::of($users)
            ->edit_column('fromuser', '@if ($payment_type =="released") Adminuser @else {{$fromuser}} @endif')
            ->edit_column('user_id', '@if ($payment_type =="released" || $payment_type =="fund_transfer" || $payment_type =="plan_purchase" || $payment_type == "register") <span >{!!$payable_amount!!}</span> @else <span class="">0</span>@endif')

            ->edit_column('payable_amount', '@if ($payment_type =="released" || $payment_type =="fund_transfer" || $payment_type == "plan_purchase"|| $payment_type == "register") <span>0</span> @else <span class="">{{round($payable_amount,2)}}</span>@endif')
            ->edit_column('payment_type', ' @if ($payment_type =="released") Payout released @else <?php  echo str_replace("_", " ", "$payment_type") ;  ?> @endif')
            ->remove_column('id')
            ->setTotalRecords($ewallet_count)
            ->escapeColumns([])
            ->make();

            
    }

    public function fund(){
        $title = trans('wallet.fund_transfer');
            $sub_title =  trans('wallet.fund_transfer');
           
            $base =  trans('wallet.fund_transfer');
            $method =  trans('wallet.fund_transfer');

            $user_balance = Balance::where('user_id',Auth::user()->id)->value('balance');

            $credit_by_users = Commission::where('user_id','=',Auth::user()->id)
                  ->where('payment_type','=','fund_transfer')
                  ->sum('payable_amount');

           $credit_by_admin = Commission::where('user_id','=',Auth::user()->id)
                  ->where('payment_type','=','credited_by_admin')
                  ->sum('payable_amount');

           $total_transfer = Commission::where('from_id','=',Auth::user()->id)
                             ->where('payment_type','=','fund_transfer')
                             ->sum('payable_amount');



           return view('app.user.ewallet.fund',compact('title','countries','user','sub_title','base','method','user_balance','credit_by_users','credit_by_admin','total_transfer'));
    }

    public function fundtransfer(Request $request){

          $validator=Validator::make($request->all(),[
                'username'=>'required|exists:users',
                'amount'=>'required|numeric',
                'oldpass'=>'required',                 
                ]);
            $current_pass =   $request->oldpass; 
            if($validator->fails()){

                return  redirect()->back()->withErrors($validator);
            }else{


                if (Hash::check($current_pass, Auth::user()->transaction_pass))
             {    
            
                if(Balance::where('user_id',Auth::user()->id)->value('balance') >= $request->amount){
                
                    
                    $user_id = User::where('username',$request->username)->value('id');
                    Commission::create([
                        'user_id'=>$user_id,
                        'from_id'=>Auth::user()->id,
                        'total_amount'=>$request->amount,
                        'payable_amount'=>$request->amount,
                        'payment_type'=>'fund_transfer',
                        ]); 
                    Balance::where('user_id',$user_id)->increment('balance',$request->amount);

                    Balance::where('user_id',Auth::user()->id)->decrement('balance',$request->amount);
                    Debit::create([
                        'user_id'=>Auth::user()->id,
                        'to_userid'=>$user_id,
                        'total_amount'=>$request->amount,
                        'payable_amount'=>$request->amount,
                        'payment_type'=>'fund_transfer',
                        ]);

                    Session::flash('flash_notification',array('message'=>trans('wallet.amount_credited'),'level'=>'success'));

                    return redirect()->back();

                }else{
                     Session::flash('flash_notification',array('message'=>trans('wallet.not_enough_balance'),'level'=>'error'));

                    return redirect()->back();
                }
                
            }

           
            else{
             Session::flash('flash_notification', array('message' => "Incorrect password"));
               return redirect()->back();
           }
                
        }

    }


    public function mytransfer(){

        $title =  trans('wallet.my_transfer');
        $sub_title =  trans('wallet.my_transfer');
        $base =  trans('wallet.my_transfer');
        $method =   trans('wallet.my_transfer');

        $data = Debit::join('users','users.id','=','debit_table.to_userid')->where('debit_table.user_id',Auth::user()->id)->select('debit_table.*','users.username as tousername')->paginate(10);
        return view('app.user.ewallet.mytransfer',compact('title','countries','user','sub_title','base','method','data'));
    }
}

