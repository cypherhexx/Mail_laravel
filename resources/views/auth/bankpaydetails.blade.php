@extends('layouts.auth')
@section('content')

  <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <!--  <h3 class="panel-title">
                        Payment Details  
                    </h3> -->
                         <center> <span class="loader-text" style="font-size: 18px">Bank Payment</span></center>
                    
                </div>
                <div class="panel-body centerDiv">
                    
                   <p style="margin: 0 auto!important;display: block!important;">

                       <center>
                      <img src="{{url('img/cache/original/Internationaltransfer.jpg')}}" style="width: 1000px;width:1000px;">
                      </center>

                      <br>
                       <br>
                      Payment Of Amount <b>€ {{$joiningfee}}</b> as <b>Joining Fee 
                      <br>
                       <br>
         
                      <b>Note! :</b><code> Registration will be completed once payment is done  </code>                          
                    </p>

                    <p>

              

                </div>

            </div>
            
       
                 
        </div>
@endsection @section('scripts') @parent 
 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('get-bankpayment-status/'.$trans_id)}}", function( data ) { 
                 if(data['status'] == 'complete'){
                        window.location.href = 'register/preview/'+data['id'];
                 }
                 
            });
     }, 4000);

 </script>
  
  
@endsection