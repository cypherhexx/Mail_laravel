<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Response;

class MemberController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = 'Member Management';
        $sub_title = 'Member Management';
        $base      = 'Settings';
        $method    = 'Member Management';
        $settings  = User::all();
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        return view('app.admin.members.index', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $members = User::where('username', 'like', "%{$request->user_name}%")
            ->orWhere('name', 'like', "%{$request->name}%")
            ->orWhere('email', 'like', "%{$request->email}%")
            ->get();

        print_r($members);die();

    }

}
