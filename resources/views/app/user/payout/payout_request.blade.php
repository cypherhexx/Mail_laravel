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
  @include('utils.errors.list') 
  @include('app.user.layouts.payoutdetails')
        {!! Form::open(array('url' => 'user/request','enctype'=>'multipart/form-data'),$rules) !!}

          <!-- <div class="form-group">

                <label class="control-label label label-primary">

        {{trans('payout.balance_amount')}} :$ {{$user_balance}}

                </label>

            </div> -->

            <div class="row">

              <div class="col-sm-4 col-md-offset-3">

               {!!  Form::label('req_amount', trans("payout.request_amount") ,array('class'=>'control-label'))  !!}  

            {!!  Form::text('req_amount',$payout_balance, array('class'=>'form-control','required'=>'true' ))  !!}

              </div>

            </div>

            @if($bank_details->account_number != NULL && $bank_details->account_holder_name != NULL && $bank_details->swift != NULL && $bank_details->bank_address != NULL && $date_today >= $date_creat_sum)

          
            <div class="row">
                <div class="col-sm-4 col-md-offset-5">

              {!! Form::submit(trans('payout.request'),array('class'=>'btn btn-success','style'=>'MARGIN: 20PX ;margin-left:-50px;')

                  ) !!}

         

              </div>
            </div>
            @else
            <br>

              <div class="row">
        <div class="col-sm-6">
            <div class="alert alert-warning fade in m-b-15">
                <strong> {{trans('wallet.caution')}}!</strong>
                    Please save bank details
                    <span class="close" data-dismiss="alert">×</span>
            </div>
        </div>
            </div>
            @endif

            

        {!! Form::close() !!}


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

  <script type="text/javascript">
// Set the date we're counting down to

var tim="{{$hourly}}"
var countDownDate = new Date(tim).getTime();
console.log(countDownDate);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
@stop

