@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles') 
@endsection

{{-- Content --}}
@section('main')
 <div class="panel panel-flat" >
    <div class="panel-heading">
      <h4 class="panel-title">{{trans('ticket_config.change_logo')}} </h4> 
    </div>
    <div class="panel-body"> 
       <div class="col-sm-6">
        <fieldset>
          <h4>{{trans('ticket_config.change_your_logo')}}:</h4>           
          <div class="media-left">
            <div class="avatar">
                <div class="avatarin ajxloaderouter">
                    <div class="img-circle" id="logopreview" style="width:100px;height:100px;margin:0px auto;background-image:url({{url('img/cache/logo/'.$logo)}}">
                    </div>
                    
                    <div class="profileuploadwrapper">
                        <form id="logoform" method="post" name="logoform">
                            {!! Form::file('file', ['class' => 'inputfile profilepic','id'=>'logo']) !!}
                            {!! Form::hidden('type', 'logo') !!}
                            {!! Form::hidden('user_id', 1) !!} 
                            {!! csrf_field() !!}
                            <label for="logo">
                                <i class="icon-file-plus position-left" style="color: red;">
                                </i>
                                <span>
                                </span>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
          </div>
      </fieldset> 
    </div>
    <div class="col-sm-6">
      <fieldset>
        <h4>{{trans('ticket_config.change_your_logo_icon')}}: </h4>
        <div class="col-md-10">
          <div class="media-left">
            <div class="avatar">
                <div class="avatarin ajxloaderouter">
                    <div class="img-circle" id="logoiconpreview" style="width:100px;height:100px;margin:0px auto;background-image:url({{url('img/cache/logo/'.$logo_ico)}}">
                    </div>
                    
                    <div class="profileuploadwrapper">
                        <form id="logoiconform" method="post" name="logoiconform">
                            {!! Form::file('file', ['class' => 'inputfile profilepic','id'=>'logoicon']) !!}
                            {!! Form::hidden('type', 'logoicon') !!}
                            {!! Form::hidden('user_id', 1) !!} 
                            {!! csrf_field() !!}
                            <label for="logoicon">
                                <i class="icon-file-plus position-left" style="color: red;">
                                </i>
                                <span>
                                </span>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
      </div>  
    </fieldset>            
  </div> 

    </div>
      



@endsection



@section('scripts') @parent

<script src="{{ asset('assets/admin/js/logo-setting-editable.js') }}"></script><!-- jQuery vectormap-->

    @endsection