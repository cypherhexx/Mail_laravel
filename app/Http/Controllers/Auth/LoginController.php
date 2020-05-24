<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Request;
use App\MenuSettings;
use App\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
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
    // protected $redirectTo = 'admin/dashboard';

    public function redirectTo(){

      $id = Auth::user()->admin;
      if( $id == 1)
       return 'admin/dashboard';
      else
       return 'user/dashboard'; 

     }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
        if(Request::get('redirectPath')){
              $this->redirectTo = Request::get('redirectPath');
        }
    }


    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return property_exists($this, 'username') ? $this->username : 'username';
    }

    public function login(\Illuminate\Http\Request $request)
    {
       $usr1=User::where('id','=','1')->value('username');

       $usr= $request->{$this->username()};
       $block=MenuSettings::where('menu_name','=','Login')->value('status');
       $active = User::where('username','=',$usr)->value('active');
      
      if($block == 'no'&& $usr != $usr1 || $active == 'no'){
      
        return redirect()->back()->withErrors("Sorry! Currently Login Blocked By Admin");
       }
        $this->validateLogin($request);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);

        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }

}
