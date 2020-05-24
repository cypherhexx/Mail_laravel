@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
<style type="text/css">
.invoice>div:not(.invoice-footer) {
    margin-bottom: 43px;
}
.invoice-price .invoice-price-right {
    padding: 3px;
}

</style>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endsection

{{-- Content --}}
@section('main')
 <div class="invoice">
     <!--  <div class="invoice-company">
         <span class="pull-right hidden-print"> 

             <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i>  {{trans('report.print')}}</a>
         </span>     </div> -->
         <div class="invoice-header">
        <div class="invoice-from">
            <address class="m-t-5 m-b-5">
                <strong>{{$app->company_name}}</strong><br>
                            {{$app->company_address}}<br>
                            email: {{$app->email_address}}
                </address>
        </div>
      <!--   <div class="invoice-date">
            <div class="date m-t-5">{{ date('F d, Y') }}</div>
            <div class="invoice-detail">
                Joining repot from August 19, 2015 to  October 19, 2015
            </div>
        </div> -->
    </div>


    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice" id ="table">
                <thead>
                    <tr>
                        <th>{{trans('report.no')}}</th>
                        <th>{{trans('report.username')}}</th>
                        <th>{{trans('report.firstname')}}</th>   
                        <th>{{trans('report.last_name')}}</th>   
                        <th>{{trans('report.email')}}</th>  
<!--                          <th>Package</th>  
                          <th>Payment Cycle</th>   -->
                           <th>Payment Method</th>  
                              <th>Payment Type</th>  
                           <!-- <th>Payment Date</th>   -->
                            <!-- <th>Next Payment Date</th>   -->
                             <!-- <th>Initial Payment Amount</th>   -->
                              <th>Amount </th>  
                               <th>Profile Status</th> 
                              <th>Payment Status</th>

                      
                        <th>{{trans('report.date')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key=> $report) 
                    <tr>
                        <td>{{ $key +1 }}</td>
                         <td>@if($report->username == null)
                            @php $values=json_decode($report->resp);@endphp
                           {{$values->username}}
                            @else
                            {{$report->username}}
                          @endif</td>
                       <td>@if($report->name == null)
                            @php $values=json_decode($report->resp);@endphp
                           {{$values->firstname}}
                            @else
                            {{$report->name}}
                          @endif</td>
                        <td>@if($report->lastname == null)
                            @php $values=json_decode($report->resp);@endphp
                           {{$values->lastname}}
                            @else
                            {{$report->lastname}}
                          @endif</td>
                         <td>@if($report->email == null)
                            @php $values=json_decode($report->resp);@endphp
                           {{$values->email}}
                            @else
                            {{$report->email}}
                          @endif</td>
                       <!--  <td>@if($report->package == 'member')
                           NA
                            @else
                            {{$report->package}}
                          @endif</td>
                          <td>@if($report->payment_cycle == null)
                           NA
                            @else
                            {{$report->payment_cycle}}
                          @endif</td> -->
                          <td>@if($report->payment_method == 'cheque')
                            Bank
                            @else
                            {{$report->payment_method}}
                          @endif</td>

                           <td>@if(($report->payment_type != 'upgrade') && ($report->payment_type != 'register'))
                            Upgrade
                            @else
                            {{$report->payment_type}}
                          @endif</td>
                           <!-- <td>{{$report->payment_date}}</td>
                            <td>{{$report->next_payment_date}}</td> -->
                             <td>{{$report->amount}}</td>
                              <!--  --><!-- td>{{$report->amount_per_cycle}}</td> -->
                               <td>@if($report->profile_status == 'complete')
                            Active
                            @else
                           {{$report->profile_status}}
                          @endif</td>
                               <td>{{$report->payment_status}}</td>
                               
                  
                        <td>{{ date('d M Y H:i:s',strtotime($report->created_at))}}</td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
           
    </div>
    <div class="invoice-footer text-muted">
            <p class="text-center m-b-5">
            {{trans('report.thank_you_for_your_business')}}
        </p>
    </div>
</div>             

@endsection
@section('scripts') @parent
  <script  src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script  src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        App.init();                 
    });
</script>
<script>
    $(document).ready(function() {
        $('#table').DataTable( {
            dom: "<'row'<'col-sm-6'l><'col-sm-6'fr>>" +
                 "<'row'<'col-sm-12't>>" +
                 "<'row'<'col-sm-2'i><'col-sm-5'<'pull-left'p>><'col-sm-5'<'pull-right'B>> >" ,
        language: {
            paginate: {
                next: '<i class="glyphicon glyphicon-chevron-right">',
                previous: '<i class="glyphicon glyphicon-chevron-left">', 
            }
        },
        buttons: [        
        
          { "extend": 'pdf', 
          "pageSize":'A3',
          "orientation":'landscape',
          "text":'<span class="fa fa-print"> PDF</span>',
          "className": 'btn  btn-xs  btn-primary paginate_button ' },

         { "extend": 'csv', 
           "text":'<span class="fa fa-file-excel-o"> CSV</span>',
           "className": 'btn  btn-xs  btn-primary paginate_button  '
        },
         { "extend": 'excel', 
          "text":'<span class="fa fa-file-excel-o"> EXCEL</span>',
          "className": 'btn  btn-xs  btn-primary paginate_button ' },
         
        ] 
    } );
} );
 </script>
 @endsection