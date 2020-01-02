@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.admin.helpdesk.tickets.layout.sidebar') @endsection {{-- Content --}} @section('main')

    <div class="panel panel-flat border-top-success">
        <div class="panel-heading">
            <h5 class="panel-title">Ticket ID : <b>{{$ticket->ticket_number}}</b></h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px;">
                    <li>
                        <a class="btn btn-xs btn-default" id="edit_Ticket" href="{{url('/admin/helpdesk/ticket/')}}/{{$ticket->id}}/edit"><i class="fa fa-edit" style="color:green;"> </i> Edit</a>
                    </li>
                  <!--   <li><a href="http://localhost:8000/ticket/print/4" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-print" > </i> Generate PDF</a></li> -->
                    <li class="changestatuswrapper">
                        {!!$ticket_status_markup!!}
                    </li>
                    <li>
                        <div id="more-option" class="btn-group">
                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" id="d2"><i class="fa fa-cogs" style="color:teal;"> </i> More <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li data-toggle="modal" data-target="#ChangeOwner"><a href="#"><i class="fa fa-users" style="color:green;"> </i>Change Owner</a></li>
                                <li id="delete"><a class="btn-delete-ticket" data-id="{{$ticket->id}}" href="javascript:void(0)"><i class="fa fa-trash-o" style="color:red;" > </i>Delete ticket</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <section>
                    <div class="col-md-12">
                        <div class="alert bg-indigo-800">
                            <div class="row">
                                <div class="col-md-3">
                                    <b>SLA plan: NIL </b>
                                </div>
                                <div class="col-md-3">
                                    <b>Created date: </b> {{$ticket->created_at}}
                                </div>
                                <div class="col-md-3">
                                    <b>Due date: </b> {{$ticket->created_at}}
                                </div>
                                <div class="col-md-3">
                                    <b>Last response: </b> {{$ticket->created_at}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="hide2">
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <div id="refresh">
                                    <tr>
                                        <td><b>Status:</b></td>
                                        <td title="{{$ticket->statusR->properties}}">{{$ticket->statusR->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Priority:</b></td>
                                        <td title="{{$ticket->priorityR->priority_desc}}">{{$ticket->priorityR->priority}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Department:</b></td>
                                        <td title="{{$ticket->departmentR->description}}">{{$ticket->departmentR->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td>{{$ticket->userR->email}}</td>
                                    </tr>
                                </div>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tr>
                                    <td><b>Category:</b></td>
                                    <td title="{{$ticket->categoryR->description}}">{{$ticket->categoryR->category}}</td>
                                </tr>
                                <tr>
                                    <td><b>Username:</b></td>
                                    <td title="{{$ticket->UserR->username}}">{{$ticket->UserR->username}}</td>
                                </tr>
                                <div id="refresh3">
                                    <tr>
                                        <td><b>Last message:</b></td>
                                        <td>{{$ticket->last_message_at->diffForHumans() }}</td>
                                    </tr>
                                </div>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <hr/>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-flat border-left-xlg border-left-info">
                        <div class="panel-heading">
                            <h6 class="panel-title"><span class="text-semibold">{{$ticket->subject}}</span></h6>
                        </div>
                        <div class="panel-body">
                            {!!$ticket->description!!}
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>

<div class="row">
<div class="col-sm-12">

     <div class="panel panel-flat border-left-xlg border-left-info">
                        <div class="panel-heading">
                            <h6 class="panel-title"><span class="text-semibold">Reply </span></h6>
                        </div>
                        <div class="panel-body">
                            {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsController@ticketReplyPost' , 'method' => 'post','class'=>'form-vertical ticketform ','data-parsley-validate'=>'true','role'=>'form') )!!}
                    
                     <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

                <div class="panel-body bg-primary required form-group{{ $errors->has('canned') ? ' has-error' : '' }}">
                    {!! Form::label('canned', trans("ticket.canned_reponses"), array('class' => 'control-label')) !!}
                    <select data-placeholder="You may choose a canned response..." class="select2 form-control" name="canned" id="cannedchooser" >
                        <optgroup label="Canned Responsed">
                            @foreach($ticket_canned_responses as $canned)
                                <option data-id="{{$canned->id}}" value="{{$canned->id}}">{{$canned->title}} 
                            </option>
                            @endforeach
                        </optgroup>
                    </select>
                    
                </div>
                <div class="mt-10 mb-10">                       
                         Variables you can use :  <span class="text-bold"> {name} </span> | <span class="text-bold"> {username}</span> | <span class="text-bold"> {email} </span>| <span class="text-bold"> {ticket_id} </span>
                    </div>

            <div class="required form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', trans("ticket.title"), array('class' => 'control-label')) !!} {!! Form::text('title', Input::old('title'), ['id'=>'ticket_title', 'class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.title")]) !!}
            </div>  

                <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('body', trans("ticket.reply"), array('class' => 'control-label')) !!} {!! Form::textarea('body', Input::old('body'), ['id'=>'ticket_body','class' => 'form-control summernote','required' => 'required','data-parsley-required-message' => trans("ticket.body")]) !!}
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-primary submit-ticket-reply"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.submit_reply')}}</button>
            </div>


                {!!Form::close()!!}
                        </div>
                    </div>


                
</div>
</div>
<div class="row">
<div class="col-sm-12">
           <div class="timeline timeline-left">
                                <div class="timeline-container">

                                    @foreach($ticket_replies as $reply)
                                        <div class="timeline-row">
                                        <div class="timeline-icon">
                                            <i class=" icon-radio-checked" style="font-size: 40px;color: #4baf4a;"></i>
                                        </div>
                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <h6 class="panel-title"> {{$reply->title}} : <small>{{$reply->userR->name}} ({{$reply->userR->username}})</small></h6>
                                                <div class="heading-elements">
                                                    <span class="heading-text"><i class="icon-history position-left text-success"></i> Updated {{$reply->created_at}}</span>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                {!! $reply->body !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    
                                    
                                  
                                </div>
                            </div>
</div>
</div>

<!-- page modals -->
<div>
    <!-- Change Owner Modal -->
    <div class="modal fade" id="ChangeOwner">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsController@changeOwner' , 'method' => 'PATCH','class'=>'form-vertical ticketform','id'=>'changeownerform','data-parsley-validate'=>'true','role'=>'form') )!!}
                <div class="modal-header">
                    <button type="button" class="close" id="close101" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change owner for ticket <b> {{$ticket->ticket_number}}</b></h4>
                </div>
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="ahah1">
                            <div class="modal-body">

                                <h3>Select new owner</h3>
                                <input type="hidden" name="ticketid" value="{{$ticket->id}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="key-word" name="key-word" placeholder="Search Member">
                                        <input type="hidden" id="key_user_hidden" name="key_user_hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="dismis42">Close</button>
                            <!--<input type='checkbox' name='send-mail' class='icheckbox_flat-blue' value='".$ticket->id."'><span disabled class="btn btn-sm">Check to notify user</span></input>-->
                            <button type="submit" class="btn btn-primary pull-right" id="submt2">Update</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
                <!--tab-content-->
            </div>
            <!--nav-tabs-custom-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
@endsection