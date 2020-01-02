<?php

namespace App\Http\Controllers\user\Helpdesk\Ticket;

use App\Http\Controllers\user\UserAdminController;
use App\Models\Helpdesk\Ticket\TicketCannedResponse;
use App\Http\Requests\Admin\Helpdesk\Ticket\TicketCannedResponseRequest;
use Datatables;
use Illuminate\Http\Request;
use Validator;
use Session;
use Response;

class TicketsCannedResponseController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('ticket.tickets');
        $sub_title = trans('ticket.tickets');
        $base      = trans('ticket.tickets');
        $method    = trans('ticket.tickets');
        return view('app.user.helpdesk.tickets.canned_response.index', compact('title', 'sub_title', 'base', 'method'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //We have form in index page itself so, omitting this
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|max:200|unique:ticket_canned_responses,title',           
            'subject' => 'bail|required|max:200|unique:ticket_canned_responses,subject',           
            'message' => 'bail|required|max:30000|unique:ticket_canned_responses,message',           
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $ticket_canned_response = new TicketCannedResponse();
        $ticket_canned_response->title = $request->title;        
        $ticket_canned_response->subject = $request->subject;         
        $ticket_canned_response->message = $request->message;         
        $ticket_canned_response->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.new_canned_response_added')));
        return redirect('admin\helpdesk\tickets\canned-response');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title     = trans('ticket.department');
        $sub_title = trans('ticket.department');
        $base      = trans('ticket.department');
        $method    = trans('ticket.department');
        $TicketDepartment = TicketDepartment::findOrFail($id);
        return view('app.admin.helpdesk.tickets.department.show', compact('title', 'sub_title', 'base', 'method','TicketDepartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

        /* get the atributes of the category model whose id == $id */
        $canned_response = TicketCannedResponse::whereId($id)->first();
        $canned_responses = TicketCannedResponse::pluck('title','subject', 'id')->toArray();
        $title     = trans('kb.department_edit');
        $sub_title = trans('kb.department_edit');
        $base      = trans('kb.department_edit');
        $method    = trans('kb.department_edit');
        
        try {
            return view('app.admin.helpdesk.tickets.canned_response.edit',compact('title','sub_title','base','method','canned_response','canned_responses'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, TicketCannedResponseRequest $request)
    {
       
        $canned_response = TicketCannedResponse::where('id', $id)->first();
        $sl = $request->input('title');        
        try {
            
            $canned_response->fill($request->input())->save();

              Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.canned_response_updated_successfully')));

              return redirect('admin/helpdesk/tickets/canned-response');

            


        } catch (Exception $e) {
           
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.canned_response_not_updated <li>'.$e->getMessage().'</li>')));

            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $canned_response = TicketCannedResponse::find($id);
        $canned_response->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Canned response deleted succesfully'));
        return redirect()->back();
    }

    public function data(Request $request)
    {
        try {
            $ticket_canned_response  = new TicketCannedResponse();
            $ticket_canned_response = $ticket_canned_response->select('id', 'title','subject','message','created_at')->get();
            
            return Datatables::of($ticket_canned_response)
                ->remove_column('id')
                ->remove_column('created_at')
                ->remove_column('message')
                ->filterColumn('title', true)
                ->filterColumn('subject', true)
                ->filterColumn('message', true)
                ->editColumn('title', function ($model) {
                    $title = strip_tags(preg_replace('/(\>)\s*(\<)/m', '$1$2', $model->title));
                    return '<span class="table-element-editable canned-response" data-type="text" data-url=' . url("admin/helpdesk/tickets/canned-response/update") . ' data-pk="' . $model->id . '" data-title="Enter canned-response title" data-name="title">' . $title . '</span>';
                })->editColumn('subject', function ($model) {
                    $subject = strip_tags(preg_replace('/(\>)\s*(\<)/m', '$1$2', $model->subject));
                    return '<span class="table-element-editable canned-response" data-type="text" data-url=' . url("admin/helpdesk/tickets/canned-response/update") . ' data-pk="' . $model->id . '" data-title="Enter canned-response subject" data-name="subject">' . $subject . '</span>';
                })->editColumn('message', function ($model) {
                    $message = strip_tags(preg_replace('/(\>)\s*(\<)/m', '$1$2', $model->message));
                    return '<span class="table-element-editable canned-response" data-type="text" data-url=' . url("admin/helpdesk/tickets/canned-response/update") . ' data-pk="' . $model->id . '" data-title="Enter canned-response message" data-name="message">' . $message . '</span>';
                })
                ->addColumn('action', function ($model) {
                    return ' <a data-toggle="modal" data-target="#view'.$model->id.'" href="#" class="btn btn-info btn-xs">View</a> &nbsp; <a href="'.url('admin/helpdesk/tickets/canned-response/'.$model->id).'/edit" class="btn btn-success btn-info btn-xs btn-edit-canned-response" data-id="'.$model->id.'"> Edit </a>&nbsp;<button class="btn btn-warning btn-info btn-xs btn-delete-canned-response" data-id="'.$model->id.'"> delete </button>  <!-- Surrender Modal -->
            <div class="modal fade" id="view'.$model->id.'">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><label>Title</label>: '.$model->title.'</h4>
                        </div>
                        <div class="modal-body">
                            <p><h6><label>Subject<label/>:'.$model->subject.'</h6></p>
                            <p><label>Message</label>:<pre>'.$model->message.'</pre></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="dismis6">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->';
                })
                ->escapeColumns([])
                ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }
    }



     public function getCannedResponse(Request $request){

        $validator = Validator::make($request->all(), [
            'id'         => 'required|exists:ticket_canned_responses',            
        ]);

        if ($validator->fails()) {

             return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        } else {
            
            $canned_response = TicketCannedResponse::find($request->id);
            return Response::json([
            'error' => false,
            'code'  => 200,
            'subject'  => $canned_response->subject,
            'message'  => $canned_response->message,
            
        ], 200);
        }
     }


}
