@extends('layouts.auth')

<div class="bg-register">
@section('content')




<!-- Wizard with validation -->

<style type="text/css">
.binary-demo{
    padding: 10px 20px;
}
.sponse-img {
    padding: 10px 40px;
    width: 285px;
    margin: 0 auto;
}
.side-1 h3 {
    font-family: 'Abel',sans-serif;
    text-transform: uppercase;
    font-size: 22px;
    padding: 0 0 10px 10px;
    border-bottom: solid 1px #ccc;
}
.side-1 h3 i {
    color: #2196F3;
    margin-right: 10px;
}
.side-1 h3 span {
    color: #2196F3;
}
.binary-dlt {
    padding: 0;
}

.clear {
    padding: 0;
    margin: 0;
    clear: both;
}
.side-1 {
    background: #fff;
    margin-top: 30px;
    -webkit-box-shadow: 0 0 12px -5px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 0 0 12px -5px rgba(0, 0, 0, 0.75);
    box-shadow: 0 0 12px -5px rgba(0, 0, 0, 0.75);
    margin-bottom: 30px;
}
.bdr {
    padding: 10px;
}
.binary-dlt li {
    list-style: none;
    padding: 10px 0;
    font-size: 17px;
}
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.428571429;
    color: #333;
    background-color: #fff;
}

li {
    display: list-item;
    text-align: -webkit-match-parent;
}
ul, menu, dir {
    display: block;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}

