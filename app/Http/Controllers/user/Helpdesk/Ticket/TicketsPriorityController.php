<?php

namespace App\Http\Controllers\user\Helpdesk\Ticket;

use App\Http\Controllers\user\UserAdminController;
use App\Models\Helpdesk\Ticket\TicketPriority;
use App\Http\Requests\Admin\Helpdesk\Ticket\TicketsPriorityRequest;
use Datatables;
use Illuminate\Http\Request;
use Validator;
use Session;

class TicketsPriorityController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('ticket.priority_list');
        $sub_title = trans('ticket.priority_list');
        $base      = trans('ticket.priority_list');
        $method    = trans('ticket.priority_list');
        return view('app.admin.helpdesk.tickets.ticket_priority.index', compact('title', 'sub_title', 'base', 'method'));
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
    public function store(TicketsPriorityRequest $request)
    {
       


        $tk_priority = new TicketPriority();
        $tk_priority->priority = $request->priority;
        $tk_priority->status = $request->status;
        $tk_priority->priority_desc = $request->priority_desc;
        $tk_priority->priority_color = $request->priority_color;
        $tk_priority->ispublic = $request->ispublic;
        // dd($tk_priority);
        $tk_priority->save();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.new_ticket_priority_added')));
        return redirect('admin\helpdesk\tickets\priority');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $title     = trans('ticket.department');
        // $sub_title = trans('ticket.department');
        // $base      = trans('ticket.department');
        // $method    = trans('ticket.department');
        // $TicketDepartment = TicketDepartment::findOrFail($id);
        // return view('app.admin.helpdesk.tickets.department.show', compact('title', 'sub_title', 'base', 'method','TicketDepartment'));
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
        $ticket_priority = TicketPriority::whereId($id)->first();
        $ticket_priorities = TicketPriority::pluck('priority','status', 'id','priority_desc','priority_color','ispublic','is_default')->toArray();
        $title     = trans('kb.department_edit');
        $sub_title = trans('kb.department_edit');
        $base      = trans('kb.department_edit');
        $method    = trans('kb.department_edit');
        
        try {
            return view('app.admin.helpdesk.tickets.ticket_priority.edit',compact('title','sub_title','base','method','ticket_priority','ticket_priorities'));
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
    public function update($id, TicketsPriorityRequest $request)
    {       
        $ticket_priority = TicketPriority::where('id', $id)->first();   
        try {
            // dd($request->input());
            $ticket_priority->fill($request->input())->save();
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.priority_updated_successfully')));
            return redirect('admin/helpdesk/tickets/priority');          
        } catch (Exception $e) {           
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('ticket.priority_not_updated <li>'.$e->getMessage().'</li>')));
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
        $ticket_priority = TicketPriority::find($id);
        $ticket_priority->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Priority deleted succesfully'));
        return redirect()->back();
    }

    public function data(Request $request)
    {


        try {
            $ticket_priority = new TicketPriority();
            $ticket_priority = $ticket_priority->select('id', 'priority', 'priority_desc', 'priority_color', 'status', 'is_default', 'ispublic')->get();

             return Datatables::of($ticket_priority)
                            ->remove_column('id')
                            ->remove_column('created_at')                            
                            ->remove_column('is_default')
                            ->remove_column('ispublic')
                           
                            ->addColumn('priority_color', function ($model) {
                                return "<button class='btn' style = 'background-color:$model->priority_color'></button>";
                            })
                            ->editColumn('status', function ($model) {
                                if ($model->status == 1) {
                                    return "<a style='color:green'>active</a>";
                                } elseif ($model->status == 0) {
                                    TicketPriority::where('id', '=', '$id')
                                    ->update(['id' => '']);

                                    return "<a style='color:red'>inactive</a>";
                                }
                            })
                            ->addColumn('action', function ($model) {
                                if ($model->is_default > 0) {
                                    return "<a href='javascript:void(0)' class='btn btn-info btn-xs' disabled='disabled'>Edit</a>&nbsp;<a href='javascript:void(0)' class='btn btn-warning btn-info btn-xs' disabled='disabled' > delete </a>";
                                } else {
                                    return '<a href='.url('admin/helpdesk/tickets/priority/'.$model->id.'/edit')." class='btn btn-info btn-xs'>Edit</a>&nbsp;<a class='btn btn-danger btn-xs btn-delete-priority' data-id=".$model->id." >Delete </a>";
                                }
                            })
                            ->escapeColumns([])                           
                            ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }


    }
}
