@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans("users.users") }}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <table  class="table datatable-basic table-striped table-hover">
            <!-- id="pending-users" -->
                    <thead>
                        <tr>
                             <th>
                               No
                            </th>
                          
                            <th>
                               ID
                            </th>
                            <th>
                               {{ trans("users.username") }}
                            </th>
                            <th>
                               {{ trans("users.email") }}
                            </th>
                             <th>
                              Package
                            </th>
                            <th>
                              Payment Type
                            </th>
                            <th>
                               Amount
                            </th>
                             <th>
                        Created At
                            </th>
                            <th>
                                {{ trans("users.action") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($users as $key=> $user)
                            <tr>
                        <td>{{$key +1 }}</td>   

                         <td>{{$user->order_id }}</td>   
                        <td>{{$user->username}}</td>
                          <td>{{$user->email}}</td>
                            <td>{{$user->package}}</td>
                              <td>{{$user->payment_type}}</td>
                                 <td>{{$user->amount}}</td>
                        <td>{{ date('d M Y H:i:s',strtotime($user->created_at))}}</td>
                                 <td>  <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$user->id}}"> <span class="fa fa-check "></span>   </button>

                                      <!-- Modal -->

                                <div id="myModal{{$user->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                              <!-- Modal content-->

                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>

                                <div class="modal-body" style="overflow: auto !important;">

                               <center> 

                               Do you want to confirm this payment??
                              

                                </center>

                                
                                </div>                 
                                </form>
                                <div class="modal-footer">
                                <div class="row">
                                
                                <a href="{{url('admin/activatependinguser/'.$user->id)}}" class="btn btn-success" ></span>Confirm </a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>

                                 </td>
                                 

                                    <td>  <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#modaltrash{{$user->id}}"> <span class="fa fa-trash"></span>   </button>

                                      <!-- Modal -->

                                <div id="modaltrash{{$user->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                              <!-- Modal content-->

                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>

                                <div class="modal-body" style="overflow: auto !important;">

                               <center> 

                               Do you want to Delete ?
                              

                                </center>

                                
                                </div>                 
                                
                                <div class="modal-footer">
                                <div class="row">
                                
                                <a href="{{url('admin/deletependinguser/'.$user->id)}}" class="btn btn-success" ></span>Confirm </a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>

                                 </td>
                                        
                     
                    </tr>
                             @endforeach  
                    </tbody>
                        </table>
                    </div>
                </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop

            