<?php $__env->startSection('title'); ?>
    Administration :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('app.admin.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('app.admin.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-header'); ?>
    <?php echo $__env->make('app.admin.partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('app.admin.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>




<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<?php $__env->stopSection(); ?>

<?php $__env->startSection('overscripts'); ?>
##parent-placeholder-cf3aa7a97dccc92dae72236fb07ec31668edf210##
<script type="text/javascript">window.CLOUDMLMSOFTWARE = {"signedIn":<?php if(Auth::User()): ?> true <?php else: ?> false <?php endif; ?>,"csrfToken":"<?php echo e(csrf_token()); ?>","admin":true,"username":<?php if(Auth::User()): ?> "<?php echo e($user->username); ?>" <?php else: ?> false <?php endif; ?>,"siteUrl":"<?php echo e(URL::to('/')); ?>","previousUrl":"<?php echo e(URL::previous()); ?>","currentUrl":"<?php echo e(URL::current()); ?>","usernamehash":"<?php echo e(Crypt::encrypt($user->username)); ?>","LockUrl":"<?php echo url('lock/?loggedOut=').Crypt::encrypt($user->username).'&redirect='.URL::current(); ?>","presence":<?php echo e($presence); ?>,"idleTimeout":true,"idleTimeoutTime":900000}; /*15 minute is 900000 - 1 minute 60000*/ 

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CLOUDMLMSOFTWARE.csrfToken
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.admin.layouts.sidenav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>