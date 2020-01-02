@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
<!-- Secondary sidebar -->
<div class="sidebar sidebar-secondary sidebar-default">
    <div class="sidebar-content">
        <!-- Sub navigation -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>
                    Navigation
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="category-content no-padding">
                <ul class="navigation navigation-alt navigation-accordion">
                    <li class="navigation-header">
                        Tickets
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-ticket">
                            </i>
                           Tickets Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-ticket">
                            </i>
                           View all tickets
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-ticket">
                            </i>
                           Overdue
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-ticket">
                            </i>
                           Closed
                        </a>
                    </li>
                    <li class="navigation-header">
                        Manage Categories
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-list">
                            </i>
                            Ticket Categories
                        </a>
                        <ul>
                            <li>
                                <a href="#">
                                <i class="icon-files-empty">
                                </i>
                                List categories
                            </a>
                            </li>
                            <li>
                                <a href="#">
                                <i class="icon-files-empty">
                                </i>
                                Create Category
                            </a>
                            </li>
                        </ul>
                    </li>
                    <li class="navigation-header">
                        Reports
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-files-empty">
                            </i>
                            Reports
                        </a>
                    </li>
                    <li class="navigation-header">
                        Configurations
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-files-empty">
                            </i>
                           Settings
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-file-plus">
                            </i>
                           Manage FAQ                            
                        </a>
                    </li>
                    <li class="navigation-divider">
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-cog3">
                            </i>
                            Manage
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sub navigation -->
    </div>
