@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main') @include('flash::message') @include('utils.errors.list')
<div class="panel panel-flat ">
    <div class="panel-heading col-sm-offset-3">
        <h4 class="panel-title">
            Edit Broker
        </h4>
    </div>
    <div class="panel-body col-sm-offset-2">

  
        <form action="{{url('admin/savededitbroker')}}" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
              <input name="id" type="hidden" value="{{$broker->id}}">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="name">
                  Name:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                  <input class="form-control" id="name" name="name" value="{{$broker->name}}" type="text" required="true">
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="url">
                    URL:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control" id="url" name="url" value="{{$broker->url}}" type="text" required="true">
                    </input>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" for="current_password">
                   Status 
                </label>
                 <div class="col-sm-4">
                    <select name="status" id=status class="form-control">
                         <option value="{{$broker->status}}">{{$broker->status}}</option>
                        @if($broker->status == 'enabled')
                       <option value="disabled">disabled</option>
                        @endif 
                         @if($broker->status == 'disabled')
                       <option value="enabled">enabled</option>  
                       @endif
                    </select>
                   
               
                </div>
            </div>
            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                        <button class="btn btn-info" id="add" name="add" tabindex="4" type="submit" >
                          Save
                        </button>
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>

@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
 @parent
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>

 @endsection