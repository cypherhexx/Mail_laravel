<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;


use Auth;
use Validator;
use Session;
use App\Codes;
use App\User;

class CodeController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('code.view_my_adds_account');
        $code = Codes::where('user_id',Auth::user()->id)->orderby('id','DESC')->paginate(10);
        $credits = User::where('id',Auth::user()->id)->pluck('credits');
        return view('app.user.code.index',compact('title','code','credits'));
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
    public function show(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
                'email'=>'required|email',
                'user_id'=>'required',
            ]);

        if($validator->fails()){
                return redirect()->back()->with($validator->erros());
        }else{
            if(User::where('id',Auth::user()->id)->pluck('credits') > 0){
                Codes::create([
                    'user_id'=>Auth::user()->id,
                    'email'=>$request->email,
                    'identification'=>$request->user_id,
                    ]);
                User::where('id',Auth::user()->id)->decrement('credits');

                 Session::flash('flash_notification',array('message'=>"You have added the details succesfully ",'level'=>'success'));
             }else{
                Session::flash('flash_notification',array('message'=>"You dont have enough adds  credit balance ",'level'=>'warning'));
             }


                
         
         return redirect()->back();
        }

    }

    
}
