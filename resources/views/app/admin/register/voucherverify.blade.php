@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
<style type="text/css">
div.dataTables_filter label {
    font-weight: normal;
    float: left !important;
}
</style>
@endsection {{-- Content --}} @section('main') @include('flash::message')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h4 class="panel-title">voucher </h4>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
        </div>
    </div>
    <div class="panel-body">
        <table id="tables" class="table table-striped table-hover">
            <thead>
                <tr>
                    <!--   <th style="background-color: #00ACAC;">No</th> -->
                    <!--  <th style="background-color: #00ACAC;">User ID</th> -->
                    <th style="background-color: #00ACAC;">{{trans('products.no')}}</th>
                    <th style="background-color: #00ACAC;">{{trans('products.name')}}</th>
                    <th style="background-color: #00ACAC;"> {{trans('products.share')}}</th>
                    <th style="background-color: #00ACAC;">{{trans('products.amount')}}</th>
                    <th style="background-color: #00ACAC;">{{trans('products.share_status')}}</th>
                    <th style="background-color: #00ACAC;">{{trans('products.date')}}</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection @section('scripts') @parent @stop @section('scripts') @parent
<script src="{{ asset('assets/admin/js/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor\bllim\laravalid\public/jquery.validate.laravalid.js') }}"></script>
<!-- <script type="text/javascript">



$('form').validate({onkeyup: false});



App.init();

var arra;

$.get( 

        'getAllUsers',

         { sponsor: 'ghjgj' },

            function(response) {

                    if (response) {

                        month_users=response;

arra = month_users.split(",");

$("#username").autocomplete({source:arra});

}

});

</script> -->
<script type="text/javascript" src="{{asset('assets/globals/js/autosuggest.js')}}" charset="utf-8"></script>
<script>
$(document).ready(function() {
    App.init();

    var options = {
        script: "{{url('admin/suggestlist')}}?json=true&limit=10&",
        varname: "input",
        json: true,
        shownoresults: false,
        maxresults: 10,
        callback: function(obj) { document.getElementById('testid').value = obj.id; }
    };
    var as_json = new bsn.AutoSuggest('username', options);
});
</script>
<script type="text/javascript">
var oTable;
$(document).ready(function() {
    oTable = $('#tables').DataTable({
        "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
        "sPaginationType": "bootstrap",
        "processing": true,
        "serverSide": true,
        "ajax": "{{ URL::to('/admin/register/data') }}",
        "fnDrawCallback": function(oSettings) {
            $(".iframe").colorbox({
                iframe: true,
                width: "80%",
                height: "80%",
                onClosed: function() {
                    oTable.ajax.reload();
                }
            });
        }

    });
    oTable.on('order.dt search.dt', function() {
        oTable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
    App.init();
});
</script>
@stop