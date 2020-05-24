<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Controllers\Controller;
use App\LeadCapture;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class LeadController extends Controller
{

    public function leadcapture($id)
    {

        $title     = trans('leadcapture.leadcapture_page');
        $sub_title = trans('leadcapture.leadcapture_page');
        $base      = trans('leadcapture.leadcapture_page');
        $method    = trans('leadcapture.leadcapture_page');

        $username = $id;

        $lead = LeadCapture::all();
        if (User::where('username', '=', $username)->count() > 0) {

            return view('site.register.lead', compact('username', 'title', 'lead'));
        }

        return Redirect::action('user\dashboard@index');

    }

    public function create($id, Request $request)
    {

        $data = array();

        $data['name']   = $request->name;
        $data['email']  = $request->email;
        $data['mobile'] = $request->mobile;

        $validator = Validator::make($data, [

            'name'   => 'required|unique:users,username|alpha|max:255',
            'email'  => 'required|unique:users,email|email|max:255',
            'mobile' => 'required|numeric',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);

        } else {

            $username = $id;

            if (User::where('username', '=', $username)->count() > 0) {
                $uid = User::where('username', '=', $username)->pluck('id');

                LeadCapture::create([

                    'username' => $uid,
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'mobile'   => $request->mobile,

                ]);

                Alert::success('Good job,We Will Contact You Soon ');
                return Redirect::back();

                //   Session::flash('flash_notification',array('level'=>'success','message'=>'Successfull'));
                // return redirect()->back();

            }

        }
        // Session::flash('flash_notification',array('level'=>'danger','message'=>'failed'));
        // return redirect()->back();

    }

    public function deletelead($id)
    {
        dd($id);
        // $data = $request->id;
        // dd($data );
        // echo "hii";

        $del = LeadCapture::where('id', $id)->delete();

    }

}
