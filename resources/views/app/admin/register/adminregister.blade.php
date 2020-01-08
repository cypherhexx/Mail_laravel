@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent
<style type="text/css">
.form-control-feedback {
    display: none;
}

.wizard>.actions>ul>li>a[href="#finish"] {
    display: none
}
</style>
@endsection {{-- Content --}} @section('main') @include('utils.errors.list') @include('utils.vendor.flash.message')
<!-- Wizard with validation -->
<div class="row">
            
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                     <div class="panel panel-flat">
                          <div class="panel-heading">
                            <h5 class="panel-title">{{trans('registration.create_new_admin')}}</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                          </div>
                        <div class="panel-body">
                   <form action="{{url('admin/admin_register')}}" method="POST" data-parsley-validate="true" name="form-wizard">

                    <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                    <input type="hidden" name="payment" id="payment" value="cheque">
                    <input type="hidden" name="payable_vouchers[]" value=""> 

                                <div id="wizard">
                                    
                                    <!-- wizard start -->
                                                             
                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full"> {{trans('register.contact_information') }}  </legend>                                           
                                                 
                                            <!-- end row -->
                                             <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                       <label>{{trans('register.name') }} <span>*</span> </label>
                                                        <input type="text" name="firstname" value="{{old('firstname')}}" placeholder="Name" class="form-control" data-parsley-group="wizard-step-1"  required />   
                                                        
                                                    </div>
                                                </div>

                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('register.mobile') }}  <span>*</span>  </label>
                                                            <input type="text" name="phone"  class="form-control" data-parsley-group="wizard-step-1" value="{{old('phone')}}"  required placeholder="{{trans('register.mobile') }} " required >
                                                        
                                                    </div>
                                                </div>                              
                                               </div>


                                             <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('register.email') }} <span>*</span> </label>
                                                        <input type="email" name="email" id="email" placeholder="{{trans('register.email') }}" class="form-control" data-parsley-group="wizard-step-2" value="{{old('email')}}" data-parsley-type="email"  required />
                                                        <span id="errsemail"></span>
                                                       
                                                        
                                                    </div>
                                                </div>                                               
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> {{trans('register.username') }} <span>*</span> </label>
                                                        <div class="controls">
                                                            <input type="text" name="username" id="username" placeholder="{{trans('register.username') }}" class="form-control" value="{{old('username')}}" data-parsley-group="wizard-step-1" data-parsley-type="alphanum" required />
                                                              <span id="errsuser"></span>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>


                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> {{trans('register.password') }} <span>*</span> </label>
                                                        <div class="controls">
                                                            <input type="password" name="password"  id="password" placeholder=" {{trans('register.password') }} {{trans('register.minimum_6_characters')}}" class="form-control" data-parsley-group="wizard-step-1"  data-parsley-minlength="6" required />
                                                        </div>
                                                    </div>
                                                </div>                                               
                                                 <!-- begin col-4 -->
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('register.confirm_password') }} <span>*</span> </label>
                                                        <div class="controls">
                                                            <input type="password" name="password_confirmation" placeholder="{{trans('register.confirm_password') }}" class="form-control"  data-parsley-group="wizard-step-3" data-parsley-minlength="6" data-parsley-equalto="#password" />
                                                        </div>
                                                    </div>
                                                </div>                                               
                                            </div>

                                              <div class="text-center">
                                             <div class="text-center">
                                             <p><button class="btn btn-success" role="button"> {{trans('register.confirm') }}</button></p>

                                             </div>
                                               </div>

                                          

                                                
                                        </fieldset>
                                    </div>                                              
             
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
@endsection