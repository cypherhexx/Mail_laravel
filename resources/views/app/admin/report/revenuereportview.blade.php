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





     <div class="invoice-header">

        <div class="invoice-from">

            <address class="m-t-5 m-b-5">

                <strong>From:  </strong> {{ date('d M  Y',strtotime($request->start)) }} <br>

                 <strong> To:   </strong>{{ date('d M  Y',strtotime($request->end)) }}

               

                </address>

        </div>

        <div class="invoice-date">

            <div class="date m-t-5"></div>

            <div class="invoice-detail">  

            <p>

                <strong>{{trans('report.username')}}:  </strong> {{ isset($user) ? $user->username : 'All'  }} <br>
                <strong>{{trans('report.userid')}}:  </strong> {{ isset($user) ? $user->user_id : 'All'  }} <br>

                <!-- User ID: - <br> -->

                  <strong>{{trans('report.bonus_type')}}:  </strong>  {{ ucfirst(str_replace('_',' ',$request->bonus_type)) }} <br>

            </p>              



            </div>

        </div>

    </div>





    <div class="invoice-content">

    	<div class="table-responsive">

    		<table class="table table-invoice">

    			<thead>

    				<tr>

    					<th> {{trans('report.total_sales')}}</th>

                        <th> {{trans('report.rm')}} {{ number_format($total_sales,2) }} </th>                       

                    </tr>

                    <tr>

                        <th>{{trans('report.total_payout')}}</th> 

                        <th>{{trans('report.rm')}} {{  number_format($payout,2) }}</th>

                        <th> {{ number_format($payout * 100/$total_sales,2) }} % </th>

                    </tr>

                </thead>

	            <tbody>

                    <tr r style="    background: #2d353c;    color: #fff;">

                        <th>{{trans('report.revenue')}} </th>

                        <th>    {{trans('report.rm')}}  {{  number_format($revenue =  $total_sales -  $payout,2) }}  </th>

                        <th>         {{ round($revenue * 100/$total_sales,2) }} % </th>

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