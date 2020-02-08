<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\News;
use Validator;
use DB;
use Session;
use Hash;


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
}
