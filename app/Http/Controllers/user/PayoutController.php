<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use Redirect;
use Session;
use Validator;
use App\Balance;
use Hash;
use App\Payout;
use App\User;
use App\Mail;
use App\Activity;
use App\Http\Requests;
use App\Http\Requests\user\getPayoutRquestingRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;

class PayoutController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
        $user_balance = Balance::where('user_id','=',Auth::user()->id)->value('balance');
        $title = trans('payout.payout_request');
        $sub_title = trans('payout.my_requests');
        
        $rules = ['req_amount' => 'required'];
        
        $base = trans('payout.payout');
        $method = trans('payout.payout_request');

        $total_payout = Payout::where('user_id','=',Auth::user()->id)
                            ->where('status','=','released')
                            ->sum('amount');
         $total_pending = Payout::where('user_id','=',Auth::user()->id)
                            ->where('status','=','pending')
                            ->sum('amount');
       
        return view('app.user.payout.payout_request',compact('user','title','user_balance','rules','base','method','sub_title','total_payout','total_pending'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function request(Request $request){
        $validator = Validator::make(Input::all(), array('req_amount' => 'required|numeric','oldpass'=>'required', ));

    
        $current_pass =   $request->oldpass; 
        if ($validator->fails()) {

        // get the error messages from the validator
        $messages = "Request amount is required";

        // redirect our user back to the form with the errors from the validator
        return  redirect()->back()->withErrors($validator);
        }

        else{
        
         if (Hash::check($current_pass, Auth::user()->transaction_pass))
             {  
        $req_amount = round($request->req_amount,2);
        $user_balance = Balance::getTotalBalance(Auth::user()->id);
        if($req_amount <= $user_balance and $req_amount > 0 and is_numeric( $request->req_amount )){
             Payout::create([
        'user_id'        => Auth::user()->id,            
        'amount'        => $req_amount,
        'req_amount'        => $req_amount,
        'status'   => 'pending'
        ]);
                Balance::updateBalance(Auth::user()->id, $req_amount);
                Activity::add("payout requested by ".Auth::user()->username, Auth::user()->username ." requested payout  an amount of $req_amount ");
            Session::flash('flash_notification',array('level'=>'success','message'=>trans('payout.request_completed')));
        }
        else{
            Session::flash('flash_notification',array('level'=>'danger','message'=>trans('payout.invalid_amount')));
        }
    }
     else{
             Session::flash('flash_notification', array('message' => "Incorrect password"));
               return redirect()->back();
           }
        
        return Redirect::action('user\PayoutController@index');
    }
    }
    public function viewall(){
        $title = trans('payout.view_all_requests');
        $sub_title = trans('payout.my_requests');
        $requests = Payout::getMyPayoutRequests();
        
        $base = trans('payout.payout');
        $method = trans('payout.my_requests');
        // dd($requests->all());
        return view('app.user.payout.view_all_requests',compact('title','requests','user','base','method','sub_title'));
    }
    public function reg(){
        $title = trans('payout.view_all_requests');
        return view('app.user.payout.reg',compact('title','requests'));
    }
    public function getpayout(){
        $details = Payout::getUserPayoutDetails();
        print_r($details);
    }
}
