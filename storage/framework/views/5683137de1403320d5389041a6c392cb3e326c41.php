  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>  <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?>
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo e(trans('wallet.fund_transfer')); ?></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <?php echo $__env->make('app.user.layouts.fundrecord', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="panel-body">
        <div class="col-sm-12">
            <form action="<?php echo e(url('user/fund-transfer')); ?>" class="smart-wizard form-horizontal" method="post"  >
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <!--   <div class="form-group">
                <label class="control-label label label-primary">
                    <?php echo e(trans('wallet.balance_amount')); ?> : <?php echo e($currency_sy); ?> <?php echo e($user_balance); ?>

                </label>
            </div> -->
            <div class="form-group">
                <label class="col-sm-4 control-label" for="username">
                    <?php echo e(trans('wallet.enter_username')); ?>: <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <input type="text" id="username" name="username" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="amount">
                    <?php echo e(trans('wallet.amount')); ?> : <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <input type="text" id="amount" name="amount" class="form-control" >
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="current_password">
                       <?php echo e(trans('ewallet.transaction_password')); ?> 
                </label>
                 <div class="col-sm-5">
                <input class="form-control" name="oldpass" id="oldpass" autocomplete="new-password"  type="password"  >
                </input>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label" for="amount">
                </label>
                <div class="col-sm-5">
                     <button class="btn btn-info" tabindex="4" name="add_amount" id="add_amount" type="submit" value="Add Amount"> <?php echo e(trans('wallet.add_amount')); ?></button >              
                </div>
            </div>
   
        </form>
        </div>
 <!--        <div class="col-sm-6">
            <div class="alert alert-warning fade in m-b-15">
                <strong> <?php echo e(trans('wallet.caution')); ?>!</strong>
                    <?php echo e(trans('wallet.please_enter_id')); ?>

                    <span class="close" data-dismiss="alert">×</span>
            </div>
        </div> -->


    </div>
                    </div>
                  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>
<?php $__env->stopSection(); ?>



 
<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>