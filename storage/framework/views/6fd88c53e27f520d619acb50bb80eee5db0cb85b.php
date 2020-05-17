<?php $__env->startSection('title'); ?> Member profile:: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##

<?php $__env->stopSection(); ?>




<?php $__env->startSection('main'); ?>
<!-- Cover area -->
<form id="usersearch" method="post" action="<?php echo e(url('admin/searchuser')); ?>" name="usersearch">
        <?php echo csrf_field(); ?>

    <div id="searchuser" class="row mb-10">
            <div class="col-sm-12">
                <span class="input-group">   
                    <input type="text" class="form-control" id="clear1" name="username" placeholder="Search User">
                
                    <span class="input-group-btn">                    
                        <button class="btn-icon btn btn-info" type="submit" id="btn-filter-node"  ><i class="fa fa-search position-left"></i><?php echo e(trans('profile.search')); ?></button>
                    </span>
                <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"  id="btnClear"><i class="icon-cross"></i></button>
                    </span>
                </span>
            </div>
        </div>
    </form>
    <div class="profile-cover">
    <div class="profile-cover-img" style="background-image: url(<?php echo e(url('img/cache/original/'.$cover_photo)); ?>">
    </div>

    

    <div class="media">
        <div class="media-left">
            <div class="avatar">
                <div class="avatarin ajxloaderouter">
                    <div class="img-circle" id="profilephotopreview" style="width:100px;height:100px;margin:0px auto;background-image:url(<?php echo e(url('img/cache/profile/'.$profile_photo)); ?>">
                    </div>
                    <!--  <?php echo e(Html::image(route('imagecache', ['template' => 'profile', 'filename' => $selecteduser->profile_info->image]), 'Admin', array('class' => '','style'=>'img-circle'))); ?> -->
                    <div class="profileuploadwrapper">
                        <form id="profilepicform" method="post" name="profilepicform">
                            <?php echo Form::file('file', ['class' => 'inputfile profilepic','id'=>'profile']); ?>

                <?php echo Form::hidden('type', 'profile'); ?>

                <?php echo Form::hidden('user_id', $selecteduser->id); ?>

                <?php echo csrf_field(); ?>

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
                <?php echo e($selecteduser->name); ?> <?php echo e($selecteduser->lastname); ?>

                <small class="display-block">
                    <?php echo e($selecteduser->username); ?>

                </small>
            </h1>
        </div>
        <div class="media-right media-middle">
            <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                <li>
                    <form id="coverpicform" method="post" name="coverpicform">
                        <?php echo Form::file('file', ['class' => 'inputfile coverpic','style'=>'display:none;','id'=>'cover']); ?>

                    <?php echo Form::hidden('type', 'cover'); ?>

                    <?php echo Form::hidden('user_id', $selecteduser->id); ?>

                    <?php echo csrf_field(); ?>

                        <label for="cover">
                            <span class="btn btn-default" href="#">
                                <i class="icon-file-picture position-left">
                                </i>
                                <?php echo e(trans('profile.cover_image')); ?>

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
                    <?php echo e(trans('profile.overview')); ?>

                </a>
            </li>
             <li >
                <a data-toggle="tab" href="#update">
                    <i class="icon-pencil position-left">
                    </i>
                    <?php echo e(trans('profile.edit_info')); ?>

                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#activity">
                    <i class="icon-menu7 position-left">
                    </i>
                   <?php echo e(trans('profile.activity')); ?>

                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#settings">
                    <i class="icon-cog3 position-left">
                    </i> 
                    <?php echo e(trans('profile.account_settings')); ?>

                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#referral">
                    <i class="icon-stack position-left">
                    </i> 
                    <?php echo e(trans('profile.referrals')); ?>

                </a>
            </li>
        </ul>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo e(url('admin/notes')); ?>">
                        <i class="icon-stack-text position-left">
                        </i>
                        <?php echo e(trans('profile.notes')); ?>

                    </a>
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
                        <?php echo $__env->make('app.admin.users.earnings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <div class="panel">
                            <div class="panel-body">
                           
                                <div class="row">
                                                         <div class="col-sm-6">
                                        <div class="content-group user-details-profile">
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.username')); ?> :
                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->username); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.email')); ?> :
                                                </label>
                                                <span class="pull-right-sm">
                                                    <a href="emailto: <?php echo e($selecteduser->email); ?>">
                                                        <?php echo e($selecteduser->email); ?>

                                                    </a>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.sponsor')); ?>

                                                </label>
                                                <span class="pull-right-sm">

                                                    <?php if($sponsor == null): ?>
                                                    NA
                                                    <?php else: ?>
                                                  <?php echo e($sponsor->username); ?>

                                                  <?php endif; ?>
                                                </span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.package')); ?>

                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->profile_info->package_detail->package); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.firstname')); ?>

                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->name); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.lastname')); ?>

                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->lastname); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.gender')); ?>

                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php if($selecteduser->profile_info->gender == 'm'): ?>  <?php echo e(trans('register.male')); ?>

                                                    <?php else: ?> <?php echo e(trans('register.female')); ?>  <?php endif; ?>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.phone')); ?>

                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->profile_info->mobile); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.wechat')); ?>

                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->id); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="content-group user-details-profile">
                                            <div class="form-group">
                                                <span class="">
                                                    <div class="flag-icon flag-icon-<?php echo e(strtolower($selecteduser->profile_info->country)); ?>" style="width: 250px;height: 188px;">
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.country')); ?>:
                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($country); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.state')); ?>:
                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($state); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.zipcode')); ?>:
                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->profile_info->zip); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.address')); ?> :
                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->profile_info->address1); ?>

                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-semibold">
                                                    <?php echo e(trans('register.city')); ?> :
                                                </label>
                                                <span class="pull-right-sm">
                                                    <?php echo e($selecteduser->profile_info->city); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>


                    <div class="tab-pane fade in " id="update">                             
                        <div class="panel panel-flat">

                           <?php echo Form::model($selecteduser, array('route' => array('admin.saveprofile', $selecteduser->id))); ?> 


                            <form action="<?php echo e(url('admin/saveprofile')); ?>" method="post">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <div class="panel-heading">
                                    <h6 class="panel-title">
                                        <?php echo e(trans('all.update_profile')); ?>

                                    </h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                               



                                <div class="panel-body">
                                <div class="row">
