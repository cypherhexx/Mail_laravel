@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')


<div class="col-sm-12">
	<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Update ticket type : {{$ticket_type->title}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

 {!! Form::model($ticket_type,['url' => '/admin/helpdesk/tickets/ticket-type/'.$ticket_type->id , 'method' => 'PATCH','class'=>'form-vertical tickettypeform ','data-parsley-validate'=>'true','role'=>'form'] )!!}

{{ csrf_field() }}
    <input type="hidden" name="type_id" value="{{$ticket_type->id}}">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">{{trans('ticket.edit')}}</h2>
        </div>
        <div class="box-body">
           
            <!-- Name text form Required -->
            <div class="box-body table-responsive no-padding"style="overflow:hidden;">
            <!-- <table class="table table-hover" style="overflow:hidden;"> -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            {!! Form::label('type',trans('ticket.type')) !!}<span class="text-red"> *</span>
                            <input type="text" class="form-control" name="name" value="{{ ($ticket_type->name) }}" >
                        </div>
                    </div>
                    <!-- Grace Period text form Required -->
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('type_desc') ? 'has-error' : '' }}">
                            {!! Form::label('type_desc',trans('ticket.type_desc')) !!} <span class="text-red"> *</span>
                            <input type="text" class="form-control" name="description" value="{{ ($ticket_type->description) }}">
                        </div>
                    </div></div>
                <!-- type Color -->
                <div class="row">
                   
                    <!-- status radio: required: Active|Dissable -->
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            {!! Form::label('status',trans('ticket.status')) !!}<span class="text-red"> *</span>
                            <input type="radio"  name="status" value="1" {{$ticket_type->status == '1' ? 'checked' : ''}}>{{trans('ticket.active')}}
                            <input type="radio"  name="status"  value="0" {{$ticket_type->status == '0' ? 'checked' : ''}}>{{trans('ticket.inactive')}}
                        </div>
                    </div>
                    <!-- Show radio: required: public|private -->
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('ispublic') ? 'has-error' : '' }}">
                            {!! Form::label('visibility',trans('ticket.visibility')) !!}&nbsp;<span class="text-red"> *</span>
                            <input type="radio"  name="ispublic" value="1" {{$ticket_type->ispublic == '1' ? 'checked' : ''}} >&nbsp;{{trans('ticket.public')}}
                            <input type="radio"  name="ispublic"  value="0" {{$ticket_type->ispublic == '0' ? 'checked' : ''}}>{{trans('ticket.private')}}
                        </div>       
                    </div>
                </div>  
                 <div class="row">
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                        {!! Form::label('color',trans('ticket.color')) !!}&nbsp;<span class="text-red"> *</span>
                        <input type="text"  name="color" value="{{$ticket_type->color}}" class="colorpicker-basic">
                    </div>       
                </div>
            </div>
                <!-- Admin Note : Textarea : -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('admin_note',trans('ticket.admin_notes')) !!}
                            {!! Form::textarea('admin_note',null,['class' => 'form-control','size' => '30x5']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <input type="checkbox" name="default_type" @if($ticket_type->is_default == $ticket_type->type_id) checked disabled @endif> {{ trans('ticket.make-default-type')}}
            </div>
            <div class="form-group">
            </div>
            {!! Form::submit(trans('ticket.update'),['class'=>'btn btn-primary'])!!}
        </div>
    </div>
    <!-- close form -->
    {!! Form::close() !!}

    </div>
</div>
</div>




@endsection @section('scripts') @endsection