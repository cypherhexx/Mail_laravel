@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles') 
@endsection

{{-- Content --}}
@section('main')
@include('flash::message')
 <div class="panel panel-flat" >
    <div class="panel-heading">
      <h4 class="panel-title">{{trans('ticket_config.site_management')}} </h4> 
    </div>


     <form action="{{URL::to('admin/postsite_mode')}}" method="post">

        <input type="hidden" name="_token"  value="{{csrf_token()}}">
    <div class="panel-body"> 
       <div class="col-sm-12">

         <div class="form-group col-sm-6">
                <label class="form-label col-sm-6">Site Mode</label>
                <div class="col-sm-6">
                    <div class="input-group">     
                         <select class="form-control" name="mode" id="mode" required="true">
                                                 
                            <option value="yes">Yes</option>
                            <option value="no"> No</option>
                                                  
                        </select>
                    </div>
                </div>
            </div>


  
    </div>
      <button type="submit" class="btn btn-primary" style="margin-left: 200px;">{{trans('report.get_report')}}</button>
  
    </div>

    
      <br>

    </form>
      



@endsection



@section('scripts') @parent

<script src="{{ asset('assets/admin/js/logo-setting-editable.js') }}"></script><!-- jQuery vectormap-->

    @endsection