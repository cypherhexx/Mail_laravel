@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent


<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{trans('ewallet.wallet')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <table class="table datatable-basic table-striped table-hover" id="ewallet">
        <!-- id="ewallet-table"  -->
                            <thead>
                                <tr>
                                    <th>
                                        {{trans('ewallet.username')}}
                                    </th>
                                    <th>
                                        {{trans('ewallet.from_user')}}
                                    </th>
                                    <th>
                                        {{trans('ewallet.amount_type')}}
                                    </th>
                                    <th>
                                        {{trans('Package Name')}}
                                    </th>

                                    <th>
                                        {{trans('ewallet.debit')}} ({{$currency_sy}})
                                    </th>
                                    <th>
                                        {{trans('ewallet.credit')}} ({{$currency_sy}})
                                    </th>
                                    <th>
                                        {{trans('ewallet.date')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($users as $key=> $report)
                                
                                <tr>
                                    <td>
                                        {{$report->username}}
                                    </td>
                                     <td>
                                            {{$report->fromuser}}
                                    </td>
                                     <td>

                                            {{str_replace("_", " ",$report->payment_type)}}
                                    </td>
                                     <td>

                                            {{$report->package}}
                                    </td>
                                     <td>
                                           @if ($report->payment_type =="released" || $report->payment_type =="fund_transfer" || $report->payment_type =="plan_purchase")
                                           {{$report->payable_amount}} @else 0 @endif 
                                    </td>
                                     <td>
                                             @if ($report->payment_type =="released" || $report->payment_type =="fund_transfer" || $report->payment_type =="plan_purchase")
                                          0 @else {{$report->payable_amount}}@endif 
                                    </td>
                                     <td>
                                            {{$report->created_at}}
                                    </td>
                                </tr>
                                 @endforeach   

                            </tbody>
                        </table>
                    </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script>
 $(document).ready(function() {
   $('#ewallet').DataTable();
} );
</script>
@stop