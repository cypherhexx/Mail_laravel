<?php namespace App\Http\Controllers\user\Helpdesk\Ticket;

use App\Models\Helpdesk\Ticket\Ticket;
use App\Http\Controllers\user\UserAdminController;
use App\Models\Helpdesk\Ticket\TicketPriority;
use App\Models\Helpdesk\Ticket\TicketDepartment;
use App\Models\Helpdesk\Ticket\TicketCategory;
use App\Models\Helpdesk\Ticket\TicketStatus;
use App\Models\Helpdesk\Ticket\TicketCannedResponse;
use App\Models\Helpdesk\Ticket\TicketType;
use App\TicketReply;
use App\TicketTags;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Input;
use Validator;
use Carbon;
use Datatables;
use App\Http\Requests\Admin\Helpdesk\Ticket\TicketRequest;

class TicketsController extends UserAdminController
{
    public function dashboard()
    {
        $title       = trans('ticket_details.help_desk');
        $sub_title   = trans('ticket_details.tickets_dashboard');
        $base        = trans('ticket_details.help_desk');
        $method      = trans('ticket_details.tickets_dashboard');
        $total       = DB::table('tickets')->count();
        $ticket_tags = User::find(Auth::id());
        $category    = TicketCategory::all();
        $priority    = TicketPriority::all();
        $tags        = TicketTags::all();
        $status      = TicketStatus::orderBy('id')->value('id');
        $id          = User::where('id', Auth::id())->value('id');
        $ticket_tag  = (json_decode($ticket_tags->tags) == null) ? array() : json_decode($ticket_tags->tags);
        $id          = User::where('id', Auth::id())->value('id');
        $ticket_join = DB::table('tickets')
            ->Join('ticket_priorities', 'tickets.id', '=', 'ticket_priorities.id')
            ->join('ticket_categories', 'tickets.category', '=', 'ticket_categories.id')
            ->join('ticket_statuses', 'tickets.status', '=', 'ticket_statuses.id')
            ->orderBy('tickets.created_at', 'desc')
            ->take(3)
            ->get();
        $category_count = TicketCategory::join('tickets', 'tickets.category', '=', 'ticket_categories.id')
            ->select('ticket_categories.category as label', DB::raw('COUNT( tickets.category) as value'))
            ->groupBy('tickets.category')
            ->get();
        $category_count = json_encode($category_count);
        $reply          = Ticket::select('created_at')->get();
        $ticket_graph   = [];
        for ($i = 11; $i > 0; $i--) {
            $date           = date('Y-m-d', strtotime(" -$i days"));
            $ticket_count   = Ticket::where('created_at', 'like', $date . '%')->count();
            $reply_count    = Ticket::where('created_at', 'like', $date . '%')->count();
            $ticket_graph[] = array('date' => $date, 'ticket_count' => $ticket_count, 'reply_count' => $reply_count);
        }
        return view('app.user.helpdesk.tickets.dashboard',
            compact('title',
                'sub_title',
                'base',
                'method',
                'total',
                'category',
                'status',
                'tag',
                'ticket_join',
                'tickets_no',
                'category_count',
                'value',
                'ticket_graph',
                'priority',
                'tags',
                'status',
                'ticket_tag',
                'id'));
    }

