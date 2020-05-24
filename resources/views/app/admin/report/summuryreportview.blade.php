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





            <div class="col-sm-12 text-center"> 

                 <p> 

                    <strong>{{trans('report.nce_global_sdn_bhd')}}</br>

                    {{trans('report.incentive_statement_for')}} {{$request->start}}

                    </strong>

                </p>



            </div>



            <div class="col-sm-12">



            @if($user != NULL)

                <div class="row">

                    <div class="col-sm-6">

                        <table class="table">

                            <tr>

                                <td>{{trans('report.id')}}   :</td> <td> {{$user->user_id}}</td>

                            </tr>

                            <tr>

                                <td> {{trans('report.name')}} :</td> <td> {{$user->name}}  {{$user->lastname}}</td>

                            </tr>

                            <tr>

                                <td> {{trans('report.address')}}:</td> <td> {{$user->address1}}{{$user->address2}}</td>

                            </tr>

                        </table>

                    </div>

            </div>



            @endif





                <div class="col-sm-4">

                    <table class="table">

                    <tr>

                        <td> {{trans('report.direct_sponsor_bonus')}}</td>

                        <td>{{trans('report.rm')}}  {{number_format($total_direct_sponsor,2)}}  </td>

                    </tr>

                   

                    <tr>

                        <td>{{trans('report.pairing_bonus')}}</td>

                        <td>{{trans('report.rm')}} {{ number_format( $total_pairing_bonus[0]->first_bonus +  $total_pairing_bonus[0]->second_bonus + $total_pairing_bonus[0]->third_bonus,2)}} </td>

                    </tr>



                    <tr>

                        <td>{{trans('report.matching_bonus')}}</td>

                        <td>{{trans('report.rm')}} {{number_format($total_matching_bonus,2)}} </td>

                    </tr>



                     <tr>

                        <td>{{trans('report.loyalty_bonus')}}</td>

                        <td>{{trans('report.rm')}} {{ number_format($totaloyalty_bonus,2)}}  </td>

                    </tr>



                </table>

                </div>



                

            </div>



        </div>



    </div>

     

    <div class="invoice-content">

    	<div class="table-responsive">

             <p>

                <strong>{{trans('report.direct_sponsor_bonus')}}</strong>

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

                        <td>RM {{number_format($report->payable_amount,2)}}</td>

	                    <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>

					</tr>

	                @endforeach  

                    <tr  style="background: #2d353c;color: #fff;font-size: 20px;" >

                        <th colspan="3" class="text-center">l{{trans('report.total')}} </th>

                        <th colspan="2">{{trans('report.rm')}} {{number_format($total_direct_sponsor,2)}}</th>



                    </tr> 

				</tbody>

        	</table>

        </div>

    </div>







    <div class="invoice-content">

        <div class="table-responsive">

             <p>

                <strong>{{trans('report.pairing_bonus')}}</strong>

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

                                    <td>{{trans('report.bv')}}</td>

                                    <td>{{trans('report.rm')}}</td>

                                </tr>

                            </table>

                        </th>

                        <th>

                            <table class="table table-bordered">

                                <tr class="info">

                                    <td> %</td>

                                    <td>{{trans('report.bv')}}</td>

                                    <td>{{trans('report.rm')}}</td>

                                </tr>

                            </table>

                        </th>

                        <th>

                            <table class="table table-bordered">

                                <tr class="info">

                                    <td> %</td>

                                    <td>{{trans('report.bv')}}</td>

                                    <td>{{trans('report.rm')}}</td>

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

                                    <td>RM {{number_format($report->first_bonus,2)}}</td>

                                </tr>

                            </table>

                        </td>

                        <td>

                            <table class="table table-bordered">

                                <tr class="active">

                                    <td> {{round($report->second_percent)}}</td>

                                    <td>{{round($report->second_amount)}}</td>

                                    <td>RM {{number_format($report->second_bonus,2)}}</td>

                                </tr>

                            </table>

                        </td>

                        <td>

                            <table class="table table-bordered">

                                <tr class="active">

                                    <td> {{round($report->third_percent)}}</td>

                                    <td>{{round($report->third_amount)}}</td>

                                    <td>RM {{number_format($report->third_bonus,2)}}</td>

                                </tr>

                            </table>

                        </td>

                        

                        

                        <td>{{ date('d F Y H:i:s',strtotime($report->created_at))}}</td>

                    </tr>

                    @endforeach  

                    <tr class="text-right" style="background: #2d353c;color: #fff;font-size: 20px;">

                        <th colspan="4" class="text-center">{{trans('report.total')}}</th>

                        

                        <th class="">{{trans('report.rm')}} {{ number_format($total_pairing_bonus[0]->first_bonus+ $total_pairing_bonus[0]->second_bonus + $total_pairing_bonus[0]->third_bonus,2)}}</th>
                        <th class=""></th> 



                    </tr> 

                </tbody>

            </table>

        </div>

    </div>





     <div class="invoice-content">

        <div class="table-responsive">

             <p>

                <strong>{{trans('report.matching_bonus')}}</strong>

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

                        <td>RM {{number_format($report->payable_amount,2)}}</td>

                        <td>{{ date('d F Y H:i:s',strtotime($report->created_at))}}</td>

                    </tr>

                    @endforeach  

                    <tr style="background: #2d353c;color: #fff;font-size: 20px;">

                        <th colspan="3" class="text-center">{{trans('report.total')}} </th>

                        <th colspan="2">{{trans('report.rm')}}  {{number_format($total_matching_bonus,2)}}</th>



                    </tr> 

                </tbody>

            </table>

        </div>

    </div>







  <div class="invoice-content">

        <div class="table-responsive">

             <p>

                <strong>{{trans('report.loyalty_bonus')}} </strong>

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

                        <td>RM {{number_format($report->payable_amount,2)}}</td>

                        <td>{{ date('d F Y H:i:s',strtotime($report->created_at))}}</td>

                    </tr>

                    @endforeach  

                    <tr style="background: #2d353c;color: #fff;font-size: 20px;">

                        <th colspan="3" class="text-center">{{trans('report.total')}} </th>

                        <th colspan="2">{{trans('report.rm')}}  {{number_format($totaloyalty_bonus,2)}}</th>



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