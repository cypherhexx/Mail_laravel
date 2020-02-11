@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans("users.users") }}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <table id="pending-users" class="table datatable-basic table-striped table-hover">
                    <thead>
                        <tr>
                          
                            <th>
                               ID
                            </th>
                            <th>
                               {{ trans("users.username") }}
                            </th>
                            <th>
                               {{ trans("users.email") }}
                            </th>
                             <th>
                              Package
                            </th>
                            <th>
                              Payment Type
                            </th>
                            <th>
                               Amount
                            </th>
                             <th>
                        Created At
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
                </div>
                  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript ">
   

</script>
@stop

            