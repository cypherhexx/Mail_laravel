<?php

namespace App\Http\Controllers\user\Helpdesk\Ticket;

use App\Http\Controllers\user\UserAdminController;
use App\Models\Helpdesk\Ticket\TicketType;
use App\Http\Requests\Admin\Helpdesk\Ticket\TicketsTypeRequest;
use Datatables;
use Illuminate\Http\Request;
use Validator;
use Session;

class TicketsTypeController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('ticket.ticket_types');
        $sub_title = trans('ticket.ticket_types');
        $base      = trans('ticket.ticket_types');
        $method    = trans('ticket.ticket_types');
        return view('app.admin.helpdesk.tickets.ticket_type.index', compact('title', 'sub_title', 'base', 'method'));
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
    public function store(TicketsTypeRequest $request)
    {
       


        $tk_type = new TicketType();
        $tk_type->name = $request->name;
        $tk_type->description = $request->description;
        $tk_type->status = $request->status;
        $tk_type->color = $request->color;
        $tk_type->ispublic = $request->ispublic;
        $tk_type->admin_note = $request->admin_note;
        $tk_type->save();

        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.new_ticket_type_added')));
        return redirect('admin\helpdesk\tickets\ticket-type');
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
        $ticket_type = TicketType::whereId($id)->first();
        $ticket_types = TicketType::pluck('id','name','description', 'status','color','ispublic','is_default','admin_note')->toArray();
        $title     = trans('ticket.edit_ticket_type');
        $sub_title = trans('ticket.edit_ticket_type');
        $base      = trans('ticket.edit_ticket_type');
        $method    = trans('ticket.edit_ticket_type');
        
        try {
            return view('app.admin.helpdesk.tickets.ticket_type.edit',compact('title','sub_title','base','method','ticket_type','ticket_types'));
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
    public function update($id, TicketsTypeRequest $request)
    {       
        $ticket_type = TicketType::where('id', $id)->first();   
        try {
            // dd($request->input());
            $ticket_type->fill($request->input())->save();
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.ticket_type_updated_successfully')));
            return redirect('admin/helpdesk/tickets/ticket-type');          
        } catch (Exception $e) {           
            Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('ticket.ticket_type_not_updated <li>'.$e->getMessage().'</li>')));
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
        $ticket_type = TicketType::find($id);
        $ticket_type->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Ticket type deleted succesfully'));
        return redirect()->back();
    }

    public function data(Request $request)
    {


        try {
            $ticket_type = new TicketType();
            $ticket_type = $ticket_type->select('id', 'name', 'description', 'status','color', 'is_default', 'ispublic','admin_note')->get();

             return Datatables::of($ticket_type)
                            ->remove_column('id')
                            ->remove_column('created_at')                            
                            ->remove_column('is_default')
                            ->remove_column('ispublic')
                            ->remove_column('color')
                            ->remove_column('admin_note')
                           
                            ->editColumn('name', function ($model) {
                               
                                    return "<button class='btn btn-xs' style='color:white;background-color:$model->color'>$model->name</button>";
                               
                            })
                            ->editColumn('status', function ($model) {
                                if ($model->status == 1) {
                                    return "<a style='color:green'>active</a>";
                                } elseif ($model->status == 0) {
                                    TicketType::where('id', '=', '$id')
                                    ->update(['id' => '']);

                                    return "<a style='color:red'>inactive</a>";
                                }
                            })
                            
                            ->addColumn('action', function ($model) {
                                if ($model->is_default > 0) {
                                    return "<a href='javascript:void(0)' class='btn btn-info btn-xs' disabled='disabled'>Edit</a>&nbsp;<a href='javascript:void(0)' class='btn btn-warning btn-info btn-xs' disabled='disabled' > delete </a>";
                                } else {
                                    return '<a href='.url('admin/helpdesk/tickets/ticket-type/'.$model->id.'/edit')." class='btn btn-info btn-xs'>Edit</a>&nbsp;<a class='btn btn-danger btn-xs btn-delete-ticket-type' data-id=".$model->id." >Delete </a>";
                                }
                            })
                            ->escapeColumns([])                           
                            ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }


    }
}
