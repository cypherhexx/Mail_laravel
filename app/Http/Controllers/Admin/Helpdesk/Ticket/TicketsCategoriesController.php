<?php

namespace App\Http\Controllers\Admin\Helpdesk\Ticket;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Helpdesk\Ticket\TicketCategory;
use App\Http\Requests\Admin\Helpdesk\Ticket\TicketCategoryRequest;
use Datatables;
use Illuminate\Http\Request;
use Validator;
use Session;

class TicketsCategoriesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket_categories = TicketCategory::all();
        $title     = trans('ticket.tickets');
        $sub_title = trans('ticket.tickets');
        $base      = trans('ticket.tickets');
        $method    = trans('ticket.tickets');
        return view('app.admin.helpdesk.tickets.ticket_category.index', compact('title', 'sub_title', 'base', 'method','ticket_categories'));
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
            'category' => 'bail|required|max:20|unique:ticket_categories,category',
            'description' => 'bail|required|max:20|unique:ticket_categories,description'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($validator);
        }

        $ticket_categories = new TicketCategory();
        $ticket_categories->category = $request->category;
        $ticket_categories->description = $request->description;
        $ticket_categories->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.ticket_categories_added')));
        // return redirect('admin\helpdesk\configuration');
         return redirect()->back();

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
        $TicketCategory = TicketCategory::findOrFail($id);
        return view('app.admin.helpdesk.tickets.ticket_category.show', compact('title', 'sub_title', 'base', 'method','TicketCategory'));
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
        $category = TicketCategory::whereId($id)->first();
        $categories = TicketCategory::pluck('category', 'id')->toArray();
        $title     = trans('ticket.edit_category');
        $sub_title = trans('ticket.edit_category');
        $base      = trans('ticket.edit_category');
        $method    = trans('ticket.edit_category');
        
        try {
            return view('app.admin.helpdesk.tickets.ticket_category.edit',compact('title','sub_title','base','method','category','categories'));
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
    public function update($id, TicketCategoryRequest $request)
    {



        $department = TicketCategory::where('id', $id)->first();
        $sl = $request->input('category');        
        try {
            
            $department->fill($request->input())->save();

              Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.category_updated_successfully')));

              return redirect('admin/helpdesk/tickets/category');

            


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
        $ticket_category = TicketCategory::find($id);
        $ticket_category->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Ticket category deleted succesfully'));
        return redirect()->back();
    }

    public function data(Request $request)
    {
        try {
            $category  = new TicketCategory();
            $categories = $category->select('id', 'category','description')->get();
            // dd($tickets);
            return Datatables::of($categories)
                ->remove_column('id')
                ->filterColumn('category', true)
                ->filterColumn('description', true)
                ->editColumn('name', function ($model) {
                    return $model->name;
                })->editColumn('description', function ($model) {
                    return $model->description;
                })
                ->addColumn('action', function ($model) {
                    return ' <a href="'.url('admin/helpdesk/ticket/?category='.$model->category).'" class="btn btn-success btn-info btn-xs btn-view-category" data-id="'.$model->id.'"> View tickets </a> &nbsp; <a href="'.url('admin/helpdesk/tickets/category/'.$model->id).'/edit" class="btn btn-success btn-info btn-xs btn-edit-category" data-id="'.$model->id.'"> Edit </a>
                                    &nbsp;
                                    <button class="btn btn-warning btn-info btn-xs btn-delete-category" data-id="'.$model->id.'"> delete </button>';
                })
                ->escapeColumns([])
                ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }
    }
}
