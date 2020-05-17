@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.admin.helpdesk.tickets.layout.sidebar') @endsection {{-- Content --}} @section('main') @if(app('request')->input('create') === 'true')
<div class="col-sm-12">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Create a ticket</h5>
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
            @endif {!! Form::open(array('action' => 'Admin\Helpdesk\Ticket\TicketsController@store' , 'method' => 'post','class'=>'form-vertical ticketform ','data-parsley-validate'=>'true','role'=>'form') )!!}
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
                            <input type="radio" class="styled" name="type" value="{{$type->id}}">&nbsp; {{$type->name}} 
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
                            <option data-color="{{$priority->priority_color}}" value="{{$priority->id}}">{{$priority->priority}} </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="required form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                    {!! Form::label('department', trans("ticket.department"), array('class' => 'control-label')) !!}
                    <select data-placeholder="Select a department..." class="select2 form-control" name="department" id="department" required="required" data-parsley-required-message="Please Select department">
                        <optgroup label="Departments">
                            @foreach($ticket_departments as $department)
                            <option data-color="{{$department->name}}" value="{{$department->id}}">{{$department->name}} </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="required form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    {!! Form::label('category', trans("ticket.category"), array('class' => 'control-label')) !!}
                    <select data-placeholder="Select a category..." class="select2 form-control" name="category" id="category" required="required" data-parsley-required-message="Please Select category">
                        <optgroup label="category">
                            @foreach($ticket_categories as $category)
                            <option data-color="{{$category->category}}" value="{{$category->id}}">{{$category->category}} </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                
                <div class="required form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {!! Form::label('status', trans("ticket.status"), array('class' => 'control-label')) !!}
                    <select data-placeholder="Select a status..." class="select2 form-control" name="status" id="status" required="required" data-parsley-required-message="Please Select status">
                        <optgroup label="status">
                            @foreach($ticket_statuses as $status)
                            <option data-color="{{$status->status}}" value="{{$status->id}}">{{$status->name}} </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary submit-ticket"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.create_ticket')}}</button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>
@endif
<!-- Basic datatable -->
<div class="col-sm-12">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">
            Tickets 

            @if(app('request')->input('overdue') === 'on')
				- Overdue items
            @endif

        </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-xs btn-primary text-white" id="filter" data-toggle="collapse" data-target="#filterticketpanel" title="Filter tickets"><i class="fa fa-filter"></i>&nbsp;</button> {!! $ticket_priorities->contains('priority',app('request')->input('priority')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-flag"></i> Priority:&nbsp;'.app('request')->input('priority').'</label>' : '' !!} {!! $ticket_statuses->contains('name',app('request')->input('status')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-check"></i> Status:&nbsp;'.app('request')->input('status').'</label>' : '' !!} {!! $ticket_categories->contains('category',app('request')->input('category')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-tags"></i> Category:&nbsp;'.app('request')->input('category').'</label>' : '' !!} {!! $ticket_departments->contains('name',app('request')->input('department')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-building-o"></i> Department :&nbsp;'.app('request')->input('department').'</label>' : '' !!}
            
            <div id="filterticketpanel" class="collapse">
                <div class="panel panel-flat border-top-info border-bottom-info">
                <div class="panel-body">
                    <form method="GET" action="{{url('admin/helpdesk/ticket')}}" accept-charset="UTF-8" class="form-horizontal" id="filter-form">
                        <input type="hidden" name="showtickets" value="showtickets">
                        <div class="row">
                            <div class="col-sm-3">
                                Department
                                <select class="select2 filter form-control" name="department" id="departments-filter">
                                    <option value="all" selected>All</option>
                                    @foreach($ticket_departments as $department)
                                    <option value="{{$department->name}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                Priority
                                <select class="select2 filter form-control" name="priority" id="priorities-filter">
                                    <option value="all" selected>All</option>
                                    @foreach($ticket_priorities as $priority)
                                    <option value="{{$priority->priority}}">{{$priority->priority}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                Status
                                <select class="select2 filter form-control" name="status" id="statuses-filter">
                                    <option value="all" selected>All</option>
                                    @foreach($ticket_statuses as $status)
                                    <option value="{{$status->name}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                Category
                                <select class="select2 filter form-control" name="category" id="categories-filter">
                                    <option value="all" selected>All</option>
                                    @foreach($ticket_categories as $category)
                                    <option value="{{$category->category}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                Ticket ID
                                <input class="form-control" id="ticket-number" name="ticket-number" />
                            </div>
                            <div class="col-sm-3">
                                Owner
                                <input type="text" class="form-control" id="key-word" name="key-word" placeholder="Search Member">
                                <input type="hidden" id="key_user_hidden" name="key_user_hidden">
                            </div>
                            <div class="col-sm-3">

                                <label for="overduechooser">Show only overdue items</label>
                                <input class="styled" id="overduechooser" type="checkbox" name="overdue">
                           
                            </div>
                        </div>
                        <br/>
                        <input id="apply-filter" class="btn btn-primary" type="submit" name="" value="Apply" onclick="removeEmptyValues()">
                        <input id="resetFilter" class="btn btn-default" type="reset" name="reset" value="Clear">
                    </form>
                </div>
                </div>
            </div>
            <table data-overdue="{{app('request')->input('overdue') ? app('request')->input('overdue') : 'false' }}" data-priority="{{app('request')->input('priority') ? app('request')->input('priority') : 'All' }}" data-department="{{app('request')->input('department') ? app('request')->input('department') : 'All' }}" data-category="{{app('request')->input('category') ? app('request')->input('category') : 'All' }}" data-status="{{app('request')->input('status') ? app('request')->input('status') : 'All' }}" data-deleted="{{app('request')->input('deleted') ? app('request')->input('deleted') : '' }}" class="table datatable-basic table-striped table-hover changestatuswrapper" id="ticket-table" data-search="false" >
                <thead>
                    <tr>
                        <th>
                            {{trans('tickets.ticket_number')}}
                        </th>
                        <th>
                            {{trans('tickets.ticket_from')}}
                        </th>
                        <th>
                            {{trans('tickets.subject')}}
                        </th>
                        <th>
                            {{trans('tickets.status')}}
                        </th>
                        <th>
                            {{trans('tickets.priority')}}
                        </th>
                        <th>
                            {{trans('tickets.department')}}
                        </th>
                        <th>
                            {{trans('tickets.actions')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection @section('scripts') @endsection