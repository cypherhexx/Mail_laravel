@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


<div class="col-sm-12">
	<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Update canned response : {{$canned_response->title}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

 {!! Form::model($canned_response,['url' => '/admin/helpdesk/tickets/canned-response/'.$canned_response->id , 'method' => 'PATCH','class'=>'form-vertical cannedresponseform ','data-parsley-validate'=>'true','role'=>'form'] )!!}
    	
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="required form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                          {!! Form::label('title', trans("ticket.canned_response_title"), array('class' => 'control-label')) !!} 

                          {!! Form::text('title', Input::old('title'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.canned_response_title")]) !!}

                                            
                    </div>                    
                   <div class="required form-group{{ $errors->has('subject') ? ' has-error' : '' }}">

                          {!! Form::label('subject', trans("ticket.canned_response_subject"), array('class' => 'control-label')) !!} 

                          {!! Form::text('subject', Input::old('subject'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.canned_response_subject")]) !!}
                    
                    </div>                    
                    <div class="required form-group{{ $errors->has('message') ? ' has-error' : '' }}">

                         {!! Form::label('message', trans("ticket.canned_response_message"), array('class' => 'control-label')) !!} 

                          {!! Form::textarea('message', Input::old('message'), ['class' => 'form-control summernote','required' => 'required','data-parsley-required-message' => trans("all.canned_response_message")]) !!}
                   
                    </div>                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-canned-response"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.update_canned_response')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>




@endsection @section('scripts') @endsection