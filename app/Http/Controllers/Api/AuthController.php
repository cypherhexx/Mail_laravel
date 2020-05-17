<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Assets;
use View;
use Response;
use Session;
use Auth;
use App\User;




class AuthController extends Controller
{
    



    public function index(Request $request)
    {
         
        $login  = urldecode($request->email) ;
        $confirmation_code   = urldecode($request->code)  ;
        $webpenter_token   = urldecode($request->token)  ;
        Session::put('webpenter_token', $webpenter_token);
        $user = User::where('email', '=' , urldecode($login))
                ->where('confirmation_code',$confirmation_code )
                ->first();

            if ($user) {
                Auth::login($user);
                return redirect('user/genealogy');
            }else{
                return redirect()->back();
            }
    }

    
    public function store(Request $request)
    {
        $login  = $request->email ;
         $confirmation_code   = $request->code  ;
        $webpenter_token   = $request->token  ;
        Session::put('webpenter_token', $webpenter_token);
        $user = User::where('email', '=' , urldecode($login))->where('confirmation_code',$confirmation_code )->first();

            if ($user) {
                Auth::login($user);
                return Response::json([1000=>'OK'])->header('Content-Type','application/json');
            }else{
                return Response::json([1000=>'not ok'])->header('Content-Type','application/json');
            }
    }
}
