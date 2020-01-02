@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

<!-- Basic datatable -->
<div class="col-sm-12">
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Priorities</h5>
        <div class="heading-elements">
            <ul class="icons-list">                
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>    
    </div>
    <div class="panel-body">    
    <table class="table datatable-basic table-striped table-hover" id="ticket-priority-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('tickets.priority')}}
                    </th>           
                    <th>
                        {{trans('tickets.priority_desc')}}
                    </th>                                    
                    <th>
                        {{trans('tickets.priority_color')}}
                    </th>
                    <th>
                        {{trans('tickets.status')}}
                    </th>
                    <th>
                        {{trans('tickets.action')}}
                    </th>
                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

       

        </div>

    </div>
</div>
<div class="col-sm-12">
	<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Create priority</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

 {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsPriorityController@store' , 'method' => 'post','class'=>'form-vertical departmentsform ','data-parsley-validate'=>'true','role'=>'form') )!!}


            <!-- <table class="table table-hover" style="overflow:hidden;"> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('priority') ? 'has-error' : '' }}">
                        {!! Form::label('priority',trans('ticket.priority')) !!} <span class="text-red"> *</span>
                        <input type="text" class="form-control" name="priority" value="" >
                    </div>
                </div>
                <!-- Grace Period text form Required -->
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('priority_desc') ? 'has-error' : '' }}">
                        {!! Form::label('priority_desc',trans('ticket.priority_desc')) !!}<span class="text-red"> *</span>
                        <input type="text" name="priority_desc" class="form-control">
                    </div>
                </div> 
            </div>
            <!-- Priority Color -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('priority_color') ? 'has-error' : '' }}">
                        {!! Form::label('priority_color',trans('ticket.priority_color')) !!}<span class="text-red"> *</span>
                        <input class="form-control my-colorpicker1 colorpicker-element colorpicker-priority" id="colorpicker" type="text" name="priority_color">
                        

                    </div>
                </div>
                <!-- status radio: required: Active|Dissable -->
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        {!! Form::label('status',trans('ticket.status')) !!}&nbsp;<span class="text-red"> *</span>
                        <input class="styled" type="radio"  name="status" value="1" checked>&nbsp;{{trans('ticket.active')}}
                        <input class="styled" type="radio"  name="status" value="0" >&nbsp;{{trans('ticket.inactive')}}
                    </div>       
                </div>

                <!-- Show radio: required: public|private -->
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('ispublic') ? 'has-error' : '' }}">
                        {!! Form::label('ispublic',trans('ticket.visibility')) !!}&nbsp;<span class="text-red"> *</span>
                        <input class="styled" type="radio"  name="ispublic" value="1" checked>&nbsp;public
                        <input class="styled" type="radio"  name="ispublic" value="0" >&nbsp;private
                    </div>       
                </div>
            </div>  
            <!-- Admin Note  : Textarea :  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('admin_note',trans('ticket.admin_notes')) !!}
                        {!! Form::textarea('admin_note',null,['class' => 'form-control','size' => '30x5']) !!}
                    </div>
                </div>
            </div>
        
            {!! Form::submit(trans('ticket.submit'),['class'=>'btn btn-primary'])!!}
       

    <!-- close form -->
    {!! Form::close() !!}
    </div>
</div>
</div>
@endsection @section('scripts') @endsection