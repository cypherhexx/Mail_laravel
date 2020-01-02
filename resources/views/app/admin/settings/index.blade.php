@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


{{-- Content --}}
@section('main')

<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">{{trans('settings.commission_settings')}}</h4>
<div class="heading-elements">
                            <button id="enable_settings" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
</div>


                            
                        </div>

                        <div class="panel-body"> 
                          <form id="settings">                             
                        <legend>{{trans('settings.commission_settings')}}</legend>
                        <div class="col-sm-6">                          
                                <fieldset>                                   
                                   

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="">{{trans('ticket_config.joining_fee')}}:</label>
                                            </div>
                                            <div class="col-sm-6">
                                                 <a class="settings form-control"  id="service_charge" data-type='text' data-pk="{{$settings->id}}" data-title='Joining Fee, The amount for member when he joins' data-name="joinfee">
                                                 {{ $settings->joinfee}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>   

                                     <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="sponsor_Commisions">{{ trans('settings.fast_start') }} :</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Sponsor commisions, The amount for member when he enroll a new member' data-name="sponsor_Commisions">
                                                 {{ $settings->sponsor_Commisions}}
                                                 
                                                </a>
                                                    <span class=" input-group-addon">%</span>   
                                            </div>
                                        </div>
                                    </div>  

                                     <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="sponsor_Commisions">{{ trans('settings.indirect_fast_start_level_one') }} :</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Sponsor commisions, The amount for member when he enroll a new member' data-name="sponsor_Commisions">
                                                 5
                                                </a>
                                                    <span class=" input-group-addon">%</span>   
                                            </div>
                                        </div>
                                    </div>  
                                     <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="sponsor_Commisions">{{ trans('settings.indirect_fast_start_level_two') }} :</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Sponsor commisions, The amount for member when he enroll a new member' data-name="sponsor_Commisions">
                                                4
                                                </a>
                                                <span class=" input-group-addon">%</span>   
                                            </div>
                                        </div>
                                    </div> 

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="sponsor_Commisions">{{ trans('settings.indirect_fast_start_level_three') }} :</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Sponsor commisions, The amount for member when he enroll a new member' data-name="sponsor_Commisions">
                                                 3
                                                </a>
                                                <span class=" input-group-addon">%</span>   
                                            </div>
                                        </div>
                                    </div>  

                                </fieldset>                            
                        </div> 
                        <div class="col-sm-6">
                          
                                <fieldset>
                                     <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="tds">{{ trans('settings.tax') }} :</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control" data-type='text' id="tds" data-pk="{{$settings->id}}" data-title='Taxamount, The % amount will decuct from each commission received by member ' data-name="tds">
                                                 {{ $settings->tds}}
                                                </a>   
                                                 <span class=" input-group-addon">%</span>                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="service_charge">{{ trans('settings.service_charge') }}:</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Service charge, The % amount will decuct from each commission received by member as service charge ' data-name="service_charge">
                                                 {{ $settings->service_charge}}
                                                </a> 
                                                <span class=" input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="service_charge">{{ trans('settings.binary_bonus') }}:</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Service charge, The % amount will decuct from each commission received by member as service charge ' data-name="service_charge">
                                                10 
                                                </a> 
                                                <span class=" input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="service_charge">{{ trans('settings.matching_bonus_one') }}:</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Service charge, The % amount will decuct from each commission received by member as service charge ' data-name="service_charge">
                                                5 
                                                </a> 
                                                <span class=" input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="service_charge">{{ trans('settings.matching_bonus_two') }}:</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Service charge, The % amount will decuct from each commission received by member as service charge ' data-name="service_charge">
                                                3 
                                                </a> 
                                                <span class=" input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="service_charge">{{ trans('settings.matching_bonus_three') }}:</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-pk="{{$settings->id}}" data-type='text' data-title='Service charge, The % amount will decuct from each commission received by member as service charge ' data-name="service_charge">
                                                2 
                                                </a> 
                                                <span class=" input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                     
                                    



                                                                        
                                </fieldset>
                        </div>
                    </form>
                        
                        
                       
                </div>
              

            </div>
                  

            
@endsection