.vide-strap {
    background: url(../images/blr-img.png) center center no-repeat;
    position: relative;
    width: 100%;
    font-size: 30px;
    font-family: 'Abel',sans-serif;
    color: #333333;
    padding: 21px 10px;
    text-transform: uppercase;
    line-height: 54px;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.bg-register{
      background-image:url('img/cache/original/register-bg-1.jpg');
        background-repeat: no-repeat;
        background-size:cover;
        width: 100%;
        height: auto;
      
      
}
.side-1{
    margin-top:0px;
}
.binary-dlt li{
    font-size: 16px;
}
</style>

<!-- Wizard with validation -->
<div class="row">
<!--<div class="col-md-4">
	<div class="row">
<a href="https://algolight.net/"><img src="img/cache/original/algo-logo.png" width="40%" height="auto"></a>
<a href="http://vintagehut.in/wordpress-demo/cloud-2162/home/"><img src="{{url('img/cache/logo/alg-logo-004.png')}}"></a>
</div>
</div>-->
<div class="col-md-8 col-md-offset-4">
    <div class="vide-strap">
         @if($sponsor_name != NULL)
          <p>Welcome , This site is sponsored by <b>{{ $sponsor[0]->username }}</b> </p>
         @endif
    </div>
</div>
</div>
<div class="col-md-3 side-1 padding-1">
@if($sponsor_name != NULL)
    <div class="panel panel-white" >
    <h3 class="bdr">
        <i class="fa fa-newspaper-o"></i>Sponsor
        <span>Info</span>
    </h3>
    <div class="sponse-img">
        <div class="img-circle" id="profilephotopreview" style="width:100px;height:100px;margin:0px auto;background-image:url({{url('img/cache/profile/'.$profile_photo)}}">
        </div>
    </div>
    <div class="binary-demo">
        <h3>{{ $sponsor[0]->username }}</h3>
        <ul class="binary-dlt">
            <li>  
                {{trans('register.full_name')}} : {{ $sponsor[0]->name }}  {{ $sponsor[0]->lastname }}
            </li>
            <li>   
                {{trans('register.email')}} : {{ $sponsor[0]->email}}
            </li>
          
            <li>
                {{trans('register.country')}} : {{$profile[0]->country}}
            </li>
           

         
        </ul>
        <div class="social-media">
          
        </div>    
    </div>
   
    <div class="clear"></div>
    <div class="shadow"></div>
 </div>
 @endif
 </div>


    <div class="col-md-9">
                    <div class="side-2">
                        <div class="home-page">
                            
                            <script>
    jQuery(document).ready(function()
    {
        jQuery("#close_link").click(function()
        {
            jQuery("#message_box").fadeOut(1000);
        }
        )
    })
</script>  
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
        <h5 class="panel-title">New Member Register </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div><p style="text-align:center;"><img src="{{url('img/cache/original/atmor.png')}}" alt="logo" style="width:60px;height:60px;" align="middle"></p>
    </div>
    <div class="panel-body">

   
        <form class="form-vertical steps-validation" action="{{url('register')}}" method="POST" data-parsley-validate="true" name="form-wizard">
            {!! csrf_field() !!}
            <input type="hidden" name="payable_vouchers[]" value="">
            <!-- <input type="hidden" name="payment" id="payment" value="paypal"> -->
              <input type="hidden" name="payment" id="payment" value="cheque">
              <input type="hidden" name="pack_new" id="pack_new" value="">
            <input type="hidden" name="leg" id="leg" value="L">

           
            <h6 class="width-full">  {{trans('register.contact_information') }}  </h6>
            
            <h6 class="width-full">  {{trans('register.login_information') }}   </h6>
            
            <h6 class="width-full">  {{trans('register.payment') }}   </h6>
          <!--    <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('sponsor') ? ' has-error' : '' }}">
                            {!! Form::label('sponsor', trans("all.sponsor"), array('class' => 'control-label')) !!}
                            <input class="form-control" value="{{$sponsor_name}}" required="required" data-parsley-required-message="all.please_enter_sponsor_name" name="sponsor" type="text" id="sponsor" data-parsley-group="block-0" data-parsley-sponsor="null"> -->
                            <!--data-parsley-remote="data-parsley-remote" data-parsley-remote-validator="validate_sponsor" data-parsley-remote-options='{ "type": "POST", "dataType": "jsonp", "data": { "csrf": {{csrf_token()}} } }' data-parsley-remote-message="all.there_is_no_user_with_that_username" data-parsley-trigger-after-failure="change" data-parsley-trigger="change" 
                            -->
                     <!--        <div class="form-control-feedback">
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
                    @if($leg) -->
               <!--      <div class="col-md-4">
                        <div class="required form-group{{ $errors->has('placement_user') ? ' has-error' : '' }}">
                            {!! Form::label('placement_user', trans("all.placement_username"), array('class' => 'control-label')) !!} {!! Form::text('placement_user', $sponsor_name, ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_placement_username") ,'data-parsley-group' => 'block-0','value' => $placement_user,'readonly']) !!}
                        </div>
                    </div> -->
                 <!--    @else @if($placement_user) -->
                    <!-- <input type="hidden" name="placement_user" placeholder="{{trans('register.placement_username')}}" class="form-control" value="{{$placement_user}}" required />  -->
               <!--      @endif @endif -->
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                  <!--   <div class="col-md-4">
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
<!--                     <div class="col-md-4">
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
                    </div>
                </div>
            </fieldset> -->
            <fieldset>
                <div class="row">

                         <div class="col-md-6">
                        <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('sponsor') ? ' has-error' : '' }}">
                            {!! Form::label('sponsor', trans("all.sponsor"), array('class' => 'control-label')) !!}
                            @if($sponsor_name != NULL)
                            <input class="form-control" value="{{$sponsor_name}}" required="required" data-parsley-required-message="all.please_enter_sponsor_name" name="sponsor" type="text" id="sponsor" data-parsley-group="block-0" data-parsley-sponsor="null" readonly>
                            @else
                            <input class="form-control" value="{{$sponsor_name}}" required="required" data-parsley-required-message="all.please_enter_sponsor_name" name="sponsor" type="text" id="sponsor" data-parsley-group="block-0" data-parsley-sponsor="null">
                            @endif
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
                 
                </div>
                <!-- end row -->
                <div class="row">

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
                  
                </div>
                <!-- end row -->
                <div class="row">

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
              
                </div>
                <div class="row">

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
              
                </div>
                <div class="row">

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
                  
                </div>
                <div class="row">

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
             <fieldset>

                @if($joiningfee == 0)

                 <div class="m-b-0 text-center">
                    <div class="containerX">
                        <br><br>

                          <div class="text-center">
                                            <div class="text-center">
                                                <p>
                                                    <button class="btn btn-success btn-lg" role="button" style="background-color: #00bcd4; border-color: #00bcd4;width: 204px;font-size: 20px;">Free Registration</button>
                                                </p>
                                            </div>
                                        </div>

                                            </div>
                </div>
                @endif

                 @if($joiningfee >  0)



                <div class="m-b-0 text-center">
                    <div class="containerX">
                        <br><br>
                        <div class="row bhoechie-tab-container">
                            <div class="col-xs-12 ">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                                    <div class="list-group">
                                        @foreach($payment_type as $payment) @if($payment->id==4)
                                            <a href="#" payment="paypal" class="list-group-item text-center active" class="">

                                           <img src="{{url('img/cache/original/paypallogo.png')}}" style="width: 76px;height: 60px;">
                                        </a>
                                        @elseif($payment->id==6)
                                        <a href="#" payment="{{$payment->code}}" class="list-group-item text-center" class="">
                                              <img src="{{url('img/cache/original/bit.png')}}" style="width: 90px;height: 63px;">
                                        </a>
                                        @else
                                        <a href="#" payment="{{$payment->code}}" class="list-group-item text-center" class="">
                                             Bank transfer
                                        </a>
                                        @endif @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">


                                      
                                 
                                    @foreach($payment_type as $pay) @if($pay->payment_name=="Cheque")
                                    <div class="bhoechie-tab-content active">
                                        <div class="text-center">
                                            <div class="text-center">
                                                <h1> <p class="text-body">
                                                    
                                                    {{trans('register.joining_fee') }}:$
                                                    <span name="fee" id="joiningfee"> 70 </span>
                                                    
                                                    
                                                    
                                                </p></h1>
                                               
                                                <p>
                                                    <button class="btn btn-success btn-lg" role="button" style="background-color: #00bcd4; border-color: #00bcd4;">{{$pay->payment_name}} payment confirmation</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif($pay->payment_name=="Ewallet")
                                    <div class="bhoechie-tab-content ">
                                        <div class="text-center">
                                            <div class="text-center">
                                                <h1> <p class="text-body">
                                                    
                                                    {{trans('register.joining_fee') }}:$
                                                    <span name="fee" class="ewallet_joining"> 70 </span>
                                                    
                                                </p></h1>
                                               
                                                <p>
                                                    <button class="btn btn-success btn-lg"  role="button" style="background-color: #00bcd4; border-color: #00bcd4;">{{$pay->payment_name}} payment confirmation</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                
                                    @elseif($pay->payment_name=="Paypal")
                                    <div class="bhoechie-tab-content active">
                                        <div class="text-center">
                                             <div class="text-center">
                                                <h1> <p class="text-body">
                                                    
                                                    {{trans('register.joining_fee') }}:{{$currency_sy}}
                                                    <span name="fee" class="ewallet_joining"> {{$joiningfee}} </span>
                                                    
                                                </p></h1>
                                               
                                                <p>
                                                    <button class="btn btn-success btn-lg"  role="button" style="background-color: #00bcd4; border-color: #00bcd4;">Card payment confirmation</button>
                                                </p>
                                            </div>
                                            <div id="myContainer" style="margin-top:100px">
                                            </div>
                                        </div>
                                    </div>

                                         @elseif($pay->payment_name=="Bitcoin")
                                    <div class="bhoechie-tab-content">
                                        <div class="text-center">
                                            <div class="text-center">
                                                <h1> <p class="text-body">
                                                    
                                                    {{trans('register.joining_fee') }}:{{$currency_sy}}
                                                    <span name="fee" class="ewallet_joining"> {{$joiningfee}} </span>
                                                    
                                                </p></h1>
                                               
                                                <p>
                                                    <button class="btn btn-success btn-lg"  role="button" style="background-color: #00bcd4; border-color: #00bcd4;">{{$pay->payment_name}} payment confirmation</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    @elseif($pay->payment_name=="BankTransfer")
                                    <div class="bhoechie-tab-content">
                                        <div class="text-center">
                                            <div class="text-center">
                                                <h1> <p class="text-body">
                                                    
                                                    {{trans('register.joining_fee') }}:{{$currency_sy}}
                                                    <span name="fee" class="ewallet_joining"> {{$joiningfee}} </span>
                                                    
                                                </p></h1>
                                               
                                                <p>
                                                    <button class="btn btn-success btn-lg"  role="button" style="background-color: #00bcd4; border-color: #00bcd4;">{{$pay->payment_name}} payment confirmation</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                  
                         
                          <!--   <div class="bhoechie-tab-content ">
                              <div class="text-center">
                              <div class="text-center">
                              <h1><p class="text-success">   -->   
                          <!--   {{trans('register.joining_fee') }}:$
                                            <span name="fee" id="voucher_joining">70  </span> -->
                               <!-- </p></h1> -->
                  <!--   #reg         --> 
                     <div class="tab-pane fade in active" id="steps-planpurchase-tab1">
                       <table class="table table-dark bg-slate-600 table-vouher-regpayment">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Voucher code</th>
                            <th>Amount  used</th>
                            <th>Voucher balance</th>
                            <th>Remaining</th>
                            <th>Validate Voucher</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td><input type="text" name="voucher[]" class="form-control"></td>
                            <td><span class="amount"></span></td>
                            <td><span class="balance"></span></td>                             
                            <td><span class="remaining"></span></td>                             
                            <td class="td-validate-voucher"><button class="btn btn-info validatevoucher" onclick="return false;">Validate</button></td>


                          </tr>
                          </tbody>
                           <p><button id="resulttable" class="btn btn-primary" payment="{{$pay->code}}" role="button" style="border-color:#00bcd4; background-color: #00bcd4" >{{{ trans('all.confirm') }}}</button></p>
                </table>
            </div>


                            <div class="row">
                            <div class="col-sm-2">
                            <h5 style="color:silver";>Voucher No.</h5>
                            </div>
                            <div   class="col-sm-4">
                            <input type="text" name="key" id="key" placeholder="{{{ trans('all.voucher_key') }}}" class="form-control" />
                            </div>
                            <div   class="col-sm-2">
                            <a href="" id="verify" class="btn btn-default">{{{ trans('all.verify') }}}</a>
                            </div>
                            <div class="col-sm-4">
                            <div id ="err"></div>
                            </div>
                            </div>  


                           <!--  <table class="table" id="resulttable">

                            </table><br> -->
                           
                            </div>
                            </div>
                            </div> 


                                    @endif 
                                    @endforeach
                                <!-- </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
                @endif
    </fieldset>
        </form>  
    </div>
   
   
 </div>
 </div>

        @endsection



@section('topscripts')
@parent
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAPQXi7ZBZ73SPXi7JfHycSCi30thvQGCg&sensor=false&libraries=places"></script>

@endsection

@section('scripts')
@parent
 
<!--  <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script> -->

<script>

$('.location-picker').on('show.bs.dropdown', function (e) {

   callmap();

    $('.dropdown-menu').click(function(e) {
          e.stopPropagation();
    });

});


$("#location").on('keyup',function (e){
      $('.location-picker').addClass('open');
      callmap();
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
