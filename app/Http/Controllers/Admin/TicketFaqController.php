<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\TicketFaq;
use Illuminate\Http\Request;
use Response;
use Session;

class TicketFaqController extends AdminController
{
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
    public function view_ticket_faq()
    {
        $title     = trans('ticket_details.faq');
        $sub_title = trans('ticket_details.faq');
        $base      = trans('ticket_details.faq');
        $method    = trans('ticket_details.faq');

        $ticket_faq = TicketFaq::all();

        return view('app.admin.ticket_faq.ticket_faq', compact('title','sub_title','base','method', 'ticket_faq'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTicketFaq()
    {
        $title     = trans('ticket_details.view_faq');
        $sub_title = trans('ticket_details.view_faq');
        $base      = trans('ticket_details.view_faq');
        $method    = trans('ticket_details.view_faq');

        return view('app.admin.view_ticket_faq.add_ticket_faq', compact('title'));
    }

    public function saveTicketFaq(Request $request)
    {

        $ticket_faq = new TicketFaq();

        $ticket_faq->faq = $request->faq;

        $ticket_faq->description = $request->message;

        // $taglessBody = strip_tags($subject->body);strip_tags

        $ticket_faq->save();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_details.ticket_faq_added')));

        return redirect('admin\get-faq');

    }

    // public function edit_ticket_faq($id)
    // {
    //     $title="Edit FAQ";

    //     $ticket_faq=TicketFaq::where('id',$id)->get();

    //     return view('app.admin.ticket_faq.edit_ticket_faq',compact('title','ticket_faq'));
    // }

    public function update_ticket_faq(Request $request)
    {

        // dd($request->all());

        // TicketFaq::where('id',$request->pk)->update(array('faq'=>$request->value,'description'=>$request->value));

        // return Response::json(array('status'=>1));

        $app_settings = TicketFaq::findOrFail($request->pk);

        $field_name = $request->name;

        $data_name = $request->value;

        if ($field_name == "faq_level") {
            $app_settings->faq = $request->value;
        } elseif ($field_name == "description_level") {
            $app_settings->description = $request->value;
        }

        $app_settings->save();

        return Response::json(array('status' => 1));

    }

    public function delete_ticket_faq($id)
    {

        $delete_faq = TicketFaq::find($id);

        $delete_faq->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_details.ticket_faq_deleted')));

        return redirect('admin/get-faq');

    }

}
