 
	@extends('app.user.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')@parent 

 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  

<style type="text/css">

.form-horizontal{

	margin-bottom: 20px;
}


</style>
 @stop
                             
{{-- Content --}}
@section('main')
@include('utils.vendor.flash.message')   

         @include('utils.errors.list')       


<div class = "panel panel-primary">

<div class="panel-heading">

    <div class="panel-heading-btn">
            
            
            
            
    </div>

     <h3 class = "panel-title">{{trans('ticket.reply_ticket')}}</h3>

</div>

<div class = "panel-body">  

 			<div class="invoice-content">

                     <div class="table-responsive">

                     <div class="col-md-12">

                     <table class="table table-invoice">

                     <thead>

                   

                     <tr class="tableFont">

                     <th>{{trans('ticket.ticket')}}</th>

                     <th>{{trans('ticket.status')}}</th>  

                     <th>{{trans('ticket.subject')}}</th>
                     
                     <th>{{trans('ticket.created')}}</th>

                     </tr>
   
                     </thead>                   

                     <tbody>           
                        
            

    <tr class="tableFont2">

            <td>{{$ticket->ticket_no}}</td>

            <td class="badge badge-inverse">{{$ticket->status}}</td> 

            <td>{{$ticket->subject}}</td> 

            <td>{{$ticket->created_at}}</td>  



    </tr> 

<!-- //$ticket->ticket_files -->
            
    </tbody>

</table>

       </div>

        </div>

         </div> 




    @foreach($comment as $data)

 

        <div class="paddingRL resTable2 mePadB">   

            <div class="conversation">

            <i class="fa fa-user fa-3x"   ></i>

                 {{$data->role}}                 
               
                 {{$data->created_at}}               

                  <div class="col-md-offset-2">  
                               
                    {{$data->comment}} 

                    </div>
               
            </div>   

        </div>

   

@endforeach




    <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('user/save_ticket_reply') }}">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">

   			<div class="form-horizontal col-md-12">

      			<label for="answer">{{trans('ticket.your_answer')}}</label>

  				<textarea class="form-control" rows="5" name="reply" required></textarea>

               <input type="hidden" name="id" value="{{$ticket->id}}"> 

               <input type="hidden" name="ticket_no" value="{{$ticket->ticket_no}}"> 

   			</div>

   			<div class="form-horizontal col-md-12">

      			<label for="role">{{trans('ticket.your_role')}}</label>

      				<div class="user"> 

      			     <span class="input-xlarge uneditable-input">User</span>

      			  </div>

   			</div>
              <input type="hidden" name="id" value="{{$id}}">

   			<div class="form-horizontal col-md-12">

   			<button type="submit" class="btn btn-success" name="send">{{trans('ticket.send')}}</button>      				

   			</div>

      </form>

</div>

</div>

 @endsection


{{-- Scripts --}}

@section('scripts')@parent

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <script type="text/javascript">          

        $(document).ready(function() {

          App.init();    

           
                       
        });


    </script>




@endsection    

