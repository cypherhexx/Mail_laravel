@extends('app.admin.layouts.default')





{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop



{{-- Content --}}

@section('main')


<div class="panel panel-flat" >
  <div class="panel-heading">
    <h4 class="panel-title">{{trans('ticket_config.change_company_details')}}</h4>
    <div class="heading-elements">
      <button id="enable" type="submit"  class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
    </div>
  </div>
  <div class="panel-body"> 
    <legend>{{trans('ticket_config.updations')}}</legend>
    @foreach($settings as $rank)

                          <form id="settings"> 
                         
                               <div class="form-group">
                                    <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('ticket_config.company_name')}}: </label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="company_name" data-title='Enter Company name' data-name="company_name">
                                                 {{$rank->company_name}}
                                                 </a>
                                           </div>
                                            
                                    </div>
                              </div> 


                           

                                 <div class="form-group">
                                       <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('ticket_config.company_address')}}: </label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="company_address" data-title='Enter Company Address' data-name="company_address">
                                                 {{$rank->company_address}}
                                                 </a>
                                           </div>
                                          
                                       </div>
                                 </div> 

                            <div class="form-group">
                                       <div class="row">
                                      
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('ticket_config.email_address')}}: </label>    
                                           </div>

                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="email_address" data-title='Enter Email Address' data-name="email_address">
                                                 {{$rank->email_address}}
                                                 </a>
                                           </div>
                                           
                                       </div>
                            </div>
                            <div class="form-group">
                                       <div class="row">
                                      
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('ticket_config.currency')}}: </label>    
                                           </div>

                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$currency_sy}}" data-type='text' id="currency" data-title='Enter currency' data-name="currency">
                                                 {{$currency_sy}}
                                                 </a>
                                           </div>
                                           
                                       </div>
                            </div>
                       
                      

                        
                      </form>
                        <br>
                      
                       </div>
                       </div>
                        @endforeach 

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
<!-- <script src="{{ asset('assets/globals/plugins/x-editables/js/bootstrap-editable.min.js') }}"></script> -->
<script src="{{ asset('assets/admin/js/appsettings-editable.js') }}">
</script>
<script>
    $(document).ready(function() {

            // App.init();     
            // $('#enable').click(function() {

            //     $("#upload-submit").editable('toggleDisabled');

            //      $('#settings .settings').editable('toggleDisabled');

            //       $('#enable').text(function(i, text){

            //          return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";

            //     });

            // });
             

        });
</script>

<script type="text/javascript">


</script>

@endsection

