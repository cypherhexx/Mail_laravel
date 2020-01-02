@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.user.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


<div class="col-sm-12">
	<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Create canned response</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

 {!! Form::open(array('action' => 'user\Helpdesk\Ticket\TicketsCannedResponseController@store' , 'method' => 'post','class'=>'form-vertical cannedresponseform ','data-parsley-validate'=>'true','role'=>'form') )!!}

    	
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                  
                   <div class="required form-group{{ $errors->has('subject') ? ' has-error' : '' }}">

                          {!! Form::label('subject', trans("ticket.canned_response_subject"), array('class' => 'control-label')) !!} 

                          {!! Form::text('subject', Input::old('subject'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.canned_response_subject")]) !!}
                    
                    </div>                    
                    <div class="required form-group{{ $errors->has('message') ? ' has-error' : '' }}">

                         {!! Form::label('message', trans("ticket.canned_response_message"), array('class' => 'control-label')) !!} 

                          {!! Form::textarea('message', Input::old('message'), ['class' => 'form-control summernote','required' => 'required','data-parsley-required-message' => trans("all.canned_response_message")]) !!}
                   
                    </div>                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-canned-response"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_canned_response')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>

<!-- Basic datatable -->
<div class="col-sm-12">
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Canned Responses</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        
    
    
        
    <div class="table-responsive">
    <table class="table datatable-basic table-striped table-hover" id="ticket-canned-response-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('ticket_canned_response.title')}}
                    </th>           
                    <th>
                        {{trans('ticket_canned_response.subject')}}
                    </th>                         
                                                                  
                    <th>
                        {{trans('ticket_canned_response.actions')}}
                    </th>                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
       

        </div>

    </div>
</div>


@endsection @section('scripts') @endsection