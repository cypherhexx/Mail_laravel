@extends('app.user.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')
@parent 
<style type="text/css">


</style>
 @stop
                             
{{-- Content --}}
@section('main')
@include('utils.vendor.flash.message')   

         @include('utils.errors.list')       


<div class = "panel panel-primary">

<div class="panel-heading">

    <div class="panel-heading-btn">
            
            
            
            
    </div>

     <h3 class = "panel-title">View My Files</h3>

</div>

<div class = "panel-body">


























</div>
</div>



 @endsection


@section('scripts') @parent



  <script type="text/javascript"> 
     
           $(document).ready(function() {

            App.init();  

            EmailCompose.init();          
        });
       
    </script>


    @endsection