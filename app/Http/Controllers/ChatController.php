<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Closure;
use Auth;
use Carbon;
use Cache;
use Validator;

class ChatController extends Controller
{
    public function setPresence(Request $request)
    {
   
    	$validator = Validator::make($request->all(), [
		    'status' => 'required',
		]);
    	
    	if(Auth::check() && $request->status == "true") {    	
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            return "set to online";
        }

    	if(Auth::check() && $request->status == "false") {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::forget('user-is-online-' . Auth::user()->id, true, $expiresAt);
            return "set to offline";
        }

    }
}
