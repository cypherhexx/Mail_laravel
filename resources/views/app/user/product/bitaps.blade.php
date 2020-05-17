@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('main')
 @include('utils.errors.list')
 @include('utils.vendor.flash.message') 


    <div class="col-md-6 col-md-offset-3">
<div class="row" style="align-items: center;">
        <div class="panel panel-default">
             <div class="panel-body">
                <div class="text-center">
               
                <h5 class="mb-0">Bitcoin Payment</h5>
                                <!-- <span class="d-block text-muted">All fields are required</span> -->
                </div>
       
                    <div class="form-group">
                       <div class="text-center">
                        <label for="cardNumber">BTC {{$package_amount}} </label>
                        <div class="input-group" style="margin: 0 auto;">

                            <input type="text" class="form-control selectall copyfrom form-control" readonly="" id="cardNumber" value="{{$payment_details->address}}" style="width:318px;" 
                                required autofocus />
                          <!--   <span class="input-group-addon"  data-clipboard-target="#replicationlink"> <i class="fa fa-copy"></i> </span> -->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                         <div class="text-center" style="margin: 0 auto;">
                            <img src="https://bitaps.com/api/qrcode/png/{{$payment_details->address}}">
                        </div>                         
                    </div>                     

                    <p>
                     Make your payment <b>BTC {{$package_amount}}</b> ie <b>€{{$pay_amount}}</b> for the package {{$package->package}} worth amount {{$package->amount}} for payment period {{$period}}ly to the above wallet, when your payment processed, you will redirect to preview

                    </p>


            <span> <img class="ajax-loader" src="{{ url('assets/pp.gif')}}"> <span class="loader-text">Waiting for you payment</span></span>
                                                        
            </div>
        </div>
    </div>
</div>

                

@endsection @section('scripts') @parent 

   
 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('ajax/get-bitaps-status/'.$trans_id)}}", function( data ) { 
                 if(data['status'] == 'complete'){
                        window.location.href = 'purchase/preview/'+data['id'];
                 }
                 
            });
     }, 4000);

 </script>
@endsection