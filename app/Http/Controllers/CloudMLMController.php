<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;

class CloudMLMController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         // $this->middleware('guest:admin');
        // if(Auth::user()->id =! 1)
        //     $redirectTo='user/dashboard';
        //  $this->redirectTo = '/homes';
         $this->redirectTo = '/homes';
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function performLogoutToLock(Request $request)
    {        
        Auth::logout(); 
        $request->session()->flush();
        $request->session()->regenerate();
        if(isset($request->loggedOut)){
            if((null !==$request->loggedOut) && (null !==$request->redirect)){                
                return redirect('login/?loggedOut='.$request->loggedOut.'&redirect='.$request->redirect);       
            }else if(isset($request->loggedOut)){ 
                return redirect('login/?loggedOut='.$request->loggedOut);       
            }
        }else{
            return redirect('login');  
        }
    }


}