    public function index()
    {
        $title     = trans('ticket_details.tickets');
        $sub_title = trans('ticket_details.tickets');
        $base      = trans('ticket_details.tickets');
        $method    = trans('ticket_details.tickets');
           $ticket_priorities = TicketPriority::all();
           $ticket_departments = TicketDepartment::all();
           $ticket_categories = TicketCategory::all();
           $ticket_types = TicketType::all();
           $ticket_statuses = TicketStatus::all();

        return view('app.user.helpdesk.tickets.tickets.index', compact('title', 'sub_title', 'base', 'method','ticket_priorities','ticket_departments','ticket_categories','ticket_statuses','ticket_types'));
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           $model = Ticket::where('user_id','=',Auth::user()->id)->findOrFail($id);
           $ticket_user = User::findOrFail($model->user_id);
           $ticket_user_card = User::hoverCard($model->user_id);
           $ticket_priorities = TicketPriority::all();
           $ticket_departments = TicketDepartment::all();
           $ticket_categories = TicketCategory::all();
           $ticket_statuses = TicketStatus::all();
           $ticket_canned_responses = TicketCannedResponse::all();

           $ticket_replies = TicketReply::select('id','user_id', 'title','body', 'created_at')
            ->where('ticket_id', $id)
            ->orderBy('created_at', 'ASC')
            ->with('userR')
            ->get();


              //     $reply = TicketReply::select('id', 'reply as comment', 'created_at', 'role')
    //         ->where('ticket_num', $ticket_number);
    //     $comment = $comment->union($reply)
    //         ->orderBy('created_at', 'ASC')
    //         ->get();
    //         
           $ticket_status_markup =  $this->getStatusMarkup($model);

        /* get the atributes of the category model whose id == $id */
        $ticket = Ticket::whereId($id)->with('statusR','priorityR','categoryR','departmentR','userR')->first();
        $tickets = $ticket->pluck('id','subject','description','priority','department','category','status')->toArray();
        $title     = trans('ticket.edit_ticket');
        $sub_title = trans('ticket.edit_ticket');
        $base      = trans('ticket.edit_ticket');
        $method    = trans('ticket.edit_ticket');
        
        try {
            return view('app.user.helpdesk.tickets.tickets.show',compact('title','sub_title','base','method','ticket','tickets','ticket_priorities','ticket_departments','ticket_categories','ticket_statuses','ticket_status_markup','ticket_user','ticket_user_card','ticket_canned_responses','ticket_replies'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }

    }


    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
       // dd($id);
           $ticket_priorities = TicketPriority::all();
           $ticket_departments = TicketDepartment::all();
           $ticket_categories = TicketCategory::all();
           $ticket_statuses = TicketStatus::all();
           $ticket_types = TicketType::all();

        /* get the atributes of the category model whose id == $id */
        $ticket = Ticket::whereId($id)->first();
       
        $tickets = $ticket->pluck('id','subject','description','priority','type','department','category','status')->toArray();
        $title     = trans('ticket.edit_ticket');
        $sub_title = trans('ticket.edit_ticket');
        $base      = trans('ticket.edit_ticket');
        $method    = trans('ticket.edit_ticket');
        
        try {
            return view('app.user.helpdesk.tickets.tickets.edit',compact('title','sub_title','base','method','ticket','tickets','ticket_priorities','ticket_departments','ticket_categories','ticket_statuses','ticket_types'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'subject' => 'bail|required|max:60000|unique:tickets,subject',           
            'description' => 'bail|required|max:60000|unique:tickets,description',           
            'priority' => 'bail|required',           
            'department' => 'bail|required',           
            'category' => 'bail|required',           
            'type' => '',           
            'status' => 'bail|required',           
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $ticket = new Ticket();
        // dd($request);

        $ticket->subject = $request->subject;        
        $ticket->description = $request->description;        
        $ticket->priority = $request->priority;        
        $ticket->department = $request->department;        
        $ticket->category = $request->category;        
        $ticket->status = $request->status;        
        $ticket->type = $request->type;        


        $ticket->ticket_number =  $this->generateTicketCode();    
        $ticket->user_id = Auth::id();        
        $ticket->ip_address = $request->ip();        
        $ticket->last_message_at = Carbon::now();




        $ticket->save(); 

         return Redirect::back()->with('success', trans('ticket.ticket_has_been_created_successfully_your_ticket_number_is').' <b>'.$ticket->ticket_number.'. </b>'.trans('ticket.please_save_this_for_future_reference'));




    }


   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, TicketRequest $request)
    {



        $ticket = Ticket::where('id', $id)->first();
        $sl = $request->input('name');        
        try {
            
            $ticket->fill($request->input())->save();

              Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.ticket_updated_successfully')));

              return redirect('user/helpdesk/ticket');

            


        } catch (Exception $e) {
           
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.ticket_not_updated <li>'.$e->getMessage().'</li>')));

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
        $ticket = Ticket::find($id);
        $ticket->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => 'Ticket deleted succesfully'));
        return redirect('user/helpdesk/ticket');
    }



 public function data(Request $request)
    {


        try {

            
            
            $ticket  = new Ticket();
            $query = NULL;

            $priority = NULL;            
            $department = NULL;            
            $category = NULL;            
            $status = NULL;            
            
           
            $tickets = $ticket->select('id','ticket_number','user_id', 'subject','status','priority','department','category');    

            $tickets->where('user_id',Auth::user()->id);                   

          
            if($request->input('priority')){
                if(TicketPriority::where('priority',$request->input('priority'))){
                    $priority = TicketPriority::where('priority',$request->input('priority'))->value('id');
                    if($priority){
                        $tickets->where('priority',$priority);                   
                    }
                }
            }
          
            if($request->input('department')){
                if(TicketDepartment::where('name',$request->input('department'))){
                    $department = TicketDepartment::where('name',$request->input('department'))->value('id');
                    if($department){
                        $tickets->where('department',$department);                   
                    }
                }
            }

          
            if($request->input('category')){
                if(TicketCategory::where('category',$request->input('category'))){
                    $category = TicketCategory::where('category',$request->input('category'))->value('id');
                    if($category){
                        $tickets->where('category',$category);           
                    }        
                }
            }


            if($request->input('status')){
                if(TicketStatus::where('name',$request->input('status'))){
                    $status = TicketStatus::where('name',$request->input('status'))->value('id');
                    if($status){
                        $tickets->where('status',$status);      
                    }             
                }
            }

            
            if($request->input('overdue') == 'on'){
                 $expDate = Carbon::now()->subDays(6);
                 $tickets->whereDate('created_at', '<',$expDate); 
            }

            
            
            if($request->input('deleted') == 'on'){                 
                 $tickets->withTrashed();
                 $tickets->whereNotNull('deleted_at');
            }

            
            $tickets->get();
            


            
            return Datatables::of($tickets)
                ->remove_column('id')
                ->remove_column('category')
                ->editColumn('description', function ($model) {
                    return '<span class="table-element-editable department" data-type="text" data-url=' . url("admin/helpdesk/tickets/departments/update") . ' data-pk="' . $model->id . '" data-title="Enter department description" data-name="description">' . $model->description . '</span>';
                })     
                ->editColumn('ticket_number', function ($model) {                  
                    if(!$model->type === null){    
                        dd('aa');                    
                        return 'XXXXX<span><span class="label label-success">Success</span>' . $model->ticket_number . '</span>';
                    }else{
                        return '<span>' . $model->ticket_number . '</span>';
                    }
                })                
                ->editColumn('status', function ($model) {
                    
                    return $this->getStatusMarkup($model);

                    
                })                
                ->editColumn('priority', function ($model) {
                  

                  
                    $selected_priority = TicketPriority::where('id',$model->priority)->value('priority');
                    $selected_priority_color = TicketPriority::where('id',$model->priority)->value('priority_color');
                    


                    $markup = '<div class="btn-group heading-btn prioritydropbtn">
                        <button class="priorityname btn-xs btn" style="color:white;background:'.$selected_priority_color.'">'.$selected_priority.'</button>
                        
                        
                    </div>';
                    return $markup;



                    // return '<button class="btn" style="background:'.$priority_color.'"></button> &nbsp; '.$priority;
                })                
                ->editColumn('department', function ($model) {
                    return TicketDepartment::where('id',$model->department)->value('name');
                })                
                ->editColumn('user_id', function ($model) {
                    return User::where('id',$model->user_id)->value('name');
                })
                ->addColumn('action', function ($model) {
                    return ' <a href="'.url('user/helpdesk/ticket/'.$model->id).'" class="btn btn-success btn-info btn-xs btn-view-ticket" data-id="'.$model->id.'"> View </a> ';
                })
                ->escapeColumns([])
                ->make();
        } catch (Exception $ex) {
            return redirect()->back()->with('fails', $ex->getMessage());
        }
    }


public function getStatusMarkup($model){

                    $model = $model;

                
                    $selected_status = TicketStatus::where('id',$model->status)->value('name');
                    $buttoncolor = 'btn-success';
                       if($selected_status == 'Open'){ $buttoncolor = 'btn-danger'; }
                       if($selected_status == 'Resolved'){ $buttoncolor = 'btn-success';  }
                       if($selected_status == 'Closed'){ $buttoncolor = 'btn-grey';  }
                       if($selected_status == 'Archived'){ $buttoncolor = 'btn-grey';  }
                       if($selected_status == 'Deleted'){ $buttoncolor = 'btn-grey';  }
                       if($selected_status == 'Unverified Status'){ $buttoncolor = 'btn-danger';  }
                  

                    $markup = '<div class="btn-group statusdropbtn changestatus">
                        <button class="statusname btn-xs btn '.$buttoncolor.'">'.$selected_status.'</button>
                         
                       
                    </div>';
                    return $markup;

}
    /**
     * function to change the status of the ticket.
     *
     * @param type $status
     * @param type $id
     *
     * @return string
     */
    public function changeStatus(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ticketid' => 'bail|required|exists:tickets,id',           
            'statusid' => 'bail|required|exists:ticket_statuses,id',           
               
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
        // dd($request);


        $id = $request->ticketid;
        $status = $request->statusid;
        $ticket = Ticket::where('id', '=', $id)->first();
        $old_status = Ticket::where('id', '=', $id)->value('status');
        $old_status_state = TicketStatus::where('id', '=', $old_status)->value('state');

        $ticket->status = $status;
        $ticket_status = TicketStatus::where('id', '=', $status)->first();

        if ($ticket_status->state == 'closed') {
            $ticket->closed = $ticket_status->id;
            $ticket->closed_at = date('Y-m-d H:i:s');
            $ticket->reopened = '0';
            $ticket->reopened_at = NULL;
        }

        
        if ($old_status_state == 'closed' && $ticket_status->state == 'open') {
            $ticket->reopened = $ticket_status->id;
            $ticket->reopened_at = date('Y-m-d H:i:s');
        }

        $ticket->save();
        return;

 
    }


   /**
     * function to change the priority of the ticket.
     *
     * @param type $priority
     * @param type $id
     *
     * @return string
     */
    public function changePriority(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticketid' => 'bail|required|exists:tickets,id',           
            'priorityid' => 'bail|required|exists:ticket_priorities,id',           
               
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        // dd($request);


        $id = $request->ticketid;
        $priority = $request->priorityid;
        $ticket = Ticket::where('id', '=', $id)->first();
        $ticket->priority = $priority;
        $ticket->save();
        return;

 
    }



   /**
     * function to change the changeOwner  of the ticket.
     *
     * @param type $changeOwner 
     * @param type $id
     *
     * @return string
     */
    public function changeOwner(Request $request)
    {

        // dd($request->key_user_hidden);
        $validator = Validator::make($request->all(), [
            'ticketid' => 'bail|required|exists:tickets,id',           
            'key_user_hidden' => 'bail|required|exists:users,username',           
               
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }
        $id = $request->ticketid;
        $user_id = $request->key_user_hidden;
        $ticket = Ticket::where('id', '=', $id)->first();
        $user_id = User::where('username', '=',  $request->key_user_hidden)->value('id');
        $ticket->user_id = $user_id;
        $ticket->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket.ticket_owner_changed_to '.$request->key_user_hidden.'')));

        return redirect()->back();

    }


 
     

    public function ticketReplyPost(Request $request)
    {


        // dd($request->key_user_hidden);
        $validator = Validator::make($request->all(), [
            'ticket_id' => 'bail|required|exists:tickets,id',                                      
            'title' => 'bail|required',
            'body' => 'bail|required',
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $savereply            = new TicketReply();
        $savereply->user_id = Auth::id();
        $savereply->ticket_id = $request->ticket_id;

        $afterTitle = $this->replyFormatter($request->ticket_id,$request->title);
        $savereply->title   = $afterTitle;

        $afterBody = $this->replyFormatter($request->ticket_id,$request->body);

        $savereply->body = $afterBody;
        $savereply->save();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_details.replied_ticket')));
        return Redirect::back();
    }

    public function replyFormatter($ticketid,$body){
        
        $ticket_id = Ticket::where('id',$ticketid)->value('ticket_number');
        $user_id = Ticket::where('id',$ticketid)->value('user_id');
        $name = User::where('id',$user_id)->value('name');
        $username = User::where('id',$user_id)->value('username');
        $email  = User::where('id',$user_id)->value('email');

        $beforeStr = $body;

        preg_match_all('/{(\w+)}/', $beforeStr, $matches);
        $afterStr = $beforeStr;
        foreach ($matches[0] as $index => $var_name) {
          if (isset(${$matches[1][$index]})) {
            $afterStr = str_replace($var_name, ${$matches[1][$index]}, $afterStr);
          }
        }

        return $afterStr;
    }

 

public function generateTicketCode()
{
         do{
             $rand = $this->generateTicketCodeString();
          }while(!empty(Ticket::where('ticket_number',$rand)->first()));
           return $rand;
        }


    public function generateRandomString($length) 
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
     }


public function generateTicketCodeString(){

    $unique =   FALSE;
    $length =   7;
    $chrDb  =   array('0','1','2','3','4','5','6','7','8','9');

    while (!$unique){

          $str = '';
          for ($count = 0; $count < $length; $count++){

              $chr = $chrDb[rand(0,count($chrDb)-1)];

              if (rand(0,1) == 0){
                 $chr = strtolower($chr);
              }
              if (3 == $count){
                 $str .= '-';
              }
              $str .= $chr;
          }

          /* check if unique */
          $existingCode = Ticket::where('ticket_number',$str)->first();
          if (!$existingCode){
             $unique = TRUE;
          }
    }
    return $str;
}




}
