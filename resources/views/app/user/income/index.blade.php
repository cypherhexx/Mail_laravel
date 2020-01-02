@extends('app.user.layouts.default')



{{-- Web site Title --}}





@section('title') {{{ $title }}} :: @parent @stop





{{-- Content --}}



@section('main')





 @include('flash::message')





  <div class="panel panel-success" >



    <div class="panel-heading">



        <div class="panel-heading-btn">



            



            



            



            



        </div>



        <h4 class="panel-title">{{$title}}</h4>



    </div>



    <div class="panel-body">
    	<form action="{{URL::to('user/income')}}" method="post">

     	<input type="hidden" name="_token"  value="{{csrf_token()}}">


       <div class="form-group col-sm-6">

	     		<label class="form-label col-sm-3">{{trans('income.bonus_type')}}</label>

	     		<div class="col-sm-9">

	     			<select class="form-control" name="bonus_type" id="bonus_type" required="true">

	     					<option value="All">{{trans('income.overall')}}</option>
		            		<option value="direct_refer_bonus">{{trans('income.direct_refer_bonus')}</option>
		            		<option value="group_sales_bonus">{{trans('income.group_sales_bonus')}</option>
		            		<option value="reorder_bonus">{{trans('income.Reorder Bonus')}</option>
		            		<option value="share_bonus">{{trans('income.share_bonus')}</option>


	     			</select>



	     		</div>

	     	</div>	
       <div class="form-group col-sm-6">
       	<button class="btn btn-primary"> {{trans('income.filter')}}</button>
	     	</div>	


    	</form>
</div>
    <div class="panel-body">

	    <div class="row">

	    	<div class="col-sm-4">

	    		<h4> {{trans('income.income_details')}} : {{ucfirst($username)}} </h4> 

	    	</div>

	    	<div class="col-sm-3">

	    		<h4> {{trans('income.total_ewallet')}} : <label class="label label-primary">{{ round($balance,2)}}</label></h4>

	    	</div>

	    	<div class="col-sm-2">

	    		<h4> {{trans('income.total_pv')}} : <label class="label label-primary">{{ round($pv,2)}} </label></h4>

	    	</div>

	    	<div class="col-sm-3">

	    		<h4> {{trans('income.total_credit_points')}} : <label class="label label-primary"> {{round($redeem_pv,2)}} </label> </h4>

	    	</div>

	    </div>



    <hr>



	    <table class="table table-striped">

	    	<thead>

	    		<th> {{trans('income.username')}}</th>

	    		<th> {{trans('income.from_username')}}</th>

	    		<th> {{trans('income.bonus_type')}}</th>

	    		<th> {{trans('income.credit_points')}}</th>

	    		<th> {{trans('income.date')}}</th>

	    	</thead>

	    	<tbody>

	    	@foreach($data as $item)

	    		<tr>

	    			<td>{{$username}}</td>

	    			<td>{{ $item->username }}</td>

	    			<td>{{ str_replace('_',' ',$item->commision_type) }}</td>

	    			<td>{{ round($item->redeem_pv,2) }}</td>

	    			<td>{{ $item->created_at }}</td>

	    		</tr>    		

	    	@endforeach

	    	</tbody>

	    </table>







    </div>







</div> 

   





@endsection







@section('scripts') @parent 







<script src="{{ asset('assets/admin/js/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>







<script src="{{ asset('vendor\bllim\laravalid\public/jquery.validate.laravalid.js') }}"></script>







<script type="text/javascript">







$('form').validate({onkeyup: false});







App.init();



var arra;



$.get( 



        'getAllUsers',



         { sponsor: 'ghjgj' },



            function(response) {



                    if (response) {



                        month_users=response;



arra = month_users.split(",");



$("#username").autocomplete({source:arra});



}



});



</script>















@stop