<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\User;
use App\Country;
use App\Voucher;
use App\Settings;
use App\Tree_Table;
use App\Sponsortree;
use App\PointTable;
use App\Ranksetting;
use App\Commission;
use App\Packages;
use App\PointHistory;
use App\Sales;
use App\Emails;
use App\AppSettings;

use Assets;
use Mail;
use DB;
use Crypt;
use Session;
use Validator;
use Auth;
use Response;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


       
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

        // print_r($request->all());
         $data = array();
        $data['reg_by']="free_join";
        $data['firstname'] = $request->firstname;        
        $data['lastname'] = $request->lastname;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['reg_type'] = $request->reg_type;
        $data['cpf'] = $request->cpf;
        $data['passport'] = $request->passport;
        $data['username'] = $request->username;
        $data['gender'] = $request->gender;
        $data['country'] = $request->country;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['address'] = $request->address;
        $data['zip'] = $request->zip;
        $data['location'] = "";
        $data['password'] = $request->password;
        $data['sponsor'] = $request->sponsor;
        $data['placement'] = $request->placement;
        $data['package'] = 1;
        $data['leg'] = $request->leg;

        $messages = [
            'unique'    => 'The :attribute already existis in the system',
            'exists'    => 'The :attribute not found in the system',
           
        ];

        $validator = Validator::make($data, [
            'sponsor' => 'required|exists:users,username|max:255',
            'placement' => 'required|exists:users,username|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'username' => 'required|unique:users,username|alpha_num|max:255',
            'password' => 'required|alpha_num|min:6',
            'leg' => 'required'
        ]);

        if($validator->fails()){

            return Response::json($validator->errors());

        }else{       
        

        $sponsor_id = User::checkUserAvailable($data['sponsor']); 
        $placement_id = User::checkUserAvailable($data['placement']); 
 
        if(!$sponsor_id){
            return redirect()->back()->withErrors(['The username not exist']); 
        }
             
       
        DB::beginTransaction();


        $userkey =User::createUserID();
     
        $userresult=User::create([
            'name' => $data['firstname'],
            'lastname' => $data['lastname'],
            'user_id' => $userkey,
            'mobile' => $data['phone'],
            'email' => $data['email'],
            'register_type' => $data['reg_type'],
            'username' => $data['username'],
            'rank_id' => '1',
            'register_by' => $data['reg_by'],
            'cpf' => $data['cpf'],
            'passport' => $data['passport'],
            'gender' => $data['gender'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'address1' => $data['address'],
            'zip' => $data['zip'],
            'location' => $data['location'], 
            'package' => $data['package'], 
            'password' => bcrypt($data['password'])
            ]);
        
       
        $sponsortreeid=Sponsortree::where('sponsor',$sponsor_id)->orderBy('id', 'desc')->take(1)->pluck('id');
       
        $sponsortree=Sponsortree::find($sponsortreeid);
        $sponsortree->user_id=$userresult->id;  
        $sponsortree->sponsor=$sponsor_id; 
        $sponsortree->type="no"; 
        $sponsortree->save();

        $sponsorvaccant = Sponsortree::createVaccant($sponsor_id,$sponsortree->position); // from tree table
        $uservaccant = Sponsortree::createVaccant($userresult->id,0); // from tree table  

        $placement_id = Tree_Table::getPlacementId($placement_id,$data['leg']); // from tree table
        $tree_id = Tree_Table::vaccantId($placement_id,$data['leg']); // from tree table
        
        $tree = Tree_Table::find($tree_id);
        $tree->user_id = $userresult->id;       
        $tree->sponsor = $sponsor_id;
        $tree->type = 'no';
        $tree->save(); 


        Tree_Table::createVaccant($tree->user_id);  

        PointTable::addPointTable($userresult->id);

        user::insertToBalance($userresult->id);
        
        user::addCredits($userresult->id);

        DB::commit();

        }

        return Response::json(['message'=>'succes','1000'=>'OK'])->header('Content-Type','application/json');
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


    public function username_verification(Request $request)
    {

        $user_exists = User::where('username',$request->username)->count();
        
        if ($user_exists > 0){
        return Response::json(['message'=>'success','1000'=>'OK'])->header('Content-Type','application/json');          
        }
        else{
        return Response::json(['message'=>'failed','1000'=>'OK'])->header('Content-Type','application/json');  
        }

    }
 
}
