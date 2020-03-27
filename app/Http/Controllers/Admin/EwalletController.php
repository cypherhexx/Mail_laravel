<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\AdminController;
use App\Commission;
use App\UserDebit;
use App\RsHistory;
use App\Balance;
use App\Payout;
use App\User;

use Illuminate\Http\Request;
use Datatables;
use Validator;
use Session;
use Auth;
use Hash;

class EwalletController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = trans('ewallet.ewallet');
        $sub_title = trans('ewallet.ewallet');
        $base      = trans('ewallet.ewallet');
        $method    = trans('ewallet.ewallet');

        // $users     = User::pluck('users.username', 'users.id');
        if (!session('user')) {
            Session::put('user', 'none');
        }

        if (!session('wallet_type')) {
            Session::put('wallet_type', 'All');
        }

        // $balance             = Balance::sum('balance');

        // $userss = User::getUserDetails(Auth::id());
        // $user   = $userss[0];
        // $fast_start=Commission::where('payment_type','=','fast_start')->sum('payable_amount');
        //  $indirect_start=Commission::where('payment_type','=','Indirect_fast_start')->sum('payable_amount');
        // $payout_rel=Payout::where('status','=','released')
        //      ->sum('amount');


                     $amount = 0;
        $users1 = array();
        $users2 = array();
        //echo $user_id;die();
        $users1 = Commission::select('commission.id', 'user.username', 'fromuser.username as fromuser', 'commission.payment_type', 'commission.user_id', 'commission.payable_amount', 'commission.created_at','packages.package')
            ->join('users as fromuser', 'fromuser.id', '=', 'commission.from_id')
            ->join('users as user', 'user.id', '=', 'commission.user_id')
            ->join('packages', 'packages.id', '=','commission.package')
            // ->get();
            // dd($users1);
            ->orderBy('commission.id', 'desc');
        $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.user_id', 'payout_request.released_amount as payable_amount', 'payout_request.created_at','payout_request.created_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
             ->where('payout_request.status','!=','pending')
            ->orderBy('payout_request.id', 'desc'); 
        $users3 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.user_id', 'payout_request.amount as payable_amount', 'payout_request.created_at','payout_request.created_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->where('payout_request.status','=','pending')
            ->orderBy('payout_request.id', 'desc');

        $users4 = UserDebit::select('user_debit.id', 'fromuser.username as fromuser', 'user.username', 'user_debit.payment_type', 'user_debit.user_id', 'user_debit.debit_amount', 'user_debit.created_at','user_debit.created_at')
            ->join('users as fromuser', 'fromuser.id', '=', 'user_debit.from_id')
            ->join('users as user', 'user.id', '=', 'user_debit.user_id')
            ->orderBy('user_debit.id', 'desc');

         $ewallet_count = $users1->union($users2)->union($users3)->union($users4)->orderBy('created_at', 'DESC')->get()->count();
        $users = $users1->union($users2)->union($users3)->union($users4)->orderBy('created_at', 'DESC')->get();
         // dd($users);

        return view('app.admin.ewallet.wallet', compact('title', 'users', 'sub_title', 'base', 'method'));
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
            ->orderBy('commission.id', 'desc');
        $users2 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.user_id', 'payout_request.released_amount as payable_amount', 'payout_request.created_at','payout_request.created_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
             ->where('payout_request.status','!=','pending')
            ->orderBy('payout_request.id', 'desc'); 
        $users3 = Payout::select('payout_request.id', 'users.username', 'users.username as fromuser', 'payout_request.status as payment_type', 'payout_request.user_id', 'payout_request.amount as payable_amount', 'payout_request.created_at','payout_request.created_at')
            ->join('users', 'users.id', '=', 'payout_request.user_id')
            ->where('payout_request.status','=','pending')
            ->orderBy('payout_request.id', 'desc');

        $users4 = UserDebit::select('user_debit.id', 'fromuser.username as fromuser', 'user.username', 'user_debit.payment_type', 'user_debit.user_id', 'user_debit.debit_amount', 'user_debit.created_at','user_debit.created_at')
            ->join('users as fromuser', 'fromuser.id', '=', 'user_debit.from_id')
            ->join('users as user', 'user.id', '=', 'user_debit.user_id')
            ->orderBy('user_debit.id', 'desc');

         $ewallet_count = $users1->union($users2)->union($users3)->union($users4)->orderBy('created_at', 'DESC')->get()->count();
        $users = $users1->union($users2)->union($users3)->union($users4)->orderBy('created_at', 'DESC');
        // dd($users);
            // ->offset($request->start)
            // ->limit($request->length)
            // ->get();


      // die();

        return Datatables::of($users)
            ->edit_column('fromuser', '@if ($payment_type =="released") Adminuser @else {{$fromuser}} @endif')
            ->edit_column('user_id', '@if ($payment_type =="released" || $payment_type =="fund_transfer" || $payment_type =="plan_purchase") <span >{!!$payable_amount!!}</span> @else <span class="">0</span>@endif')
            ->edit_column('payable_amount', '@if ($payment_type =="released" || $payment_type =="fund_transfer" || $payment_type == "plan_purchase") <span>0</span> @else <span class="">{{round($payable_amount,2)}}</span>@endif')
            ->edit_column('payment_type', ' @if ($payment_type =="released") Payout released @else <?php  echo str_replace("_", " ", "$payment_type") ;  ?> @endif')
            ->remove_column('id')
            ->setTotalRecords($ewallet_count)
            ->escapeColumns([])
            ->make();

    }
    public function userwallet(Request $request)
    {
        $amount     = 0;
        $users1     = array();
        $users2     = array();
        $users      = array();
        $user_id    = Auth::id();
        $bonus_type = trans('ewallet.bonus_type');
        if (session('user') != 'none') {
            $user_id = $request->user;
        }
        if (session('wallet_type') != 'All') {
            $bonus_type = $request->bonus_type;
        }
        $title = trans('ewallet.title');
        $users = User::lists('users.username', 'users.id');
        Session::put('user', $request->user);
        Session::put('bonus_type', $request->bonus_type);
        return redirect('admin/wallet');
    }

    public function search(Request $request)
    {
        $keywords    = $request->get('username');
        $suggestions = User::where('username', 'LIKE', '%' . $keywords . '%')->get();
        return $suggestions;
    }

    public function fund()
    {

        $title     = trans('ewallet.credit_fund');
        $sub_title = trans('ewallet.credit_fund');
        $base      = trans('ewallet.credit_fund');
        $method    = trans('ewallet.credit_fund');
        $data      = Commission::where('payment_type','=','credited_by_admin')
                                ->join('users','users.id','commission.user_id')
                                ->select('commission.*','users.username')
                                ->paginate(10);

        return view('app.admin.ewallet.fund', compact('title', 'countries', 'user', 'sub_title', 'base', 'method','data'));

    }

    public function creditfund(Request $request)
    {    
        $input = $request->all();
        $input['username'] = $request->username;
        $current_pass =   $request->oldpass; 

        $request->merge($input);
   

        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users',
            'amount'   => 'required|numeric|min:1|not_in:1',
        ]);

        if ($validator->fails()) {
            


            return redirect()->back()->withErrors($validator);
        } else {
             // if (Hash::check($current_pass, Auth::user()->transaction_pass))
             //   {    
            
       
                  $user_id = User::where('username', $request->username)->value('id');
                  Commission::create([
                  'user_id'        => $user_id,
                  'from_id'        => Auth::user()->id,
                  'total_amount'   => $request->amount,
                  'payable_amount' => $request->amount,
                  'payment_type'   => 'credited_by_admin',
            ]);
            Balance::where('user_id', $user_id)->increment('balance', $request->amount);

            Session::flash('flash_notification', array('message' => "Amount Credited to ({$request->username}) E-wallet", 'level' => 'success'));

            return redirect()->back();
           }
           // else{
           //   Session::flash('flash_notification', array('message' => "Incorrect password", 'level' => 'danger'));
           //     return redirect()->back();
           // }
       
        }

    // }

    public function rs_wallet()
    {

        $title     = trans('ewallet.rs_wallet');
        $sub_title = trans('ewallet.rs_wallet');
        $base      = trans('ewallet.rs_wallet');
        $method    = trans('ewallet.rs_wallet');

        return view('app.admin.ewallet.rs_wallet', compact('title', 'sub_title', 'base', 'method'));
    }

    public function rs_data(Request $request)
    {

        $rs_count = RsHistory::count();

        $rstable = RsHistory::select('rs_history.id', 'user.username', 'fromuser.username as fromuser', 'rs_history.rs_debit', 'rs_history.rs_credit', 'rs_history.created_at')
            ->join('users as fromuser', 'fromuser.id', '=', 'rs_history.from_id')
            ->join('users as user', 'user.id', '=', 'rs_history.user_id')
            ->orderBy('rs_history.id', 'desc')             
            ->get();

        return Datatables::of($rstable)
            ->remove_column('id')
            ->setTotalRecords($rs_count)
            ->make();
    }
}

