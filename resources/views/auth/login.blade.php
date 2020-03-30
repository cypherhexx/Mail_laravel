
<div class="bg">
	

@extends('layouts.auth')
@section('content')

@php
$lockedflag = false;
$redirectFlag = false;
@endphp

@if(Input::get('loggedOut'))
@if(App\User::where('username', '=', Crypt::decrypt(Input::get('loggedOut')))->exists())
@php
$lastusername = Crypt::decrypt(Input::get('loggedOut'));
$lastuserid = App\User::where('username', '=', $lastusername )->value('id');
$lastuserObj = App\User::with('profile_info')->find($lastuserid);
$lastUserNiceName = $lastuserObj->name;
$lockedflag = true;
@endphp
@endif
@endif

@if(Input::get('redirect'))
@php
    $redirectPath = array_get(parse_url(Request::get('redirect')),'path');
    $redirectFlag = true;
@endphp
@endif
@include('flash::message')

      @include('utils.errors.list')
<style type="text/css">


.icon-object img{
    animation: rotation 11s infinite linear;

}
    @keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(359deg);
  }
}

.bg{
      background-image:url('http://cloud2162.cloudmlmdemo.com/img/cache/original/login-bg.jpg');
        background-repeat: no-repeat;
        background-size:cover;
        width: 100%;
        height: auto;
       /* Lovepik_com-400062711-golden-halo-material-background.jpg background-size: cover;logo-banner4.jpg logo-banner.jpg*/
  
       background-repeat: no-repeat;
       background-attachment: fixed;
       background-position: center; 
        

           
    }
    body{
    	/*overflow: hidden;*/
    }
.ellipse{
    width: 320px;
    height: 528px;
    margin: 20px;
    shape-outside: ellipse(20% 50%);
    clip-path: ellipse(50% 50%);
    margin: 0 auto !important;

    /* width: 780px;clip-path: ellipse(20% 50%);
    margin: 0 auto !important;*/

}
.form-horizontal .form-group {
    margin-left: -1px;
    margin-right: -1px;
}
.form-group .checkbox{
    margin-left: 13px;
}
.sub-btn{
    width: 62%;
    margin-left: 54px;
}
.for-pass a{
 font-size: 11px;
}
.panel{
    background-color:#f0c9b8;
}
.icon-login{
    margin-top: 10px;
}
.logo-login{
  /* margin-left: -20px;*/
 
}
</style>




<!-- Simple login form -->
<form class="form-horizontal" method="POST" action="{{ route('login') }}">

<div class="col-md-5">
<a href="https://algolight.net/"><img src="img/cache/original/alg-logo.png" width="40%" height="auto"></a>
<!--<a href="http://vintagehut.in/wordpress-demo/cloud-2162/home/"><img src="{{url('img/cache/logo/alg-logo-004.png')}}"></a>-->
</div>
    {{ csrf_field() }}
    <div class="col-md-12">
    <div class="ellipse">
    <div class="panel panel-body login-form">
        
        @if($redirectFlag==true) 
        <input id="redirectPath" type="hidden" name="redirectPath" value="{{$redirectPath}}">
        @endif

        @if($lockedflag==true)         
        <input id="username" type="hidden" name="username" value="{{$lastusername}}" >
        <div class="thumb thumb-rounded">
            {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $lastuserObj->profile_info->image]), 'a picture', array('')) }}
        </div>
        <h6 class="content-group text-center text-semibold no-margin-top">{{$lastUserNiceName}} <small class="display-block">{{trans('all.unlock_your_account')}}</small></h6>
        @endif
        
        @if($lockedflag==false)    
        <div class="text-center">
            <div class="logo-login icon-object border-slate-300 text-slate-300"><img src="{{url('img/cache/logo/logo-login.png')}}" alt="solidus"></div>
            <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
        </div>
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback has-feedback-left" >
            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus placeholder="username" autofocus="true">
            @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
            <div class="form-control-feedback">
                <i class="icon-user text-muted icon-login"></i>
            </div>
        </div>
        @endif

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback has-feedback-left">
            <input id="password" type="password" placeholder="Password" class="form-control" name="password" required  @if($lockedflag == true) autofocus @endif >
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted icon-login"></i>
            </div>
        </div>
        <div class="form-group">
            
            <div class="checkbox">
                <label>
                    <input type="checkbox"  class="styled" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>

            
        </div>
        
        @if($lockedflag==true)    
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Unlock account<i class="icon-circle-right2 position-right"></i></button>
        </div>
        @endif

        @if($lockedflag==false)    
        <div class="form-group">
            <button type="submit" class=" sub-btn btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
        </div>
        @endif



        <div class="text-center for-pass">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
    </div>
   </div>
</div>
    <!--pannel-->


</form>
<!-- /simple login form -->
</div>
</div>
@endsection
