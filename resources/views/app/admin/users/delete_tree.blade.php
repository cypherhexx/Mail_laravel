@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main') 
 @include('utils.errors.list')
<div class="panel panel-flat border-top-success">
    <div class="panel-heading">
        <h4 class="panel-title">
           Change Member to Customer
        </h4>
    </div>
    <div class="panel-body">

    

        <form action="{{url('admin/users/delete_tree')}}" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="username">
                    {{trans('ewallet.username')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control autocompleteusers" id="username" name="autocompleteusers" placeholder="{{trans('ewallet.please_enter_username')}}" type="text" required="true">
                    <input class="form-control key_user_hidden" name="username" type="hidden">
                    </input>
                </div>
            </div>
           
            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                        <button type="button"  class="btn btn-info" data-toggle="modal" data-target="#myModal">
                            {{trans('ewallet.submit')}}
                        </button>
                         <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                        <!-- Modal content-->

                        <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>

                        <div class="modal-body" style="overflow: auto !important;">

                        <center> 

                        Do you want to change usertype 
      

                        </center>

                        </div>  
                    
                        <div class="modal-footer">
                        <div class="row">
                        <button type="submit" class="btn btn-success" >Confirm </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
       
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>
@endsection @section('scripts') @parent 
 <script type="text/javascript">

        $("#myModal").on("hidden.bs.modal", function () {
        oTable.ajax.reload();
        })
        </script>
        @endsection