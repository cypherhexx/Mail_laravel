@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent

<style type="text/css">
.row{
    margin-top: 2px;
}

</style>


 <link type="text/css" rel="stylesheet" href="{{ asset('assets/globals/plugins/bjornd-jvectormap/jquery-jvectormap.css') }}" >
 <link type="text/css" rel="stylesheet" href="{{ asset('assets/globals/plugins/bootstrap-calendar/css/calendar.min.css') }}" >
 <link type="text/css" rel="stylesheet" href="{{ asset('assets/globals/plugins/Gritter/css/jquery.gritter.css') }}" >
 <link type="text/css" rel="stylesheet" href="{{ asset('assets/globals/plugins/morris.js-0.5.1/morris.css') }}" >


@endsection
{{-- Content --}}
@section('main')

        @include('utils.vendor.flash.message')
        @include('utils.errors.list') 

<div class="panel panel-success" >
	<div class="panel-heading">
        	<div class="panel-heading-btn">
			
            
            
                   </div>
        <h4 class="panel-title">{{trans('code.view_my_adds_account')}}</h4>
     </div>
     <div class="panel-body">
            <div class="form-group">
                <label class="control-label label label-primary">
                  {{trans('code.total_adds_available')}} : {{$credits}}
                </label>
            </div>

            <div class="form-group">
                  
                  <form action="{{url('user/view-adds')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                      <div class="col-md-8">
                      <div class="row row-space-10">
                           <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email here" required>
                            </div>
                            <div class="col-md-6">
                                 <input type="text" class="form-control" name="user_id" placeholder="User id here " required>
                            </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                     <button class="btn btn-primary">{{trans('code.total_adds_available')}}</button>
                    </div>

                </form>
              </div>           


	</div>
</div>

<div class="panel panel-success" >
    <div class="panel-body">
      <table class="table table-condensed">
            <thead>
                                    <tr>
                                        <th>{{trans('code.no')}}</th>
                                        <th>{{trans('code.email')}}</th>
                                        <th>{{trans('code.userid')}}</th>
                                        <th>{{trans('code.status')}}</th>
                                        <th>{{trans('code.created_date')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($code as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1}}</td>
                                        <td>{{$item->email }}</td>
                                        <td>{{$item->identification }}</td>
                                        <td>{{$item->status }}</td>        
                                         <td>{{  date('d M Y H:i:s',strtotime($item->created_at)) }}</td>                                        
                                    </tr>
                                  @endforeach                              
                                </tbody>
                            </table>

                         <div class="col-sm-12 col-sm-offset-4">
                               {!! $code->render() !!}
                         </div>


    </div>
  </div>

@endsection
@section('scripts') 
@parent
        
<script src="{{ asset('assets/globals/plugins/Gritter/js/jquery.gritter.js') }}"></script><!-- jQuery gritter-->
<script src="{{ asset('assets/globals/js/dashboard-v2.min.js') }}"></script><!-- dashboard-->
<script src="{{ asset('assets/globals/plugins/bjornd-jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script><!-- jQuery vectormap-->
<script src="{{ asset('assets/globals/plugins/bjornd-jvectormap/jquery-jvectormap-world-merc-en.js') }}"></script><!-- jQuery vectormap-->
<script src="{{ asset('assets/globals/js/clipboard.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            App.init(); 
             var clipboard = new Clipboard('.clipboard-button');
              $.gritter.add({
                   title: "View my adds account ,",
                    text: ' Add merchants advertising accounts here. If you are the one who uploads the information for them, please input  your email address. Once this is done, you will receive an email to register and upload your merchant’s advertising account.',                                           
                    sticky: true,
                    time: 6000,
                    class_name: "gritter-light"
                });
             });
           

    </script>
    @endsection