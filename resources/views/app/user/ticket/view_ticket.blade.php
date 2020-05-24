@extends('app.user.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')
@parent 
<style type="text/css">

.conversation{

    padding-bottom: 20px;
}

.reply{

    padding-bottom: 20px;
}

.comment{

    padding-bottom: 20px;
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

     <h3 class = "panel-title">{{trans('ticket.view_my_ticket')}}</h3>

</div>

<div class = "panel-body">
    <div class="invoice-content">
        <div class="table-responsive">
            <div class="col-md-12">
                <table class="table table-invoice">
                    <thead>
                        <tr class="tableFont">
                            <th>{{trans('ticket.ticket')}}</th>                    
                            <th>{{trans('ticket.subject')}}</th>
                            <th>{{trans('ticket.status')}}</th>  
                            <th>{{trans('ticket.priority')}}</th>   
                            <th>{{trans('ticket.created')}}</th>                
                        </tr>   
                     </thead>
                     <tbody>
                @foreach($ticket as $data)
                        <tr class="tableFont2">
                            <td>{{$data->ticket_no}}</td>
                            <td>{{$data->subject}}</td>
                            <td class="badge badge-inverse">{{$data->status}}</td>
                            <td>{{$data->priority}}</td>
                            <td>{{$data->created_at}}</td>

                            <td>   <a href="{!! url('user/ticket_reply',$data->ticket_no) !!}" class="btn btn-success btnDetails">{{trans('ticket.view_details')}}</a> </td>
                        </tr>
                @endforeach      
                    </tbody>
                </table>
             </div>
        </div>
    </div>
</div>

 </div>

</div>

  </div>

 @endsection


@section('scripts') @parent



  <script type="text/javascript"> 
     
           $(document).ready(function() {

            App.init();  

               
        });
       
    </script>


    @endsection