</div>
<!-- /secondary sidebar -->
@endsection {{-- Content --}} @section('main')
<!-- Single line -->
<div id="category-create">

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-flat border-top-info border-bottom-info">
                <div class="panel-heading">
                    <h4 class="panel-title text-semibold color-green">Categories<a class="heading-elements-toggle"><i class="icon-more"></i></a></h4>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-lg">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th><i class="icon-menu7"></i> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="label label-flat border-primary text-primary-600">Default</span></td>
                                    <td><span class="label label-success label-roundless">Default category</span></td>
                                    <td>
                                        <ul class="icons-list">
                                            <li><a href="#"><i class="icon-pencil7"></i></a></li>
                                            <li><a href="#"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr/>
                    <form class="form-vertical categoryform" role="form" method="POST" action="{{ URL::to('admin/post_ticket_categories') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label class="control-label">{{trans('ticket_details.add_category')}}</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-category"><b><i class=" icon-folder-plus2"></i></b> {{trans('ticket_details.add')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
@section('scripts')
@parent
<script type="text/javascript">
    
$('.submit-category').click(function() {
    $('.categoryform').submit();
});
$(".categoryform").submit(function(e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $('.categoryform').parsley().validate();
    if ($('.categoryform').parsley().isValid()) {
        var block = $(this).parent().parent().parent().parent();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/admin/post-note',
            data: new FormData($('.notesform')[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function() {
                $(block).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function(response) {
                $(block).unblock();
                $('.notesform').find("input[type=text], textarea").val("");
                new PNotify({
                    text: 'Note Added',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
                if ($('.notes').length) {
                    $newNote = '<div class="each-note col-sm-3"><div class="panel ' + response.color + '"><div class="panel-body"><div class="media"><div class="media-left"><i class=" icon-file-text3 text-warning-400 no-edge-top mt-5"></i></div><div class="media-body"><h6 class="media-heading text-semibold">' + response.title + ' - <i class="text-xs">' + response.date + '</i></h6>' + response.description + '</div></div></div></div></div>';
                    $('.notes>.row:first-child').append($newNote);
                }
            }
        });
    } else {
        console.log('not valid');
    }
});

</script>
@endsection


<div id="ticket-dashboard">
    
    <div class="row">
        <div class="col-sm-6">
            <div class="mt-10 mb-10">
                <a href="#" class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-paperplane"></i></b> Create a ticket </a>
                <a href="#" class="btn bg-blue btn-labeled heading-btn" data-toggle="modal" data-target="#modal_create_category"> Create a ticket </a>
                <!-- modal_create_category -->
                <div id="modal_create_category" class="modal fade">
                    <div class="modal-dialog modal-xs">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title">Add category</h5>
                            </div>
                            <div class="modal-body">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /modal_create_category -->
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body text-center">
            <div class="icon-object border-warning-400 text-warning"><i class="icon-lifebuoy"></i></div>
            <h5 class="text-semibold">{{trans('menu.help_desk_ticket_center')}}</h5>
            <p class="mb-15">View and manage tickets submitted</p>
            <a href="#" class="btn bg-warning-400">View statistics</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-blue-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">{{$total}}</h3>
                        <span class="text-uppercase text-size-mini">{{trans('menu.total_tickets')}}</span>
                    </div>
                    <div class="media-right media-middle">
                        <i class="icon-ticket icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-success-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">23</h3>
                        <span class="text-uppercase text-size-mini">{{trans('menu.resolved')}}</span>
                    </div>
                    <div class="media-right media-middle">
                        <i class="icon-checkmark-circle icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-warning-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-left media-middle">
                        <i class="icon-hour-glass2 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin">20 </h3>
                        <span class="text-uppercase text-size-mini">{{trans('menu.pending')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-danger-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-left media-middle">
                        <i class="icon-info3 icon-3x opacity-75"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin">{{$status}} - 12 ticktes</h3>
                        <span class="text-uppercase text-size-mini">{{trans('menu.due_today')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-title">
        <h4 class="m-t-0 m-b-30 header-title">{{trans('menu.latest_tickets')}}</h4>
    </div>
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-colored table-centered m-0">
                    <thead>
                        <tr>
                            <th>{{ trans('menu.ticket_no') }}:</th>
                            <th>{{ trans('menu.subject') }}</th>
                            <th>{{trans('menu.status')}}</th>
                            <th>{{trans('menu.priority')}}</th>
                            <th>{{trans('menu.category')}}</th>
                        </tr>
                    </thead>
                    @foreach($ticket_join as $tickets)
                    <tbody>
                        <tr>
                            <td>{{$tickets->ticket_no}}</td>
                            <td>{{$tickets->subject}}</td>
                            <td>{{$tickets->status}}</td>
                            <td>{{$tickets->priority}}</td>
                            <td>{{$tickets->category}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<h3>Category</h3>
<h3>priority</h3>
<form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/post_ticket_priority') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="col-md-2 control-label">{{trans('ticket_details.priority')}}</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="priority" required />
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4  col-md-offset-2">
            <button type="submit" class="btn btn-primary">
                {{trans('ticket_details.add_priority')}}
            </button>
        </div>
    </div>
</form>
<h3>Tags</h3>
<form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/post_ticket_tags') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-sm-12">
        <div class="form-group">
            <label class="col-md-2 control-label">{{trans('ticket_details.tags')}}</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="tags" required>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <div class="col-md-4  col-md-offset-2">
                <button type="submit" class="btn btn-primary">
                    {{trans('ticket_details.add_tags')}}
                </button>
            </div>
        </div>
    </div>
</form>
<h3>Ticket</h3>
<form class="form-horizontal" role="form" method="POST" action="{{ URL::to('user/save_ticket') }}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="col-md-2 control-label"> {{trans('ticket.category')}} </label>
        <div class="col-md-8">
            <select name="category" class="form-control" required>
                <option value="">{{trans('ticket.select')}}</option>
                @foreach($category as $data)
                <option value="{{$data->id}}">{{$data->category}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"> {{trans('ticket.priority')}} </label>
        <div class="col-md-8">
            <select name="priority" class="form-control" required>
                <option value="">{{trans('ticket.select')}}</option>
                @foreach($priority as $data)
                <option value="{{$data->id}}">{{$data->priority}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" name="status" value="{{$status}}">
    <input type="hidden" name="id" value="{{$id}}">
    <div class="form-group">
        <label class=" col-md-2 control-label" for="tags"> {{trans('ticket.tags')}} </label>
        <div class="col-md-8">
            <select data-placeholder={{trans( 'ticket.choose_tags')}} name="tags[]" id="ticket_tags" class=" col-sm-6 form-control chosen-select" multiple data-parsley-mincheck="0" required data-parsley-trigger="change">
                @foreach($tags as $tags_item)
                <option {{ (in_array($tags_item->id,$ticket_tag)) ? 'selected' : '' }} value="{{$tags_item->id}}">{{$tags_item->tags}}</option>
                @endforeach
            </select>
            {!! $errors->first('tags', '
            <label class="control-label required " for="tags">:message</label>')!!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"> {{trans('ticket.subject')}} </label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="ticket_subject" required placeholder={{trans( 'ticket.pls_enter_subject')}}>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">{{trans('ticket.description')}}</label>
        <div class="col-md-8">
            <label class="control-label">{{ trans('mail.content') }}:</label>
            <div class="m-b-15">
                <textarea id="wysihtml5" class="textarea form-control" rows="12" required name="ticket_description"></textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8 col-md-offset-2">
            <input id="input-711" name="savefile[]" type="file" multiple class="file-loading">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-2">
            <button class="btn btn-primary" type="submit">{{trans('ticket.create_ticket')}}</button>
        </div>
    </div>
</form>
@endsection @section('scripts') @endsection