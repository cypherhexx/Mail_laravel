

@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{trans('report.income_report') }}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
     <div class="panel-body"> 

     <form action="{{URL::to('user/incomereport')}}" method="post">

     	<input type="hidden" name="_token"  value="{{csrf_token()}}">

     	<div class="row">

     		<div class="form-group col-sm-6">

	     		<label class="form-label col-sm-3">{{trans('report.pick_start_date')}}</label>

	     		<div class="col-sm-6">

	     			<div class="input-group"> 

	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="start" id="start"  value="{{ date('m/01/Y')}}"required="true">

	     			<label for="start" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>

	     		



	     			</div>

	     		</div>

	     	</div>

	     	<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-3">{{trans('report.pick_end_date')}}</label>
	     		<div class="col-sm-6">
	     			<div class="input-group"> 
	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="end" id="end"  value="{{ date('m/t/Y')}}" required="true">
	     				<label for="end" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>
	     			</div>

	     		</div>

	     	</div>

     	</div>
 

     	<div class="form-group col-sm-offset-6" >

     		<button type="submit" class="btn btn-primary">{{trans('report.get_report')}}</button>

     	</div>



     	

     </form>  



                     

	</div>

    	 



                        
  </div>
                  
@stop
 
 