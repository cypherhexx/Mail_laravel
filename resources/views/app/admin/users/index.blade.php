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
    <button type="button" class="btn btn-xs btn-default text-white" id="filter" data-toggle="collapse" data-target="#filterticketpanel" title="Filter Users"><i class="fa fa-filter" style="color: #252323 !important; font-size: large;"></i>&nbsp;</button> {!! $users_data->contains('username',app('request')->input('username')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-user"></i> Username:&nbsp;'.app('request')->input('username').'</label>' : '' !!}
            {!! $sponsor->contains('username',app('request')->input('sponsor')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-user"></i> Sponsor:&nbsp;'.app('request')->input('sponsor').'</label>' : '' !!}
            {!! $package->contains('package',app('request')->input('package')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-gift"></i> Position:&nbsp;'.app('request')->input('package').'</label>' : '' !!}
            
            <div id="filterticketpanel" class="collapse">
               
                <div class="panel-body">
                    <form method="GET" action="{{url('admin/users/filter')}}" accept-charset="UTF-8" class="form-horizontal" id="filter-form">
                        <input type="hidden" name="showtickets" value="showtickets">
                        <div class="row">
                           
                            <div class="col-sm-3">
                                Username
                                <select class="select2 filter form-control" name="username" id="username-filter">
                                    <option value="all" selected>All</option>
                                    @foreach($users_data as $priority)
                                    <option value="{{$priority->username}}">{{$priority->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                               Sponsor
                                <select class="select2 filter form-control" name="sponsor" id="sponsor-filter">
                                    <option value="all" selected>All</option>
                                    @foreach($sponsor as $sponsors)
                                    <option value="{{$sponsors->username}}">{{$sponsors->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="col-sm-3">
                                Position
                                <select class="select2 filter form-control" name="package" id="package-filter">
                                    <option value="all" selected>All</option>
                                    @foreach($package as $packages)
                                    <option value="{{$packages->package}}">{{$packages->package}}</option>
                                    @endforeach
                                </select>
                            </div>
                              <div class="col-sm-3">
                                <br>
                          <input id="apply-filter" class="btn btn-primary" type="submit" name="" value="Apply" onclick="removeEmptyValues()">
                        <input id="resetFilter" class="btn btn-default" type="reset" name="reset" value="Clear">
                         </div> 
                        </div>
                        <br/>
                        
                        <br/>
                       
                    </form>
                </div>
                </div>
            
    <table data-priority="{{app('request')->input('username') ? app('request')->input('username') : 'all' }}" data-sponsor="{{app('request')->input('sponsor') ? app('request')->input('sponsor') : 'all' }}" data-package="{{app('request')->input('package') ? app('request')->input('package') : 'all' }}"class="table datatable-basic table-striped table-hover changestatuswrapper" id="users-table" data-search="false" >
                            <thead>
                                <tr>
                                    <th>
                                       {{ trans("users.no") }}
                                    </th>
                                    <th>
                                       {{ trans("users.name") }}
                                    </th>
                                    <th>
                                       {{ trans("users.username") }}
                                    </th>
                                    <th>{{trans("users.sponsor")}}</th>
                                    <th>
                                       {{ trans("users.position") }}
                                    </th>
                                    <th>
                                       {{ trans("users.joined_level") }}
                                    </th>
                                    <th>
                                       {{ trans("users.email") }}
                                    </th>
                                    <th>
                                       {{ trans("users.join_at") }}
                                    </th>
                                    <th>
                                       {{ trans("users.view") }}
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

            