@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}
@section('main')

<div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">View my voucher</h4>
                        </div>
                        <div class="panel-body">
							<table class="table table-condensed">
								<thead class="">
									<tr>
									<th>Sl No</th>
									<th>Amount</th>
									<th>Count</th>
									<th>Total Amount</th>
									<th>Status</th>
									<th>Date</th>
									</tr>
								</thead>
								<tbody>						
									
									@foreach ($all_vouchers as $key=>$voucher)
									<tr class="text-success text-bold">
									<td>{{$key +1 }}</td>
									<td>{{$voucher->amount}}</td>
									<td>{{$voucher->count}}</td>
									<td>{{$voucher->total_amount}}</td>
									<td>{{$voucher->status}}</td>
									<td>{{$voucher->created_at}}</td>
									</tr>
									@endforeach
								</tbody>
						</table>
 
    					</div>  
</div>      
        
  
@endsection
@section('scripts') @parent
<script type="text/javascript">
 App.init();
</script>


@stop
