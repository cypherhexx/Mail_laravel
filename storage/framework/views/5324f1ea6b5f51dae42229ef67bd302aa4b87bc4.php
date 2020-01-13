<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]>   <![endif]-->
<html class="no-js" lang="<?php echo e(app()->getLocale()); ?>" itemscope itemtype="http://schema.org/website"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="">    
    <!-- Favicon /-->
    <link rel="shortcut icon" href="<?php echo e(url('img/cache/logo/'.$logo_ico)); ?>" type="image/x-icon" /> <!-- Favicon /-->
    <!-- Facebook Metadata /-->
    <meta property="fb:page_id" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content=""/>
    <meta property="og:title" content=""/>
    <!-- Google+ Metadata /-->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="">
    <link rel="shortcut icon" href="<?php echo e(url($logo_ico)); ?>" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title><?php echo e(config('app.name', 'Cloud MLM Software')); ?></title>
    <?php $__env->startSection('meta_keywords'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <meta name="keywords" content="MLM Software, Multilevel Marketing software"/>
    <?php echo $__env->yieldSection(); ?> <?php $__env->startSection('meta_author'); ?>
    <?php echo $__env->yieldSection(); ?> <?php $__env->startSection('meta_description'); ?>
    <meta name="description" content="The best MLM Software in the market"/>
    <?php echo $__env->yieldSection(); ?>
    <!-- Styles -->
    <link href="<?php echo e(mix('/css/app.css')); ?>" rel="stylesheet"/>
    <?php echo $__env->yieldContent('styles'); ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/site/ico/favicon.ico')); ?>"/>
    <?php echo $__env->yieldContent('headerscripts'); ?>
</head>
<body class="<?php echo $__env->yieldContent('page_class'); ?>">
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldContent('overscripts'); ?>
    <script src="<?php echo e(mix('/js/app.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>


    <?php if(isset($errors) && !$errors->isEmpty()): ?>
    <script type="text/javascript">
    swal("","<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($error); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>","error");
    </script>
    <?php endif; ?>
    <?php if(session()->has('flash_notification.message')): ?>
      <?php if(session()->has('flash_notification.overlay')): ?>
          <script type="text/javascript">
           swal("<?php echo Session::get('flash_notification.title'); ?>","<?php echo Session::get('flash_notification.message'); ?>","<?php echo Session::get('flash_notification.level'); ?>");
          </script>
      <?php else: ?>
          <script type="text/javascript">
           swal("<?php echo session('flash_notification.level'); ?>"," <?php echo session('flash_notification.message'); ?>","<?php echo session('flash_notification.level'); ?>");
          </script>
      <?php endif; ?>
    <?php endif; ?>

</body>
</html>