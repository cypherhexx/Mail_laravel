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
    <!-- @include('app.admin.layouts.ewalletrecord') -->
    <table class="table datatable-basic table-striped table-hover" id="ewallet-table" ">
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
                            </tbody>
                        </table>
                    </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop