 <div class="bg"> <?php $__env->startSection('content'); ?> <?php $lockedflag = false; $redirectFlag = false; ?> <?php if(Input::get('loggedOut')): ?> <?php if(App\User::where('username', '=', Crypt::decrypt(Input::get('loggedOut')))->exists()): ?> <?php $lastusername = Crypt::decrypt(Input::get('loggedOut')); $lastuserid = App\User::where('username', '=', $lastusername )->value('id'); $lastuserObj = App\User::with('profile_info')->find($lastuserid); $lastUserNiceName = $lastuserObj->name; $lockedflag = true; ?> <?php endif; ?> <?php endif; ?> <?php if(Input::get('redirect')): ?> <?php $redirectPath = array_get(parse_url(Request::get('redirect')),'path'); $redirectFlag = true; ?> <?php endif; ?> <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php echo $__env->make('utils.errors.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <style type="text/css"> .icon-object img{ animation: rotation 11s infinite linear; } @keyframes rotation { from { transform: rotate(0deg); } to { transform: rotate(359deg); } } .bg{ background-image:url('img/cache/original/login-bg1.jpg'); background-repeat: no-repeat; background-size:cover; width: 100%; height: auto; /* Lovepik_com-400062711-golden-halo-material-background.jpg background-size: cover;logo-banner4.jpg logo-banner.jpg*/ background-repeat: no-repeat; background-attachment: fixed; background-position: center; } body{ /*overflow: hidden;*/ } .ellipse{ width: 320px; height: 528px; margin: 20px; shape-outside: ellipse(20% 50%); clip-path: ellipse(50% 50%); margin: 0 auto !important; /* width: 780px;clip-path: ellipse(20% 50%); margin: 0 auto !important;*/ } .form-horizontal .form-group { margin-left: -1px; margin-right: -1px; } .form-group .checkbox{ margin-left: 13px; } .sub-btn{ width: 62%; margin-left: 54px; } .for-pass a{ font-size: 11px; } .panel{ background-color:#f0c9b8; } .icon-login{ margin-top: 10px; } .logo-login{ /* margin-left: -20px;*/ } </style> <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>"> <?php echo e(csrf_field()); ?> <div class="col-md-12"> <div class="ellipse"> <div class="panel panel-body login-form"> <?php if($redirectFlag==true): ?> <input id="redirectPath" type="hidden" name="redirectPath" value="<?php echo e($redirectPath); ?>"> <?php endif; ?> <?php if($lockedflag==true): ?> <input id="username" type="hidden" name="username" value="<?php echo e($lastusername); ?>" > <div class="thumb thumb-rounded"> <?php echo e(Html::image(route('imagecache', ['template' => 'profile', 'filename' => $lastuserObj->profile_info->image]), 'a picture', array(''))); ?> </div> <h6 class="content-group text-center text-semibold no-margin-top"><?php echo e($lastUserNiceName); ?> <small class="display-block"><?php echo e(trans('all.unlock_your_account')); ?></small></h6> <?php endif; ?> <?php if($lockedflag==false): ?> <div class="text-center"> <div class="logo-login icon-object border-slate-300 text-slate-300"><img src="<?php echo e(url('img/cache/logo/logo-login.png')); ?>" alt="solidus"></div> <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5> </div> <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?> has-feedback has-feedback-left" > <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required autofocus placeholder="username" autofocus="true"> <?php if($errors->has('username')): ?> <span class="help-block"> <strong><?php echo e($errors->first('username')); ?></strong> </span> <?php endif; ?> <div class="form-control-feedback"> <i class="icon-user text-muted icon-login"></i> </div> </div> <?php endif; ?> <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> has-feedback has-feedback-left"> <input id="password" type="password" placeholder="Password" class="form-control" name="password" required <?php if($lockedflag == true): ?> autofocus <?php endif; ?> > <?php if($errors->has('password')): ?> <span class="help-block"> <strong><?php echo e($errors->first('password')); ?></strong> </span> <?php endif; ?> <div class="form-control-feedback"> <i class="icon-lock2 text-muted icon-login"></i> </div> </div> <div class="form-group"> <div class="checkbox"> <label> <input type="checkbox" class="styled" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me </label> </div> </div> <?php if($lockedflag==true): ?> <div class="form-group"> <button type="submit" class="btn btn-primary btn-block">Unlock account<i class="icon-circle-right2 position-right"></i></button> </div> <?php endif; ?> <?php if($lockedflag==false): ?> <div class="form-group"> <button type="submit" class=" sub-btn btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button> </div> <?php endif; ?> <div class="text-center for-pass"> <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>"> Forgot Your Password? </a> </div> </div> </div> </div> </form> </div> </div> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>