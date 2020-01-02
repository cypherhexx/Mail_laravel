@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Wallet</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <table id="rs-wallet-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{trans('ewallet.username')}}</th>
                <th>{{trans('ewallet.from_user')}}</th>
                <th>{{trans('ewallet.rs_debit')}}</th>
                <th>{{trans('ewallet.rs_credit')}}</th>
                <th>{{trans('ewallet.date')}}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop {{-- Scripts --}} @section('scripts') @parent @stop