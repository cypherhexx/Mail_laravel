<?php

namespace App\Http\Controllers\Admin\Marketing\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\AdminController;

use App\User;
use Auth;
use Validator;
use Session;
use Datatables;

use App\Models\Marketing\ContactsGroup;
use App\Models\Marketing\Contacts;

class ContactsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $title     = trans('contact.contact');
        $sub_title = trans("contact.view_and_manage_contact");
        $base   = trans('contact.contact');
        $method = trans("contact.view_and_manage_contact");
        
        return view('app.admin.campaign.contact.contact', compact('title', 'sub_title', 'base', 'method'));
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
         
          $validator =Validator::make($request->all(),[
            'firstname' => 'bail|required',           
            'lastname' => 'bail|required',           
            'email' => 'bail|required|email|unique:email_marketing_contacts',           
            'mobile' => 'bail|sometimes|unique:email_marketing_contacts',           
            'address' => 'bail|sometimes',           
            'id' => 'bail|exists:email_marketing_contacts_group,id',           
        ]);

           if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
         }else{   
            Contacts::create([
                'email'=>$request->email,
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'address'=>$request->lastname,
                'mobile'=>$request->mobile,
                'group_id'=>$request->id,
            ]);

               Session::flash('flash_notification', array('level' => 'success', 'message' => 'Contact created '));
            

            return redirect()->back()->withSuccess('Contacts added');
         }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function creategruop(Request $request)
    {	

    	 $validator =Validator::make($request->all(),[
            'name' => 'bail|required',           
            'description' => 'bail|required',         
                      
        ]);
    	 if ($validator->fails()) {
    	 	$errors = $validator->errors();
    	 	return redirect()->back()->withInput()->withErrors($validator);
    	 }else{         
    	 	ContactsGroup::create([
    	 		'name'=>$request->name,
    	 		'description'=>$request->description,
    	 	]);

    	 	Session::flash('flash_notification', array('level' => 'success', 'message' => 'Contacts Group created '));
    	 	return redirect()->back();
    	 }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title     = trans('contact.contact');
        $sub_title = trans("contact.view_and_manage_contact");
        $base   = trans('contact.contact');
        $method = trans("contact.view_and_manage_contact");   
        $contactgroup = ContactsGroup::findOrFail($id);      
        return view('app.admin.campaign.contact.contactlist', compact('title', 'sub_title', 'base', 'method','id','contactgroup'));
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

    public function editgruop($id)
    {	
    	$title     = trans('contact.contact_group');
        $sub_title = trans("contact.edit_contact_group");
        $base   = trans('contact.contact_group');
        $method = trans("contact.edit_contact_group");
        $contactsgroup = ContactsGroup::findOrFail($id);

        return view('app.admin.campaign.contact.editcontactgroup', compact('title', 'sub_title', 'base', 'method','contactsgroup'));
    }


     public function destroygruop($id)
    {
        $contacts = ContactsGroup::findOrFail($id);
        $contacts->delete();

        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Contacts Group deleted '));
    	return redirect('admin/campaign/contacts');


    }
    public function savegruop(Request $request ,  $id)
    {
    	 $validator =Validator::make($request->all(),[
            'name' => 'bail|required',           
            'description' => 'bail|required',         
                      
        ]);
    	 if ($validator->fails()) {
    	 	$errors = $validator->errors();
    	 	return redirect()->back()->withInput()->withErrors($validator);
    	 }else{ 

		        $contacts = ContactsGroup::findOrFail($id);
		        $contacts->name = $request->name; 
		        $contacts->description = $request->description;
		        $contacts->save();

		        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Contacts Group updated '));
		    	return redirect('admin/campaign/contacts');

    	 }  



    }


    public function datagruop(Request $request)
    {

        try {
            $category  = new ContactsGroup();
            $categories = $category->select('id', 'name','description')->get();
            // dd($tickets);
            return Datatables::of($categories)
                ->remove_column('id')
                ->filterColumn('name', true)
                ->filterColumn('description', true)
                ->editColumn('name', function ($model) {
                    return $model->name;
                })->editColumn('description', function ($model) {
                    return $model->description;
                })
                ->addColumn('action', function ($model) {
                    return ' <a href="'.url('admin/campaign/contacts/'.$model->id).'" class="btn btn-success btn-info btn-xs btn-view-category" data-id="'.$model->id.'"> View  </a> &nbsp; <a href="'.url('admin/campaign/contacts/'.$model->id."/editgruop/").'" class="btn btn-success btn-info btn-xs btn-edit-category" data-id="'.$model->id.'"> Edit </a>
                                    &nbsp;
                                    <button class="btn btn-warning btn-info btn-xs btn-delete-contactgroup" data-id="'.$model->id.'"> delete </button>';
                })
                ->escapeColumns([])
                ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }
    }

    public function data(Request $request,$group)
    {


        try {
            $category  = new Contacts();
            $categories = $category->where('group_id','=',$group)->select('firstname','lastname','email','mobile','address','created_at')->get();
            // dd($tickets);
            return Datatables::of($categories)
                ->remove_column('id')
                ->filterColumn('firstname', true)
                ->filterColumn('lastname', true)
                ->filterColumn('mobile', true)
                ->filterColumn('email', true)
                ->editColumn('firstname', function ($model) {
                    return $model->firstname;
                })
                ->addColumn('action', function ($model) {
                    return ' &nbsp; <a href="'.url('admin/campaign/contacts/'.$model->id."/editgruop/").'" class="btn btn-success btn-info btn-xs btn-edit-category" data-id="'.$model->id.'"> Edit </a>
                                    &nbsp;
                                    <button class="btn btn-warning btn-info btn-xs btn-delete-contactgroup" data-id="'.$model->id.'"> delete </button>';
                })
                ->escapeColumns([])
                ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }
    }
}
