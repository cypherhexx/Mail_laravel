<?php $__env->startSection('content'); ?>
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content">
                <!-- Error title -->
                <div class="text-center content-group">
                    <h1 class="error-title">
                        404
                    </h1>
                    <h5>
                        Oops, That page is not found, maybe for now!
                    </h5>
                </div>
                <!-- /error title -->
                <!-- Error content -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <a class="btn btn-primary btn-block content-group" href="<?php echo e(url('/')); ?>">
                                    <i class="icon-circle-left2 position-left">
                                    </i>
                                    <?php echo e(trans('all.go_home')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /error wrapper -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('no-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>