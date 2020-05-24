<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProfileModel;

use Validator;
use Response;
use DB;


class AjaxController extends Controller
{
    //

    public function validateSponsor(Request $request)
    {
   
        // dd($request->all());
    	$validator = Validator::make($request->all(), [
		    'sponsor' => 'exists:users,username|required',
		]);
        // dd($request->all());
    	
    	if ($validator->fails()) {
    		return response()->json(['valid' => false]);
    	}else{
    		return response()->json(['valid' => true]);
    	}
        
        return response()->json(['valid' => false]);


    }

    public function globalmap(Request $request){
        $user_info = ProfileModel::groupBy('country')->select('country', DB::raw('count("country") as total'))->get();
        $keyed = $user_info->mapWithKeys(function ($item) {
            return [$item['country'] => $item['total']];
        });
        $list = $keyed->all();
        return Response::json($list);
    }


}
