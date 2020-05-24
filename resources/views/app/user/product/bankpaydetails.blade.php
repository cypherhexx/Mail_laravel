

@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
    .centerDiv
    {
      margin: 0 auto;
     
    }
  </style>
@endsection @section('main')
<!-- Basic datatable -->
    
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

                  <img src="{{url('img/cache/original/Internationaltransfer.jpg')}}" style="width: 1000px;width:1000px;">




                   <!--    1 .Payment to this account <br><br>
                       <center>
                        
                        
                        Bank name: <b>Wirecard Bank AG</b><br>
                        Bank address: <b>Einsteinring 35 85609 Aschheim, Germany</b><br> 
                        BIC: <b>WIREDEMM</b><br>
                        IBAN:<b>DE25512308006506628444</b><br>
                        Bank country:<b>Germany</b><br>
                        Beneficiary name:<b>gold   y ltd</b><br>
                    <br>
                      </center>
                
                      <center>
                      <b>שם בעל החשבון : גולד וי בעמ</b><br>
                      <b>בנק: הבינלאומי הראשון (31</b>)<br>
                      <b>סניף אם המושבות (124)</b><br>
                      <b>מס חשבון :273082</b><br>
                      </center> -->

                     <br>
                       <br> 
                      2.Payment Of Amount <b>€{{$package_amount}}</b> for the Package <b>{{$package->package}}</b> worth €{{$package->amount}} for {{$period}}ly.
                      <br>
                       <br>
             <!--         3 . USE this as PAYMENT REFERENCE :
                     <div class="row" style="margin-top: 2%!important;">
                      <div class="col-sm-4">
                    <b><input type="text" value="{{$orderid}}" id="myInput" readonly=""  class="form-control"></b>
                    </div>
                    <div class="col-sm-2">

                   
                    <button class = "btn-copy form-control" onclick="myFunction()"  data-clipboard-target="#myInput" >Copy</button>
                    </div>
                    </div><br><br><br><br> -->

                      <b>Note! :</b><code> Package Upgrade will be completed once payment is done  </code>                          
                    </p>

                    <p>

              

                </div>

            </div>
            
       
                 
        </div>
                  
@endsection @section('scripts') @parent 
 <script type="text/javascript">
     setInterval(function(){
            $.get("{{url('user/get-purchasepayment-status/'.$trans_id)}}", function( data ) { 
                 if(data['status'] == 'complete'){
                        window.location.href = 'purchase/preview/'+data['id'];
                 }
                 
            });
     }, 4000);

 </script>
  
@endsection
 
 
 