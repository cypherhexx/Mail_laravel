@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main') @include('flash::message') @include('utils.errors.list')
<div class="panel panel-flat ">
    <div class="panel-heading col-sm-offset-3">
        <h4 class="panel-title">
            Create Broker
        </h4>
    </div>
    <div class="panel-body col-sm-offset-2">

  
        <form action="{{url('admin/upcreatebrokers')}}" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="name">
                  Name:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                  <input class="form-control" id="name" name="name" type="text" required="true">
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="url">
                    URL:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control" id="url" name="url" type="text" required="true">
                    </input>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" for="current_password">
                   Status 
                </label>
                 <div class="col-sm-4">
                    <select name="status" id=status class="form-control">
                       <option value="enabled">enabled</option>  
                       <option value="disabled">disabled</option>  
                    </select>
                   
               
                </div>
            </div>
            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                        <button class="btn btn-info" id="add" name="add" tabindex="4" type="submit" >
                          Save
                        </button>
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>

@if(count($all_brokers) > 0)

 <div class="panel panel-flat" data-sortable-id="ui-widget-11">
    <div class="panel-heading">
        <h4 class="panel-title">All Brokers</h4>
    </div>
            <div class="panel-body">
                <form action="" method="">
                    <div class="invoice-content">
                        <div class="table-responsive">
                            <table class="table table-invoice" id="table">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Name</th> 
                                        <th>URL</th>  
                                        <th>Status</th>  
                                        <th>Created</th> 
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                    <tbody>

                                            @foreach($all_brokers as $key=> $broker)

                                                <tr>

                                                <td>{{$key + 1}}</td>
                                                <td>{{$broker->name}}</td>
                                                <td><a href="{{$broker->url}}" target="_blank"> {{$broker->url}}</a></td>
                                                <td>{{$broker->status}}</td>


                                               <td> {{ date('d M Y H:i:s',strtotime($broker->created_at))}}</td>
                                                <td>
                                               

                                                 <a  class="btn btn-sm btn-primary m-b-10" href="{{ URL::to('admin/editbroker/'.$broker->id) }}"><i class="icon-pencil4"></i></a>

                                                  <a class="btn btn-sm btn-primary m-b-10" href="{{ URL::to('admin/deletebroker/'.$broker->id) }}"><i class="fa fa-trash"></i></a>

                                                </td>
                                              
                                                </tr>

                                            @endforeach  

                                               

                                                          

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </form>

                 {!! $all_brokers->render() !!} 

            </div>
        </div>

        @endif


@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
 @parent
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>

 @endsection