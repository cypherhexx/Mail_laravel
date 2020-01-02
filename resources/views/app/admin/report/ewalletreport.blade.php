@extends('app.admin.layouts.default')



{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

@section('styles')
@parent




@endsection

{{-- Content --}}

@section('main')



      @include('utils.errors.list')



<div class="panel panel-flat" >

	<div class="panel-heading">

    	
        <h4 class="panel-title">{{trans('report.members_income_report')}} </h4>

     </div>

     <div class="panel-body"> 

     <form action="{{URL::to('admin/incomereport')}}" method="post">

     	<input type="hidden" name="_token"  value="{{csrf_token()}}">

     	<div class="row">

     		<div class="form-group col-sm-6">

	     		<label class="form-label col-sm-3">{{trans('report.pick_start_date')}}</label>

	     		<div class="col-sm-6">

	     			<div class="input-group"> 

	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="start" id="start" value="{{ date('m/01/Y') }}"  required="true">

	     			<label for="start" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>

	     		



	     			</div>

	     		</div>

	     	</div>

	     	<div class="form-group col-sm-6">

	     		<label class="form-label col-sm-3">{{trans('report.pick_end_date')}}</label>

	     		<div class="col-sm-6">

	     			<div class="input-group"> 

	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="end" id="end" value="{{ date('m/t/Y') }}"  required="true">

	     				<label for="end" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>

	     		

	     			</div>

	     		</div>

	     	</div>

     	</div>

     	<div class="row">
     		<!--<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-3">{{trans('report.position')}}</label>
	     		<div class="col-sm-6">
	     			<select class="form-control" name="position" id="position" required="true">
	     					<option value="all">{{trans('report.all')}}</option>
	     					@foreach($packages as $item)
		            			<option value="{{$item->id}}">{{$item->package}}</option>
	     					@endforeach
	     			</select>
	     		</div>
	     	</div>-->
        </div>
        <div>	
	     	<div class="form-group col-sm-6">
	     	
             <label class="col-sm-3 control-label" for="username">
            {{trans('ewallet.username')}}: <span class="symbol required"></span>
            </label>
            <div class="col-sm-6">
                <input type="text" id="username" name="username" class="form-control">
            </div>
	     
	</div>
</div>


     	<div class="row">
     		<div class="form-group col-sm-6">
	     		<label class="form-label col-sm-3">{{trans('report.bonus_type')}}</label>
	     		<div class="col-sm-6">
	     			<select class="form-control" name="bonus_type" id="bonus_type" required="true">
	     					<option value="all">{{trans('report.all')}}</option>
		            		@foreach($bonus_type as $bonus)
		            		<option value="{{$bonus->payment_type}}"><?php  echo str_replace("_", " ",$bonus->payment_type) ;  ?></option>
		            	    @endforeach
	     			</select>
	     		</div>
	     	</div>	     	
     	</div>

     	<div class="form-group col-sm-offset-6" >

     		<button type="submit" class="btn btn-primary">{{trans('report.get_report')}}</button>

     	</div>



     	

     </form>  



                     

	</div>

</div>

                  



            

@endsection







@section('scripts') @parent





<script type="text/javascript" src="{{asset('assets/globals/js/autosuggest.js')}}" charset="utf-8"></script>


    <script>

        $(document).ready(function() {

            App.init(); 

            $(".datetimepicker").datepicker()          

        });

   var options = {
                script:"{{url('admin/suggestlist')}}?json=true&limit=10&",
                varname:"input",
                json:true,
                shownoresults:false,
                maxresults:10,
                callback: function (obj) { document.getElementById('testid').value = obj.id; }
            };
            var as_json = new bsn.AutoSuggest('username', options);        
             

   

    </script>

   

    @endsection