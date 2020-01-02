
@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{trans('voucher.view_my_voucher')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    		<table class="table table-condensed">
								<thead class="">
									<tr>
									<th>{{trans('voucher.sl_no')}}</th>
									<th>{{trans('voucher.amount')}}</th>
									<th>{{trans('voucher.voucher_code')}}</th>
									<th>{{trans('voucher.created_at')}}</th>
									</tr>
								</thead>
								<tbody>						
									
									@foreach ($my_vouchr as $key=>$voucher)
									<tr >
									<td>{{$key +1 }}</td>
									<td>{{$voucher->total_amount}}</td>
									
									
									<td>{{$voucher->voucher_code}}</td>
									<td>{{$voucher->created_at}}</td>
									</tr>
									@endforeach
								</tbody>
						</table>
          





                        
  </div>
                  
@stop
 

 