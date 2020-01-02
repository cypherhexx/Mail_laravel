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




    <div class="container-fluid display-page" id="display-post-category" >

        <!-- @create Modal-->
        <modal  v-if="modal.get('create')" @close="modal.set('create', false)" >
        <template slot="header" ><h4>Create Item</h4></template>
        <template slot="body" >
            <form method="POST" action="" @submit.prevent="storeItem()">
                <div class="modal-body">
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control border-input" placeholder="Title" v-model="forms.title"  type="text"  >
                        <span class="error-msg" v-if="errors.has('title')" v-text="errors.get('title')"></span>


                    </div>

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="sub_title">Sub Title</label>
                        <input class="form-control border-input" placeholder="Sub Title" v-model="forms.sub_title"  type="text"  >
                        <span class="error-msg" v-if="errors.has('sub_title')" v-text="errors.get('sub_title')"></span>
                    </div>


                    <!-- form Group -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control border-input" placeholder="Type here the description" rows="10" name="short_text" cols="50" v-model="forms.description"></textarea>
                        <span class="error-msg" v-if="errors.has('description')" v-text="errors.get('description')"></span>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('create', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>

            </form>
        </template>
        </modal>


        <!-- @update -->
        <modal  v-if="modal.get('edit')" @close="modal.set('edit', false)"  >
        <template slot="header" ><h4>Edit Item</h4></template>
        <template slot="body" >
            <form method="POST" action="" @submit.prevent="updateItem()">
                <div class="modal-body">
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control border-input" placeholder="Title" v-model="forms.title"  type="text"  >
                        <span class="error-msg" v-if="errors.has('title')" v-text="errors.get('title')"></span>
                    </div>

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="sub_title">Sub Title</label>
                        <input class="form-control border-input" placeholder="Sub Title" v-model="forms.sub_title"  type="text"  >
                        <span class="error-msg" v-if="errors.has('sub_title')" v-text="errors.get('title')"></span>
                    </div>


                    <!-- form Group -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control border-input" placeholder="Type here the description" rows="10" name="short_text" cols="50" v-model="forms.description"></textarea>
                        <span class="error-msg" v-if="errors.has('description')" v-text="errors.get('description')"></span>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('edit', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </template>
        </modal>


        <!-- @delete -->
        <modal  v-if="modal.get('delete')" @close="modal.set('delete', false)"  >
        <template slot="header" ><h4>Delete Item</h4></template>
        <template slot="body" >
            <form method="POST" action="" @submit.prevent="destroyItem( submitSelectedItems )">
                <div class="modal-body">
                    <p>Are you Sure that you want to delete this  ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('delete', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Delete</button>
                </div>
            </form>
        </template>
        </modal>
        <div class="row" >
            <div class="col-md-7">
            </div>
            <div class="col-md-5 text-right">
                <ul class="list_right_menu_top list-inline">
                    <li><a href="#" type="button" class="delete-item-all-btn btn btn-primary btn pull-right "  @click="deleteManyItems()" >Delete</a></li>
                    <li> <a href="#" class="btn-primary btn pull-right "  @click="createItem()" >Create Item</a></li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h4 class="title">Ticket categories</h4>
                        <p class="total_row_values"><span>Total of</span> <span class="total_row_number" id="total_row_number"> </span> <span>Items</span> </p>
                    </div>
                            <!-- content -->
                    <div class="content table-responsive table-full-width" id="display"   >
                        <table class="table  table-striped">
                            <thead>
                            <th>ID</th>
                            <th>
                                
                                    <input class="styled" name="chkSelectAll" type="checkbox" id="chkSelectAll" v-model="toggleAll" @click="selectAll" >
                                
                            </th>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th class="td-actions text-right" data-field="actions" >
                                <div class="th-inner ">Ação</div>

                            </th>

                            </thead>


                            <tbody class="posts">


                            <tr class="display_item post"  v-for="(item , index )  in displayItems"   >

                                <td></td>
                                <td> 

                                        <input class="styled" type="checkbox" :value="index" v-model="selectedItems">

                                    
                                </td>

                                <td class="row_title" v-text="item.title" ></td>

                                <td  v-text="item.sub_title"></td>

                                <td class="td-actions text-right " >



                                    <ul class="list_table_action list-inline">


                                        <!-- edit  Button -->
                                        <li class="edit">
                                            <a class="hint--top" aria-label="Editar"  href="#"  @click.prevent="editItem(item)" >
                                                <i class="icon-pencil7"></i>
                                            </a>
                                        </li>

                                        <!-- edit  Button -->
                                        <li class="delete">
                                            <a class="hint--top" aria-label="Deletar"  href="#"  @click.prevent="deleteItem(item)" >
                                                <i class="icon-trash"></i>
                                            </a>
                                        </li>




                                    </ul>



                                </td>
                            </tr>



                            </tbody>

                        </table>


                        <!-- pagination -->
                        <div class="fixed-table-pagination">
                            <div class="text-center">

                                <ul class="pagination">
                                    <li class="first_pg">
                                        <a v-if="pagination.get('current_page') > 1" href="#" aria-label="Previous" @click.prevent="pagination.prevPage()">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                                    <li v-for="page in pagesNumber"  v-bind:class="[ page == pagination.isActived ? 'active' : '']" >
                                        <a href="#" @click.prevent="pagination.changePage(page)">
                                            @{{ page }}
                                        </a>
                                    </li>
                                    <li class="last_pg">
                                        <a  v-if="pagination.get('current_page') < pagination.get('last_page')" href="#" aria-label="Next" @click.prevent="pagination.nextPage()">
                                            <span aria-hidden="true">»</span>
                                        </a>
                                    </li>
                                </ul>



                            </div>
                        </div>
                        <!-- end pagination -->

                    </div>
                    <!-- content -->



                    <!-- end row -->
                </div>
                <!-- container-fluid-->
            </div>





        </div>
    </div>




















<div id="ticket-dashboard">
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

@endsection 
@section('scripts') 
@endsection