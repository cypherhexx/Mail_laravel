@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('main') @include('flash::message')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h4 class="panel-title">{{$title}}</h4>
    </div>
    <div class="panel-body">
        <form class="col-sm-10 col-sm-offset-1" method="post" action="{{ URL::to('admin/income') }}" autocomplete="off">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-2">
                        <label class="control-label"> {{trans('income.choose_an_users')}} </label>
                    </div>
                    <div class="col-sm-4">
                        <input placeholder="Choose An Users" type="text" name="user" id="username" class="form-control" required>
                    </div>
                    <!-- <div class="col-sm-4">
		            	<select class="form-control" required name="bonus_type" id="bonus_type">
		            		<option value="All">Overall</option>
		            		 <option value="pairing_bonus">Pairing bonus</option>
                            <option value="direct_sponsor_bonus">direct sponsor bonus</option>
                            
		            	</select>
		            </div> -->
                    <div class="col-sm-2">
                        <button class="btn btn-primary"> Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4">
                <h4>{{trans('income.income_details')}}: {{$username}} </h4>
            </div>
            <div class="col-sm-3">
                <h4>{{trans('income.total_ewallet')}} : <label class="label label-primary">{{$currency_sy}}{{round($balance,2)}}</label></h4>
            </div>
            <div class="col-sm-2">
                <h4>{{trans('income.total_pv')}} : <label class="label label-primary">{{round($pv,2)}} </label></h4>
            </div>
            <div class="col-sm-3">
                <h4>{{trans('income.total_credit_points')}} : <label class="label label-primary"> {{ round($redeem_pv,2)}} </label> </h4>
            </div>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <th>{{trans('income.username')}}</th>
                <th>{{trans('income.from_username')}}</th>
                <th>{{trans('income.bonus_type')}}</th>
                <th>{{trans('income.pv')}}</th>
                <th>{{trans('income.leg')}}</th>
                <th>{{trans('income.date')}}</th>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{$username}}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ str_replace('_'," ",$item->commision_type) }}</td>
                    <td>{{ round($item->pv,2) }}</td>
                    <td>
                        @if($item->leg == 'L') Left @else Right @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection @section('scripts') @parent
<script src="{{ asset('assets/admin/js/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor\bllim\laravalid\public/jquery.validate.laravalid.js') }}"></script>
<script type="text/javascript">
$('form').validate({ onkeyup: false });







App.init();



var arra;



$.get(



    'getAllUsers',



    { sponsor: 'ghjgj' },



    function(response) {



        if (response) {



            month_users = response;



            arra = month_users.split(",");



            $("#username").autocomplete({ source: arra });



        }



    });
</script>
@stop