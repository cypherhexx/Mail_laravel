@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}
@section('main')

<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">{{trans('ticket_config.email_settings')}}</h4>
<div class="heading-elements">
                             <button id="enable-email-settings-edit" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
</div>



                             
                        </div>
                        <div class="panel-body"> 
                          <form id="settings">                             
                        <legend>{{trans('ticket_config.email_settings')}}</legend>

                       
                        @foreach($settings as $email)

                         <div class="col-sm-6">
                         <fieldset>
                              <div class="form-group">
                                    <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('email_config.welcome_email')}}</label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$email->id}}" data-type='text' id="username" data-title='Enter username' data-name="username">
                                                 {{$email->username}}
                                                 </a>
                                           </div>
                                           
                                    </div>
                              </div> 
                           

                                 <div class="form-group">
                                       <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('email_config.rank_email')}} </label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$email->id}}" data-type='text' id="password" data-title='Enter password' data-name="password">
                                                 {{$email->password}}
                                                 </a>
                                           </div>
                                          
                                       </div>
                                 </div> 

                            <div class="form-group">
                                       <div class="row">
                                      
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('email_config.referal_email')}} </label>    
                                           </div>

                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$email->id}}" data-type='text' id="incoming_server" data-title='Enter incoming server' data-name="incoming_server">
                                                 {{$email->incoming_server}}
                                                 </a>
                                           </div>
                                           
                                       </div>
                            </div>
                        </fieldset> 
                        </div>
                        <div class="col-sm-6">
                         <div class="form-group">
                                       <div class="row">
                                       <!-- <div class="col-sm-6"> -->
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('email_config.payout_email')}} </label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$email->id}}" data-type='text' id="incoming_port" data-title='Enter incoming port' data-name="incoming_port">
                                                 {{$email->incoming_port}}
                                                 </a>
                                           </div>
                                          <!--  </div> -->
                                       </div>
                                   </div> 

                            <div class="form-group">
                                       <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('email_config.lead_email')}}</label>    
                                           </div>

                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$email->id}}" data-type='text' id="outgoing_server" data-title='Enter outgoing server' data-name="outgoing_server">
                                                 {{$email->outgoing_server}}
                                                 </a>
                                           </div>
                                           
                                       </div>
                             </div> 
                            <div class="form-group">
                                       <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value">{{trans('email_config.fundtransfer_email')}}</label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="{{$email->id}}" data-type='text' id="outgoing_port" data-title='Enter outgoing port' data-name="outgoing_port">
                                                 {{$email->outgoing_port}}
                                                 </a>
                                           </div>
                                           
                                       </div>
                            </div> 
                         </div>
                         @endforeach
                       
                        
                        </form>

                       
                     
                    
                </div>
            </div>
                  

            
@endsection



