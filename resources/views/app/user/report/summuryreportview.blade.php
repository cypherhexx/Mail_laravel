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



     <div class="invoice-header">

        <div class="invoice-from">





            <div class="col-sm-12 text-center"> 

                 <p> 

                    <strong>NCE GLOBAL SDN BHD </br>

                    INCENTIVE STATEMENT FOR {{$request->start}}

                    </strong>

                </p>



            </div>



            <div class="col-sm-12">



            @if($user != NULL)

                <div class="row">

                    <div class="col-sm-6">

                        <table class="table">

                            <tr>

                                <td> ID     :</td> <td> {{$user->user_id}}</td>

                            </tr>

                            <tr>

                                <td> Name   :</td> <td> {{$user->name}}  {{$user->lastname}}</td>

                            </tr>

                            <tr>

                                <td> Address :</td> <td> {{$user->address1}}{{$user->address2}}</td>

                            </tr>

                        </table>

                    </div>

            </div>



            @endif





                <div class="col-sm-4">

                    <table class="table">

                    <tr>

                        <td> Direct Sponsor Bonus </td>

                        <td> {{$USER_CURRENCY->symbol_left}} {{number_format(  $USER_CURRENCY->value * $total_direct_sponsor,2)}}   {{$USER_CURRENCY->symbol_right}} </td>

                    </tr>

                   

                    <tr>

                        <td>Pairing Bonus</td>

                        <td> {{$USER_CURRENCY->symbol_left}} {{ number_format(  $USER_CURRENCY->value * ($total_pairing_bonus[0]->first_bonus +  $total_pairing_bonus[0]->second_bonus + $total_pairing_bonus[0]->third_bonus),2)}}  {{$USER_CURRENCY->symbol_right}} </td>

                    </tr>



                    <tr>

                        <td>Matching Bonus</td>

                        <td> {{$USER_CURRENCY->symbol_left}} {{number_format( $USER_CURRENCY->value * $total_matching_bonus,2)}}  {{$USER_CURRENCY->symbol_right}} </td>

                    </tr>



                     <tr>

                        <td> Loyalty Bonus </td>

                        <td> {{$USER_CURRENCY->symbol_left}} {{ number_format($USER_CURRENCY->value * $totaloyalty_bonus,2)}}   {{$USER_CURRENCY->symbol_right}}</td>

                    </tr>



                </table>

                </div>



                

            </div>



        </div>



    </div>

     

    <div class="invoice-content">

    	<div class="table-responsive">

             <p>

                <strong>Direct sponsor bonus</strong>

                <hr>

            </p>



    		<table class="table table-invoice">

    			<thead>

    				<tr>

    					<th>{{trans('report.no')}}</th>

                        <th>{{trans('report.username')}}</th>                        

                        <th>{{trans('report.from_username')}}</th>

                        <th>{{trans('report.bonus')}}</th>

                        <th>{{trans('report.date')}} </th>                     

                    </tr>

                </thead>

	            <tbody>

	            	@foreach($direct_sponsor as $key=> $report)

	            	<tr>

	            		<td>{{$key +1 }}</td>	                   

                        <td>{{$report->username}}</td>                     

                        <td>{{$report->fromuser}}</td>

                        <td>  {{$USER_CURRENCY->symbol_left}}   {{number_format(  $USER_CURRENCY->value * $report->payable_amount,2)}}  {{$USER_CURRENCY->symbol_right}} </td>

	                    <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>

					</tr>

	                @endforeach  

                    <tr style=" color: #fff;    background: #2d353c;font-size: 20px;" >

                        <th colspan="3" class="text-center">Total</th>

                        <th colspan="2"> {{$USER_CURRENCY->symbol_left}}   {{number_format(  $USER_CURRENCY->value * $total_direct_sponsor,2)}}  {{$USER_CURRENCY->symbol_value}} </th>



                    </tr> 

				</tbody>

        	</table>

        </div>

    </div>







    <div class="invoice-content">

        <div class="table-responsive">

             <p>

                <strong>Pairing bonus</strong>

                <hr>

            </p>



            <table class="table table-invoice">

                <thead>

                    <tr>

                        <th>{{trans('report.no')}}</th>

                        <th class="text-center">{{trans('report.username')}}</th>                        

                        <th>

                            <table class="table table-bordered">

                                <tr class="info">

                                    <td> %</td>

                                    <td>BV</td>

                                    <td>RM</td>

                                </tr>

                            </table>

                        </th>

                        <th>

                            <table class="table table-bordered">

                                <tr class="info">

                                    <td> %</td>

                                    <td>BV</td>

                                    <td>RM</td>

                                </tr>

                            </table>

                        </th>

                        <th>

                            <table class="table table-bordered">

                                <tr class="info">

                                    <td> %</td>

                                    <td>BV</td>

                                    <td>RM</td>

                                </tr>

                            </table>

                        </th>

                        

                        <th>{{trans('report.date')}} </th>                     

                    </tr>

                </thead>

                <tbody>

                    @foreach($pairing_bonus as $key=> $report)

                    <tr>

                        <td>{{$key +1 }}</td>                      

                        <td>{{$report->username}}</td>

                        <td>

                            <table class="table table-bordered">

                                <tr class="active">

                                    <td> {{round($report->first_percent)}}</td>

                                    <td>{{round($report->first_amount)}}</td>

                                    <td> {{$USER_CURRENCY->symbol_left}} {{number_format( $USER_CURRENCY->value * $report->first_bonus,2)}} {{$USER_CURRENCY->symbol_right}} </td>

                                </tr>

                            </table>

                        </td>

                        <td>

                            <table class="table table-bordered">

                                <tr class="active">

                                    <td> {{round($report->second_percent)}}</td>

                                    <td>{{round($report->second_amount)}}</td>

                                    <td> {{$USER_CURRENCY->symbol_left}} {{number_format( $USER_CURRENCY->value * $report->second_bonus,2)}} {{$USER_CURRENCY->symbol_right}} </td>

                                </tr>

                            </table>

                        </td>

                        <td>

                            <table class="table table-bordered">

                                <tr class="active">

                                    <td> {{round($report->third_percent)}}</td>

                                    <td>{{round($report->third_amount)}}</td>

                                    <td> {{$USER_CURRENCY->symbol_left}}  {{number_format(  $USER_CURRENCY->value * $report->third_bonus,2)}}  {{$USER_CURRENCY->symbol_right}} </td>

                                </tr>

                            </table>

                        </td>

                        

                        

                        <td>{{ date('d M Y',strtotime($report->created_at))}}</td>

                    </tr>

                    @endforeach  

                    <tr class="text-right" style=" color: #fff;    background: #2d353c;font-size: 20px;">

                        <th colspan="4" class="text-center">Total</th>

                        

                        <th class=""> {{$USER_CURRENCY->symbol_left}}  {{ number_format(  $USER_CURRENCY->value * ($total_pairing_bonus[0]->first_bonus + $total_pairing_bonus[0]->second_bonus + $total_pairing_bonus[0]->third_bonus),2)}}  {{$USER_CURRENCY->symbol_right}} </th>
                        <th></th>



                    </tr> 

                </tbody>

            </table>

        </div>

    </div>





     <div class="invoice-content">

        <div class="table-responsive">

             <p>

                <strong>Matching bonus</strong>

                <hr>

            </p>



            <table class="table table-invoice">

                <thead>

                    <tr>

                        <th>{{trans('report.no')}}</th>

                        <th>{{trans('report.username')}}</th>                        

                        <th>{{trans('report.from_username')}}</th>

                        <th>{{trans('report.bonus')}}</th>

                        <th>{{trans('report.date')}} </th>                     

                    </tr>

                </thead>

                <tbody>

                    @foreach($matching_bonus as $key=> $report)

                    <tr>

                        <td>{{$key +1 }}</td>                      

                        <td>{{$report->username}}</td>                     

                        <td>{{$report->fromuser}}</td>

                        <td>  {{$USER_CURRENCY->symbol_left}}  {{number_format( $USER_CURRENCY->value  *  $report->payable_amount,2)}}  {{$USER_CURRENCY->symbol_right}} </td>

                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>

                    </tr>

                    @endforeach  

                    <tr style=" color: #fff;    background: #2d353c;font-size: 20px;" >

                        <th colspan="3" class="text-center">Total</th>

                        <th colspan="2"> {{$USER_CURRENCY->symbol_left}}  {{number_format( $USER_CURRENCY->value * $total_matching_bonus,2)}}  {{$USER_CURRENCY->symbol_right}} </th>



                    </tr> 

                </tbody>

            </table>

        </div>

    </div>







  <div class="invoice-content">

        <div class="table-responsive">

             <p>

                <strong>Loyalty bonus</strong>

                <hr>

            </p>



            <table class="table table-invoice">

                <thead>

                    <tr>

                        <th>{{trans('report.no')}}</th>

                        <th>{{trans('report.username')}}</th>                        

                        <th>{{trans('report.from_username')}}</th>

                        <th>{{trans('report.bonus')}}</th>

                        <th>{{trans('report.date')}} </th>                     

                    </tr>

                </thead>

                <tbody>

                    @foreach($loyalty_bonus as $key=> $report)

                    <tr>

                        <td>{{$key +1 }}</td>                      

                        <td>{{$report->username}}</td>                     

                        <td>{{$report->fromuser}}</td>

                        <td> {{$USER_CURRENCY->symbol_left}}  {{number_format($USER_CURRENCY->value * $report->payable_amount,2)}}  {{$USER_CURRENCY->symbol_right}} </td>

                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>

                    </tr>

                    @endforeach  

                    <tr style=" color: #fff;    background: #2d353c;font-size: 20px;" >

                        <th colspan="3" class="text-center">Total</th>

                        <th colspan="2">{{$USER_CURRENCY->symbol_left}}  {{number_format($USER_CURRENCY->value * $totaloyalty_bonus,2)}} {{$USER_CURRENCY->symbol_right}}</th>



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







@section('scripts')

 @parent

    <script>

        $(document).ready(function() {

            App.init();                 

        });        

    </script>

    @endsection