
@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{$title}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
   
    <div class="panel-body">

     	<table class="table table-condensed">

			<thead class="">

				<tr>

					<th>{{trans('payout.sl_no')}}</th>

					<th>{{trans('report.amount_released')}}</th>
					<th>{{trans('report.amount_requested')}}</th>

					<th>{{trans('payout.status')}}</th>

					<th>{{trans('payout.date')}}</th>

				</tr>

			</thead>

			<tbody>

				<?php $i = 1; ?>
			<!-- 	{{dd($requests)}} -->

				@foreach ($requests as $request)

					<tr class="text-default text-bold">

						<td>{!!$i++!!}</td>

						<td> {{$currency_sy}} {{$request->released_amount}}</td>
						<td> {{$currency_sy}} {{$request->amount}}</td>
						<td>{!!$request->status!!}</td>
						  <td>{{ date('d M Y',strtotime($request->created_at))}}</td>
					</tr>

				@endforeach

			</tbody>

		</table>

    </div>        
  </div>
                  
@stop

 