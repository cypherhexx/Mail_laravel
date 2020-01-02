<?php

namespace App\Http\Controllers\Admin;

use App\Balance;
use App\Http\Controllers\Admin\AdminController;
use App\PointHistory;
use App\PointTable;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class IncomeDetailsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = trans('income.title');
        $sub_title = trans('income.sub_title');
        $method    = trans('income.title');
        $base      = trans('income.title');

        $username  = Auth::user()->username;
        $pv        = PointTable::where('user_id', Auth::user()->id)->pluck('pv');
        $redeem_pv = PointTable::where('user_id', Auth::user()->id)->pluck('redeem_pv');
        $balance   = round(Balance::where('user_id', Auth::user()->id)->pluck('balance'), 2);
        $data      = PointHistory::join('users', 'users.id', '=', 'point_history.from_id')->select('point_history.*', 'users.username')->where('user_id', Auth::user()->id)->get();

        return view('app.admin.income.index', compact('title', 'sub_title', 'method', 'base', 'username', 'data', 'balance', 'pv', 'redeem_pv'));

    }

    public function indexPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user'       => 'required|exists:users,username',
            'bonus_type' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

            $user_id = User::userNameToId($request->user);

            $title     = trans('income.title');
            $sub_title = trans('income.sub_title');
            $base      = trans('income.title');
            $method    = trans('income.title');

            $username  = $request->user;
            $pv        = PointTable::where('user_id', $user_id)->pluck('pv');
            $redeem_pv = PointTable::where('user_id', $user_id)->pluck('redeem_pv');
            $balance   = round(Balance::where('user_id', $user_id)->pluck('balance'), 2);
            $data      = PointHistory::join('users', 'users.id', '=', 'point_history.from_id')
                ->select('point_history.*', 'users.username')
                ->where('user_id', $user_id)
            // ->where(function($query) use($request){
            //     if($request->bonus_type != 'All'){
            //         $query->where('point_history.commision_type','=',$request->bonus_type);
            //     }
            // })
                ->orderby('created_at', 'DESC')
                ->take(100)
                ->get();

            return view('app.admin.income.index', compact('title', 'sub_title', 'method', 'base', 'username', 'data', 'balance', 'pv', 'redeem_pv'));

        }

    }
}
