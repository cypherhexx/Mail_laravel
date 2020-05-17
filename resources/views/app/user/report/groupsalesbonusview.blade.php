@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
<style type="text/css">
.invoice>div:not(.invoice-footer) {
    margin-bottom: 43px;
}
.invoice-price .invoice-price-right {
    padding: 3px;
}
</style>
@endsection
{{-- Content --}}
@section('main')

 <div class="invoice">

     <div class="invoice-company">
         <span class="pull-right hidden-print">                   
             <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
         </span>
     </div>
      
    <div class="invoice-content">
    	<div class="table-responsive">
    		<table class="table table-invoice">
    			<thead>
    				<tr>
    					<th>{{trans('report.no')}}</th>
                        <th>{{trans('report.username')}}</th>                                               
                        <th>{{trans('report.position')}}</th>                                               
                        <th>{{trans('report.sponsor')}}</th>                                               
                        <th>{{trans('report.total_group_sales_pv')}}</th>
                        <!-- <th>Total Group Sales ( {{ $USER_CURRENCY->symbol_left}} {{ $USER_CURRENCY->symbol_right}} )</th> -->
                        <th>{{trans('report.view_more')}}</th>
                        
                    </tr>
                </thead>
	            <tbody>
	            	@foreach($usernamedata as $key=> $report)
	            	<tr>
	            		<td>{{$key +1 }}</td>	                   
	                    <td>{{$report['username']}}</td>
	                    <td>{{$report['package']}}</td>	                   
                        <td>{{$report['sponsor']}}</td>
                        <td>{{ round($report['total_pv'],2)}}</td>
                        <!-- <td>{{ $USER_CURRENCY->symbol_left}} {{  round($USER_CURRENCY->value * $report['total_amount'],2)}} {{ $USER_CURRENCY->symbol_right}}</td> -->
                        
                        <td>
                            <form target="blank" method="post" action="{{ url('user/groupsalesbonusdetails/'.$report['user_id']) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" name="start" value="{{$request->start}}">
                                <input type="hidden" name="end" value="{{$request->end}}">
                                <input type="hidden" name="user_id" value="{{$report['user_id']}}">

                                <button type="submit" class="btn btn-primary">{{trans('report.view_more')}}</button>
                             </form>

                            </td>
	                    
					</tr>
	                @endforeach   
				</tbody>
        	</table>
        </div>
        	<div class="invoice-price">                       
            	<div class="invoice-price-right col-sm-offset-6">
                </div>
            </div>
    </div>
    <div class="invoice-footer text-muted">
    	<p class="text-center m-b-5">
        	{{trans('report.thank_you_for_business')}}
        </p>
       
      
        
    </div>
</div>             
@endsection



@section('scripts') @parent
    <script>
        $(document).ready(function() {
            App.init();                 
        });


       

        
    </script>
    @endsection