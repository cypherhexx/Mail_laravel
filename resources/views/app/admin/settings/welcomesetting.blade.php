@extends('app.admin.layouts.default')


@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

<link href="{{ asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css') }}" rel="stylesheet"/>

<link href="{{ asset('assets/admin/css/plugins/bootstrap-wysihtml5-0.0.3.css') }}" rel="stylesheet"/>


@endsection


@section('main')



<div class="panel panel-flat" >

                        <div class="panel-heading">

                            <h4 class="panel-title">{{trans('ticket_config.welcome_email')}}</h4>
                            <div class="heading-elements">
 <button id="enable" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
</div>


                        </div>
                            <div class="panel-body"> 
                                <form id="settings">
                                <legend>{{trans('ticket_config.welcome_email')}}</legend>
                                @foreach($settings as $rank)
                                  <div class="col-sm-12">
                                  <!--     <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                              <label  class="form-label" for="point_value">{{trans('ticket_config.to')}} :</label>   
                                            </div>
                                            <div class="col-sm-8">
                                              <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' data-url='{{url("admin/welcomeemail")}}' id="to_email" data-title='Enter from' data-name="to_email">{{$rank->to_email}}</a>
                                            </div>
                                        </div>
                                      </div> -->
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-4">
                                            <label  class="form-label" for="point_value">{{trans('ticket_config.subject')}}:</label>    
                                          </div>
                                          <div class="col-sm-8">
                                            <a class="settings form-control" data-pk="{{$rank->id}}"  data-url='{{url("admin/welcomeemail")}}' data-type='text' id="subject" data-title='Enter subject' data-name="subject" style="min-height:58px;min-width:50px">{!!$rank->subject!!}
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-4">
                                            <label  class="form-label" for="point_value">{{trans('ticket_config.welcome_email_message')}}:</label>
                                          </div>
                                          <div class="col-sm-8" >
                                            <div class="settings form-control" data-url='{{url("admin/welcomeemail")}}' data-pk="{{$rank->id}}" data-type='wysihtml5' id="note" data-title='Enter content' data-name="body" style="min-height:200px;min-width:50px">{!! $rank->body !!}</div> 
                                          </div>
                                      </div>
                                </div>
                           </div>  
                          </form>
                         </div>

                         @endforeach

                      
                      </div>

<div class="panel panel-flat" >

                        <div class="panel-heading">


                            <h4 class="panel-title">Payout Notification Settings</h4>
<div class="heading-elements">
                            <button id="enable-payout-settings-edit" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
</div>



                            

                        </div>
                            <div class="panel-body"> 
                                <form id="settings_pay">
                                <legend>Payout Notification Settings</legend>
                                @foreach($settings_payout as $rank)
                                  <div class="col-sm-12">
                                      <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                              <label  class="form-label" for="point_value">Mail Status:</label>   
                                            </div>
                                            <div class="col-sm-8">
                                              <a class="settings form-control" data-pk="{{$rank->id}}" data-type='select' 
                                            data-url='{{url("admin/payoutnotification")}}'  id="mail_status" data-title='select Status' data-name="mail_status">{{$rank->mail_status}}</a>
                                            
                                            </div>
                                        </div>
                                      </div> -->
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-4">
                                            <label  class="form-label" for="point_value">{{trans('ticket_config.subject')}}:</label>    
                                          </div>
                                          <div class="col-sm-8">
                                            <a class="settings_pay form-control" data-pk="{{$rank->id}}"  data-url='{{url("admin/payoutnotification")}}' data-type='text' id="subject" data-title='Enter subject' data-name="subject">{{$rank->subject}}
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="row">
                                          <div class="col-sm-4">
                                            <label  class="form-label" for="point_value">Mail Content:</label>
                                          </div>
                                          <div class="col-sm-8" >
                                             <div class="settings_pay form-control" data-url='{{url("admin/payoutnotification")}}' data-pk="{{$rank->id}}" data-type='wysihtml5' id="note" data-title='Enter content' data-name="mail_content" style="min-height:200px;min-width:50px">{!! $rank->mail_content !!}</div> 
                                          </div>
                                      </div>
                                </div>
                           </div>  
                          </form>
                         

                         @endforeach

                      </div>
</div>

            

@endsection

@section('scripts') @parent
      <script src="{{ asset('assets/admin/js/welcome-settings-editable.js') }}"></script>
    @endsection 