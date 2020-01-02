@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main')
<div class="row">
<div class="col-sm-6">
<div class="panel panel-flat ">
    <div class="panel-heading">
        <h6 class="panel-title">{{trans('all.create_voucher')}}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

		
		 <form action="{{URL::to('admin/voucherlist')}}" class="smart-wizard form-horizontal" method="post">
		 <input name="_token" type="hidden" value="{{{ csrf_token() }}}"/>
		

			<div class="form-group">
				<label class="col-lg-3 control-label"> {{trans('all.amount')}}:</label>
				<div class="col-lg-9">
					<input autocomplete="off" class="form-control" name="amount" required="" type="text"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-3 control-label">  {{trans('all.count')}}:</label>
				<div class="col-lg-9">
					 <input autocomplete="off" class="form-control" name="count" required="" type="text"/>
				</div>
			</div>
			<div class="text-right">
				<button type="submit" id="add_amount" name="add_amount" class="btn btn-primary">{{trans('all.create_new_voucher')}}<i class="icon-arrow-right14 position-right"></i></button>
			</div>



             

		 </form>

    </div>

</div>
</div>
</div>
<div class="row">
	<div class="col-sm-12">
	<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Voucher list 
								<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>			                		
			                	</ul>
		                	</div>
						</div>

						
			<div class="table-responsive">
				<table class="table">
				    <thead>
                        <tr>
                            <th>
                                {{trans('all.no')}}
                            </th>
                            <th>
                                {{trans('all.voucher_code')}}
                            </th>
                            <th>
                                {{trans('all.total_amount')}} ({{$currency_sy}})
                            </th>
                            <th>
                                {{trans('all.balance_amount')}} ({{$currency_sy}})
                            </th>
                            <th>
                                {{trans('all.created_at')}}
                            </th>
                            <th>
                                {{trans('all.action')}}
                            </th>
                        </tr>
                    </thead>
					<tbody>
                        @foreach($vhr as $key=>$request)
                        <tr>
                            <td>
                                {{ ($vhr->currentPage() - 1 ) * $vhr->perPage()  +$key +  1 }}
                            </td>
                            <td>
                                <input type="text" name="vcode" readonly="true" class="form-control selectall" value="{{$request->voucher_code}}"/>
                            </td>
                            <td>
                                {{$request->total_amount}}
                            </td>
                            <td>
                                {{$request->balance_amount}}
                            </td>
                            <td>
                                {{ date('d M Y',strtotime($request->created_at)) }}
                            </td>
                            <td>
                                <button class="btn btn-info" data-target="#myModal{{$request->id}}" data-toggle="modal" type="button">
                                   <i class="fa fa-edit"></i>
                                </button>
                                <div class="modal fade" id="myModal{{$request->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close" data-dismiss="modal" type="button">
                                                    ×
                                                </button>
                                                <h4 class="modal-title">
                                                    {{trans('all.edit')}}
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form action="{{URL::to('admin/updatevoucher')}}" method="post">
                                                    <input name="_token" type="hidden" value="{{csrf_token() }}">
                                                        <input name="requestid" type="hidden" value="{{$request->id}}">
                                                            <div class="col-sm-12">
                                                                <div class="col-sm-4">
                                                                    {{trans('all.amount')}}
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control" min="1" name="amount" type="number" value="{{$request->total_amount}}">
                                                                    </input>
                                                                </div>
                                                            </div>
                                                            
                                                        </input>
                                                    </input>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <br><br>
                                                <button class="btn btn-success" name="submit" type="submit">
                                                                {{trans('all.update')}}
                                                            </button>
                                                <button class="btn btn-default" data-dismiss="modal" type="button">
                                                    {{trans('all.close')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                                <button class="btn btn-danger" data-target="#myModal2{{$request->id}}" data-toggle="modal" type="button">
                                   <i class="fa fa-trash"></i>
                                </button>
                                <div class="modal fade" id="myModal2{{$request->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <button class="close" data-dismiss="modal" type="button">
                                                    ×
                                                </button>
                                                <h4 class="modal-title text-danger">
                                                    {{trans('all.delete')}}
                                                </h4>
                                            </div>
                                            <form action="{{URL::to('admin/deleteconfirm')}}" method="post">
                                            <div class="modal-body">
                                                <p>
                                                    Voucher Code :{{$request->voucher_code}}
                                                </p>
                                                
                                                    <input name="_token" type="hidden" value="{{csrf_token() }}">
                                                        <input name="requestid" type="hidden" value="{{$request->id}}">
                                                            <center>
                                                                <h4>
                                                                    {{trans('all.Are_You_Sure_You_Want_To_Delete')}}
                                                                    <h4>
                                                                    </h4>
                                                                </h4>
                                                            </center>
                                                        </input>
                                                    </input>
                                               
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-success" name="submit" type="submit">
                                                    {{trans('all.delete')}}
                                                </button>
                                                <button class="btn btn-danger" data-dismiss="modal" type="button">
                                                    {{trans('all.cancel')}}
                                                </button>
                                            </div>
                                             </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach  

                    </tbody>
				</table>
            </div>
        </div>
        <div class="dataTables_paginate paging_simple_numbers" id="users-table_paginate">
                 {{$vhr->links()}}
             </div>
	</div>

</div>

@endsection