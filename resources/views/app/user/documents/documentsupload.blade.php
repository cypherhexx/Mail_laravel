


@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{$title}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
        

 <table class="table table-invoice">

                                      <thead>

                                           <tr>

                                             <th>{{trans('download.no')}}</th>

                                             <th>{{trans('download.file_title')}}</th>

                                             <th>{{trans('download.name')}}</th>

                                             <th>{{trans('download.download')}}</th>

                                             <th>{{trans('download.created_at')}}</th>   

                                          </tr>

                                      </thead>

                                      <tbody>

                                       @foreach($downloads as $key=> $request)

                                        <tr>

                                          <td>{{$key +1 }}</td>

                                          <td>{{$request->file_title}}</td>

                                          <td>{{$request->name}}</td>

                                          <td><a class="btn btn-success" href="{{url('user/download/'.$request->name)}}"  name="requestid">{{trans('download.download')}}</a></td>

                                          <td>{{$request->created_at}}</td>

                                        </tr>

                                        @endforeach  

                                        @if(!count($downloads))

                                        <tr><td>{{trans('download.no_data')}}</td></tr>

                                          @endif

                                        </tbody>

                                                             

                            </table>

                          {!! $downloads->render() !!}



                        
  </div>
                  
@stop 