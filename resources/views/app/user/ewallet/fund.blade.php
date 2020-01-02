@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{trans('wallet.fund_transfer')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    @include('app.user.layouts.fundrecord')
      <div class="panel-body">
        <div class="col-sm-12">
            <form action="{{url('user/fund-transfer')}}" class="smart-wizard form-horizontal" method="post"  >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
          <!--   <div class="form-group">
                <label class="control-label label label-primary">
                    {{trans('wallet.balance_amount')}} : {{$currency_sy}} {{$user_balance}}
                </label>
            </div> -->
            <div class="form-group">
                <label class="col-sm-4 control-label" for="username">
                    {{trans('wallet.enter_username')}}: <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <input type="text" id="username" name="username" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="amount">
                    {{trans('wallet.amount')}} : <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <input type="text" id="amount" name="amount" class="form-control" >
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="current_password">
                       {{trans('ewallet.transaction_password')}} 
                </label>
                 <div class="col-sm-5">
                <input class="form-control" name="oldpass" id="oldpass" autocomplete="new-password"  type="password"  >
                </input>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label" for="amount">
                </label>
                <div class="col-sm-5">
                     <button class="btn btn-info" tabindex="4" name="add_amount" id="add_amount" type="submit" value="Add Amount"> {{trans('wallet.add_amount')}}</button >              
                </div>
            </div>
   
        </form>
        </div>
 <!--        <div class="col-sm-6">
            <div class="alert alert-warning fade in m-b-15">
                <strong> {{trans('wallet.caution')}}!</strong>
                    {{trans('wallet.please_enter_id')}}
                    <span class="close" data-dismiss="alert">×</span>
            </div>
        </div> -->


    </div>
                    </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>
@stop



 