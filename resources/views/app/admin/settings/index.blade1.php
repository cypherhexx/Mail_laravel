@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')
<link href="{{ asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css') }}" rel="stylesheet"/>
@endsection

{{-- Content --}}
@section('main')

<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">{{ trans('settings.settings') }}</h4>
<div class="heading-elements">
                             <button id="enable" type="submit" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
</div>




                             
                        </div>
                        <div class="panel-body"> 
                          <form id="settings">                             
                        <legend>{{ trans('settings.binary_commission_settings') }}</legend>
                        <div class="col-sm-6">                          
                                <fieldset>                                   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label  class="form-label" for="point_value">{{ trans('settings.point_value') }}:</label>    
                                            </div>
                                            <div class="col-sm-8">
                                                <a class="settings form-control" data-type='text' id="point_value" data-title='Enter Point Value , What is the point for each Product/Enroll' data-name="point_value">
                                                 {{ $settings->point_value}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="pair_value">{{ trans('settings.pair_value') }}:</label>
                                            </div>
                                            <div class="col-sm-8">
                                                 <a class="settings form-control" id="pair_value" data-type='text' data-title='Enter Pair amount ,How Much amount will get for one pair' data-name="pair_value">
                                                 {{ $settings->pair_value}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="pair_amount">{{ trans('settings.pair_amount') }} :</label>
                                            </div>
                                            <div class="col-sm-8">
                                                 <a class="settings form-control" id="pair_amount" data-type='text' data-title='Enter Pair amount ,How Much amount will get for one pair' data-name="pair_amount">
                                                 {{ $settings->pair_amount}}
                                                </a>
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
                                                <label for="tds">Tax :</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control" data-type='text' id="tds" data-title='Taxamount, The % amount will decuct from each commission received by member ' data-name="tds">
                                                 {{ $settings->tds}}
                                                </a>   
                                                 <span class=" input-group-addon">%</span>                                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="service_charge">{{ trans('settings.service_charge') }} :</label>
                                            </div>
                                            <div class="col-sm-6 input-group">
                                                 <a class="settings form-control"  id="service_charge" data-type='text' data-title='Service charge, The % amount will decuct from each commission received by member as service charge ' data-name="service_charge">
                                                 {{ $settings->service_charge}}
                                                </a> 
                                                <span class=" input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-4">
                                                <label for="sponsor_Commisions">{{ trans('settings.sponsor_commisions') }}:</label>
                                            </div>
                                            <div class="col-sm-6">
                                                 <a class="settings form-control"  id="service_charge" data-type='text' data-title='Sponsor commisions, The amount for member when he enroll a new member' data-name="sponsor_Commisions">
                                                 {{ $settings->sponsor_Commisions}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>                                    
                                </fieldset>
                        </div>
                    </form>
                        
                      
                    
                </div>
            </div>
                  

            
@endsection



@section('scripts') @parent

<script src="{{ asset('assets/globals/plugins/x-editables/js/bootstrap-editable.min.js') }}"></script><!-- jQuery vectormap-->
<script src="{{ asset('assets/admin/js/settings-editable.js') }}"></script><!-- jQuery vectormap-->

    <script>
        $(document).ready(function() {
            App.init();           
        });
       

        
    </script>
    @endsection