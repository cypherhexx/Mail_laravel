@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ trans("users.users") }}} :: @parent @stop @section('main')
<form action="{{ URL::to('admin/deleteconfirms') }}" class="form-horizontal" method="POST" role="form">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <input name="cid" type="hidden" value="{{$response[0]->id}}">
    <div class="form-group">
        <label class="col-md-6 control-label">
            {{ trans('autoresponse.are_you_sure_to_delete') }} {{$response[0]->subject}} ?
        </label>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-2">
            <button class="btn btn-primary" type="submit">
                {{ trans('autoresponse.confirm') }}
            </button>
        </div>
    </div>
    </input>
    </input>
</form>
<form action="{{ URL::to('admin/autoresponse') }}" class="form-horizontal" method="get" role="form">
    <div class="form-group">
        <div class="col-md-6 col-md-offset-2">
            <button class="btn btn-primary" type="submit">
                {{ trans('autoresponse.cancel') }}
            </button>
        </div>
    </div>
</form>
@endsection @section('scripts') @parent @endsection