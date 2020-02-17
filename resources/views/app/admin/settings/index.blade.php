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
                                       
                                <fieldset>                                   
                                   

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Direct Referral (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="direct_referral" data-type='text' data-pk="{{$settings->id}}" data-title='Direct Referral' data-name="direct_referral">
                                                 {{ $settings->direct_referral}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Joininf Fee Referral (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="joinfee" data-type='text' data-pk="{{$settings->id}}" data-title='Joining Fee' data-name="joinfee">
                                                 {{ $settings->joinfee}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   

                                      <h4>Withdraw Settings</h4>

                                                               <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Withdraw Percent (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="withdraw_percent" data-type='text' data-pk="{{$settings->id}}" data-title='withdraw percent' data-name="withdraw_percent">
                                                 {{ $settings->withdraw_percent}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   

                                         <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Withdra Period (days):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="withdraw_days" data-type='number' data-pk="{{$settings->id}}" data-title='Days' data-name="withdraw_days">
                                                 {{ $settings->withdraw_days}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>  


                                  
                                    <!--   <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Three Friends (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="three_friends" data-type='text' data-pk="{{$settings->id}}" data-title='three friends' data-name="three_friends">
                                                 {{ $settings->three_friends}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>    -->
<!-- 
                                         <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Eight Friends (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="eight_friends" data-type='text' data-pk="{{$settings->id}}" data-title='eight friends' data-name="eight_friends">
                                                 {{ $settings->eight_friends}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   -->

                                 
                              

                                </fieldset>                            
                 
                     
                    </form>
                        
                        
                       
                </div>
              

            </div>
                  

            
@endsection

