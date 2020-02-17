@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
@include('flash::message') 
@include('utils.errors.list')

<div class="panel panel-flat ">
    <div class="panel-heading">
        <h4 class="panel-title">
          Run Software
        </h4>
    </div>
    <div class="panel-body">
      <div class="row">
    <div class="col-sm-6">

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

                                                @if(!count($broker_users))

                                                <tr><td>No Data</td></tr>

                                                @endif  

                                                          

                                    </tbody>
                            </table>
     
      
    </div>
    <div class="col-sm-6">
   

          @if($status == "stopped")
        <a class="btn btn-success" data-toggle="modal" data-target="#myModalstart">Start</span> </a>
       
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
                      <option value="{{$busers->id}}">{{$busers->name}}</option>
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




@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
@parent

<script type="text/javascript"> 

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>


@endsection
