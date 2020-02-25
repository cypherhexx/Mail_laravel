@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} @parent
@stop


@section('styles')
@endsection

{{-- Content --}}
@section('main')




<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">{{ trans('payout.payout') }}  </h4> 
                        </div>
                        <div class="panel-body"> 
                       @include('app.admin.layouts.payoutrecord')



    <table id="data-table" class="table table-striped ">
                                    @if($count_requests > 0)
                                    <thead>
                                        <tr role="row">
                                            <th>{{ trans('payout.username') }} </th>
                                            <th >{{ trans('payout.user_balance') }}</th>
                                            <th >{{trans('register.bank_account_details')}}</th>
                                            <!-- <th style="background-color: #008A8A;">{{trans('ticket_config.request_date')}}</th> -->
                                            <!-- <th style="background-color: #008A8A;">{{trans('ticket_config.status')}}</th> -->
                                            <th >{{ trans('payout.amount') }}({{$currency_sy}})</th> 
                                           <th></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>    
                                    @foreach($vocherrquest as $request)
                                        <tr class="gradeC " role="row">
                                            <td class="sorting_1">{{$request->username}}</td>
                                            <td>{{round($request->balance,2)}}</td>
                                            <td>{{trans('register.account_number')}} &nbsp;&nbsp;&nbsp;         : {{$request->account_number}}<br>
                                                {{trans('register.account_holder_name')}}: {{$request->account_holder_name}}<br>
                                                {{trans('register.bank_code')}} &nbsp;&nbsp;&nbsp;          : {{$request->bank_code}}<br>
                                            <!-- <td>{{$request->created_at}}</td> -->
                                            <td>
                                                <form action="{{URL::to('admin/payoutconfirm')}}" method="post">
                                                    <!-- <input type="hidden" value="{{csrf_token() }}" name="_token">
                                                    
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"value="{{$request->count}}" name="count">                                     
                                                    </div> -->
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" value="{{$request->payout_id}}" name="requestid">
                                                    <input type="hidden" value="{{$request->user_id}}" name="user_id">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                             <input type="text" class="form-control" value="{{round($request->amount,2)}}" name="amount">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-success" value="{{round($request->amount,2)}}" name="submit"><i class="fa fa-check" aria-hidden="true"></i> </button>
                                                            
                                                        </div>
                                                         <div class="col-sm-2">
                                                            <a type="submit" class="btn btn-danger" href="{{URL::to('admin/payoutreject/'.$request->payout_id.'/'.$request->amount)}}" name="reject"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                                            
                                                        </div>
                                                        

                                                    </div>
                                                   
                                                    
                                                </form>
                                            </td>                                                                                    
                                        </tr>
                                    @endforeach  



                                    </tbody>
                                    @else
                                      {{ trans('ticket_config.no_payout_request_so_far') }} !!
                                    @endif
                                </table>


                             <div class="text-center">   {!! $vocherrquest->render() !!} </div>


                       
                </div>
            </div>
  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
    <script type="text/javascript"> 
     
             App.init();
             TableManageDefault.init();
       
    </script>

<script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>
    
@stop
