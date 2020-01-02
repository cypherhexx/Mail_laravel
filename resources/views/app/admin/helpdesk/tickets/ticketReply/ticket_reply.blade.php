 
	@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')@parent 

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

                <h3 class = "panel-title">{{trans('ticket_details.ticket_reply')}}</h3>

    </div>

        <div class = "panel-body">  

 			      <div class="invoice-content">

                <div class="table-responsive">

                    <div class="col-md-12">

                        <table class="table table-invoice">

                          <thead>

                                @foreach($ticket as $data)

                                <tr class="tableFont">

                                  <th>{{trans('ticket_details.ticket')}}</th>

                                  <th>{{trans('ticket_details.status')}}</th>  

                                  <th>{{trans('ticket_details.subject')}}</th>
                           
                                  <th>{{trans('ticket_details.created_date')}}</th>

                                </tr>
   
                          </thead>                   

    <tbody>             

          <tr class="tableFont2">

                <td>{{$data->ticket_no}}</td>

                <td class="badge badge-inverse">{{$data->status}}</td> 

                <td>{{$data->subject}}</td> 

                <td>{{$data->created_at}}</td>  

                <td colspan="6">


                        <div class="paddingRL resTable2 mePadB">   

                            <div class="tableW">
          
                                 {!!$data->description!!}

                                    <a href="{!! url('admin/ticket_details',$data->id) !!}" type="button" class="btn btn-primary">{{trans('ticket_details.view_details')}}</a>

                            </div>   

                        </div>

                </td>


          </tr> 

<!-- <tr>

    <td colspan="6">


        <div class="paddingRL resTable2 mePadB">   

            <div class="tableW">
                
      
            {!!$data->description!!}	

              <a href="{!! url('admin/ticket_details',$data->id) !!}">{{trans('ticket_details.continue')}}

                <span class="meta-nav">-></span></a>

            </div>   

        </div>

    </td>

</tr> -->



@endforeach              
            
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



  <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/save_ticket_reply') }}">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">

   			  <div class="form-horizontal col-md-12">

      			  <label for="answer">{{trans('ticket_details.your_ans')}}</label>

  				        <textarea class="form-control" rows="5" name="comment" required></textarea>

                      <input type="hidden" name="id" value="{{$data->id}}"> 

                        <input type="hidden" name="ticket_no" value="{{$ticket_number}}"> 

   			  </div>

   	<div class="form-horizontal col-md-12">

      	<label for="role">{{trans('ticket_details.your_role')}}</label>

      			<div class="admin"> 

      			    <span class="input-xlarge uneditable-input">Admin</span>

      			</div>

   	</div>

     	  <div class="form-horizontal col-md-12">

   			      <button type="submit" class="btn btn-success" name="send">{{trans('ticket_details.send')}}</button>      				

   		  </div>

      </form>

    </div>

</div>

 @endsection


{{-- Scripts --}}

@section('scripts')@parent

    <script type="text/javascript">          

        $(document).ready(function() {

          App.init();           
                       
        });

    </script>

@endsection    

