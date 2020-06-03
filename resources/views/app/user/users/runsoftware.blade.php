@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
.run-table{
  margin-top: 640px;
}

.border{
  border: 2px solid #000000;
  padding: 20px;
}
.run-backg{
        background-image: url('/img/cache/original/runsoft-bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
            /*color: #fdfdfd;*/
      background-position: center;

    }
.panel-flat > .panel-heading{
     background-color: transparent;
}
.btn{
  padding: 7px 34px;
}
.alert{
    display: block;
    margin-top: -150px;
    background-color: #fff;
    width: 470px;
    padding: 20px;
    border-radius: 3px;
    text-align: center;
    position: fixed;
    left: 50%;
    top: 50%;
    margin-left: -235px;
    /* margin-top: -200px; */
    overflow: hidden;
    /* display: none; */
    z-index: 1060;
}

@media (min-width:1025px) and (max-width:1081px) {
 
  .btn {
    padding: 7px 29px;
}
}
@media (min-width:769px) and (max-width:828px) {
 
  .btn {
    padding: 7px 26px;
}
}
@media (min-width: 320px) and (max-width:926px) {
.run-backg{
height: 358px;
}
.run-table {
/*margin-top: 129px;*/
margin-top: 137px;
} 
}
</style>
@endsection @section('main')

@include('utils.errors.list')

<div class="panel panel-flat run-backg">
    <div class="panel-heading">
        <h4 class="panel-title">
          Run Software
        </h4>
    </div>

    <div class="panel-body">
 
      <div class="row">
     <!--    <div class="col-sm-12">
          
          <img src="{{url('img/cache/original/runsoftware.jpg')}}" width="100%" height="300px">
        </div> -->

      <div class="run-table">
<!--     <div class="col-sm-6">

       @if(count($broker_users) > 0)

                     <table class="table" id="table">
                                <thead>
                                    <tr>

                                     
                                        <th>Broker</th> 
                                        <th>URL</th>
                                      

                                    </tr>

                                </thead>
                                    <tbody>

                                            @foreach($broker_users as $key=> $busers)

                                                <tr>

                                             
                                                <td>{{$busers->name}}</td>
                                                  <td> <a href="{{$busers->url}}" target="_blank"> {{$busers->url}}</a></td>
                                                 
                                            @endforeach  

                                              

                                                          

                                    </tbody>
                            </table>
                            @else
                            No data Found
                            @endif

     
      
    </div> -->
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center border" style="margin-top: -550px;" >
      <p><h4 style="color:#ffffff; font-weight: 600;">Run Software</h4></p>
   

          @if($status == "stopped")
       <!--  <a class="btn btn-success" data-toggle="modal" data-target="#myModalstart">Start</span> </a> -->
        <div>
            <form action="{{url('user/runsoftware')}}" method="post" data-parsley-validate="true" name="form-wizard">
             <input type="hidden" name="_token" value="{{csrf_token()}}"> 
              <input type="hidden" name="privateKey"  value="c553fef5bf159f3a57e984db2be954ce">
              <input type="hidden" name="issuer_key"  value="38da33fe1a9092e3ca4a0bc7be832cfd">
              <button type="submit" class="btn btn-success">Download</button>
            </form>
        </div>
        &nbsp

      
       
              <!-- Modal -->

                <div id="myModalstart" class="modal fade" role="dialog">
                <div class="modal-dialog">

              <!-- Modal content-->

                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body" style="overflow: auto !important;">
           <form action="{{url('user/savebrokerdetails')}}" class="smart-wizard form-horizontal" method="post"  >
            <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                <label class="col-sm-4 control-label" for="username">
                    Choose Broker: <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <select name="user" id="user" class="form-control" required="true">
                      <option value="">Choose User</option>
                      @foreach($broker_users as $busers)
                      
                      <option value="{{$busers->id}}">{{$busers->name}} - {{$busers->url}}</option>
                      
                      @endforeach
                    </select>
                </div>
            </div>
     
            <div class="form-group">
                <label class="col-sm-4 control-label" for="account">
                    Number Account: <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <input type="text" id="account" name="account" class="form-control" required="true">
                </div>
            </div>
     
              <div class="form-group">
                <label class="col-sm-4 control-label" for="current_password">
                      Password Account
                </label>
                 <div class="col-sm-5">
                <input class="form-control" name="password" id="password"  type="password" required="true">
                </input>
                </div>
            </div>
         
   
                <div class="modal-footer">
                <div class="row">
              <button class="btn btn-info" tabindex="4" name="start" id="start" type="submit" value="start"> Start</button >       
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
        </form>
                </div>
                </div>
                </div>




                 @endif

                @if($status == "started")

                 <a href="{{url('user/changestatus')}}" class="btn btn-danger">Stop</span> </a>
                 @endif
    </div>
        
      </div>

 
        </div>
      </div>
        </div>

      
</div>




@if (session()->has('success'))
        <div class="alert alert-success">
            <img src="/images/smile.png" style="width: 100px; margin-top: 25px;">
           
            <p style="margin: 25px; font-size: 20px;">Become a Marketer to download</p>
            <a type="button" href="purchasedashboard" class="btn btn-primary" id="alerting">Ok</a>
        </div>
@endif

@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
@parent

<script type="text/javascript"> 

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>

<script type="text/javascript"> 

   $(document).ready(function() {
            $('#alerting').click(function(){
              $(this).parent().remove();
            });
        });
</script>

 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>
@endsection
