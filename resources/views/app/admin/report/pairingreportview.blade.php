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
@endsection
{{-- Content --}}
@section('main')

 <div class="invoice">
      <div class="invoice-company">
         <span class="pull-right hidden-print">                   
             <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
         </span>
     </div>
       
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice">
                <thead>
                    <tr>
                        <th>{{trans('report.no')}}</th>
                        <th>{{trans('report.username')}}</th>
                        <th>{{trans('report.left_carry')}}</th>
                        <th>{{trans('report.right_carry')}}</th>  
                        <th>{{trans('report.carry')}}</th>
                        <th>{{trans('report.amount')}}</th>
                        <th>{{trans('report.date')}} </th>                     
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportdata as $key=> $report)
                    <tr>
                        <td>{{$key +1 }}</td>                      
                        <td>{{$report->username}}</td>                      
                        <td>{{$report->left_carry}}</td>                      
                        <td>{{$report->right_carry}}</td> 
                        <td>{{$report->carry}}</td> 
                        <td>{{$report->amount}}</td> 
                        <td>{{date('d M Y H:i:s',strtotime($report->created_at))}}</td>
                    </tr>
                    @endforeach 

                    @if(count($reportdata) == 0)  

                    <tr>
                        <td class="text-center" colspan="8"> {{trans('report.no_data_found')}} </td>

                    </tr>
                    @endif
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
    <script>
        $(document).ready(function() {
            App.init();                 
        });        
    </script>
    @endsection