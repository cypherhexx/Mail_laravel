 			<div class="form-group">
				<label for="first-name" class="col-md-4 control-label"> {{trans('users.sponsor_name')}}</label>
                	<div class="col-md-8">
                		<label for="first-name" class="control-label"> @if($user->id != 1) {{$sponsor->name}} @else NA @endif</label>
                    </div>
            </div>
            <div class="form-group">
				<label for="first-name" class="col-md-4 control-label"> {{trans('users.sponsor_username')}} </label>
                	<div class="col-md-8">
                		<label for="first-name" class="control-label">@if($user->id != 1) {{$sponsor->username}} @else NA @endif</label>
                    </div>
            </div>
            <div class="form-group">
				<label for="first-name" class="col-md-4 control-label">{{trans('users.date_joined')}}</label>
                	<div class="col-md-8">
                		<label for="first-name" class="control-label">@if($user->id != 1) {{ $sponsor->created_at }} @else NA @endif</label>
                    </div>
            </div> 
            <div class="form-group">
					<label for="first-name" class="col-md-4 control-label">{{trans('users.sponsor_position')}}</label>
                	<div class="col-md-8">
                		<label for="first-name" class="control-label">@if($user->id != 1) {{ $sponsor->sponsor_package }} @else NA @endif</label>
                    </div>
            </div>
           