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
    <!--  <div class="invoice-header">
     	<div class="invoice-from">
     		<address class="m-t-5 m-b-5">
     			<strong>Cloud MLM software</strong>
                            City, Zip Code<br>
                            Phone: (123) 456-7890<br>
                            email: info@cloudmlmsoftware.com
                </address>
        </div>
        <div class="invoice-date">
        	<div class="date m-t-5">{{ date('F d, Y') }}</div>
        	<div class="invoice-detail">
        		Payout released report
        	</div>
        </div>
    </div> -->
    <div class="invoice-content">
    	<div class="table-responsive">
    		<table class="table table-invoice">
    			<thead>
    				<tr>
    					<th>{{trans('report.no')}}</th>
                        <th>{{trans('report.username')}}</th>                        
    				    <th>{{trans('report.from_user')}}</th>                        
                        <th>{{trans('report.bonus')}}</th>
                        <th>{{trans('report.credit_points')}}</th>
                        <th>{{trans('report.get_report')}}</th>
                        <th>{{trans('report.get_report')}} </th>
                        
                    </tr>
                </thead>
	            <tbody>
	            	@foreach($reportdata as $key=> $report)
	            	<tr>
	            		<td>{{$key +1 }}</td>	                   
	                    <td>{{$report->tousername}}</td>
	                    <td>{{$report->fromusername}}</td>	                   
                        <td>{{number_format($report->pv,2)}}</td>
                        <td>{{ number_format($report->redeem_pv,2) }}</td>
	                    <td>{{str_replace('_',' ',$report->commision_type)}}</td>
                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
	                    
					</tr>
	                @endforeach   
				</tbody>
        	</table>
        </div>
        	<div class="invoice-price">                       
            	<div class="invoice-price-right col-sm-offset-6">
                	{{trans('report.total_bonus')}} {{ number_format($totalpv,2)}} , {{trans('report.total_credits_points')}} {{ number_format($totalredeem_pv,2)}}
                </div>
            </div>
    </div>
    <div class="invoice-footer text-muted">
    	<p class="text-center m-b-5">
        	{{trans('report.thank_you_for_business')}}
        </p>
       
       <!--  <p class="text-center">
        	<span class="m-r-10"><i class="fa fa-globe"></i> cloudmlmsoftware.com</span>
            <span class="m-r-10"><i class="fa fa-phone"></i> T:016-18192302</span>
            <span class="m-r-10"><i class="fa fa-envelope"></i> info@cloudmlmsoftware.com</span>
        </p> -->
        
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