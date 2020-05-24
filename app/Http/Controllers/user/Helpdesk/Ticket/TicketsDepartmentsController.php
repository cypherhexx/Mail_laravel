<?php

namespace App\Http\Controllers\user\Helpdesk\Ticket;

use App\Http\Controllers\user\UserAdminController;
use App\Models\Helpdesk\Ticket\TicketDepartment;
use App\Http\Requests\Admin\Helpdesk\Ticket\TicketDepartmentRequest;
use Datatables;
use Illuminate\Http\Request;
use Validator;
use Session;

class TicketsDepartmentsController extends UserAdminController
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
        return view('app.admin.helpdesk.tickets.department.index', compact('title', 'sub_title', 'base', 'method'));
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
            'name' => 'bail|required|max:20|unique:ticket_departments,name',           
            'description' => 'bail|required|max:20|unique:ticket_departments,description',           
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $ticket_department = new TicketDepartment();
        
        if($ticket_department->count() >= 5 ){
            Session::flash('flash_notification', array('overlay'=>'true','title' => 'Sorry!','level' => 'warning', 'message' => trans('ticket.sorry_but_maximum_5_departments_allowed')));
            return redirect('admin\helpdesk\tickets\department')->withInput();
        }

        $ticket_department->name = $request->name;        
        $ticket_department->description = $request->description;        
        $ticket_department->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.ticket_department_added')));
        return redirect('admin\helpdesk\tickets\department');
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
        $department = TicketDepartment::whereId($id)->first();
        $departments = TicketDepartment::pluck('name', 'id')->toArray();
        $title     = trans('kb.department_edit');
        $sub_title = trans('kb.department_edit');
        $base      = trans('kb.department_edit');
        $method    = trans('kb.department_edit');
        
        try {
            return view('app.admin.helpdesk.tickets.department.edit',compact('title','sub_title','base','method','department','departments'));
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
    public function update($id, TicketDepartmentRequest $request)
    {



        $department = TicketDepartment::where('id', $id)->first();
        $sl = $request->input('name');        
        try {
            
            $department->fill($request->input())->save();

              Session::flash('flash_notification', array('level' => 'success', 'message' => trans('kb.department_updated_successfully')));

              return redirect('admin/helpdesk/tickets/department');

            


        } catch (Exception $e) {
           
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('kb.department_not_updated <li>'.$e->getMessage().'</li>')));

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
        $ticket_department = TicketDepartment::find($id);
        $ticket_department->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Department deleted succesfully'));
        return redirect()->back();
    }

    public function data(Request $request)
    {
        try {
            $ticket  = new TicketDepartment();
            $tickets = $ticket->select('id', 'name','description')->get();
            // dd($tickets);
            return Datatables::of($tickets)
                ->remove_column('id')
                ->filterColumn('name', true)
                ->filterColumn('description', true)
                ->editColumn('name', function ($model) {
                    return '<span class="table-element-editable department" data-type="text" data-url=' . url("admin/helpdesk/tickets/departments/update") . ' data-pk="' . $model->id . '" data-title="Enter department name" data-name="name">' . $model->name . '</span>';
                })->editColumn('description', function ($model) {
                    return '<span class="table-element-editable department" data-type="text" data-url=' . url("admin/helpdesk/tickets/departments/update") . ' data-pk="' . $model->id . '" data-title="Enter department description" data-name="description">' . $model->description . '</span>';
                })
                ->addColumn('action', function ($model) {
                    return ' <a href="'.url('admin/helpdesk/ticket/?department='.$model->name).'" class="btn btn-success btn-info btn-xs btn-view-department" data-id="'.$model->id.'"> View tickets </a> &nbsp; <a href="'.url('admin/helpdesk/tickets/department/'.$model->id).'/edit" class="btn btn-success btn-info btn-xs btn-edit-department" data-id="'.$model->id.'"> Edit </a>
                                    &nbsp;
                                    <button class="btn btn-warning btn-info btn-xs btn-delete-department" data-id="'.$model->id.'"> delete </button>';
                })
                ->escapeColumns([])
                ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }
    }
}
