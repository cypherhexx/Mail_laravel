<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Cloud MLM Software')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(mix('/css/app.css')); ?>" rel="stylesheet">

</head>

<body class="login-container">

<!-- Main navbar -->
    <div class="navbar navbar-inverse">
       <!--  <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>"> <?php echo e(config('app.name', 'Laravel')); ?> </a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>
 -->
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">

       <!--      <li class="dropdown currency-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                             <i class="fa fa-<?php echo e(strtolower(currency()->getUserCurrency())); ?>"></i>
                                <?php echo e(currency()->getUserCurrency()); ?> - <?php echo e(currency()->__get('name')); ?>

                             </span>                     
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu"> -->

                    <!--TODO : http://lyften.com/projects/laravel-currency/doc/methods.html -->
               <!--       <?php $__currentLoopData = currency()->getActiveCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curr => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($curr != strtolower(currency()->getUserCurrency())): ?>
                        <?php endif; ?>                        
                        <li><a class="<?php echo e($curr == strtolower(currency()->getUserCurrency()) ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>/<?php echo e(Route::getFacadeRoot()->current()->uri()); ?>/?currency=<?php echo e($curr); ?>">  <span class="currency-symbol"><?php echo e($currency['symbol']); ?></span> <span class="currency-code"> <?php echo e(strtoupper($curr)); ?></span><span class="currency-name"> <?php echo e($currency['name']); ?></span></a></li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>     -->           

                <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                             <span class="lang-xs lang-lbl" lang="<?php echo e(App::getLocale()); ?>"></span>                     
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                     <?php $__currentLoopData = Config::get('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($lang != App::getLocale()): ?>
                        <?php endif; ?>

                        <li><a class="deutsch <?php echo e($lang == App::getLocale() ? 'active' : ''); ?>" href="<?php echo e(route('lang.switch', $lang)); ?>"> <span class="lang-xs lang-lbl" lang="<?php echo e($language); ?>"></span></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>

                 <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(route('login')); ?>">Login</a></li>                        
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>


            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <?php echo $__env->yieldContent('content'); ?>

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->





<?php echo $__env->yieldContent('overscripts'); ?>

<script>
    window.CLOUDMLMSOFTWARE = {
       "siteUrl":"<?php echo e(URL::to('/')); ?>"  
    };
</script>

<!-- Scripts -->
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
