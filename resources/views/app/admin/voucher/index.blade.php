@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title')  @parent
@stop
@section('styles')
@endsection
{{-- Content --}}
@section('main')
<table id="data-table" class="table table-striped table-bordered dataTable no-footer">
	@if($vouchers_count > 0)
	<thead>
		<tr role="row">
			<th style="background-color: #00ACAC;">Username</th>
			<th style="background-color: #00ACAC;">Voucher</th>
			<th style="background-color: #00ACAC;">Total amount</th>
			<th style="background-color: #00ACAC;">Balance amount</th>
			<th style="background-color: #00ACAC;">created date</th>                                           
		</tr>
	</thead>
	<tbody>    
	@foreach($vouchers as $voucher)
		<tr class="gradeC " role="row">
			<td class="sorting_1">{{$voucher->username}}</td>
			<td>{{$voucher->voucher_code}}</td>
			<td>{{$voucher->total_amount}}</td>
			<td>{{$voucher->balance_amount}}</td>
			<td>{{$voucher->created_at}}</td>
		   
		</tr>
	@endforeach    

	</tbody>
	@else
	 No vouchers yet !!
	@endif
</table>
  
@stop
{{-- Scripts --}}
@section('scripts')
@parent
    <script type="text/javascript"> 
     
             App.init();
             TableManageDefault.init();
       
    </script>
@stop
