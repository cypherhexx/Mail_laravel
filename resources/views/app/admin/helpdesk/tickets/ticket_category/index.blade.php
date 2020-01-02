@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

<!-- Basic datatable -->
<div class="col-sm-8">
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Categories</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
    	
    
    
    	
    
    <table class="table datatable-basic table-striped table-hover" id="ticket-categories-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('ticket.category')}}
                    </th>           
                    <th>
                        {{trans('ticket.description')}}
                    </th>                                    
                    <th>
                        {{trans('ticket.actions')}}
                    </th>
                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

       

        </div>

    </div>
</div>
<div class="col-sm-4">
	<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Create category</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-vertical categoryform" role="form" method="POST" action="{{ URL::to('admin/helpdesk/tickets/category') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.category_name')}}</label>
                        <input type="text" class="form-control" name="category" required>                        
                    </div>                    
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.description')}}</label>
                        <input type="text" class="form-control" name="description" required>                 
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-category"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_category')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>
@endsection @section('scripts') @endsection