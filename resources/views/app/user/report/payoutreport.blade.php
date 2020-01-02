@extends('app.user.layouts.default')







{{-- Web site Title --}}



@section('title') {{{ $title }}} :: @parent @stop



@section('styles')



@parent





<link href="{{asset('assets/globals/plugins/choosen/css/chosen.css')}}" rel="stylesheet">











@endsection



{{-- Content --}}



@section('main')







      @include('utils.errors.list')







<div class="panel panel-success" >



	<div class="panel-heading">



    	<div class="panel-heading-btn">



			



            



            



            



        </div>



        <h4 class="panel-title">{{trans('report.payout_released_report')}}</h4>



     </div>



     <div class="panel-body"> 



     <form action="{{URL::to('user/payoutreport')}}" method="post">



     	<input type="hidden" name="_token"  value="{{csrf_token()}}">



     	<div class="row">



     		<div class="form-group col-sm-6">



	     		<label class="form-label col-sm-4">{{trans('report.pick_start_date')}}</label>



	     		<div class="col-sm-6">



	     			<div class="input-group"> 



	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="start" id="start"  required="true">



	     			<label for="start" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>



	     		







	     			</div>



	     		</div>



	     	</div>



	     	<div class="form-group col-sm-6">



	     		<label class="form-label col-sm-4">{{trans('report.pick_end_date')}}</label>



	     		<div class="col-sm-6">



	     			<div class="input-group"> 



	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="end" id="end"  required="true">



	     				<label for="end" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>



	     		



	     			</div>



	     		</div>



	     	</div>



     	</div>



     	<div class="row">	



	     	<div class="form-group col-sm-6">



	     		<label class="form-label col-sm-4">Username</label>



	     		<div class="col-sm-6">

	     			<input type="hidden" name="status" value="0">



	     			<select class="form-control chosen-select" name="username" id="username" required="true">



	     				<option value="all">All</option>

	     				@foreach($users as $item)

	     				<option value="{{$item['id']}}">{{$item['username']}}</option>

	     				@endforeach

	     			</select>







	     		</div>



	     	</div> 

	     	<div class="form-group col-sm-6">



	     		<label class="form-label col-sm-4">{{trans('report.position')}}</label>



	     		<div class="col-sm-6">



	     			<select class="form-control" name="position" id="position" required="true">



	     				<option value="all">All</option>

	     				@foreach($packages as $item)

		            			<option value="{{$item->id}}">{{$item->package}}</option>

	     				@endforeach

	     			</select>







	     		</div>



	     	</div> 







     	</div>
     	<div class="row">
     		<div class="form-group col-sm-6">

	     		<label class="form-label col-sm-4">User ID</label>

	     		<div class="col-sm-6">

	     			<select class="form-control chosen-select" name="user_id" id="user_id" required="true">

	     				<option value="all">All</option>
	     				@foreach($users as $item)
	     				<option value="{{$item['id']}}">{{$item['user_id']}}</option>
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





<script src="{{asset('assets/globals/plugins/choosen/js/chosen.jquery.js')}}"></script>



    <script>



        $(document).ready(function() {



            App.init(); 



            $(".datetimepicker").datepicker()          



        });

        var config = {



      '.chosen-select'           : {},



      '.chosen-select-deselect'  : {allow_single_deselect:true},



      '.chosen-select-no-single' : {disable_search_threshold:10},



      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},



      '.chosen-select-width'     : {width:"95%"}



    };



    for (var selector in config) {



      $(selector).chosen(config[selector]);



    }  



     $('#username').on('change',function(){

    		$('#position :selected').prop("selected", false);

    });





    $('#position').on('change',function(){



    		$('#username :selected').prop("selected", false);

    		 $('#username').trigger("chosen:updated");

    });

       







        



    </script>



    @endsection