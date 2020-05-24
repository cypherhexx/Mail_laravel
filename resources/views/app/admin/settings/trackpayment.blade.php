@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main') @include('flash::message') @include('utils.errors.list')
<div class="panel panel-flat ">
    <div class="panel-heading col-sm-offset-3">
        <h4 class="panel-title">
           Forced Track Payment
        </h4>
    </div>
    <div class="panel-body col-sm-offset-2">

  
        <form action="{{url('admin/uptrackpayment')}}" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="username">
                    {{trans('ewallet.enter_username')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control autocompleteusers" id="username" name="autocompleteusers" type="text" required>
                    <input class="form-control key_user_hidden" name="username" type="hidden">
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="amount">
                  Choose Package:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                   <select name="package" id="package" class="form-control" required>
                    <option value="">
                        Choose Package
                    </option>
                    @foreach($packages as $key=>$package)
                      <option value="{{$key}}">
                        {{$package}}
                    </option>
                    @endforeach
                       
                   </select>
                </div>
            </div>
        
            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                        <button class="btn btn-info" id="add_amount" name="add_amount" tabindex="4" type="submit" value="{{trans('ewallet.add_amount')}}">
                           Assign Package
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