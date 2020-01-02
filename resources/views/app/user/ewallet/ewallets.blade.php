 <div class="panel panel-success" >
    
   <div class="panel-body">
        <div class="row">           
            <div class="col-sm-4">

                <h4> {{trans('wallet.total_credit')}}   : <label class="">{{$USER_CURRENCY->symbol_left}} {{ number_format($USER_CURRENCY->value *$credit,2)}} {{$USER_CURRENCY->symbol_right}}</label></h4>
                
            </div>
            <div class="col-sm-4">
                <h4> {{trans('wallet.total_debit')}} : <label class="">{{$USER_CURRENCY->symbol_left}} {{ number_format($USER_CURRENCY->value *$payout,2)}} </label></h4>
            </div>
            <div class="col-sm-4">
                <h4> {{trans('wallet.balance_amount')}} : <label style="    font-weight: 700;" class="">{{$USER_CURRENCY->symbol_left}} {{ number_format($USER_CURRENCY->value *$balance,2)}} </label></h4>
            </div>
           
        </div>       
    </div>
    <hr>
</div>