<?php

namespace App\Http\Controllers\user;
use Auth;
use DB;
use Mail;
use Input;
use Redirect;
use Session;
use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Http\Requests;
use App\Helpers\Thumbnail;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\changepasswordRequest;
use App\Http\Requests\user\ProfileEditRequest;
use App\Http\Requests\user\getstaesRequest;
use App\Http\Controllers\user\AluminiCornerController;

class ChangePasswordController extends AluminiCornerController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         
        $rules = ['newpas' => 'required|same:confpas','confpas' => 'required|same:newpas'];
        $title='Change Password';
        $user = User::find(Auth::user()->id);
        //print_r( $user->user_id);
        
        return view('app.user.changepassword.changepassword',compact('title','rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function updatepassword(changepasswordRequest $request){
        $current_pass_post = $request->oldpas;
        $newpas_pass_post = bcrypt($request->newpas);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if (Hash::check($current_pass_post, Auth::user()->password))
        { 
              User::updatePassword($user_id,$newpas_pass_post);
              $user_details = User::getUserDetails(Auth::user()->id);
              Session::flash('flash_notification',array('level'=>'success','message'=>'Password updated'));
              $amin_email = User::getAdminEmail();
     
Mail::send($user_details[0]->email, ['name' => $user_details[0]->name], function ($m) use ($data) {
$m->to($user_details[0]->email, $user_details[0]->name)->subject('Your password changed!')->from($amin_email, 'BPRACT');
});

     $password = Emails::find(1) ;

        $app_settings = AppSettings::find(1) ;

         Mail::send('emails.password', ['email'=>$email,'company_name'=>$app_settings->company_name,'login_username' => $data['username'],'password'=> $data['password']], function ($m) use ($data , $email) {
             $m->to($data['email'], $data['firstname'])->subject('Password changed')->from($email->from_email, $email->from_name);
        });
              
     return Redirect::action('user\ChangePasswordController@index');
        }
    }



}
