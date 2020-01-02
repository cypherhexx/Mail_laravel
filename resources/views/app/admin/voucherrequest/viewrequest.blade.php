@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title')  @parent
@stop
@section('styles')
@endsection
{{-- Content --}}
@section('main')

@include('utils.vendor.flash.message')


<div class="panel panel-flat" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">{{trans('ticket_config.view_voucher_requests')}}</h4>
                        </div>
                        <div class="panel-body">
							<table class="table table-condensed">
							@if($voucher_count > 0)
								<thead class="">
									<tr>
										<th>{{trans('ticket_config.username')}}</th>
										<th>{{trans('ticket_config.voucher_amount')}} ({{$currency_sy}}) </th>
										<th>{{trans('ticket_config.count')}}</th>
										<th>{{trans('ticket_config.total_amount')}} ({{$currency_sy}}) </th>
										<th>{{trans('ticket_config.request_date')}}</th>
										<th>{{trans('ticket_config.approve')}}</th>
										<th>{{trans('ticket_config.delete')}}</th>
									</tr>
								</thead>
								<tbody>						
									
									@foreach($vocherrquest as $request)
									<tr >
									<td class="sorting_1">{{$request->username}}</td>
									<td>{{$request->amount}}</td>
									<td>{{$request->count}}</td>
									<td> {{$request->total_amount}}</td>
									<td>{{$request->created_at}}</td>
									<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{{$request->id}}"><i class="fa fa-check" aria-hidden="true"></i></button>

									  <!-- Modal -->
									  <div class="modal fade" id="myModal{{$request->id}}" role="dialog">
									    <div class="modal-dialog">
									    
									      <!-- Modal content-->
									      <div class="modal-content">
									        <div class="modal-header ">
									          <button type="button" class="close" data-dismiss="modal">&times;</button>
									          <h4 class="modal-title text-danger">{{trans('ticket_config.edit_request')}}</h4>
									        </div>
									        <div class="modal-body">
									         
									          <div class="col-sm-12">
													<div class="col-sm-4">
									          {{trans('ticket_config.username')}}
									          </div>
									          <div class="col-sm-8">
									           {{$request->username}}
									           </div>
									           </div>
									           <br>
									           <br>
										          <form action="{{URL::to('admin/vouchercreate')}}" method="post">
												<input type="hidden" value="{{csrf_token() }}" name="_token">
												<input type="hidden" value="{{$request->id}}" name="requestid">
													
													
													<div class="col-sm-12">
													<div class="col-sm-4">
													Amount
													</div>
													<div class="col-sm-8">
														<input type="number" class="form-control" value="{{$request->amount}}" name="amount" min="1">
														</div>                                     
													</div>
													<br>
													<br>
													<div class="col-sm-12">
													<div class="col-sm-4">
														{{trans('ticket_config.count')}}
														</div>
														<div class="col-sm-8">

														<input type="number" class="form-control" value="{{$request->count}}" name="count" min="1">
														</div>                                     
													
													</div>
													<br>
													<br>
													
											
									        </div>
									        <div class="modal-footer">

													
												<button type="submit" class="btn btn-success" name="submit">{{trans('ticket_config.approve')}} </button>
												
									          <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('ticket_config.cancel')}}</button>
									        </div>
									        </form>
									      </div>
									      
									    </div>
									  </div>
									  
									</td>
									<td>


											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2{{$request->id}}"><i class="fa fa-remove" aria-hidden="true"></i></button>

											

									  <!-- Modal -->
									  <div class="modal fade" id="myModal2{{$request->id}}" role="dialog">
									    <div class="modal-dialog">
									    
									      <!-- Modal content-->
									      <div class="modal-content">
									        <div class="modal-header ">
									          <button type="button" class="close" data-dismiss="modal">&times;</button>
									          <h4 class="modal-title text-danger">{{trans('ticket_config.delete_request')}}</h4>
									        </div>
									        <div class="modal-body">
									          <p>{{trans('ticket_config.username')}} {{$request->username}}</p>
										          <form action="{{URL::to('admin/voucherdelete')}}" method="post">
												<input type="hidden" value="{{csrf_token() }}" name="_token">
												<input type="hidden" value="{{$request->id}}" name="requestid">
												<center> <h4> {{trans('ticket_config.Are_You_Sure_You_Want_To_Delete')}} <h4></center>
												

									        </div>
									        <div class="modal-footer">													
												<button type="submit" class="btn btn-success" name="submit">{{trans('ticket_config.delete')}} </button>
												
									          <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('ticket_config.cancel')}}</button>
									        </div>
									        </form>
									      </div>
									      
									    </div>
									  </div>
									 
									</td>
									</tr>
									@endforeach
									@else
										{{trans('ticket_config.there_is_no_voucher_requests_yet')}} !!
							@endif
								</tbody>
						</table>
 
    					</div>  
</div>      

 {!! $vocherrquest->render() !!}



  
@stop
