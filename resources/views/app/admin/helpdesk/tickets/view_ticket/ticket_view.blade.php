@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent @include('app.admin.tickets.layout.sidebar') @endsection {{-- Content --}} @section('main')


<div class = "panel panel-primary">

    <div class="panel-heading">

        <div class="panel-heading-btn">

                
                
                
                

        </div>

                <h3 class = "panel-title">{{trans('viewTicket.all_tickets')}}</h3>

    </div>

        <div class = "panel-body">                 

            <div class="invoice-content">

                <div class="table-responsive">

                    <div class="col-md-12">

                        <table class="table table-invoice">

                            <thead>                   

                                <tr class="tableFont">

                                    <th>{{trans('viewTicket.ticket')}}</th>

                                    <th>{{trans('viewTicket.subject')}}</th>

                                    <th>{{trans('viewTicket.status')}}</th>

                                    <!-- <th>{{trans('viewTicket.files')}}</th> -->

                                    <th>{{trans('viewTicket.created_date')}}</th>

                                </tr>
   
                            </thead>

    @foreach($ticket as $data)

            <tbody>
  
                <tr class="tableFont2">

                    <td>{{$data->ticket_no}}</td>

                    <td>{{$data->subject}}</td> 

                    <td class="statuslabel ">  

                        <select name="status" id ="ticketStatus" class="form-control update_status"  required>                                
                 
                            @foreach($status as $statusitem)

                                    <option status-id="{{$data->id}}" value="{{$statusitem->id}}"


                                    @if($data->statusid   ==  $statusitem->id) selected @endif>

                                    {{$statusitem->status}}</option>     
                   
                            @endforeach


                              


                        </select>


                    </td> 

                            <!-- <td>{{$data->ticket_files}}</td>         -->

                            <td>{{$data->created_at}}</td> 

                            <td><a href="{!! url('admin/ticket_details',$data->id) !!}" type="button" class="btn btn-primary">{{trans('viewTicket.view_details')}}</a></td>

                            <td><a href="{!! url('admin/ticket_reply',$data->id) !!}" class="btn btn-success ">{{trans('viewTicket.response')}}</a></td>
                   

                </tr>  

        @endforeach     

         @if(!count($ticket))

                           <tr><td>{{trans('ticket.no_data')}}</td></tr>

                    @endif              
            
    </tbody>

</table>

                </div>

            </div>

        </div>

     </div>

  </div>

@endsection



{{-- Scripts --}}

@section('scripts')@parent


    
</script>
<script type="text/javascript">

    $(".update_status").on('change', function(){  

      var selectedValue = $(this).val();


        $.ajax({
            url:" {{ url('admin/ticket_statuses') }}",
            type: 'POST',
            data: {status : selectedValue,_token:$("meta[name=csrf-token]").attr("content"),ticketid: $('option:selected', this).attr('status-id')},
            success: function(data) {
               

            }
        });
    }); 

    $(document).ready(function() {
        App.init();    
    });


</script>

@endsection    