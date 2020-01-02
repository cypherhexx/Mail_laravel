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
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($data, [
            'email' => 'required|exists:users,email|email'           
        ]);

        if($validator->fails()){

            return Response::json($validator->errors());

        }else{ 
              $login  = $request->email ;
              $user = User::where('email', '=' , urldecode($login))->first();

               return Response::json($user);

        }
    }

   
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email|email'           
        ]);

        if($validator->fails()){

            return Response::json($validator->errors());

        }else{ 
              $login  = $request->email ; 
              $user = User::join('packages','packages.id','=','users.package')
                            ->join('tree_table as tree_table','tree_table.user_id','=','users.id')
                            ->join('users as sponsor','sponsor.id','=','tree_table.sponsor')
                            ->join('users as placememnt','placememnt.id','=','tree_table.placement_id')
                            ->select('users.name','users.lastname','users.email','users.username','users.user_id','packages.package','placememnt.username as placememnt','sponsor.username as sponsor','users.monthly_maintenance as maintenance','tree_table.type as status')->where('users.email', '=' , urldecode($login))->first();
            if($user->maintenance =="1" && $user->status =="no"){
                    $user->package = 'inactive' ;
                    $user->maintenance = 0 ;
            }
              return Response::json($user);

        }
    }

}
