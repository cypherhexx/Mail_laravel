<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\News;
use App\BrokerDetails;
use App\UserBrokerDetails;
use Validator;
use DB;
use Session;
use Hash;
use Response;


use App\Http\Controllers\user\UserAdminController;

class UserController extends UserAdminController
{
    
     public function suggestlist(Request $request){
          if($request->input != '/'  &&  $request->input != '.')
                    $users['results'] = User::join('sponsortree','sponsortree.user_id','=','users.id')->where('sponsortree.sponsor','=',Auth::user()->id)->where('username','like',"%".trim($request->input)."%")->select('users.id','username as value','email as info')->get();
           else   
                    $users['results'] = User::join('sponsortree','sponsortree.user_id','=','users.id')->where('sponsortree.sponsor','=',Auth::user()->id)->select('users.id','username as value','email as info')->get();

          echo json_encode($users);

     }

      public function updatename(Request $request)
    {

    	 // dd($request->all());
        if (strtolower($request->username) == 'mlmadmin') {
            Session::flash('flash_notification', array('message' => "Username can not changed", 'level' => 'success'));
            return redirect()->back();
        }
        $username         = $request->username;
        $new_username     = $request->new_username;
        $data             = array();
        $user['username'] = $request->username;
        $validator        = Validator::make($user,
            ['username' => 'required|exists:users']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $data['username'] = $request->new_username;
            $validator        = Validator::make($data,
                ['username' => 'required|unique:users,username|alpha_num|max:255']);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                $update = DB::table('users')->where('username', $username)->update(['username' => $new_username]);
                Session::flash('flash_notification', array('message' => "Username Changed Successfully", 'level' => 'success'));

                return redirect()->back();

            }
        }
    }

     public function updatepass(Request $request){
     	// dd($request->all());
        $current_pass = $request->oldpass;
        $new_password = $request->newpass; 
        $pass= bcrypt($request->newpass);
        $repeat_password=$request->confpass;
        $user_id = Auth::user()->id;

        // dd($current_pass,Auth::user()->password);
        if (Hash::check($current_pass, Auth::user()->password))
        {    
            if($new_password === $repeat_password ){

         
            User::updatePassword($user_id,$pass);
            Session::flash('flash_notification',array('level'=>'success','message'=>'Password updated'));
                         return redirect()->back();
                     }
                     else{
                        
                        return redirect()->back()->withErrors(['Password conformation fails']);
                     }
       }
       else
       {       
         
          return redirect()->back()->withErrors(['Password mismatch']);


        
       }
    }

     public function updatetransactionpassword(Request $request){
        // dd($request->all());
        $current_pass = $request->oldpass;
        $new_password = $request->newpass; 
        $pass= bcrypt($request->newpass);
        $repeat_password=$request->confpass;
        $user_id = Auth::user()->id;

        // dd($current_pass,Auth::user()->password);
        if (Hash::check($current_pass, Auth::user()->transaction_pass))
        {    
            if($new_password === $repeat_password ){

         
            User::where('id','=',Auth::user()->id)->update(['transaction_pass'=>$pass]);
            Session::flash('flash_notification',array('level'=>'success','message'=>'Transaction Password updated'));
                         return redirect()->back();
                     }
                     else{
                        
                        return redirect()->back()->withErrors(['Password conformation fails']);
                     }
       }
       else
       {       
         
          return redirect()->back()->withErrors(['Transaction Password mismatch']);


        
       }
    }

    public function readNews()
    {

      $title='Read News';
      $base='Read News';
      $method='Read News';
      $sub_title='Read News';
      $read_news = News::orderBy('created_at','desc')->paginate(3);
      return view('app.user.news.news',compact('title','read_news','base','method','sub_title'));

    }

    public function readMore($id)
    {       $base='Read News';
      $method='Read News';
      $sub_title='Read News';
       
         $title='Read News';
        $read_news = News::where('id',$id)->get();
        return view('app.user.news.readnews',compact('title','read_news','base','method','sub_title'));

    }

    public function runSoftware(){

      
      $title='Run Software';
      $base='Run Software';
      $method='Run Software';
      $sub_title='Run Software';
      $broker_users=BrokerDetails::where('status','enabled')->get();
      $max=UserBrokerDetails::where('user_id',Auth::user()->id)->max('id');
        if($max <> null){
          $det=UserBrokerDetails::find($max);
          $status=$det->status;
        }else{
          $status='stopped';
        }
        // dd($status);
      return view('app.user.users.runsoftware',compact('title','base','method','sub_title','broker_users','status'));

    }

    public function downloadFile(Request $request){
        $file= public_path(). "/assets/uploads/"."NOXVM.exe";
        $headers = array('Content-Type: application/exe',);
        error_log("testing loginsg");
        return  Response::download($file,"NOXVM.exe", $headers);

    }

    public function getLicense(Request $request){
      error_log("test request");
      error_log(json_encode($request));
      error_log($request->privateKey);
      error_log($request->issuer_key);
      $response =  $this->getLicenses("c553fef5bf159f3a57e984db2be954ce", "38da33fe1a9092e3ca4a0bc7be832cfd");
      $response = json_decode($response);
      error_log($response->status);
      $user_id = Auth::user()->id;
      $judge = false;
      if($response->status == 200){
        foreach($response->response as $data)
        {
          if($data->account == $user_id){
            $judge = true;
          }
        }
        if($judge == true){
          $file= public_path(). "/assets/uploads/"."NOXVM.exe";
          $headers = array('Content-Type: application/exe',);
          error_log("testing loginsg");
          return  Response::download($file,"NOXVM.exe", $headers);
        }else {
          Session::flash('flash_notification',array('message'=>"Please purchase the package to download software.",'level'=>'success'));
             return  redirect("user/runsoftware");
        }
      }else {
        Session::flash('flash_notification',array('message'=>"Please purchase the package to download software",'level'=>'success'));
             return  redirect("user/runsoftware");
      }
    }

    public function saveBrokerDetails(Request $request){
    
      UserBrokerDetails::create([
        'broker_id' => $request->user,
        'account' => $request->account,
        'user_id'  =>Auth::user()->id,
        'password' => $request->password,

      ]);

       Session::flash('flash_notification',array('level'=>'success','message'=>'Details Saved'));
        return redirect()->back();

    }

    public function changestatus(){
      $max=UserBrokerDetails::where('user_id',Auth::user()->id)->max('id');
      UserBrokerDetails::where('id',$max)->update(['status' => 'stopped']);
       Session::flash('flash_notification',array('level'=>'success','message'=>'Stopped Successfully'));
        return redirect()->back();

    }

      public function GetLicenses($privateKey, $issuer_key){
        error_log("get licesnse setting");
        error_log($privateKey);
        error_log($issuer_key);
    $post = [];
    $post["action"] = "get";                              // action
    $post["timestamp"] = time();                          // nonce (most be unique per request)
    $post["issuer_key"] = $issuer_key;                    // Unique issuer_key as you got  
    
    $requestResult = $this->SendRequest($post, $privateKey);     // Sign and Send the request
    return $requestResult;                                // Results in JSON (JSON result format described in the SendRequest function)
  } 

  // *********************************************************************
  // ************ Add License for account number and robot_id
  // *********************************************************************
  public function AddLicense($privateKey, $issuer_key, $accountNumber, $robotId, $planId){
    $post = [];
    
    $post["action"] = "add";                              // Action
    $post["timestamp"] = time();                          // Nonce (most be unique per request)
    $post["issuer_key"] = $issuer_key;                    // Unique issuer_key as you got  
    $post["account"] = $accountNumber;                    // Account number to license          
    $post["robot_id"] = $robotId;                         // RobotId to license (Valid RobotId: 10 (for now only one robotId is valid))
    $post["plan_id"] = $planId;                           // PlanId to license (Valid PlanId: 150,151,152 - according to the user plan)
    
    $requestResult = $this->SendRequest($post, $privateKey);     // Sign and Send the request
    return $requestResult;                                // Results in JSON (JSON result format described in the SendRequest function)
  }    

  // *********************************************************************
  // ************ Cancel License for account number and robot_id
  // *********************************************************************
  public function CancelLicense($privateKey, $issuer_key, $accountNumber, $robotId){
    $post = [];
    
    $post["action"] = "cancel";                           // Action
    $post["timestamp"] = time();                          // Nonce (most be unique per request)
    $post["issuer_key"] = $issuer_key;                    // Unique issuer_key as you got  
    $post["account"] = $accountNumber;                    // Account number to cancel license        
    $post["robot_id"] = $robotId;                         // RobotId to cancel license (Valid RobotId: 10 (for now only one robotId is valid))
    
    $requestResult = $this->SendRequest($post, $privateKey);     // Sign and Send the request
    return $requestResult;                                // Results in JSON (JSON result format described in the SendRequest function)
  }    

  // *********************************************************************
  // ************ Modify Account and/or robot_id and/or plan_id for existing license
  // *********************************************************************
  public function ModifyLicense($privateKey, $issuer_key, $accountNumber, $accountNumberNew, $robotId, $robotIdNew, $planIdNew){
    $post = [];
    
    $post["action"] = "modify";                           // Action
    $post["timestamp"] = time();                          // Nonce (most be unique per request)
    $post["issuer_key"] = $issuer_key;                    // Unique issuer_key as you got
    $post["account"] = $accountNumber;                    // Existing Account number of the license    
    $post["robot_id"] = $robotId;                         // Existing RobotId of the license 

    if($accountNumber != $accountNumberNew)
      $post["new_account"] = $accountNumberNew;           // **OPTIONAL** New Account number for the license          
    if($robotId != $robotIdNew)
      $post["new_robot_id"] = $robotIdNew;                // **OPTIONAL** New RobotId for the license (Valid RobotId: 10 (for now only one robotId is valid))        
    if($planId != $planIdNew)
      $post["new_plan_id"] = $planIdNew;                  // **OPTIONAL** New PlanId for the license (Valid RobotId: 10 (for now only one robotId is valid))        

    $requestResult = $this->SendRequest($post, $privateKey);     // Sign and Send the request
    return $requestResult;                                // Results in JSON (JSON result format described in the SendRequest function)
  }    

  // *********************************************************************
  // ************ Helpers Functions
  // *********************************************************************

  // Function to create signature for the requested data
  public function SignRequest($postArray, $privateKey){
    $strPostData = "";
    foreach($postArray as $item){
      $strPostData .= $item;
    }
    $signature = hash_hmac("sha256", $strPostData, $privateKey);
    return $signature;
  }

  // Function to post the requested data
  // Results are JSON format and contains 2 fields: 
  // 'status' - Contains the code result. 200 means => operation succeeded, all the other codes => operation failed
  // 'response' - Fancy description of the result code
  //      (For Example) status code 621 - License already exists 
  public function SendRequest($postArray, $privateKey){
    error_log("send request");
    error_log(json_encode($postArray));
    error_log($privateKey);
    $postUrl = "https://expertinvestcorp.com:8074/api/mtLicense";
    $postArray["signature"] = $this->SignRequest($postArray, $privateKey);    // Sign the request with the unique private key
    $varsEncoded = http_build_query($postArray);

    //init curl connection
    if(function_exists("curl_init")){ 
      $CR = curl_init();
      curl_setopt($CR, CURLOPT_URL, $postUrl);
      curl_setopt($CR, CURLOPT_POST, 1);
      curl_setopt($CR, CURLOPT_FAILONERROR, true);
      curl_setopt($CR, CURLOPT_POSTFIELDS, $varsEncoded);
      curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);
      
      //actual curl execution perfom
      $result = curl_exec($CR);
      $error = curl_error($CR);
      if(!empty($error)){
        die($error);
      }
      curl_close($CR);
      
      return $result;
    }  else{
      die("No curl_init");
    }
  }
}
