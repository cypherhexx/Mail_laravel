<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\PointTable;
use App\PointHistory;
use App\Balance;


use App\Http\Controllers\Controller;

use App\Http\Controllers\user\UserAdminController;

class IncomeDetailsController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $title = trans('income.income');         
        $sub_title = trans('income.my_income');
        $method = trans('income.income');
        $base = trans('income.income');
        $username = Auth::user()->username;
        $pv =PointTable::where('user_id',Auth::user()->id)->pluck('pv');
        $redeem_pv = PointTable::where('user_id',Auth::user()->id)->pluck('redeem_pv');
        $balance = round(Balance::where('user_id',Auth::user()->id)->pluck('balance'),2);
        $bonus_type = trans('income.all');

        if($request->bonus_type){
            $bonus_type = $request->bonus_type;
        }
        $data = PointHistory::join('users','users.id','=','point_history.from_id')
        ->select('point_history.*','users.username')
        ->where('user_id',Auth::user()->id)
        ->where(function($query) use($bonus_type){
            if($bonus_type != 'All'){
                $query->where('point_history.commision_type','=',$bonus_type);
            }
        })
        ->orderby('created_at','DESC')
        ->take(100)
        ->get();


        return view('app.user.income.index',compact('title','sub_title','method','base','username','data','balance','pv','redeem_pv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
