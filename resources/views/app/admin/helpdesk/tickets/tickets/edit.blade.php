@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.admin.helpdesk.tickets.layout.sidebar') @endsection {{-- Content --}} @section('main')
<div class="col-sm-12">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Edit ticket : <b>{{$ticket->ticket_number}}</b></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable">
            <i class="fa  fa-check-circle"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position: relative;margin-right: 10px;">&times;</button>
            {!!Session::get('success')!!} 
        </div>
        @endif



 {!! Form::model($ticket,['url' => '/admin/helpdesk/ticket/'.$ticket->id , 'method' => 'PATCH','class'=>'form-vertical ticketform ','data-parsley-validate'=>'true','role'=>'form'] )!!}

       

 	
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="col-sm-8">
            <div class="required form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                {!! Form::label('subject', trans("ticket.subject"), array('class' => 'control-label')) !!} {!! Form::text('subject', Input::old('subject'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.subject")]) !!}
            </div>          
            <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', trans("ticket.description"), array('class' => 'control-label')) !!} {!! Form::textarea('description', Input::old('description'), ['class' => 'form-control summernote','required' => 'required','data-parsley-required-message' => trans("ticket.description")]) !!}
            </div>
            <div class="required form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    {!! Form::label('type', trans("ticket.type"), array('class' => 'control-label')) !!}
                            <div class="">
                            @foreach($ticket_types as $type)
                            <input type="radio" class="styled" name="type" value="{{$type->id}}" {{ ($ticket->type == $type->id ? "checked":"") }}>&nbsp; {{$type->name}} 
                            @endforeach
                        </div>
                        
                </div>
			</div>
			<div class="col-sm-4">
            <div class="required form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                {!! Form::label('priority', trans("ticket.priority"), array('class' => 'control-label')) !!}
                <select data-placeholder="Select a priority..." class="select-priority form-control" name="priority" id="priority" required="required" data-parsley-required-message="Please Select priority">
                    <optgroup label="Priorities">
                        @foreach($ticket_priorities as $priority)
                        <option data-color="{{$priority->priority_color}}" value="{{$priority->id}}" {{ ($ticket->priority == $priority->id ? "selected":"") }} >{{$priority->priority}} </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <div class="required form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                {!! Form::label('department', trans("ticket.department"), array('class' => 'control-label')) !!}
                <select data-placeholder="Select a department..." class="select form-control" name="department" id="department" required="required" data-parsley-required-message="Please Select department">
                    <optgroup label="Departments">
                        @foreach($ticket_departments as $department)
                        <option data-color="{{$department->name}}" value="{{$department->id}}" {{ ($ticket->department == $department->id ? "selected":"") }} >{{$department->name}} </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <div class="required form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                {!! Form::label('category', trans("ticket.category"), array('class' => 'control-label')) !!}
                <select data-placeholder="Select a category..." class="select form-control" name="category" id="category" required="required" data-parsley-required-message="Please Select category">
                    <optgroup label="category">
                        @foreach($ticket_categories as $category)
                        <option data-color="{{$category->category}}" value="{{$category->id}}" {{ ($ticket->category == $category->id ? "selected":"") }} >{{$category->category}} </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>

            <div class="required form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status', trans("ticket.status"), array('class' => 'control-label')) !!}
                <select data-placeholder="Select a status..." class="select form-control" name="status" id="status" required="required" data-parsley-required-message="Please Select status">
                    <optgroup label="status">
                        @foreach($ticket_statuses as $status)
                        <option data-color="{{$status->status}}" value="{{$status->id}}" {{ ($ticket->status == $status->id ? "selected":"") }} >{{$status->name}} </option> 
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-ticket"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.edit_ticket')}}</button>
            </div>

            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>

@endsection @section('scripts') @endsection