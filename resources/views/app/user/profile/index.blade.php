@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') Member profile:: @parent
@stop
{{-- Content --}}
@section('main')
<!-- Cover area -->
<div class="profile-cover">
    <div class="profile-cover-img" style="background-size: cover;  background-position-y: 30%;background-image: url({{url('img/cache/original/'.$cover_photo)}}">
    </div>


    <div class="media">
        <div class="media-left">
            <div class="avatar">
                <div class="avatarin ajxloaderouter">
                    <div class="img-circle" id="profilephotopreview" style="width:100px;height:100px;margin:0px auto;background-image:url({{url('img/cache/profile/'.$profile_photo)}}">
                    </div>
                    <!--  {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $selecteduser->profile_info->image]), 'Admin', array('class' => '','style'=>'img-circle')) }} -->
                    <div class="profileuploadwrapper">
                        <form id="profilepicform" method="post" name="profilepicform">
                            {!! Form::file('file', ['class' => 'inputfile profilepic','id'=>'profile']) !!}
                {!! Form::hidden('type', 'profile') !!}
                {!! Form::hidden('user_id', $selecteduser->id) !!}
                {!! csrf_field() !!}
                            <label for="profile">
                                <i class="icon-file-plus position-left">
                                </i>
                                <span>
                                </span>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="media-body">
            <h1>
                {{$selecteduser->name}} {{$selecteduser->lastname}}
                <small class="display-block">
                    {{$selecteduser->username}}
                </small>
            </h1>
        </div>
        <div class="media-right media-middle">
            <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                <li>
                    <form id="coverpicform" method="post" name="coverpicform">
                        {!! Form::file('file', ['class' => 'inputfile coverpic','style'=>'display:none;','id'=>'cover']) !!}
                    {!! Form::hidden('type', 'cover') !!}
                    {!! Form::hidden('user_id', $selecteduser->id) !!}
                    {!! csrf_field() !!}
                        <label for="cover">
                            <span class="btn btn-default" href="#">
                                <i class="icon-file-picture position-left">
                                </i>
                                {{trans('profile.cover_image')}}
                            </span>
                        </label>
                    </form>
                </li>
                 
            </ul>
        </div>
    </div>
</div>
<!-- /cover area -->
<!-- Toolbar -->
<div class="navbar navbar-default navbar-xs content-group">
    <ul class="nav navbar-nav visible-xs-block">
        <li class="full-width text-center">
            <a data-target="#navbar-filter" data-toggle="collapse">
                <i class="icon-menu7">
                </i>
            </a>
        </li>
    </ul>
    <div class="navbar-collapse collapse" id="navbar-filter">
        <ul class="nav navbar-nav">
            <li class="active">
                <a data-toggle="tab" href="#overview">
                    <i class="icon-calendar3 position-left">
                    </i>
                    {{trans('profile.overview')}}
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#activity">
                    <i class="icon-menu7 position-left">
                    </i>
                   {{trans('profile.activity')}}
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#settings">
                    <i class="icon-cog3 position-left">
                    </i>
                     {{trans('profile.edit_info')}}
                </a>
            </li>
              <li>
                <a data-toggle="tab" href="#accountsettings">
                    <i class="icon-cog3 position-left">
                    </i>
                   
                    {{trans('profile.account_settings')}}
                </a>
            </li>

            @if($selecteduser->verified == 'no')
               <li>
                <a data-toggle="tab" href="#accountverification">
                    <i class="icon-cog3 position-left">
                    </i>
                   
                   Account Verification
                </a>
            </li>
            @endif

         

      <!--   </ul>
        <div class="navbar-right navbar-collapse collapse">
            <ul class="nav navbar-nav"> -->
              <!--   <li>
                     <a data-toggle="tab" href="#notes">
                        <i class="icon-stack-text position-left"></i>
                        {{trans('profile.notes')}}
                    </a>                    
                </li> -->
                <li>
                     <a data-toggle="tab" href="#referrals">
                        <i class="icon-collaboration position-left"></i>
                        {{trans('users.referrals')}}
                    </a>

                     
                </li>               
                <li class="dropdown hidden">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="icon-gear">
                        </i>
                        <span class="visible-xs-inline-block position-right">
                            {{trans('profile.options')}}
                        </span>
                        <span class="caret">
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="#">
                                <i class="icon-image2">
                                </i>
                                {{trans('profile.update_cover')}}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-clippy">
                                </i>
                                {{trans('profile.update_info')}}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-make-group">
                                </i>
                                {{trans('profile.manage_sections')}}
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-three-bars">
                                </i>
                               {{trans('profile.activity_log')}} 
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-cog5">
                                </i>
                                {{trans('profile.profile_settings')}}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /toolbar -->
