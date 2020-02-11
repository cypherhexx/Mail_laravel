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
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">{{trans('register.register_new_memeber') }}</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-vertical steps-validation" action="{{url('admin/register')}}" method="POST" data-parsley-validate="true" name="form-wizard">
            {!! csrf_field() !!}
            <input type="hidden" name="payment" id="payment" value="cheque">
            <input type="hidden" name="pack_new" id="pack_new" value="">

          
              <input type="hidden" name="payable_vouchers[]" value=""> 


             
          <!--   <h6 class="width-full">{{trans('register.network_information') }}  </h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('sponsor') ? ' has-error' : '' }}">
                            {!! Form::label('sponsor', trans("all.sponsor"), array('class' => 'control-label')) !!}
                            <input class="form-control" value="{{Auth::user()->username}}" required="required" data-parsley-required-message="all.please_enter_sponsor_name" name="sponsor" type="text" id="sponsor" data-parsley-group="block-0" data-parsley-sponsor="null"> -->
                            <!--data-parsley-remote="data-parsley-remote" data-parsley-remote-validator="validate_sponsor" data-parsley-remote-options='{ "type": "POST", "dataType": "jsonp", "data": { "csrf": {{csrf_token()}} } }' data-parsley-remote-message="all.there_is_no_user_with_that_username" data-parsley-trigger-after-failure="change" data-parsley-trigger="change" 
                            -->
                         <!--    <div class="form-control-feedback">
                                <i class="icon-person text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.type_your_sponsors_username") !!}</small>
                                @if ($errors->has('sponsor'))
                                <strong>{{ $errors->first('sponsor') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    @if($leg)
                    <div class="col-md-4">
                        <div class="required form-group{{ $errors->has('placement_user') ? ' has-error' : '' }}">
                            {!! Form::label('placement_user', trans("all.placement_username"), array('class' => 'control-label')) !!} {!! Form::text('placement_user', $placement_user, ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_placement_username") ,'data-parsley-group' => 'block-0','value' => $placement_user,'readonly']) !!}
                        </div>
                    </div>
                    @else @if($placement_user)
                    <input type="hidden" name="placement_user" placeholder="{{trans('register.placement_username')}}" class="form-control" value="{{$placement_user}}" required /> @endif @endif -->
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <!-- <div class="col-md-4">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('leg') ? ' has-error' : '' }}">
                            {!! Form::label('leg', trans("register.position"), array('class' => 'control-label',($leg)? 'readonly' : "")) !!}
                            <select class="form-control" name="leg" id="leg" required data-parsley-group="block-0">
                                <option @if($leg=='L' ) selected @endif value="L">{{ trans('register.left')}}</option>
                                <option @if($leg=='R' ) selected @endif value="R">{{ trans('register.right')}}</option>
                            </select>
                            <div class="form-control-feedback">
                                <i class=" icon-drag-left-right text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.type_your_sponsors_username") !!}</small>
                                @if ($errors->has('sponsor_name'))
                                <strong>{{ $errors->first('sponsor_name') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div> -->
             <!--        <div class="col-md-4">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('package') ? ' has-error' : '' }}">
                            {!! Form::label('package', trans("register.package"), array('class' => 'control-label')) !!}
                            <select class="form-control" name="package" id="package" required="required" data-parsley-required-message="Please Select Package" data-parsley-group="block-0">
                                @foreach($package as $data)
                                <option value="{{$data->id}}" amount="{{$data->amount}}" rs="{{$data->rs}}" pv="{{$data->pv}}">{{$data->package}}</option>
                                @endforeach
                            </select>
                            <div class="form-control-feedback">
                                <i class="icon-crown text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.select_package") !!}</small>
                                @if ($errors->has('package'))
                                <strong>{{ $errors->first('package') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div> -->
         <!--        </div>
            </fieldset> -->
            <h6 class="width-full">  {{trans('register.contact_information') }}  </h6>
            <fieldset>

                     <div class="row">
   
                  <div class="col-md-6">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('sponsor') ? ' has-error' : '' }}">
                            {!! Form::label('sponsor', trans("all.sponsor"), array('class' => 'control-label')) !!}
                            <input class="form-control" value="{{Auth::user()->username}}" required="required" data-parsley-required-message="all.please_enter_sponsor_name" name="sponsor" type="text" id="sponsor" data-parsley-group="block-0" data-parsley-sponsor="null" readonly>
                            <!--data-parsley-remote="data-parsley-remote" data-parsley-remote-validator="validate_sponsor" data-parsley-remote-options='{ "type": "POST", "dataType": "jsonp", "data": { "csrf": {{csrf_token()}} } }' data-parsley-remote-message="all.there_is_no_user_with_that_username" data-parsley-trigger-after-failure="change" data-parsley-trigger="change" 
                            -->
                            <div class="form-control-feedback">
                                <i class="icon-person text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.type_your_sponsors_username") !!}</small>
                                @if ($errors->has('sponsor'))
                                <strong>{{ $errors->first('sponsor') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>






                           @if($leg)
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('placement_user') ? ' has-error' : '' }}">
                            {!! Form::label('placement_user', trans("all.placement_username"), array('class' => 'control-label')) !!} {!! Form::text('placement_user', $placement_user, ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_placement_username") ,'data-parsley-group' => 'block-0','value' => $placement_user,'readonly']) !!}
                        </div>
                    </div>
                    @else @if($placement_user)
                    <input type="hidden" name="placement_user" placeholder="{{trans('register.placement_username')}}" class="form-control" value="{{$placement_user}}" required /> @endif @endif

               
                </div>
                <div class="row">
                         <div class="col-md-6">
                        <div class="required form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans("register.firstname"), array('class' => 'control-label')) !!} {!! Form::text('firstname', Input::old('firstname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-0']) !!}
                            <span class="help-block">
                                <small>{!!trans("all.your_firstname") !!}</small>
                                @if ($errors->has('firstname'))
                                <strong>{{ $errors->first('firstname') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            {!! Form::label('lastname', trans("register.lastname"), array('class' => 'control-label')) !!} {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-0']) !!}
                            <span class="help-block">
                                <small>{!!trans("all.your_lastname") !!}</small>
                                @if ($errors->has('lastname'))
                                <strong>{{ $errors->first('lastname') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>

                
                </div>
                <!-- end row -->
                <div class="row">

                   <div class="col-md-6">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('country') ? ' has-error' : '' }}">
                            {!! Form::label('country', trans("register.country"), array('class' => 'control-label')) !!} {!! Form::select('country', $countries ,'IL',['class' => 'form-control','id' => 'country','required' => 'required','data-parsley-required-message' => trans("all.please_select_country"),'data-parsley-group' => 'block-1']) !!}
                            <div class="form-control-feedback">
                                <i class="fa fa-flag-o text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.select_country") !!}</small>
                                @if ($errors->has('country'))
                                <strong>{{ $errors->first('country') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            {!! Form::label('state', trans("register.state"), array('class' => 'control-label')) !!} {!! Form::select('state', $states ,'WA',['class' => 'form-control','id' => 'state']) !!}
                            <span class="help-block">
                                <small>{!!trans("all.select_your_state") !!}</small>
                                @if ($errors->has('state'))
                                <strong>{{ $errors->first('state') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>

             
                </div>
                <!-- end row -->
                <div class="row">
                    <!-- begin col-6 -->

                                <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            {!! Form::label('zip', trans("register.zip_code"), array('class' => 'control-label')) !!} {!! Form::text('zip', Input::old('zip'), ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-0','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]) !!}
                            <span class="help-block">
                                <span id="ziplocation"><span></span></span>
                            <span id="ziperror"></span>
                            <small>{!!trans("all.your_zip") !!}</small> @if ($errors->has('zip'))
                            <strong>{{ $errors->first('zip') }}</strong> @endif
                            </span>
                        </div>
                    </div>
               
                    <div class="col-md-6">
                        <div class="required form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            {!! Form::label('address', trans("register.address"), array('class' => 'control-label')) !!} {!! Form::textarea('address', Input::old('address'), ['class' => 'form-control','required' => 'required','id' => 'address','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address"),'data-parsley-group' => 'block-0']) !!}
                            <span class="help-block">
                                <small>{!!trans("all.your_address") !!}</small>
                                @if ($errors->has('address'))
                                <strong>{{ $errors->first('address') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>

             
                </div>
                <div class="row">
                    <!-- begin col-6 -->

                                <div class="col-md-6">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('city') ? ' has-error' : '' }}">
                            {!! Form::label('city', trans("register.city"), array('class' => 'control-label')) !!} {!! Form::text('city', Input::old('city'), ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-city text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.your_city") !!}</small>
                                @if ($errors->has('city'))
                                <strong>{{ $errors->first('city') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
               
                    <div class="col-md-6">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('gender') ? ' has-error' : '' }}">
                            {!! Form::label('gender', trans("register.gender"), array('class' => 'control-label')) !!} {!! Form::select('gender', array('m' => trans("all.male"), 'f' => trans("all.female") ,'other' =>trans("all.other")),NULL,['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_select_gender"),'data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <i class="fa fa-neuter text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.select_your_gender_from_list") !!}</small>
                                @if ($errors->has('gender'))
                                <strong>{{ $errors->first('gender') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
            

                
                </div>
                <div class="row">
                    <!-- begin col-6 -->

                        <div class="col-md-6">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::label('phone', trans("register.phone"), array('class' => 'control-label')) !!} {!! Form::text('phone', Input::old('phone'), ['class' => 'form-control','id' => 'phone','data-parsley-required-message' => trans("all.please_enter_phone_number"),'data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <i class=" icon-mobile3 text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.enter_your_phone_number") !!}</small>
                                @if ($errors->has('phone'))
                                <strong>{{ $errors->first('phone') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', trans("register.email"), array('class' => 'control-label')) !!} {!! Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','id' => 'email','data-parsley-required-message' => trans("all.please_enter_email"),'data-parsley-group' => 'block-0']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.type_your_email") !!}</small>
                                @if ($errors->has('email'))
                                <strong>{{ $errors->first('email') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>

                           
                </div>


                <div class="row">
                    <!-- begin col-6 -->
             
                    <!-- begin col-4 -->
                 
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="transaction_pass" class="form-control" placeholder="Transaction Password " value="{{$transaction_pass}}" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <h6 class="width-full">  {{trans('register.login_information') }}   </h6>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', trans("register.username"), array('class' => 'control-label')) !!} {!! Form::text('username', Input::old('username'), ['class' => 'form-control','required' => 'required','id' => 'username','data-parsley-required-message' => trans("all.please_enter_username"),'data-parsley-type' => 'alphanum','data-parsley-group' => 'block-1']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.desired_username_used_to_login") !!}</small>
                                @if ($errors->has('username'))
                                <strong>{{ $errors->first('username') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4">
                        <div class="passy required form-group has-feedbackX has-feedback-leftx {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', trans("register.password"), array('class' => 'control-label')) !!}
                            <div class="input-group label-indicator-absolute">
                                {!! Form::text('password','', ['class' => 'form-control pwstrength','required' => 'required','id' => 'password','data-parsley-required-message' => trans("all.please_enter_password"),'data-parsley-minlength'=>'6','data-parsley-group' => 'block-1']) !!}

                               
                                <span class="label password-indicator-label-abs"></span>
                                 <span class="input-group-addon copylink">
                                   <a class="btn btn-link btn-copy" style="margin: 0 auto;padding: 0px;font-size: 12px;" data-clipboard-action="copy" data-clipboard-target="#password" data-popup="tooltip" title="copy password" data-placement="top"><i class="fa fa-copy"></i>
                                   </a>
                               </span>
                                <span class="input-group-addon">
                                                    <a class="generate-pass" href="javascript:void(0)" data-popup="tooltip" title="{{trans('register.generate_a_password')}}" data-placement="top" ><i class="icon-googleplus5"></i></a>
                                                </span>
                            </div>
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.a_secure_password") !!}</small>
                                @if ($errors->has('password'))
                                <strong>{{ $errors->first('password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('confirm_password', trans("register.confirm_password"), array('class' => 'control-label')) !!} {!! Form::text('confirm_password','', ['class' => 'form-control','required' => 'required','id' => 'confirm_password','data-parsley-equalto' => '#password','data-parsley-required-message' => trans("all.please_enter_password_confirmation"),'data-parsley-minlength'=>'6','data-parsley-group' => 'block-1']) !!}
                            <div class="form-control-feedback">
                                <i class="icon-user-check text-muted"></i>
                            </div>
                            <span class="help-block">
                                <small>{!!trans("all.confirm_your_password") !!}</small>
                                @if ($errors->has('confirm_password'))
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                @endif
                            </span>
                        </div>
                    </div>
                    <!-- end col-6 -->
                </div>
                <div class="bhoechie-tab-content active">
                    <div class="text-center">
                        <!--  <div class="text-center">
                            <h1>{{trans('register.confirm_registration') }}</h1>
                            
                            <p><button class="btn btn-success btn-lg" role="button">{{trans('register.click_to_complete_registration') }}</button></p>
                        </div> -->
                    </div>
                </div>
                <!-- end row -->
            </fieldset>
            <h6 class="width-full">  {{trans('register.payment') }}   </h6>
            <fieldset>
             <div class="2_box">
                <div class="m-b-0 text-center">
                    <div class="containerX">
                        <div class="row bhoechie-tab-container">
                            <div class="col-xs-12 ">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                                    <div class="list-group">
                                        @foreach($payment_type as $payment) @if($payment->id==1)
                                        <a href="#" payment="{{$payment->code}}" class="list-group-item text-center active" class="">
                                            <h4 class="glyphicon glyphicon-send"></h4>
                                            <br/>Bank Transfer
                                        </a>
                                        @else
                                        <a href="#" payment="{{$payment->code}}" class="list-group-item text-center " class="">
                                            <h4 class="glyphicon glyphicon-send"></h4>
                                            <br/>Card Payment
                                        </a>
                                        @endif @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                                    @foreach($payment_type as $pay) @if($pay->payment_name=="Cheque")
                                        <div class="bhoechie-tab-content active">

                                            <div class="text-center">
                                                <div class="text-center">
                                                    <h1> <p class="text-success">
                                                        
                                                        {{trans('register.joining_fee') }}:
                                                        <span name="fee" id="joiningfee"> {{$joiningfee}} </span>
                                                        
                                                        
                                                        
                                                        
                                                    </p></h1>
                                                    <h3>{{trans('register.confirm_registration') }}</h3>
                                                    <p>
                                                        <button class="btn btn-success btn-lg" role="button">Bank Transfer Confirmation</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($pay->payment_name=="Ewallet")

                                    <div class="bhoechie-tab-content ">
                                        <div class="text-center">
                                            <div class="text-center">
                                                <h1> <p class="text-success">
                                                    
                                                    {{trans('register.joining_fee') }}:
                                                    <span name="fee" class="ewallet_joining"> 70 </span>
                                                    
                                                  
                                                    
                                                    
                                                </p></h1>
                                                <h3>{{trans('register.confirm_registration') }}</h3>
                                                <p>
                                                    <button class="btn btn-success btn-lg" role="button">{{$pay->payment_name}} payment confirmation</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    @elseif($pay->payment_name=="Stripe")
                                     <div class="bhoechie-tab-content   ">
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-sm-6 center col-sm-offset-3">
                                                    <input 
                                               type="button"
                                               id="stripe_btn"
                                               class="btn btn-primary"
                                               value="Pay with Card"
                                               data-key="{{config('services.stripe.key')}}"
                                               data-amount=""
                                               data-currency="USD"
                                               data-bitcoin="false"
                                               data-name="Binary-ath"
                                               data-description="info@solidus.cc"
                                               data-locale="auto"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row stripe_div" >    
                                                All transactions are handled securely with <a href="https://stripe.com" >https://stripe.com</a>   
                                            </div>
                                        </div>
                                    </div> 


                                    @elseif($pay->payment_name=="Paypal")
                                    <div class="bhoechie-tab-content ">
                                        <div class="text-center">
                                            <div class="text-center">
                                                <h1> <p class="text-success">
                                                    
                                                    {{trans('register.joining_fee') }}:
                                                    <span >{{$joiningfee}}</span>
                                                    
                                                </p></h1>
                                                <h3>{{trans('register.confirm_registration') }}</h3>
                                                <p>
                                                    <button class="btn btn-success btn-lg" role="button">Card payment confirmation</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                   @elseif($pay->payment_name=="Voucher")
                                         <div class="bhoechie-tab-content ">
                                          <div class="text-center">
                                          <div class="text-center">
                                         
                                          <h1><p class="text-success">     
                                      <!--   {{trans('register.joining_fee') }}:$
                                                        <span name="fee" id="voucher_joining">70  </span> -->
                                           </p></h1>
                              <!--   #reg         --> 
                                 <div class="tab-pane fade in" id="steps-planpurchase-tab1">
                                   <table class="table table-dark bg-slate-600 table-vouher-regpayment">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>voucher code</th>
                                        <th>amound used</th>
                                        <th>balance</th>
                                        <th>remaining</th>
                                        <th>validate voucher</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td><input type="text" name="voucher[]" class="form-control"></td>
                                        <td><span class="amount"></span></td>
                                        <td><span class="balance"></span></td>                             
                                        <td><span class="remaining"></span></td>                             
                                        <td class="td-validate-voucher"><button class="btn btn-info validatevoucher" onclick="return false;">{{trans('register.validate') }}</button></td>


                                      </tr>
                                      </tbody>
                                       <p><button id="resulttable" class="btn btn-primary" payment="{{$pay->code}}" role="button" style="border-color:#00bcd4; background-color: #00bcd4" >{{{ trans('all.confirm') }}}</button></p>
                            </table>
                        </div>


                                   
                                       
                                        </div>
                                        </div>
                                        </div> 
                                    @endif @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    </div>
    </fieldset>
    </form>
</div>
</div>
</div>
</div>
@endsection @section('overscripts') @parent
<script type="text/javascript">
var joiningfe = {{ $joiningfee }};
</script>
@endsection @section('scripts') @parent

<script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>
<script src="//www.paypalobjects.com/api/checkout.js" async></script>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="text/javascript">
       $(document).ready(function() {
           $('#stripe_btn').on('click', function(event) {
               event.preventDefault();
               var $button = $(this),
                   $form = $button.parents('form');
               var opts = $.extend({}, $button.data(), {
                   token: function(result) {
                       $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                   }
               });
               StripeCheckout.open(opts);
           });
       });
</script>
<script type="text/javascript">
   $(document).ready(function() {
       $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
          e.preventDefault();
          $(this).siblings('a.active').removeClass("active");
          $(this).addClass("active");
          var index = $(this).index();
          $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
          $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
          $('#payment').val($(this).attr('payment'));
   });
  });
</script>

<script type="text/javascript">
$(document).ready(function(){
$("#package").change(function(){
$(this).find("option:selected").each(function(){
var optionValue = $(this).attr("value");
$('#pack_new').val(optionValue);


});
}).change();
});

</script>
@endsection