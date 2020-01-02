 
    @extends('app.admin.layouts.default')


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

     <h3 class = "panel-title">Edit Reply</h3>

</div>

<div class = "panel-body">  

    <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/save_ticket_reply') }}">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">


            <div class="invoice-content">

                     <div class="table-responsive">

                     <div class="col-md-offset-2">

                     <table class="table table-invoice">

                     <thead>

                    @foreach($ticket as $data)

                     <tr class="tableFont">

                     <th>Ticket</th>

                     <th>Status</th>  

                     <th>Subject</th>
                     
                     <th>Created Date</th>

                     </tr>
   
                     </thead>                   

                     <tbody>           
                        
            

    <tr class="tableFont2">

            <td>{{$data->ticket_no}}</td>

            <td class="badge badge-inverse">{{$data->status}}</td> 

            <td>{{$data->subject}}</td> 

            <td>{{$data->created_at}}</td>  


    </tr> 

    <tr>

    <td>

 <div class="form-horizontal col-md-offset-2">

                <label for="answer">Your Answer</label>

                <textarea class="form-control" rows="5" name="comment" required></textarea>
               <input type="hidden" name="id" value="{{$data->id}}"> 
            </div>

</td>

</tr>

@endforeach              
            
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

            EmailCompose.init();   
                       
        });


    </script>




@endsection    

