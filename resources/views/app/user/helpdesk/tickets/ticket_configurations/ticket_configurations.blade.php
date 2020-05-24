@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.admin.tickets.layout.sidebar') @endsection {{-- Content --}} @section('main')
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-flat  border-left-info border-right-info" id="ticket-categories">
            <div class="panel-heading">
                <h4 class="panel-title text-semibold color-green">{{trans('ticket_config.ticket_categories')}}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h4>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="categories" class="table table-striped table-lg table-xxs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('ticket_config.category')}}</th>
                                <th>{{trans('ticket_config.description')}}</th>
                                <th><i class="icon-menu7"></i> {{trans('ticket_config.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ticket_categories as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td><span class="label label-flat"><a class="category" data-type='text' data-url='{{url("admin/update_ticket_category")}}' data-pk="{{$data->id}}" data-title="Enter category" data-name="category">{{$data->category}} </a></span></td>

                                <td><span class="label label-flat"><a class="category" data-type='text' data-url='{{url("admin/update_ticket_category")}}' data-pk="{{$data->id}}" data-title="Enter category" data-name="description">{{$data->description}} </a></span></td>

                                <td>
                                    <ul class="icons-list">
                                        <li><a class="btn-delete-category" data-id="{{$data->id}}"><i class="icon-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr/>


                <form class="form-vertical categoryform" role="form" method="POST" action="{{ URL::to('admin/post_ticket_category') }}">
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
    <div class="col-sm-6">
              <div class="panel panel-flat  border-left-info border-right-info" id="ticket-tags">
            <div class="panel-heading">
                <h4 class="panel-title text-semibold color-green">{{trans('ticket_config.tags')}}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h4>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-xxs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('ticket_config.tag')}}</th>
                                <th>{{trans('ticket_config.description')}}</th>
                                <th><i class="icon-menu7"></i> {{trans('ticket_config.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ticket_tags as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td><span class="label label-flat"><a class="tag" data-type='text' data-url='{{url("admin/save_ticket_tags")}}' data-pk="{{$data->id}}" data-title="Enter tags" data-name="tags_level">{{$data->tags}} </a></span></td>
                                <td><span class="label label-flat"><a class="tag" data-type='text' data-url='{{url("admin/save_ticket_tags")}}' data-pk="{{$data->id}}" data-title="Enter description" data-name="description">{{$data->description}} </a></span></td>
                                <td>
                                    <ul class="icons-list">
                                        <li><a class="btn-delete-tag" data-id="{{$data->id}}"><i class="icon-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr/>
                <form class="form-vertical categoryform" role="form" method="POST" action="{{ URL::to('admin/post_ticket_tags') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.tag_name')}}</label>
                        <input type="text" class="form-control" name="tags" required>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.description')}}</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-category"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_tag')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-flat  border-left-info border-right-info" id="ticket-statuses">
            <div class="panel-heading">
                <h4 class="panel-title text-semibold color-green">{{trans('ticket_config.status')}}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h4>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="statuses" class="table table-striped table-lg table-xxs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('ticket_config.status')}}</th>
                                <th><i class="icon-menu7"></i> {{trans('ticket_config.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ticket_statuses as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td><span class="label label-flat"><a class="status" data-type='text' data-url='{{url("admin/save_ticket_status")}}' data-pk="{{$data->id}}" data-title="Enter status" data-name="status_level">{{$data->status}} </a></span></td>
                                <td>
                                    <ul class="icons-list">
                                        <li><a class="btn-delete-status" data-id="{{$data->id}}"><i class="icon-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                            @if(!count($ticket_statuses))
                                    <tr>
                                        <td>{{trans('ticket_config.no_data_found')}}</td>
                                    </tr>
                                    @endif
                        </tbody>
                    </table>
                </div>
                <hr/>
                <form class="form-vertical statusform" role="form" method="POST" action="{{ URL::to('admin/post_ticket_status') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.status_name')}}</label>
                        <input type="text" class="form-control" name="status" required>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.description')}}</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.icon')}}</label>
                        <input type="text" class="form-control" name="icon" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-status"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_status')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
              <div class="panel panel-flat  border-left-info border-right-info" id="ticket-priorities">
            <div class="panel-heading">
                <h4 class="panel-title text-semibold color-green">{{trans('ticket_config.priorities')}}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h4>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-xxs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('ticket_config.ticket_priority')}}</th>
                                <th><i class="icon-menu7"></i> {{trans('ticket_config.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ticket_priority as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td><span class="label label-flat"><a class="priority" data-type='text' data-url='{{url("admin/save_ticket_priority")}}' data-pk="{{$data->id}}" data-title="Enter priority" data-name="priority_level">{{$data->priority}} </a></span></td>
                                <td>
                                    <ul class="icons-list">
                                        <li><a class="btn-delete-priority" data-id="{{$data->id}}"><i class="icon-trash"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach 
                            @if(!count($ticket_priority))
                                    <tr>
                                        <td>{{trans('ticket_config.no_data_found')}} </td>
                                    </tr>
                                    @endif
                        </tbody>
                    </table>
                </div>
                <hr/>
                <form class="form-vertical priorityform" role="form" method="POST" action="{{ URL::to('admin/post_ticket_priority') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.priority_key')}}</label>
                        <input type="text" class="form-control" name="priority" required>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.description')}}</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label">{{trans('ticket_details.icon')}}</label>
                        <input type="text" class="form-control" name="icon" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-priority"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add_priority')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>




@endsection @section('scripts') @parent
<script type="text/javascript">
$(document).ready(function() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
@endsection