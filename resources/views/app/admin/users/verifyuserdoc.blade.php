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
                               Name
                            </th>
                            
                            <th>
                               {{ trans("users.username") }}
                            </th>
                            <th>
                               {{ trans("users.email") }}
                            </th>
                             <th>
                               View
                            </th>
                             <th>
                          Created At
                            </th>
                            <th>Verification Number</th>
                              <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($users as $key=> $user)
                            <form action="{{url('admin/verifydocuser')}}" method="post" class="form-control">
                                {!! csrf_field() !!}
                        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                      
                            <tr>
                        <td>{{$key +1 }}</td>   

                         <td>{{$user->name }} {{$user->lastname}}</td>   
                        <td>{{$user->username}}</td>
                          <td>{{$user->email}}</td>
                            <td>@if($user->document != NULL)
                              <a href="{{url('assets/uploads/'.$user->document)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                              @else
                            No Document
                          @endif</td>
                        
                        
                        <td>{{ date('d M Y H:i:s',strtotime($user->created_at))}}</td>
                          <td>
                            <input type="number" name="verification_number" class="form-control" style="width: 90px;">
                          
                          </td>
                          <td>
                             <button type="submit"  class="btn btn-primary" > <span class="fa fa-check "></span>   </button>
                          </td>
                                 
                                        
                     
                    </tr>
                    </form>
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

            