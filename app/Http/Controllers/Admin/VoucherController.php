<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\AdminController;
use App\User;
use App\Voucher;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Session;

class VoucherController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = trans('ticket_config.view_voucher');
        $sub_title = "all voucher requests";
        $base      = "Vouchers";
        $method    = "View vouchers";

        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $users          = User::getUserDetails(Auth::id());
        $user           = $users[0];
        $vouchers       = Voucher::select('vouchers.*', 'users.username')->join('users', 'users.id', '=', 'vouchers.user_id')->get();

        dd($vouchers);
        $vouchers_count = count($vouchers);
        return view('app.admin.voucher.index', compact('title', 'vouchers', 'user', 'vouchers_count', 'sub_title', 'base', 'method'));
    }

    public function voucherlist()
    {

        $title     = trans('ticket_config.create_voucher');
        $sub_title = "Text your message";
        $base      = 'Email';
        $method    = 'Voucher';
 
        $vhr   = Voucher::paginate(10);

         // dd($vhr);
        return view('app.admin.voucher.voucher_list', compact('title', 'sub_title', 'base', 'method', 'user', 'base', 'method', 'vhr'));

    }

    public function create(Request $request)
    {
        //     $requestid=$request->requestid;
        //     $vocherrquest=VoucherRequest::find($requestid);
        $count = $request->count;
        while ($count) {
            $voucher = self::RandomString();
            $res     = Voucher::create([

                'voucher_code'   => $voucher,
                'total_amount'   => $request->amount,
                'balance_amount' => $request->amount,

            ]);
            $count--;
        }
        if ($res) {
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.voucher_created')));
            // $vocherrquest->status="complete";
            // $vocherrquest->save();
        } else {
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('ticket_config.details_updated')));

        }

        return redirect()->back();
    }

    public function RandomString()
    {
        $characters       = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randstring       = '';
        for ($i = 0; $i < 11; $i++) {
            $randstring .= $characters[rand(0, $charactersLength - 1)];
        }
        $count = Voucher::where('voucher_code', $randstring)->count();
        if ($count > 0) {
            return self::RandomString();
        }

        return $randstring;
    }

    public function editvoucher(Request $request, $id)
    {
        $response = Voucher::where('id', $id)->get();

        $title     = 'Voucher';
        $sub_title = "Text your message";
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base   = 'Voucher';
        $method = 'Voucher';
        $count  = $request->count;
        //dd($count);
        $users = User::getUserDetails(Auth::id());
        $user  = $users[0];

        return view('app.admin.Voucher.voucheredit', compact('title', 'user', 'base', 'method', 'response'));
    }

    public function updatevoucher(Request $request)
    {
        $requestid = $request->requestid;
        // $requestid=$request->id;
        //dd($requestid);

        Voucher::where('id', $requestid)->update(array('total_amount' => $request->amount));
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.voucher_updated')));
        return redirect()->back();

    }

    public function deletevoucher($id)
    {

        $title = 'Voucher';
        // $sub_title = "Text your message";
        $base     = 'Voucher';
        $method   = 'Voucher';
        $users    = User::getUserDetails(Auth::id());
        $user     = $users[0];
        $response = Voucher::where('id', $id)->get();

        return view('app.admin.Voucher.Voucherdelete', compact('title', 'user', 'base', 'method', 'response'));
    }

    public function deleteconfirm(Request $request)
    {

        $requestid = $request->requestid;

        $res = Voucher::where('id', $requestid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.voucher_details')));
        return Redirect::action('Admin\VoucherController@voucherlist');
    }

}
