@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent

<link rel="stylesheet" href="{{asset('assets/globals/css/autosuggest.css')}}" type="text/css" media="screen" charset="utf-8" />



@endsection
{{-- Content --}}
@section('main')
    
         @include('flash::message')

      @include('utils.errors.list')

<div class="panel panel-flat" >
	<div class="panel-heading">
    	<div class="panel-heading-btn">
			
            
            
            
        </div>
        <h4 class="panel-title">{{trans('ticket_config.change_username')}} </h4>
     </div>
     <div class="panel-body">
    <form action="{{url('admin/users/updatename')}}" class="smart-wizard form-horizontal" method="post"  >
    <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="username">
             {{trans('ticket_config.username')}}: <span class="symbol required"></span>
            </label>
            <div class="col-sm-4">
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="amount">
                 {{trans('ticket_config.new_username')}}: <span class="symbol required"></span>
            </label>
                <div class="col-sm-4">
                <input type="text" id="new_username" name="new_username" class="form-control" required>
            </div>           
        </div>
       
         
         <div class="col-md-12">
                    <div class="col-md-6 col-md-offset-4">
                        
                        <button type="reset" class="btn btn-sm btn-default">
                        <span class="glyphicon glyphicon-remove-circle"></span> {{
                        trans("modal.reset") }}
                        </button>
                        <button type="submit" class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-ok-circle"></span>
                        
                        {{ trans("modal.edit") }}
                        
                        </button>
                    </div>
                </div>


    </form>
</div>
    



	</div>
</div>

              

           

            
@endsection
