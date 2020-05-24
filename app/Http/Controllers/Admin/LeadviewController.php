<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\LeadCapture;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Session;

class LeadviewController extends AdminController
{

    public function leadview()
    {

        $title     = trans('ticket_config.lead');
        $sub_title = trans('ticket_config.lead');
        $base      = trans('ticket_config.lead');
        $method    = trans('ticket_config.lead');

        //$data = LeadCapture::paginate(10);
        $data = LeadCapture::join('users', 'users.id', '=', 'lead_capture.username')->select('lead_capture.*', 'users.username')->paginate(10);

        return view('app.admin.lead.leadview', compact('title','sub_title','base','method', 'data'));

    }
    public function updatelead(Request $request)
    {

        $settings = LeadCapture::find($request->pk);

        $data_name = $request->name;
        if ($request->name == "status") {

            if ($request->value == "complete") {
                $request->value = 1;

            } else {
                $request->value = 0;
            }

        }
        $settings->$data_name = $request->value;

        if ($settings->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }
    }

    public function getstatus()
    {

        $settings = LeadCapture::all();

        $response[0] = "pending";

        $response[1] = "complete";

        return json_encode($response, false);

    }

    public function deletelead(Request $request, $id)
    {
        $requestid = $id;

        $res = LeadCapture::where('id', $requestid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'lead details deleted successfully'));

        return Redirect::action('Admin\LeadviewController@leadview');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
