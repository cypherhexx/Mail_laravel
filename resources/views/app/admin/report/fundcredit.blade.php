@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop 
{{-- Content --}}
@section('main') 

@include('utils.errors.list')
<div class="panel panel-flat" >
    <div class="panel-heading">        
        <h4 class="panel-title">
            {{trans('report.fund_credit')}}
        </h4>
    </div>
    <div class="panel-body">
        <form action="{{URL::to('admin/fundcredit')}}" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}"/>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label class="form-label col-sm-3">
                            {{trans('report.pick_start_date')}}
                        </label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input autocomplete="off" class="form-control datetimepicker" id="start" name="start" required="true" type="text" value="{{ date('m/01/Y') }}"/>
                                    <label class="input-group-addon" for="start">
                                        <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;">
                                        </i>
                                    </label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-label col-sm-3">
                            {{trans('report.pick_end_date')}}
                        </label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input autocomplete="off" class="form-control datetimepicker" id="end" name="end" required="true" type="text" value="{{ date('m/t/Y') }}"/>
                                    <label class="input-group-addon" for="end">
                                        <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;">
                                        </i>
                                    </label>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-offset-6">
                    <button class="btn btn-primary" type="submit">
                        {{trans('report.get_report')}}
                    </button>
                </div>
            
        </form>
    </div>
</div>
@endsection

@section('scripts') @parent
<script>
    $(document).ready(function() {  App.init();  $(".datetimepicker").datepicker()  });
</script>
@endsection
