<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Admin\AdminController;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class CurrencyController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = Currency::all();

        $title     = trans('currency.currency_management');
        $sub_title = trans('currency.currency_management');
        $base      = trans('currency.settings');
        $method    = trans('currency.currency_management');

        $userss = User::getUserDetails(Auth::id());
        $user   = $userss[0];
        return view('app.admin.currency.index', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'code'          => 'required',
            'symbol'        => 'required',
            'format'        => '',
            'exchange_rate' => '',
            'active'        => '',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {

            Currency::create([
                'name'          => $request->name,
                'code'          => $request->code,
                'symbol'        => $request->symbol,
                'format'        => $request->format,
                'exchange_rate' => $request->exchange_rate,
                'active'        => $request->active,
            ]);
            Session::flash('flash_notification', array('level' => 'success', 'message' => 'Currency added succesfully'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $package = Currency::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);

        $currency->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Currency deleted succesfully'));

        return redirect()->back();
    }
}
