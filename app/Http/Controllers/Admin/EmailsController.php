<?php

namespace App\Http\Controllers\Admin;

use App\Emails;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Session;

class EmailsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Assets::addCSS(asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css'));
        //  Assets::addJS(asset('assets/globals/plugins/x-editables/js/bootstrap-editable.min.js'));
        //  $settings=Emails::find(1);
        //  $title= 'Products management';
        //  $sub_title = 'Products management';
        //  $base = 'Settings';
        //  $method = 'Products management';
        //  $userss = User::getUserDetails(Auth::id());
        //  $user = $userss[0];
        // return view('app.admin.emails.index',compact('title','settings','user','sub_title','base','method'));
    }

    public function update(Request $request)
    {
        $settings = Emails::find(1);

        $settings->from_name = $request->from_name;

        $settings->from_email = $request->from_email;

        $settings->subject = $request->subject;

        $settings->content = $request->content;

        $settings->save();

        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Email updated succesfully'));

        return redirect()->back();
    }

}
