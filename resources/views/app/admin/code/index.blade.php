@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

@endsection

{{-- Content --}}
@section('main')

@include('utils.errors.list')

 @include('flash::message')

                    <div class="panel panel-flat" >
                        
                        <div class="panel-body">
                          <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>{{ trans('code.no') }}</th>
                                        <th>{{ trans('code.username') }}</th>
                                        <th>{{ trans('code.email') }}</th>
                                        <th>{{ trans('code.userid') }}</th>
                                        <th>{{ trans('code.status') }}</th>
                                        <th>{{ trans('code.created_date') }}</th>
                                        <th>{{ trans('code.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($code as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1}}</td>
                                        <td>{{$item->username }}</td>
                                        <td>{{$item->email }}</td>
                                        <td>{{$item->identification }}</td>
                                        <td>{{$item->status }}</td>        
                                         <td>{{  date('d M Y H:i:s',strtotime($item->created_at)) }}</td>                                        
                                         <td><a href="{{url('admin/add-confirm/'.$item->id)}}" class="btn btn-success"> Confirm</a></td>                                        
                                    </tr>
                                  @endforeach   

                                  @if(!count($code))
                                  <tr><td>{{trans('ticket.no_data')}}</td></tr>    @endif              
            


                                </tbody>
                            </table>

                         <div class="col-sm-4 col-sm-offset-4">
                               {!! $code->render() !!}
                         </div>
                      </div>
                  </div>
               
                  
 
            
@endsection



@section('scripts') @parent
    <script>
        $(document).ready(function() {
          
             App.init();              
        });
       

        
    </script>
    @endsection