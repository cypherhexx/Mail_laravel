<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class Demo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $forbidActions = ["POST","PUT","PATCH","DELETE"];

        if(in_array($request->method(),$forbidActions))
        {
            if($request->ajax()){
                // dd('ajax');
                return response(["message"=>"Not allowed to modify data on demo","data"=>[]],401);
                // return "AJAX";
            }else{
                Session::flash('flash_notification', array('level' => 'error', 'message' => 'Not allowed to modify data on demo'));
                 return Redirect::back();
            }
            // return "HTTP";

        }

        return $next($request);
    }
}