@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')


 @include('utils.errors.list')

 @include('flash::message')

 <div class="panel panel-border panel-primary" data-sortable-id="ui-widget-11">
    <div class="panel-heading">
        <h4 class="panel-title">Read News</h4>
    </div>
            <div class="panel-body">
                <form action="" method="">
                    <div class="invoice-content">
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
                                                <td>
                                                <a  class="btn btn-sm btn-primary m-b-10" href="{{url('admin/read_more',$report->id)}}">
                                                	<i class="icon-reading"></i></a>

                                                 <a  class="btn btn-sm btn-primary m-b-10" href="{{ URL::to('admin/editnews/'.$report->id) }}"><i class="icon-pencil4"></i></a>

                                                  <a class="btn btn-sm btn-primary m-b-10" href="{{ URL::to('admin/deletenews/'.$report->id) }}"><i class="fa fa-trash"></i></a>

                                                </td>
                                              
                                                </tr>

                                            @endforeach  

                                                @if(!count($read_news))

                                                <tr><td>No Data</td></tr>

                                                @endif  

                                                          

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </form>

                 {!! $read_news->render() !!} 

            </div>
        </div>

@endsection