<!-- Content area -->
<div class="content">
    <!-- User profile -->
    <div class="row">
        <div class="col-lg-9">
            <div class="tabbable">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="overview">
                        @include('app.admin.users.earnings')
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="content-group user-details-profile">
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.username') }} :
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->username}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.email') }} :
                                                </label>
                                                <span class="pull-right-sm">
                                                    <a href="emailto: {{$selecteduser->email}}">
                                                        {{$selecteduser->email}}
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.sponsor') }}
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$sponsor->username}}
                                                </span>
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.package') }}
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->profile_info->package_detail->package}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.firstname') }}
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->name}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.lastname')}}
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->lastname}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.gender') }}
                                                </label>
                                                <span class="pull-right-sm">
                                                    @if($selecteduser->profile_info->gender == 'm')  {{trans('register.male') }}
                                        @else {{trans('register.female') }}
                                        @endif
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.phone') }}
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->profile_info->mobile}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.wechat') }}
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->id}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="content-group user-details-profile">
                                            <div class="form-group">
                                                <span class="">
                                                    <div class="flag-icon flag-icon-{{strtolower($selecteduser->profile_info->country)}}" style="width: 250px;height: 188px;">
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.country') }}:
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$country}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.state') }}:
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$state}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.zipcode') }}:
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->profile_info->zip}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.address') }} :
                                                </label>
                                                <span class="">
                                                    {{$selecteduser->profile_info->address1}}
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    {{trans('register.city') }} :
                                                </label>
                                                <span class="pull-right-sm">
                                                    {{$selecteduser->profile_info->city}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade in " id="activity">
                        <!-- Timeline -->
                        <div class="timeline timeline-left content-group">
                            <div class="timeline-container">
                                @foreach($activities as $activity)
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <a href="#">
                                            {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $activity->user->profile_info->image]), $activity->user->username, array('class' => '','style'=>'')) }}
                                        </a>
                                    </div>
                                    <div class="panel panel-flat timeline-content">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">
                                                {{$activity->title}}
                                            </h6>
                                            <div class="heading-elements">
                                                <span class="label label-success heading-text">
                                                    <i class="icon-history position-left text-success">
                                                    </i>
                                                    {{$activity->created_at->diffForHumans()}}
                                                </span>
                                                <ul class="icons-list">
                                                    <li>
                                                        <a data-action="reload">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            {{$activity->description}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /timeline -->
                    </div>

                     <div class="tab-pane fade in " id="notes">
                        <div class="row">

                            @forelse($notes as $notitem)
                            <div class="each-note col-sm-4">
                                <div class="panel {{$notitem->color}}">
                                    <div class="panel-body">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class=" icon-file-text3 no-edge-top mt-5">
                                                </i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading text-semibold">
                                                    {{$notitem->title}} -
                                                    <i class="text-xs">
                                                        {{$notitem->created_at->diffForHumans()}}
                                                    </i>
                                                </h6>
                                        {{ strlen($notitem->description) > 25 ? substr($notitem->description,0,25)."..." : $notitem->title }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer {{$notitem->color}} panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                        <div class="heading-elements">
                                            <button class="btn  btn-link btn-xs heading-text text-default btn-delete-note" data-id="{{$notitem->id}}" type="button">
                                               
                                                <i class="icon-trash text-size-small position-right">
                                                </i>
                                            </button>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty

                            @endforelse


                           
                        </div>
                     </div>


                         <div class="tab-pane fade in " id="accountverification">
                        <!-- Timeline -->
             <div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
  Upload Document
</h6>
<div class="heading-elements">
    <ul class="icons-list">
        <li>
            <a data-action="collapse">
            </a>
        </li>
        <li>
            <a data-action="reload">
            </a>
        </li>
        <li>
            <a data-action="close">
            </a>
        </li>
    </ul>
</div>
</div>
<div class="panel-body">


 <form action="{{url('user/savedoc')}}" enctype="multipart/form-data" data-parsley-validate method="POST" data-parsley-validate="true" name="form-wizard">
     {!! csrf_field() !!}
      <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Proof of Identity: </label>

                                        <div class="col-sm-5">
                                                  
                                        <input id="input-711" name="savefile" type="file"  multiple class="file-loading" required>
                                    

                                        </div>                
                                    </div>

  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            {{trans('profile.save')}}
            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

{!! Form::close() !!}
</div>
</div>
                        <!-- /timeline -->
                    </div>
                     <div class="tab-pane fade in " id="referrals">
                        <!-- Timeline -->

                        <div class="panel panel-flat bg-indigo-400">
                            <div class="panel-heading">
                                <h6 class="panel-title text-semibold">
                                    {{trans('users.referrals')}}
                                    <a class="heading-elements-toggle">
                                        <i class="icon-more">
                                        </i>
                                    </a>
                                </h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li>
                                            <a data-action="collapse">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                @include('app.admin.users.referrals')
                            </div>
                        </div>
                        
                        <!-- /timeline -->
                    </div>
                    <div class="tab-pane fade" id="accountsettings">

<!-- /profile info -->
<!-- Account settings -->
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
    {{trans('ticket_config.change_username')}}
</h6>
<div class="heading-elements">
    <ul class="icons-list">
        <li>
            <a data-action="collapse">
            </a>
        </li>
        <li>
            <a data-action="reload">
            </a>
        </li>
        <li>
            <a data-action="close">
            </a>
        </li>
    </ul>
</div>
</div>
<div class="panel-body">


 <form action="{{url('user/updatename')}}" class="smart-wizard form-horizontal" method="post"  >
     {!! csrf_field() !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                    {{trans('profile.username')}}
                </label>
                <input class="form-control" id="username" name="username"type="text" readonly="readonly" value="{{ $selecteduser->username }}">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                     {{trans('ticket_config.new_username')}}:
                </label>
               <input type="text" id="new_username" name="new_username" class="form-control" required>
                </input>
            </div>
        </div>
    </div>
    
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            {{trans('profile.save')}}
            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

{!! Form::close() !!}
</div>
</div>
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
    {{trans('ticket_config.change_password')}}:
</h6>
<div class="heading-elements">
    <ul class="icons-list">
        <li>
            <a data-action="collapse">
            </a>
        </li>
        <li>
            <a data-action="reload">
            </a>
        </li>
        <li>
            <a data-action="close">
            </a>
        </li>
    </ul>
</div>
</div>
<div class="panel-body">


 <form action="{{url('user/updateadminpass')}}" class="smart-wizard form-horizontal" method="post"  >
     {!! csrf_field() !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                    {{trans('profile.username')}}
                </label>
                <input class="form-control" id="username" name="username"type="text" value="{{ $selecteduser->username }}">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                     {{trans('profile.current_password')}}
                </label>
                <input class="form-control" name="oldpass" id="oldpass" type="password" placeholder="Enter current password" >
                </input>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                     {{trans('profile.new_password')}}
                </label>
                <input class="form-control" placeholder="Enter new password" type="password" id="newpass" name="newpass">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                    {{trans('profile.repeat_password')}}
                </label>
                <input class="form-control" placeholder="Repeat new password" type="password" id="confpass" name="confpass" data-parsley-equalto ="new_password">
                </input>
            </div>
        </div>
    </div>
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            {{trans('profile.save')}}
            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

{!! Form::close() !!}
</div>
</div>
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
    {{trans('ticket_config.transaction_password')}}:
</h6>
<div class="heading-elements">
    <ul class="icons-list">
        <li>
            <a data-action="collapse">
            </a>
        </li>
        <li>
            <a data-action="reload">
            </a>
        </li>
        <li>
            <a data-action="close">
            </a>
        </li>
    </ul>
</div>
</div>
<div class="panel-body">


 <form action="{{url('user/updatetransactionpassword')}}" class="smart-wizard form-horizontal" method="post"  >
     {!! csrf_field() !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                    {{trans('profile.username')}}
                </label>
                <input class="form-control" id="username" name="username"type="text" value="{{ $selecteduser->username }}">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                     {{trans('profile.current_transaction_password')}}
                </label>
                <input class="form-control" name="oldpass" id="oldpass" type="password" placeholder="Enter current password" >
                </input>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                     {{trans('profile.new_transaction_password')}}
                </label>
                <input class="form-control" placeholder="Enter new transaction password" type="password" id="newpass" name="newpass">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                    {{trans('profile.repeat_transaction_password')}}
                </label>
                <input class="form-control" placeholder="Repeat new transaction password" type="password" id="confpass" name="confpass" data-parsley-equalto ="new_password">
                </input>
            </div>
        </div>
    </div>
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            {{trans('profile.save')}}
            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

{!! Form::close() !!}
</div>
</div>
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
    Bitcion Account Settings :
</h6>
<div class="heading-elements">
    <ul class="icons-list">
        <li>
            <a data-action="collapse">
            </a>
        </li>
        <li>
            <a data-action="reload">
            </a>
        </li>
        <li>
            <a data-action="close">
            </a>
        </li>
    </ul>
</div>
</div>
<div class="panel-body">


 <form action="{{url('user/bitconaccount_settings')}}" class="smart-wizard form-horizontal" method="post"  >
     {!! csrf_field() !!}
    <div class="form-group">
       <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Bitcoin Address</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="bitcoin_address" name="bitcoin_address" type="text" value="{{$selecteduser->bitcoin_address}}" >
                        </div>
                    </div>

                </div> 
  
            </div>
        
        </div>
    </div>
  
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            {{trans('profile.save')}}
            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

{!! Form::close() !!}
</div>
</div>
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
   Paypal Account Settings:
</h6>
<div class="heading-elements">
    <ul class="icons-list">
        <li>
            <a data-action="collapse">
            </a>
        </li>
        <li>
            <a data-action="reload">
            </a>
        </li>
        <li>
            <a data-action="close">
            </a>
        </li>
    </ul>
</div>
</div>
<div class="panel-body">


 <form action="{{url('user/payplemail_settings')}}" class="smart-wizard form-horizontal" method="post"  >
     {!! csrf_field() !!}
    <div class="form-group">
       <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Eamil Paypal</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="paypal_email" name="paypal_email" type="email" value="{{$selecteduser->paypal_email}}" >
                        </div>
                    </div>

                </div> 
  
            </div>
        
        </div>
    </div>
  
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            {{trans('profile.save')}}
            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

{!! Form::close() !!}
</div>
</div>
<!-- /account settings -->
</div>
                    <div class="tab-pane fade" id="settings">
                        <!-- Profile info -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    {{trans('profile.profile_information')}}
                                </h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li>
                                            <a data-action="collapse">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-action="reload">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-action="close">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

 <div class="panel-body">
    <div class="tab-pane fade in " id="settings">
        <div class="panel panel-flat">

             {!!  Form::model($selecteduser, array('route' => array('user.saveprofile', $selecteduser->id))) !!} 
   <form action="{{ url('user/profile/edit/'.$selecteduser->id) }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="panel-body">
      <div class="row">
<div class="col-md-4">
<div class="required form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
    {!! Form::label('name', trans("register.firstname"), array('class' => 'control-label')) !!} {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-1']) !!}
    <span class="help-block">
        <small>{!! trans("all.your_firstname") !!}</small>
        @if ($errors->has('name'))
        <strong>{{ $errors->first('name') }}</strong>
        @endif
    </span>
</div>
</div>


<div class="col-md-4">
<div class="required form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
    {!! Form::label('lastname', trans("register.last_name"), array('class' => 'control-label')) !!} {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-1']) !!}
    <span class="help-block">
        <small>{!! trans("all.your_last_name") !!}</small>
        @if ($errors->has('lastname'))
        <strong>{{ $errors->first('lastname') }}</strong>
        @endif
    </span>
</div>
</div>
<!-- begin col-6 -->


<div class="col-md-4">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('gender') ? ' has-error' : '' }}">
    {!! Form::label('gender', trans("register.gender"), array('class' => 'control-label')) !!} {!! Form::select('gender', array('m' => trans("all.male"), 'f' => trans("all.female") ,'other' =>trans("all.trans")),null !==(Input::old('gender')) ? Input::old('gender') : $selecteduser->profile_info->gender,['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_select_gender"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class="fa fa-neuter text-muted"></i>
    </div>
    <span class="help-block">
        <small>{!! trans("all.select_your_gender_from_list") !!}</small>
        @if ($errors->has('gender'))
        <strong>{{ $errors->first('gender') }}</strong>
        @endif
    </span>
</div>
</div>
</div>
<!-- row -->

<div class="row">

<div class="col-md-4">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('country') ? ' has-error' : '' }}">
    {!! Form::label('country', trans("register.country"), array('class' => 'control-label')) !!} {!! Form::select('country', $countries ,null !==(Input::old('country')) ? Input::old('country') : $selecteduser->profile_info->country,['class' => 'form-control','id' => 'country','required' => 'required','data-parsley-required-message' => trans("all.please_select_country"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class="fa fa-flag-o text-muted"></i>
    </div>
    <span class="help-block">
        <small>{!! trans("all.select_country") !!}</small>
        @if ($errors->has('country'))
        <strong>{{ $errors->first('country') }}</strong>
        @endif
    </span>
</div>
</div>

<div class="col-md-4">
<div class="required form-group{{ $errors->has('state') ? ' has-error' : '' }}">
    {!! Form::label('state', trans("register.state"), array('class' => 'control-label')) !!} {!! Form::select('state', $states ,null !==(Input::old('state')) ? Input::old('state') : $selecteduser->profile_info->state,['class' => 'form-control','id' => 'state']) !!}
    <span class="help-block">
        <small>{!! trans("all.select_your_state") !!}</small>
        @if ($errors->has('state'))
        <strong>{{ $errors->first('state') }}</strong>
        @endif
    </span>
</div>
</div>
<div class="col-md-4">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('city') ? ' has-error' : '' }}">
    {!! Form::label('city', trans("register.city"), array('class' => 'control-label')) !!} {!! Form::text('city', null !==(Input::old('city')) ? Input::old('city') : $selecteduser->profile_info->city, ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class="icon-city text-muted"></i>
    </div>
    <span class="help-block">
        <small>{!! trans("all.your_city") !!}</small>
        @if ($errors->has('city'))
        <strong>{{ $errors->first('city') }}</strong>
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
    {!! Form::label('zip', trans("register.zip_code"), array('class' => 'control-label')) !!} {!! Form::text('zip', null !==(Input::old('zip')) ? Input::old('zip') : $selecteduser->profile_info->zip, ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-1','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]) !!}
    <span class="help-block">
        <span id="ziplocation"><span></span></span>
    <span id="ziperror"></span>
    <small>{!! trans("all.your_zip") !!}</small> @if ($errors->has('zip'))
    <strong>{{ $errors->first('zip') }}</strong> @endif
    </span>
</div>
</div>
</div>

<div class="row">

<div class="col-md-6">
<div class="required form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
    {!! Form::label('address1', 'Address1', array('class' => 'control-label')) !!} {!! Form::textarea('address1', null !==(Input::old('address1')) ? Input::old('address1') : $selecteduser->profile_info->address1, ['class' => 'form-control','required' => 'required','id' => 'address1','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address1"),'data-parsley-group' => 'block-1']) !!}
    <span class="help-block">
        <small>{!! trans("all.your_address") !!}</small>
        @if ($errors->has('address'))
        <strong>{{ $errors->first('address1') }}</strong>
        @endif
    </span>
</div>
</div>
<div class="col-md-6">
<div class="required form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
    {!! Form::label('address2', 'Address2', array('class' => 'control-label')) !!} {!! Form::textarea('address2', null !==(Input::old('address2')) ? Input::old('address2') : $selecteduser->profile_info->address2, ['class' => 'form-control','required' => 'required','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address2"),'data-parsley-group' => 'block-1']) !!}
    <span class="help-block">
        <small>{!! trans("all.your_address") !!}</small>
        @if ($errors->has('address'))
        <strong>{{ $errors->first('address1') }}</strong>
        @endif
    </span>
</div>
</div>

</div>
<div class="row">
<!-- begin col-6 -->
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('phone') ? ' has-error' : '' }}">
    {!! Form::label('phone', trans("register.phone"), array('class' => 'control-label')) !!} {!! Form::text('phone', null !==(Input::old('phone')) ? Input::old('phone') : $selecteduser->profile_info->mobile, ['class' => 'form-control','id' => 'phone','data-parsley-required-message' => trans("all.please_enter_phone_number"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class=" icon-mobile3 text-muted"></i>
    </div>
    <span class="help-block">
        <small>{!! trans("all.enter_your_phone_number") !!}</small>
        @if ($errors->has('phone'))
        <strong>{{ $errors->first('phone') }}</strong>
        @endif
    </span>
</div>
</div>
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', trans("register.email"), array('class' => 'control-label')) !!} {!! Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','id' => 'email','data-parsley-required-message' => trans("all.please_enter_email"),'data-parsley-group' => 'block-1']) !!}
    <div class="form-control-feedback">
        <i class="icon-mail5 text-muted"></i>
    </div>
    <span class="help-block">
        <small>{!! trans("all.type_your_email") !!}</small>
        @if ($errors->has('email'))
        <strong>{{ $errors->first('email') }}</strong>
        @endif
    </span>
</div>

</div>
<br>
<p><h5>{{trans('register.bank_account_settings')}}</h5></p><br>
</div>
<div class="row">
<!-- begin col-6 -->
<div class="col-md-6">
   <div class="form-group">
      <label>Account Holder Name</label>
      <input class="form-control" id="account_holder_name" name="account_holder_name" type="text" value="{{$selecteduser->profile_info->account_holder_name}}" >
    </div>
</div>


<div class="col-md-6">
     <div class="form-group">
        <label>Code swift</label>
        <input class="form-control" id="swift" name="swift" type="text" value="{{$selecteduser->profile_info->swift}}" >
     </div>
 </div>       

</div>

<div class="row">
    <div class="col-md-6">
     <div class="form-group">
     <label>Iban</label>
        <input class="form-control" id="iban" name="iban" type="text" value="{{$selecteduser->profile_info->iban}}" >
    </div>
    </div>
     
     <div class="col-md-6">
       
            <div class="required form-group has-feedbackX has-feedback-leftx {{ $errors->has('country') ? ' has-error' : '' }}">
            {!! Form::label('country', trans("register.country"), array('class' => 'control-label')) !!} {!! Form::select('bank_country', $countries ,null !==(Input::old('bank_country')) ? Input::old('bank_country') : $selecteduser->profile_info->bank_country,['class' => 'form-control','id' => 'bank_country','required' => 'required','data-parsley-required-message' => trans("all.please_select_country"),'data-parsley-group' => 'block-1']) !!}
            
            </div>
     </div>


</div>



<div class="row">
     <div class="col-md-6">
      <div class="form-group">
        <label>Bank Name</label>
         <input class="form-control" id="bank_name" name="bank_name" type="text" value="{{ $selecteduser->profile_info->bank_name }}" >
      </div>
     </div>  
     <div class="col-md-6">
       <div class="form-group">
        <label>Bank Code</label>
        <input class="form-control" id="bank_code" name="bank_code" type="text" value="{{$selecteduser->profile_info->bank_code}}" >
       </div>
     </div>            
        
</div>

<div class="row">
     <div class="col-md-6">
       <div class="form-group">
        <label>Number of Branches</label>
        <input class="form-control" id="branch_count" name="branch_count" type="text" value="{{$selecteduser->profile_info->branch_count}}" >
       </div>
     </div> 
     
     <div class="col-md-6">
       <div class="form-group">
       <label>Account Number</label>
        <input class="form-control" id="account_number" name="account_number" type="text" value="{{$selecteduser->profile_info->account_number}}" >
       </div>
    </div> 
              
        
</div>


    <div class="form-group">
        <div class="row">
                 <div class="col-md-6">
                <label>
                   Bank Address
                </label>

                <textarea id="bank_address" name="bank_address"  class="form-control">
                    {{ $selecteduser->profile_info->bank_address }}
                 </textarea>
                
            </div>
    </div>
        
    </div>
   <div class="text-right">
        <button class="btn btn-primary" type="submit">
            Save
            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>



         </div>
          </div>
       </div>
</div>
                        </div>
                      
                    </div>

                    
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="panel panel-body">
                <div class="row text-center">
                    <div class="col-xs-4">
                        <p>
                            <i class="icon-medal-star icon-2x display-inline-block text-warning">
                            </i>
                        </p>
                        <h5 class="text-semibold no-margin">
                            {{$user_rank_name}}
                        </h5>
                        <span class="text-muted text-size-small">
                            Rank
                        </span>
                    </div>
                    <div class="col-xs-4">
                        <p>
                            <i class="icon-users2 icon-2x display-inline-block text-info">
                            </i>
                        </p>
                        <h5 class="text-semibold no-margin">
                            {{$total_referalz}}
                        </h5>
                        <span class="text-muted text-size-small">
                            {{trans('all.referrals')}}
                        </span>
                    </div>
                    <div class="col-xs-4">
                        <p>
                            <i class="icon-cash3 icon-2x display-inline-block text-success">
                            </i>
                        </p>
                        <h5 class="text-semibold no-margin">
                            {{$balance}}
                        </h5>
                        <span class="text-muted text-size-small">
                            {{trans('all.balance')}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="content-group">
                @if(isset($sponsor->username))
                <div background-size:="" class="panel-body bg-blue border-radius-top text-center" contain;"="">
                    <div class="content-group-sm">
                        <h5 class="text-semibold no-margin-bottom">
                            Sponsor Information
                        </h5>
                    </div>
                </div>
                <div class="panel panel-body no-border-top no-border-radius-top">
                    <div class="form-group mt-5">
                        <label class="text-semibold">
                            Sponsor name:
                        </label>
                        <span class="pull-right-sm">
                            {{$sponsor->name}}
                        </span>
                    </div>
                    <div class="form-group mt-5">
                        <label class="text-semibold">
                            Sponsor username:
                        </label>
                        <span class="pull-right-sm">
                            {{$sponsor->username}}
                        </span>
                    </div>
                    <div class="form-group mt-5">
                        <label class="text-semibold">
                            Sponsor Country:
                        </label>
                        <span class="pull-right-sm">
                            {{$sponsor->profile_info->country}}
                        </span>
                    </div>
                    <div class="form-group mt-5">
                        <label class="text-semibold">
                            Date Joined:
                        </label>
                        <span class="pull-right-sm">
                            {{$sponsor->profile_info->created_at->toFormattedDateString()}}
                        </span>
                    </div>
                </div>
                @endif
            </div>
    <!-- Share your thoughts -->
              <!--        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">
                    Create a note
                    <a class="heading-elements-toggle">
                        <i class="icon-more">
                        </i>
                    </a>
                </h6>
                <div class="heading-elements">
                </div>
            </div>
            <div class="panel-body">
                <form action="#" class="usernotesform" data-parsley-validate="">
                    <div class="form-group">
                        <input class="form-control mb-15" cols="1" id="title" name="title" placeholder="Note title"  type="text"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-15" cols="1" id="description" name="description" placeholder="Note content"  rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        
                        <div class="btn-group " id="note-color" data-toggle="buttons">
                        <label class="btn btn-primary btn-xs">
                          <input type="radio" name="color" value="bg-primary" checked> primary </label>
                        <label class="btn btn-success btn-xs">
                          <input type="radio" name="color" value="bg-success">Success</label>
                        <label class="btn btn-info btn-xs">
                          <input type="radio" name="color" value="bg-info">Info</label>
                        <label class="btn btn-warning btn-xs">
                          <input type="radio" name="color" value="bg-warning">Warning</label>
                        <label class="btn btn-danger btn-xs">
                          <input type="radio" name="color" value="bg-danger">Danger</label>
                        </div>
                    </div>
                    <div class="row"> 

                        <div class="col-sm-12 text-right">
                            <button class="submit-user-note btn btn-primary btn-labeled btn-labeled-right" type="button">
                                Save
                                <b>
                                    <i class="icon-circle-right2">
                                    </i>
                                </b>
                            </button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div> -->
        </div>
    </div>
</div>
@endsection 
{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
     $('.submit-user-note').click(function () {
        $('.usernotesform').submit();
    });
    $(".usernotesform").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $('.usernotesform').parsley().validate();
    if ($('.usernotesform').parsley().isValid()) {
        
        var block = $(this).parent().parent().parent().parent();
        $.ajax({
            url: CLOUDMLMSOFTWARE.siteUrl + '/user/notes',
            data: new FormData($('.usernotesform')[0]),
            dataType: 'json',
            async: true,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function beforeSend() {
                $(block).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function success(response) {
                $(block).unblock();
                $('.usernotesform').find("input[type=text], textarea").val("");
                new PNotify({
                    text: 'Note Added',
                    // styling: 'brighttheme',
                    // icon: 'fa fa-file-image-o',
                    type: 'success',
                    delay: 1000,
                    animate_speed: 'fast',
                    nonblock: {
                        nonblock: true
                    }
                });
                if ($('#notes').length) {
                    $newNote = '<div class="each-note col-sm-4"><div class="panel ' + response.color + '"><div class="panel-body"><div class="media"><div class="media-left"><i class=" icon-file-text3 text-warning-400 no-edge-top mt-5"></i></div><div class="media-body"><h6 class="media-heading text-semibold">' + response.title + ' - <i class="text-xs">' + response.date + '</i></h6>' + response.description + '</div></div></div><div class="panel-footer ' + response.color + ' panel-footer-condensed"><a class="heading-elements-toggle"><i class="icon-more"></i></a><div class="heading-elements"><button class="btn  btn-link btn-xs heading-text text-default btn-delete-note" data-id="' + response.id + ' " type="button"><i class="icon-trash text-size-small position-right"></i></button></div></div></div></div>';
                    $('#notes>.row:first-child').append($newNote);
                }
            }
        });
    } else {
        console.log('not valid');
    }
});

    $(document).ready(function () {
    if ($(".btn-delete-note").length) {
        $('#notes').on('click', '.btn-delete-note', function (e) {
            var id = $(this).data('id');
            var this_context = $(this);
            // confirm('Are you sure you want to delete the note?','confirmation','yes','no');
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this note!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                //console.log(id);
                $.ajax({
                    url: CLOUDMLMSOFTWARE.siteUrl + '/user/notes/'+id,
                    data: {
                        'note_id': id
                    },
                    dataType: 'json',
                    async: true,
                    type: 'delete',
                    beforeSend: function beforeSend() {
                        this_context.closest('.each-note');
                    },
                    success: function success(response) {
                        this_context.closest('.each-note').remove();
                        swal('Deleted!');
                        setTimeout(function () {}, 2000);
                    },
                    error: function error(response) {
                        swal('Something went wrong!');
                    }
                });
            });
        });
    }
});
</script>
@endsection

@section('styles')
@parent
<style type="text/css">
    div#profilephotopreview {
    background-size: cover;
}
</style>
@endsection
