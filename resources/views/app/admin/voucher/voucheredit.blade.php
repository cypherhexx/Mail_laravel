@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')
<link href="{{ asset('assets/admin/css/plugins/main.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/css/plugins/jquery.tagit.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/css/plugins/jquery.ui.min.css') }}" rel="stylesheet">
     
@endsection
{{-- Content --}}

@section('main')

@include('utils.vendor.flash.message')
<div class="panel panel-flat" >

                        <div class="panel-heading">

                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">Edit Voucher</h4>
                        </div>
                        <div class="panel-body">
                       <div class="wrapper">
                        <div class="p-30 bg-white">
                            <!-- begin email form -->
                        <form action="{{URL::to('admin/updatevoucher')}}" method="post">
                                <!-- begin email to -->
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                   <input type="hidden" name="id" value="{{$response[0]->id}}">
                             
                                
                                <!-- end email to -->
                                <!-- begin email subject -->

                                <label class="control-label">Amount:</label>
                                <div class="m-b-15">
                                    <input type="text" name="amount" class="form-control" value="{{$response[0]->total_amount}}"  required autocomplete="off">
                                </div>


                                <label class="control-label">Count:</label>
                                 <div class="m-b-15">
                                    <input type="text" name="count" class="form-control" value="" required autocomplete="off">
                                </div>

                                <!-- end email subject -->
                                <!-- begin email content -->
                        

                                
                          </div>
                                <!-- end email content -->
                                <button type="submit" class="btn btn-primary p-l-40 p-r-40" id='btn_submit'>{{ trans('autoresponse.update') }}</button>
                            </form>
                            </div>
                            </div>

                            
  

</div>             
                          
                                 

@stop

{{-- Scripts --}}
@section('scripts')
    @parent

      <script src="{{ asset('assets/admin/js/plugins/dataTables/jquery.colorbox.js') }}"></script>
      <script src="{{ asset('assets/admin/js/tag-it.min.js')}}"></script>
      <script src="{{ asset('assets/admin/js/wysihtml5-0.3.0.js') }}"></script>
      <script src="{{ asset('assets/admin/js/bootstrap-wysihtml5.js') }}"></script>
      <script src="{{ asset('assets/admin/js/email-compose.demo.min.js') }}"></script>
     
        
    <script type="text/javascript">
        
$(document).ready(function() {  
 App.init();
EmailCompose.init();
   
});
	

              
 
    </script
    
@stop
