<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Tree_Table;
use App\Sponsortree;
use App\Commission;
use App\Voucher;
use App\PointTable;
use App\Settings;
use App\Ranksetting;
use App\VoucherHistory;
use App\AppSettings;
use Validator;
use App\Http\Requests;
use Assets;
use View;
use Response;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;



class ApiAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $login  = $request->email ;
        $user = User::where('email', '=' ,urldecode($login))->first();

            if ($user) {
                Auth::login($user);
                return redirect('user/dashboard');
            }else{
                return redirect()->back();
            }
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
        $login  = $request->email ;
        $user = User::where('email', '=' , urldecode($login))->first();

            if ($user) {
                Auth::login($user);
                return Response::json([1000=>'OK'])->header('Content-Type','application/json');
            }else{
                return redirect()->back();
            }
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
