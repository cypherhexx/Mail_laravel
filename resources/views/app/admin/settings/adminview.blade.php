@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
 @include('flash::message')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Users</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <table class="table datatable-basic table-striped table-hover" id="admin-table" >
                            <thead>
                                <tr>
                                    <th>
                                       {{ trans("users.name") }}
                                    </th>
                                    <th>
                                       {{ trans("users.username") }}
                                    </th>
                                    <th>
                                       {{ trans("users.email") }}
                                    </th>
                                    <th>
                                       {{ trans("admin.created_at") }}
                                    </th>
                                    <th>
                                       {{ trans("admin.assign_role") }}
                                    </th>
                                     <th>
                                      {{ trans("users.action") }}
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
<script type="text/javascript">

   if ($('#admin-table').length) {
        $(document).ready(function() {
            oTable = $('#admin-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": CLOUDMLMSOFTWARE.siteUrl + "/admin/adminview",
                "fnDrawCallback": function(oSettings) {}
            });
        });
    }

</script>
@stop