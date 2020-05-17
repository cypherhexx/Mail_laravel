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

             <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> {{trans('report.print')}}</a>

         </span>

     </div>

    <div class="invoice-content">

    	<div class="table-responsive">

    		<table class="table table-invoice">

    			<thead>

    				<tr>

    					<th>{{trans('report.no')}}</th>

                        <th>UserID</th>
                        <th>{{trans('report.username')}}</th>

    					<th>{{trans('report.fullname')}}</th>

                        <th>{{trans('report.position')}}</th>                        

                        <th>Transaction ({{$USER_CURRENCY->symbol_left}} {{ $USER_CURRENCY->symbol_right}})</th>                        

						<th>Transaction (BV)</th>                        

                        <th>{{trans('report.date')}} </th>

                        

                    </tr>

                </thead>

	            <tbody>



                    <?php  $total_rm = $total_bv = 0 ?>

	            	@foreach($reportdata as $key=> $report)

	            	<tr>

	            		<td>{{$key +1 }}</td>	                   

                        <td>{{$report->userid}}</td>                     
	                    <td>{{$report->username}}</td>	                   

                        <td>{{$report->name}} {{$report->lastname}}</td>

                        <td>{{$report->package}}</td>

                        

                        <td>{{number_format($USER_CURRENCY->value * $report->total_amount,2)}}</td>

	                    <td>{{number_format($report->BV)}}</td>



	                    <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>



                         <?php  $total_rm +=  $report->total_amount ;



                                $total_bv +=  $report->BV ?>

					</tr>

	                @endforeach  



                    <tr style="    color: #fff;    background: #2d353c;">

                        <th class="text-center" colspan="5">Total Transaction</th>

                        <th> {{$USER_CURRENCY->symbol_left}} {{number_format($USER_CURRENCY->value * $total_rm,2) }} {{$USER_CURRENCY->symbol_right}}</th>

                        <th>{{number_format($total_bv) }}</th>

                        <td></td>



                    </tr> 

				</tbody>

        	</table>

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