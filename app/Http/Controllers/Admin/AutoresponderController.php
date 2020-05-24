<?php

use App\AutoResponse;
use App\Http\Controllers\Admin\AdminController;
use App\User;
use Auth;

class AutoresponderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('menu.Auto_Responder');
        $sub_title = "Text your message";
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base   = 'Email';
        $method = trans('menu.Auto_Responder');
        $users  = User::getUserDetails(Auth::id());
        $user   = $users[0];
        $res    = AutoResponse::all();
        // dd($res);die();
        return view('app.admin.autoresponder.autoresponse', compact('title', 'user', 'sub_title', 'base', 'method', 'res'));
    }

}
