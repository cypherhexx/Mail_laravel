@extends('app.user.layouts.default')



{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop





@section('styles')

<link href="{{ asset('assets/admin/css/plugins/main.css') }}" rel="stylesheet">

<link href="{{ asset('assets/admin/css/plugins/jquery.tagit.css') }}" rel="stylesheet">

<link href="{{ asset('assets/admin/css/plugins/jquery.ui.min.css') }}" rel="stylesheet">
<link href="{{asset('assets/user/css/wysiwyg-color.css')}}" rel="stylesheet">
<link href="{{asset('assets/user/css/bootstrap-wysihtml5.css')}}" rel="stylesheet">
     

@endsection

{{-- Content --}}



@section('main')



@include('utils.vendor.flash.message')
@include('utils.errors.list')

<div class="panel panel-success" >



                        <div class="panel-heading">



                            <div class="panel-heading-btn">

                                

                                

                                

                                

                            </div>

                            <h4 class="panel-title">{{ trans('mail.compose') }}</h4>

                        </div>

                        <div class="panel-body">

                       <div class="wrapper">

                        <div class="p-30 bg-white">

                            <!-- begin email form -->

                            <form action="{!! url('user/send') !!}" method="POST" name="email_to_form">
                              

                                <!-- begin email to -->

                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                                <label class="control-label">{{ trans('mail.to') }}:</label>
                                <div class="m-b-15" >
                                    <ul  id="email-to" class="inverse tagit ui-widget ui-widget-content ui-corner-all" required name="users" ></ul>
                                </div>
                                <!-- end email to -->
                                <!-- begin email subject -->
                                
                                <label class="control-label">{{ trans('mail.subject') }}:</label>

                                <div class="m-b-15">

                                    <input type="text" name="subject" class="form-control" required autocomplete="off">

                                </div>

                                <!-- end email subject -->

                                <!-- begin email content -->

                                <label class="control-label">{{ trans('mail.content') }}:</label>

                                <div class="m-b-15">

                                    <textarea id="wysihtml5"  class="textarea form-control"  rows="12" required name="message"></textarea>

                                   

                                </div>

                                <!-- end email content -->

                                <button type="submit" class="btn btn-primary p-l-40 p-r-40" id='btn_submit'>{{ trans('mail.send') }}</button>

                            </form>

                            <!-- end email form -->

                        </div>

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
      <script src="{{ asset('assets/admin/css/plugins/bootstrap.min.js')}}"></script>
      <script src="{{ asset('assets/admin/js/bootstrap-wysihtml5.js') }}"></script>
      <script src="{{ asset('assets/admin/js/email-compose.demo.min.js') }}"></script>  
      <script src="{{ asset('assets/admin/js/wysihtml5-0.3.0.min.js')}}"></script> 
      <script src="{{ asset('assets/admin/js/bootstrap-wysihtml5-0.0.3.min.js')}}"></script>     
      <script src="{{ asset('assets/globals/plugins/Gritter/js/jquery.gritter.js') }}"></script><!-- jQuery gritter-->

     

        

    <script type="text/javascript">          

             $(document).ready(function() {

      App.init();

      EmailCompose.init();

    });



              

 

    </script

    

@stop

