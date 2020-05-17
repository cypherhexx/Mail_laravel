<?php

namespace App\Http\Controllers;

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

use Input;
use Assets;
use Mail;
use DB;
use Session;
use Validator;
use Response;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       echo json_encode(array('key'=>'val','key1'=>'val2'));
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

       
        $data = array();
        $data['reg_by']="free_join";
        $data['name'] = urldecode($request->name);        
        $data['lastname'] =urldecode( $request->lastname);
        $data['phone'] = urldecode($request->phone);
        $data['email'] = urldecode($request->email);
        $data['reg_type'] = 'api_join';
        $data['cpf'] = urldecode($request->cpf);
        $data['passport'] = urldecode('NA');
        $data['username'] = urldecode($request->username);
        $data['gender'] =urldecode( $request->gender);
        $data['country'] = urldecode($request->country);
        $data['state'] = urldecode($request->state);
        $data['city'] = urldecode($request->city);
        $data['address'] = urldecode($request->address);
        $data['zip'] = urldecode( $request->zip);
        $data['location'] = urldecode( $request->location);
        $data['password'] =urldecode( $request->password);
        $data['sponsor'] = urldecode( $request->sponsor);
        $data['package'] = urldecode($request->package);

        $messages = [
            'unique'    => 'The :attribute already existis in the system',
            'exists'    => 'The :attribute not found in the system',
           
        ];

        $validator = Validator::make($data, [
            'sponsor' => 'required|exists:users,username|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'username' => 'required|unique:users,username|alpha_num|max:255',
            'password' => 'required|alpha_num|min:6',
            'package' => 'required|exists:packages,id',
            'name' => 'required',
        ]);

        if($validator->fails()){

                // return response()->json(['name' => 'Abigail', 'state' => 'CA']);
            return Response::json($validator->errors());
                            // ->header('Content-Type','application/json')
                            // ->header('application-type','application/json');

        }else{       
        

        $sponsor_id = User::checkUserAvailable($data['sponsor']); // from user table 
 
        if(!$sponsor_id){
             return  Response::json(['The sponsor doesnt exist'])->header('Content-Type','application/json');
            // return redirect()->back()->withErrors(['The username not exist']); 
        }
             

        $settings = Settings::getSettings();

        
        $binary_commission = $settings[0]->point_value;
        $point_value = $settings[0]->point_value;
        $tds =  $settings[0]->tds;
        $service_charge =  $settings[0]->service_charge;
        $amount_payable = $binary_commission - ($tds + $service_charge);

        DB::beginTransaction();
     
        $userresult=User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
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
        $sponsortree->type="yes"; 
        $sponsortree->save();

        $sponsorvaccant = Sponsortree::createVaccant($sponsor_id,$sponsortree->position); // from tree table
        $uservaccant = Sponsortree::createVaccant($userresult->id,0); // from tree table        

        // Tree_Table::createVaccant($tree->user_id);
        
        PointTable::addPointTable($userresult->id);



        user::insertToBalance($userresult->id);
        
        user::addCredits($userresult->id);

        /*
            Commission calculation begins 
        */


       
        Sales::addToSales($sponsor_id,$userresult->id,$data['package'],'register',1);

        Commission::pointDistribution($userresult->id,$data['package']);

        Commission::directrefererbonus($sponsor_id,$userresult->id,$data['package']);


        $next_level_sposnor = Sponsortree::getSponsorID($sponsor_id);

        if($sponsor_id >1) {
          
            $next_level_sposnor = $sponsor_id ;

            while(true){

                $sponsor_details = User::find($next_level_sposnor);

                if( $sponsor_details->package == 4){

                    $next_level_sposnor = Sponsortree::getSponsorID($next_level_sposnor);
                    continue;

                }else{

                     Commission::groupsalesbonus($next_level_sposnor,$userresult->id,$data['package'],1);

                     break;

                }

            }

                 
        }

 
        $email = Emails::find(1) ;

        $app_settings = AppSettings::find(1) ;

        Mail::send('emails.register', ['email'=>$email,'company_name'=>$app_settings->company_name,'login_username' => $data['username'],'password'=> $data['password']], function ($m) use ($data , $email) {
            $m->to($data['email'], $data['name'])->subject($email->subject)->from($email->from_email, $email->from_name);
        });

       DB::commit();

return Response::json([1000=>'OK'])->header('Content-Type','application/json');
          // return  redirect("registersucces/$userresult->id");
          
    
        // return $userresult;

        }
        
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
}
