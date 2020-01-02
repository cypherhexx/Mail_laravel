@extends('app.admin.layouts.default')

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
             <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> {{trans('report.print')}}</a>
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
                        <th>{{trans('report.from_username')}}</th>
                        <th>{{trans('report.bonus_type')}}</th>
                        <th>{{trans('report.debit')}} (RM)</th>
                        <th>{{trans('report.credit')}} (RM)</th>
                        <th>{{trans('report.date')}} </th>
                        
                    </tr>
                </thead>
	            <tbody>
	            	@foreach($reportdata as $key=> $report)
	            	<tr>
	            		<td>{{$key +1 }}</td>	                   
	                    <td>{{$report->username}}</td>
	                    <td>{{$report->name}} {{$report->lastname}}</td>	                   
	                    <td>{{$report->email}}</td>
                        <td>{{$report->amount}}</td>
	                    <td>{{$report->symbol_left}} {{ number_format($report->value * $report->amount,2) }} {{$report->symbol_right}}</td>
	                    <td>{{$report->remarks}}</td>
	                    <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
					</tr>
	                @endforeach   
				</tbody>
        	</table>
        </div>
        	<div class="invoice-price">                       
            	<div class="invoice-price-right col-sm-offset-6">
                	{{trans('report.total_amount')}} {{$currency_sy}}{{$totalamount}}
                </div>
            </div>
    </div>
    <div class="invoice-footer text-muted">
    	<p class="text-center m-b-5">
        	{{trans('report.thank_you_for_your_business')}}
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