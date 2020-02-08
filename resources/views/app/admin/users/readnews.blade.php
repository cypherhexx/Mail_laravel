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

<div class="invoice">
    <div class="invoice-company">
     <!--    <span class="pull-right hidden-print">
            <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
        </span> -->
    </div>
    
  
    <div class="invoice-content">

    @foreach($read_news as $data)




    <div class="form-group" align="center">

     <label class="control-label"><h3>{{$data->title}}</h3></label>

    </div>
    


 <div class="form-group" align="left">

     <label class="control-label">{!! $data->description !!}</label>

    </div>
  
   
    

    @endforeach


  
</div>

</form>
</div>
</div>


@endsection
@section('scripts') @parent
   
  
    @endsection 

