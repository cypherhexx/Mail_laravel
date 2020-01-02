<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Balance;
use App\Payout;
use App\User;
use App\PaymentNotification;
use App\AppSettings;
use App\Emails;

use Illuminate\Http\Request;
use Mail;
use Session;
use Auth;

class PayoutController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = trans('payout.payout');
        $sub_title = trans('payout.view_payout');
        $base      = trans('payout.payout');
        $method    = trans('payout.payout_request');

        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];
        $vocherrquest = Payout::select('payout_request.*','profile_infos.*', 'users.username', 'user_balance.balance','payout_request.id as payout_id')
        ->join('user_balance', 'user_balance.user_id', '=', 'payout_request.user_id')
        ->join('users', 'users.id', '=', 'payout_request.user_id')
        ->join('profile_infos','profile_infos.user_id','=','users.id')
        ->where('status','=','pending')->orderBy('status', 'ASC')->paginate(10);
        $total_payout = Payout::where('status','=','released')->sum('released_amount');
        $total_pending = Payout::where('status','=','pending')->sum('req_amount');  
        $count_requests = count($vocherrquest);

        return view('app.admin.payout.index', compact('title', 'vocherrquest', 'user', 'count_requests', 'sub_title', 'base', 'method','total_pending','total_payout'));
    }

    public function getpayout()
    {
       
        $payout = Payout::sum('amount');

        $balance = Balance::sum('balance');
        echo isset($payout) ? $payout : 0;
        echo ',';
        echo isset($balance) ? $balance : 0;

    }
    public function confirm(Request $request)
    {

       

        $pay_reqid = $request->requestid;

        $payout_request = Payout::find($pay_reqid);
       
        if ($payout_request->status == "rejected") {
             return redirect()->back();
        }
        if ($payout_request->amount < $request->amount) {
           return redirect()->back()->withErrors(['Payout amount is greater than requested amount']);
       }
        if ($payout_request->amount > $request->amount) {

            $diff_amount = $payout_request->amount - $request->amount;
            $res         = Balance::where('user_id', $request->user_id)->increment('balance', $diff_amount);
        }
        $res = Payout::confirmPayoutRequest($pay_reqid, $payout_request->amount,$request->amount);

        if ($res) {
            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Details updated'));
            
             $email = Emails::find(1);
            /**
             * Returning app_settings to get company name
             * @var [collection]
             */
            $welcome=PaymentNotification::find(1);
            $app_settings = AppSettings::find(1);
            $user = User::find($request->user_id);
            /**
             * Sends mail to the user
             */
            Mail::send('emails.payoutmail',
                ['email'         => $email,
                    'company_name'   => $app_settings->company_name,
                    'firstname'      => $user->name,
                    'name'           => $user->lastname,
                    'username'       => $user->username,
                    'amount'         => $request->amount,
                    'welcome'        => $welcome,
                ], function ($m) use ($user, $email,$welcome) {
                    $m->to($user->email, $user->name)->subject($welcome->subject)->from($email->from_email, $email->from_name);
                });
            // $vocherrquest->status="complete";
            // $vocherrquest->save();
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => 'Details updated'));

        } 
        return redirect()->back();

    }
     public function reject($id,$amount)
    {
   

        $payout_request = Payout::find($id);

        $payout_request->amount;

            
            $res         = Balance::where('user_id', $payout_request->user_id)->increment('balance', $amount);
         Payout::where('id','=',$id)
               ->update(['status'=>'rejected']);

            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Details updated'));
       
        return redirect()->back();

    }

    public function payoutdelete(Request $request)
    {
        $res = Payout::deletePayoutRequest($request->requestid);
        if ($res) {
            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Details updated'));

        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => 'Details updated'));

        }
        return redirect()->back();
    }
}
