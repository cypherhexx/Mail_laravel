@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-border panel-primary" data-sortable-id="ui-widget-11">
    <div class="panel-heading">
        <h4 class="panel-title">Read News</h4>
    </div>
            <div class="panel-body">
              @if(count($read_news) > 0)
                        <div class="table-responsive">
                            <table class="table table-invoice" id="table">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Title</th> 
                                        <th>Date</th>  
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                    <tbody>

                                            @foreach($read_news as $key=> $report)

                                                <tr>

                                                <td>{{$key + 1}}</td>
                                                <td>{{$report->title}}</td>

                                               <td> {{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
                                                <td><a  class="btn btn-sm btn-primary m-b-10" href="{{url('user/read_more',$report->id)}}">Read More</a></td>
                                              
                                                </tr>

                                            @endforeach  


                                    </tbody>
                            </table>
                        </div>
               

                 {!! $read_news->render() !!} 

                 @else
                 No data Found
                 @endif

            </div>
            <br>
            <br>
            <br>
          
        </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent

@stop



 