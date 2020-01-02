<?php

namespace App\Http\Controllers\Admin;

use App\Codes;
use App\Http\Controllers\Admin\AdminController;
use Datatables;
use Illuminate\Http\Request;
use Session;

class CodeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title     = trans('code.view_add_accounts');
        $sub_title = trans('code.view_add_accounts');
        $base      = trans('code.view_add_accounts');
        $method    = trans('code.view_add_accounts');

        $code = Codes::join('users', 'users.id', '=', 'codes.user_id')
            ->select('codes.*', 'users.username')
            ->where('codes.status', 'pending')
            ->orderby('id', 'DESC')->paginate(10);
        return view('app.admin.code.index', compact('title', 'sub_title', 'base', 'method', 'code'));

    }

    public function store(Request $request, $id)
    {

        $add         = Codes::find($id);
        $add->status = 'confirm';
        $add->save();

        Session::flash('flash_notification', array('message' => "Add updated succesfully", 'level' => 'success'));
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $codes = Codes::leftjoin('users', 'users.id', '=', 'codes.user_id')->select(array('codes.id', 'users.username', 'codes.code', 'codes.status', 'codes.created_at'))->orderBY('codes.id', 'DESC')->get();

        return Datatables::of($codes)
            ->edit_column('created_at', '{{ date("d M Y",strtotime($created_at)) }}')
            ->edit_column('username', '@if($username == NULL) NA @else  {{$username}} @endif')

            ->make();
    }

}
