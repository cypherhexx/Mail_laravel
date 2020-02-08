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

    <form action="" method="">

<div class="invoice">
    <div class="invoice-company">
        <span class="pull-right hidden-print">
           <!--  <a onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a> -->
        </span>
    </div>
    
  
    <div class="invoice-content">

    @foreach($read_news as $data)




    <div class="form-group" align="center">

     <label class="control-label"><h2>{{$data->title}}</h2></label>

    </div>
    
 

 <div class="form-group" align="left">

     <label class="control-label">{!! $data->description !!}</label>

    </div>
  
   
    

    @endforeach


  
</div>

</form>
</div>
</div>                
@stop

{{-- Scripts --}}
@section('scripts')
    @parent

@stop



 