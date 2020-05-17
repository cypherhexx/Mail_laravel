@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')
@parent 
<style type="text/css">

.conversation{

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

        

        <h3 class = "panel-title">{{trans('ticket_details.ticket_details')}}</h3>

    </div>



<div class = "panel-body">  

    <form class="form-horizontal" role="form" method="" action="">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="invoice-content">

                <div class="table-responsive">

                    <div class="col-md-12">

                        <table class="table table-invoice">

                            <thead>                  

                                <tr class="tableFont">

                                    <th>{{trans('ticket_details.ticket')}}</th>                    

                                    <th>{{trans('ticket_details.subject')}}</th>

                                    <th>{{trans('ticket_details.status')}}</th>  

                                    <th>{{trans('ticket_details.priority')}}</th>                   

                                </tr>
   
                            </thead>

    @foreach($ticket as $data)

        <tbody>
 
            <tr class="tableFont2">

                <td>{{$data->ticket_no}}</td>            

                <td>{{$data->subject}}</td> 

                <td class="badge badge-inverse">{{$data->status}}</td> 

                <td>{{$data->priority}}</td> 


            </tr> 


    <tr>

        <td colspan="6">

            <div class="paddingRL resTable2 mePadB">   

                <div class="conversation">

                    <h2 class="heading">{{trans('ticket_details.conversation')}}:</h2>

                        <i class="fa fa-user fa-3x"   ></i>

                    <!-- {{$data->role}} -->

                        User

                            {{$data->created_at}}

        <div class="col-md-offset-2">       

                        {!!$data->description!!}

        </div>                
              
               
                </div>   

            </div>

        </td>

    </tr>

            @endforeach

<tr>

    <td colspan="6">

        

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

    </td>

</tr>   
 
            
    </tbody>

        </table>

            </div>

                </div>

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

