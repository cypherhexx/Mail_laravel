<?php

namespace App\Http\Controllers\Admin\Marketing\Autoresponder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\User;
use Auth;
use Validator;
use Session;

use  App\Models\Marketing\Autoresponder ;

class Autoresponder extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('autoresponder.autoresponder');
        $sub_title = trans("autoresponder.view_and_manage_autoresponder");
        $base   = trans('autoresponder.autoresponder');
        $method = trans("autoresponder.view_and_manage_autoresponder");
        $emailcampaignlist = EmailCampaign::all();
        return view('app.admin.campaign.autoresponder.autoresponders', compact('title', 'sub_title', 'base', 'method','autoresponderlist'));
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
        //
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