<div class="col-md-4">
<div class="required form-group <?php echo e($errors->has('firstname') ? ' has-error' : ''); ?>">
    <?php echo Form::label('name', trans("register.firstname"), array('class' => 'control-label')); ?> <?php echo Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_first_name"),'data-parsley-group' => 'block-1']); ?>

    <span class="help-block">
        <small><?php echo trans("all.your_firstname"); ?></small>
        <?php if($errors->has('name')): ?>
        <strong><?php echo e($errors->first('name')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
<div class="col-md-4">
<div class="required form-group<?php echo e($errors->has('lastname') ? ' has-error' : ''); ?>">
    <?php echo Form::label('lastname', trans("register.lastname"), array('class' => 'control-label')); ?> <?php echo Form::text('lastname', Input::old('lastname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_enter_last_name"),'data-parsley-group' => 'block-1']); ?>

    <span class="help-block">
        <small><?php echo trans("all.your_lastname"); ?></small>
        <?php if($errors->has('lastname')): ?>
        <strong><?php echo e($errors->first('lastname')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
<!-- begin col-6 -->

<div class="col-md-4">
<div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('gender') ? ' has-error' : ''); ?>">
    <?php echo Form::label('gender', trans("register.gender"), array('class' => 'control-label')); ?> <?php echo Form::select('gender', array('m' => trans("all.male"), 'f' => trans("all.female") ,'other' =>trans("all.trans")),null !==(Input::old('gender')) ? Input::old('gender') : $selecteduser->profile_info->gender,['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("all.please_select_gender"),'data-parsley-group' => 'block-1']); ?>

    <div class="form-control-feedback">
        <i class="fa fa-neuter text-muted"></i>
    </div>
    <span class="help-block">
        <small><?php echo trans("all.select_your_gender_from_list"); ?></small>
        <?php if($errors->has('gender')): ?>
        <strong><?php echo e($errors->first('gender')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>

</div>
<!-- end row -->
<div class="row">
<div class="col-md-4">
<div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('country') ? ' has-error' : ''); ?>">
    <?php echo Form::label('country', trans("register.country"), array('class' => 'control-label')); ?> <?php echo Form::select('country', $countries ,null !==(Input::old('country')) ? Input::old('country') : $selecteduser->profile_info->country,['class' => 'form-control','id' => 'country','required' => 'required','data-parsley-required-message' => trans("all.please_select_country"),'data-parsley-group' => 'block-1']); ?>

    <div class="form-control-feedback">
        <i class="fa fa-flag-o text-muted"></i>
    </div>
    <span class="help-block">
        <small><?php echo trans("all.select_country"); ?></small>
        <?php if($errors->has('country')): ?>
        <strong><?php echo e($errors->first('country')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
<div class="col-md-4">
<div class="required form-group<?php echo e($errors->has('state') ? ' has-error' : ''); ?>">
    <?php echo Form::label('state', trans("register.state"), array('class' => 'control-label')); ?> <?php echo Form::select('state', $states ,null !==(Input::old('state')) ? Input::old('state') : $selecteduser->profile_info->state,['class' => 'form-control','id' => 'state']); ?>

    <span class="help-block">
        <small><?php echo trans("all.select_your_state"); ?></small>
        <?php if($errors->has('state')): ?>
        <strong><?php echo e($errors->first('state')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
<div class="col-md-4">
<div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('city') ? ' has-error' : ''); ?>">
    <?php echo Form::label('city', trans("register.city"), array('class' => 'control-label')); ?> <?php echo Form::text('city', null !==(Input::old('city')) ? Input::old('city') : $selecteduser->profile_info->city, ['class' => 'form-control','required' => 'required','id' => 'city','data-parsley-required-message' => trans("all.please_enter_city"),'data-parsley-group' => 'block-1']); ?>

    <div class="form-control-feedback">
        <i class="icon-city text-muted"></i>
    </div>
    <span class="help-block">
        <small><?php echo trans("all.your_city"); ?></small>
        <?php if($errors->has('city')): ?>
        <strong><?php echo e($errors->first('city')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
</div>
<!-- end row -->
<div class="row">
    <!-- begin col-6 -->
<div class="col-md-6">
<div class="required form-group<?php echo e($errors->has('zip') ? ' has-error' : ''); ?>">
    <?php echo Form::label('zip', trans("register.zip_code"), array('class' => 'control-label')); ?> <?php echo Form::text('zip', null !==(Input::old('zip')) ? Input::old('zip') : $selecteduser->profile_info->zip, ['class' => 'form-control','required' => 'required','id' => 'zip','data-parsley-required-message' => trans("all.please_enter_zip"),'data-parsley-group' => 'block-1','data-parsley-zip' => 'us','data-parsley-type' => 'digits','data-parsley-length' => '[5,8]','data-parsley-state-and-zip' => 'us','data-parsley-validate-if-empty' => '','data-parsley-errors-container' => '#ziperror' ]); ?>

    <span class="help-block">
        <span id="ziplocation"><span></span></span>
    <span id="ziperror"></span>
    <small><?php echo trans("all.your_zip"); ?></small> <?php if($errors->has('zip')): ?>
    <strong><?php echo e($errors->first('zip')); ?></strong> <?php endif; ?>
    </span>
</div>
</div>
</div>
<div class="row">

<div class="col-md-6">
<div class="required form-group<?php echo e($errors->has('address1') ? ' has-error' : ''); ?>">
    <?php echo Form::label('address1', trans("register.address1"), array('class' => 'control-label')); ?> <?php echo Form::textarea('address1', null !==(Input::old('address1')) ? Input::old('address1') : $selecteduser->profile_info->address1, ['class' => 'form-control','required' => 'required','id' => 'address1','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address1"),'data-parsley-group' => 'block-1']); ?>

    <span class="help-block">
        <small><?php echo trans("all.your_address1"); ?></small>
        <?php if($errors->has('address')): ?>
        <strong><?php echo e($errors->first('address1')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
<div class="col-md-6">
<div class="required form-group<?php echo e($errors->has('address2') ? ' has-error' : ''); ?>">
    <?php echo Form::label('address2', trans("register.address2"), array('class' => 'control-label')); ?> <?php echo Form::textarea('address2', null !==(Input::old('address2')) ? Input::old('address2') : $selecteduser->profile_info->address2, ['class' => 'form-control','required' => 'required','id' => 'address2','rows'=>'2','data-parsley-required-message' => trans("all.please_enter_address2"),'data-parsley-group' => 'block-1']); ?>

    <span class="help-block">
        <small><?php echo trans("all.your_address1"); ?></small>
        <?php if($errors->has('address')): ?>
        <strong><?php echo e($errors->first('address1')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>

</div>

<div class="row">
<!-- begin col-6 -->
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
    <?php echo Form::label('phone', trans("register.phone"), array('class' => 'control-label')); ?> <?php echo Form::text('phone', null !==(Input::old('phone')) ? Input::old('phone') : $selecteduser->profile_info->mobile, ['class' => 'form-control','id' => 'phone','data-parsley-required-message' => trans("all.please_enter_phone_number"),'data-parsley-group' => 'block-1']); ?>

    <div class="form-control-feedback">
        <i class=" icon-mobile3 text-muted"></i>
    </div>
    <span class="help-block">
        <small><?php echo trans("all.enter_your_phone_number"); ?></small>
        <?php if($errors->has('phone')): ?>
        <strong><?php echo e($errors->first('phone')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
    <?php echo Form::label('email', trans("register.email"), array('class' => 'control-label')); ?> <?php echo Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','id' => 'email','data-parsley-required-message' => trans("all.please_enter_email"),'data-parsley-group' => 'block-1']); ?>

    <div class="form-control-feedback">
        <i class="icon-mail5 text-muted"></i>
    </div>
    <span class="help-block">
        <small><?php echo trans("all.type_your_email"); ?></small>
        <?php if($errors->has('email')): ?>
        <strong><?php echo e($errors->first('email')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
</div>
<div class="row">
<!-- begin col-6 -->
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('wechat') ? ' has-error' : ''); ?>">
    <?php echo Form::label('wechat', trans("register.wechat"), array('class' => 'control-label')); ?> <?php echo Form::text('wechat', null !==(Input::old('wechat')) ? Input::old('wechat') : $selecteduser->profile_info->wechat, ['class' => 'form-control','id' => 'wechat','data-parsley-required-message' => trans("all.please_enter_wechat"),'data-parsley-group' => 'block-1']); ?>

    <span class="help-block">
        <small><?php echo trans("all.type_your_wechat"); ?></small>
        <?php if($errors->has('wechat')): ?>
        <strong><?php echo e($errors->first('wechat')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
<!-- begin col-4 -->
<div class="col-md-6">
<div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('passport') ? ' has-error' : ''); ?>">
    <?php echo Form::label('passport', trans("register.national_identification_number"), array('class' => 'control-label')); ?> <?php echo Form::text('passport', null !==(Input::old('passport')) ? Input::old('passport') : $selecteduser->profile_info->passport, ['class' => 'form-control','required' => 'required','id' => 'passport','data-parsley-required-message' => trans("all.please_enter_passport"),'data-parsley-group' => 'block-1']); ?>

    <div class="form-control-feedback">
        <i class="icon-user-check text-muted"></i>
    </div>
    <span class="help-block">
        <small><?php echo trans("all.type_your_passport_number"); ?></small>
        <?php if($errors->has('passport')): ?>
        <strong><?php echo e($errors->first('passport')); ?></strong>
        <?php endif; ?>
    </span>
</div>
</div>
</div>


</div>



<div class="panel-heading">
    <h6 class="panel-title">
        Bank Account details
    </h6>

</div>
<div class="panel-body">                                
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                    <?php echo e(trans('register.account_holder_name')); ?>

                </label>
                <input class="form-control" name="account_holder_name" type="text" value="<?php echo e($selecteduser->profile_info->account_holder_name); ?>">
                 
            </div>
            <div class="col-md-6">
                <label>
                   Swift
                </label>
                <input class="form-control" name="swift" type="text" value="<?php echo e($selecteduser->profile_info->swift); ?>">
                
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                 Iban
                </label>
                <input class="form-control" name="iban" type="text" value="<?php echo e($selecteduser->profile_info->iban); ?>">
                 
            </div>
            <div class="col-md-6">
                <div class="required form-group has-feedbackX has-feedback-leftx <?php echo e($errors->has('country') ? ' has-error' : ''); ?>">
            <?php echo Form::label('country', trans("register.country"), array('class' => 'control-label')); ?> <?php echo Form::select('bank_country', $countries ,null !==(Input::old('bank_country')) ? Input::old('bank_country') : $selecteduser->profile_info->bank_country,['class' => 'form-control','id' => 'bank_country','required' => 'required','data-parsley-required-message' => trans("all.please_select_country"),'data-parsley-group' => 'block-1']); ?>

            
            </div>
                    
                
                
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Bank Name</label>
                    <input class="form-control" id="bank_name" name="bank_name" type="text" value="<?php echo e($selecteduser->profile_info->bank_name); ?>" >
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Bank Code</label>
                    <input class="form-control" id="bank_code" name="bank_code" type="text" value="<?php echo e($selecteduser->profile_info->bank_code); ?>" >
                </div>
            </div>  
        </div>
        
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label>Number of Branches</label>
                <input class="form-control" id="branch_count" name="branch_count" type="text" value="<?php echo e($selecteduser->profile_info->branch_count); ?>" >
            </div>
            </div> 
     
            <div class="col-md-6">
            <div class="form-group">
            <label>Account Number</label>
                <input class="form-control" id="account_number" name="account_number" type="text" value="<?php echo e($selecteduser->profile_info->account_number); ?>" >
            </div>
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
                    <?php echo e($selecteduser->profile_info->bank_address); ?>

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
</form>
</div>
</div>


<div class="tab-pane fade in " id="activity">
<!-- Timeline -->
<div class="timeline timeline-left content-group">
<div class="timeline-container">


<?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="timeline-row">
    <div class="timeline-icon">
        <a href="#">
            <?php echo e(Html::image(route('imagecache', ['template' => 'profile', 'filename' => $activity->user->profile_info->image]), $activity->user->username, array('class' => '','style'=>''))); ?>

        </a>
    </div>
    <div class="panel panel-flat timeline-content">
        <div class="panel-heading">
            <h6 class="panel-title">
                <?php echo e($activity->title); ?>

            </h6>
            <div class="heading-elements">
                <span class="label label-success heading-text">
                    <i class="icon-history position-left text-success">
                    </i>
                    <?php echo e($activity->created_at->diffForHumans()); ?>

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
            <?php echo e($activity->description); ?>

        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<!-- /timeline -->
</div>
<div class="tab-pane fade" id="settings">

<!-- /profile info -->
<!-- Account settings -->
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
    <?php echo e(trans('ticket_config.change_username')); ?>

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


 <form action="<?php echo e(url('admin/users/updatename')); ?>" class="smart-wizard form-horizontal" method="post"  >
     <?php echo csrf_field(); ?>

     
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                    <?php echo e(trans('profile.username')); ?>

                </label>
                <input class="form-control" id="username" name="username"type="text" readonly="readonly" value="<?php echo e($selecteduser->username); ?>">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                     <?php echo e(trans('ticket_config.new_username')); ?>:
                </label>
               <input type="text" id="new_username" name="new_username" class="form-control" required>
                </input>
            </div>
        </div>
    </div>
    
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            <?php echo e(trans('profile.save')); ?>

            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

<?php echo Form::close(); ?>

</div>
</div>
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
    <?php echo e(trans('ticket_config.change_password')); ?>:
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


 <form action="<?php echo e(url('admin/users/updateadminpass')); ?>" class="smart-wizard form-horizontal" method="post"  >
     <?php echo csrf_field(); ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>
                    <?php echo e(trans('profile.username')); ?>

                </label>
                <input class="form-control" id="username" name="username"type="text" value="<?php echo e($selecteduser->username); ?>">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                     <?php echo e(trans('profile.current_password')); ?>

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
                     <?php echo e(trans('profile.new_password')); ?>

                </label>
                <input class="form-control" placeholder="Enter new password" type="password" id="newpass" name="newpass">
                </input>
            </div>
            <div class="col-md-6">
                <label>
                    <?php echo e(trans('profile.repeat_password')); ?>

                </label>
                <input class="form-control" placeholder="Repeat new password" type="password" id="confpass" name="confpass" data-parsley-equalto ="new_password">
                </input>
            </div>
        </div>
    </div>
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            <?php echo e(trans('profile.save')); ?>

            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

<?php echo Form::close(); ?>

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


 <form action="<?php echo e(url('admin/users/bitconaccount_settings')); ?>" class="smart-wizard form-horizontal" method="post"  >
     <?php echo csrf_field(); ?>

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
                            <input class="form-control" id="bitcoin_address" name="bitcoin_address" type="text" value="<?php echo e($selecteduser->bitcoin_address); ?>" >
                            <input type="hidden" name="user_id"value="<?php echo e($selecteduser->id); ?>">
                        </div>
                    </div>

                </div> 
  
            </div>
        
        </div>
    </div>
  
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            <?php echo e(trans('profile.save')); ?>

            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

<?php echo Form::close(); ?>

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


 <form action="<?php echo e(url('admin/users/payplemail_settings')); ?>" class="smart-wizard form-horizontal" method="post"  >
     <?php echo csrf_field(); ?>

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
                            <input class="form-control" id="paypal_email" name="paypal_email" type="email" value="<?php echo e($selecteduser->paypal_email); ?>" >
                              <input type="hidden" name="user_id"value="<?php echo e($selecteduser->id); ?>">
                        </div>
                    </div>

                </div> 
  
            </div>
        
        </div>
    </div>
  
  
    <div class="text-right">
        <button class="btn btn-primary" type="submit">
            <?php echo e(trans('profile.save')); ?>

            <i class="icon-arrow-right14 position-right">
            </i>
        </button>
    </div>
 </form>

<?php echo Form::close(); ?>

</div>
</div>
<!-- /account settings -->
</div>
<div class="tab-pane fade" id="referral">
<div class="panel panel-flat bg-indigo-400">
                            <div class="panel-heading">
                                <h6 class="panel-title text-semibold">
                                    <?php echo e(trans('users.referrals')); ?>

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
                                <?php echo $__env->make('app.admin.users.referrals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
<?php echo e($user_rank_name); ?>

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
<?php echo e($referrals_count); ?>

</h5>
<span class="text-muted text-size-small">
<?php echo e(trans('all.referrals')); ?>

</span>
</div>
<div class="col-xs-4">
<p>
<i class="icon-cash3 icon-2x display-inline-block text-success">
</i>
</p>
<h5 class="text-semibold no-margin">
<?php echo e($balance); ?>

</h5>
<span class="text-muted text-size-small">
<?php echo e(trans('all.balance')); ?>

</span>
</div>
</div>
</div>
<div class="content-group">
<?php if(isset($sponsor->username)): ?>
<div background-size:="" class="panel-body bg-blue border-radius-top text-center" contain;"="">
<div class="content-group-sm">
<h5 class="text-semibold no-margin-bottom">
<?php echo e(trans('profile.sponsor_information')); ?>

</h5>
</div>
</div>
<div class="panel panel-body no-border-top no-border-radius-top">
<div class="form-group mt-5">
<label class="text-semibold">
<?php echo e(trans('profile.sponsor_name')); ?>:
</label>
<span class="pull-right-sm">
<?php echo e($sponsor->name); ?>

</span>
</div>
<div class="form-group mt-5">
<label class="text-semibold">
<?php echo e(trans('profile.sponsor_username')); ?>:
</label>
<span class="pull-right-sm">
<?php echo e($sponsor->username); ?>

</span>
</div>
<div class="form-group mt-5">
<label class="text-semibold">
<?php echo e(trans('profile.sponsor_country')); ?>:
</label>
<span class="pull-right-sm">
<?php echo e($sponsor->profile_info->country); ?>

</span>
</div>
<div class="form-group mt-5">
<label class="text-semibold">
<?php echo e(trans('profile.date_of_join')); ?>:
</label>
<span class="pull-right-sm">
<?php echo e($sponsor->profile_info->created_at->toFormattedDateString()); ?>

</span>
</div>
</div>
<?php endif; ?>
</div>
<!-- Share your thoughts -->
<div class="panel panel-flat">
<div class="panel-heading">
<h6 class="panel-title">
<?php echo e(trans('profile.create_a_note')); ?>

<a class="heading-elements-toggle">
<i class="icon-more">
</i>
</a>
</h6>
<div class="heading-elements">
</div>
</div>
<div class="panel-body">
<form action="#" class="notesform" data-parsley-validate="">
<div class="form-group">
<input class="form-control mb-15" cols="1" id="title" name="title" placeholder="Note title" required="" type="text"/>
</div>
<div class="form-group">
<textarea class="form-control mb-15" cols="1" id="description" name="description" placeholder="Note content" required="" rows="3"></textarea>
</div>
<div class="form-group">

<div class="btn-group hide hidden" id="note-color" data-toggle="buttons">
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
<div class="col-sm-6">
<a href="<?php echo e(url('admin/notes')); ?>" class="btn btn-link">
 <?php echo e(trans('profile.view_all_notes')); ?> <i class="icon-arrow-right14 position-right">
</i>                                
</a>
</div>

<div class="col-sm-6 text-right">
<button class="submit-note btn btn-primary btn-labeled btn-labeled-right" type="button">
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
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?> 

<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

<script>
    $(document).ready(function(){
        $('#btnClear').click(function(){  
            $('#usersearch input[type="text"]').val('');
            $('#usersearch #clear1').val('');
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
    div#profilephotopreview {
    background-size: cover;
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>