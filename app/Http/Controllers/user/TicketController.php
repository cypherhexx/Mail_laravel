<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\user\UserAdminController;

use App\TicketCategory;

use App\TicketTags;

use App\Models\Helpdesk\Ticket\TicketStatus;

use App\TicketPriority;

use App\TicketFaq;

use App\CreateTicket;

use App\User;

use App\CommentTable;

use File;

use Input;

use Auth;

use Session;

use getClientOriginalExtension;

use Response;

use Validator;

use App\TicketReply;

use Redirect;


class TicketController extends UserAdminController
{

    public function view_ticket_configuration()
    {

            $title=trans('ticket.view_config');

            $ticket_categories=TicketCategory::all();

            $ticket_tags=TicketTags::all();

            $ticket_statuses=TicketStatus::all();

            $ticket_priority=TicketPriority::all();
                    
            return view('app.user.configuration.view_configuration',compact('ticket_categories','ticket_tags','ticket_statuses','ticket_priority','title'));

    }

    
    public function view_ticket_faq()
    {
       $title= trans('ticket.view_faq');

       $ticket_faq=TicketFaq::all();

       return view('app.user.configuration.view_ticket_faq',compact('title','ticket_faq'));
    }

    
    public function createTicket()
    {

        $title=trans('ticket.create_new_ticket');

        $ticket_tags=User::find(Auth::user()->id);

        $category = TicketCategory::all();

        $priority = TicketPriority::all();

        $tags = TicketTags::all();

        $status = TicketStatus::orderBy('id')->pluck('id');
        
        $id = User::where('id',Auth::user()->id)->pluck('id');

        $ticket_tag=(json_decode($ticket_tags->tags) == null) ? array() : json_decode($ticket_tags->tags);

        return view('app.user.ticket.create_ticket',compact('title','category','priority','tags','status','ticket_tag','id'));

    }

  public function  saveTicket(Request $request)
    {

    $ticket_new=new CreateTicket();

    $ticket_new->ticket_no = $this->getClientNumber();

    $ticket_new->subject=$request->ticket_subject;

    $ticket_new->user_id=$request->id;

    $ticket_new->description=$request->ticket_description;

    $ticket_new->category=$request->category;

    $ticket_new->priority=$request->priority;

    $ticket_new->status=$request->status;

    $ticket_new->tags=json_encode($request->tags);        

            $files = Input::file('savefile');

            $file_count = count($files);

        $filenamelist = [];

 
            $uploadcount = 0;

        foreach($files as $file){
              
                            $rules = array('savefile' => 'required'); 

                            $validator = Validator::make(array('savefile'=> $file), $rules);

                if($validator->passes()){
            
                                    $destinationPath = public_path().'/assets/uploads'; 

                                    $filenamelist[]=$filename = time() . '.' . $file->getClientOriginalName();

                                    $upload_success = $file->move($destinationPath, $filename);

                                    $uploadcount ++;

                                   

   


          }               

       } 
        $ticket_new->ticket_files = json_encode($filenamelist); 

    $ticket_new->save();

    
        
    Session::flash('flash_notification', array('level' => 'success','message' => trans('ticket.new_ticket_created')));

    return redirect('user\create_new_ticket');   
    
       

    } 


public function getClientNumber()
{
         do{
             $rand = $this->generateRandomString(6);
          }while(!empty(CreateTicket::where('ticket_no',$rand)->first()));
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

    public function  viewmyTicket()

      {

        $title= trans('ticket.view_my_ticket');

        $ticket=CreateTicket::join('ticket_statuses','ticket_statuses.id','=','ticket_new.status')

         ->join('ticket_priority','ticket_priority.id','=','ticket_new.priority')       

         ->select('ticket_new.ticket_no','ticket_new.subject','ticket_new.description','ticket_new.ticket_files','ticket_statuses.status','ticket_priority.priority','ticket_new.created_at','ticket_new.ticket_no')

         ->where('ticket_new.user_id',Auth::user()->id)    
 
         ->orderBy('created_at', 'asc')  

         ->get(); 


        return view('app.user.ticket.view_ticket',compact('title','ticket'));

      }   




    public function ticketReply($ticket_no)
    {

      $title= trans('ticket.reply_ticket');
        
      $ticket=CreateTicket::join('ticket_statuses','ticket_statuses.id','=','ticket_new.status')

      ->where('ticket_no',$ticket_no)

      ->select('ticket_new.ticket_no','ticket_new.subject','ticket_statuses.status','ticket_new.created_at','ticket_new.ticket_files')

      ->orderBy('created_at', 'asc')          

      ->first();

      $comment=CommentTable::select('id','comment','created_at','role')->where('ticket_no',$ticket_no);

      $reply=TicketReply::select('id','reply as comment','created_at','role')->where('ticket_num',$ticket_no);

      $comment =$comment->union($reply)->orderBy('created_at','ASC')->get();

      $id = User::where('id',Auth::user()->id)->pluck('id');
        
      return view('app.user.TicketReply.reply_ticket',compact('title','ticket','id','comment'));
        
    }

   
    public function saveticketReplied(Request $request)
    {
       

     $new_reply = new TicketReply();

     $new_reply->reply=$request->reply;

     $new_reply->user_id=$request->id;

     $new_reply->role='User';

     $new_reply->ticket_num=$request->ticket_no;

     $new_reply->save();

    Session::flash('flash_notification', array('level' => 'success','message' => trans('ticket.msg_send')));

     

    return Redirect::back();

    }

   
    public function destroy($id)
    {
      
    }
}
