  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>  <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?>
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo e(trans('ewallet.wallet')); ?></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <!-- <?php echo $__env->make('app.user.layouts.ewalletrecord', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
    <table class="table datatable-basic table-striped table-hover" id="ewallet-user-table">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo e(trans('ewallet.username')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('ewallet.from_user')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('ewallet.amount_type')); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans('ewallet.package')); ?>

                                    </th>
                                    <th>
                                    <?php echo e(trans('ewallet.debit')); ?> (<?php echo e($currency_sy); ?>)
                                    </th>
                                    <th>
                                       <?php echo e(trans('ewallet.credit')); ?>  (<?php echo e($currency_sy); ?>)  
                                    </th>
                                    <th>
                                        <?php echo e(trans('ewallet.date')); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script type="text/javascript ">
   

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>