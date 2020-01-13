  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>  <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?>
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo e($title); ?></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
        
<div class="panel-body">
  <?php echo $__env->make('utils.errors.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
  <?php echo $__env->make('app.user.layouts.payoutdetails', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Form::open(array('url' => 'user/request','enctype'=>'multipart/form-data'),$rules); ?>


          <!-- <div class="form-group">

                <label class="control-label label label-primary">

        <?php echo e(trans('payout.balance_amount')); ?> :$ <?php echo e($user_balance); ?>


                </label>

            </div> -->

            <div class="row">

              <div class="col-sm-4 col-md-offset-3">

               <?php echo Form::label('req_amount', trans("payout.request_amount") ,array('class'=>'control-label')); ?>  

            <?php echo Form::text('req_amount',$user_balance, array('class'=>'form-control','required'=>'true' )); ?>


              </div>

            </div>

             <div class="row">

                 <div class="col-sm-4 col-md-offset-3">

               <?php echo Form::label('current_password', trans("profile.current_transaction_password") ,array('class'=>'control-label')); ?>  

            <?php echo Form::password('oldpass', array('class'=>'form-control','required'=>'true' )); ?>


              </div>
            

            </div>
            <div class="row">
                <div class="col-sm-4 col-md-offset-5">

              <?php echo Form::submit(trans('payout.request'),array('class'=>'btn btn-success','style'=>'MARGIN: 20PX ;')

                  ); ?>


         

              </div>
            </div>

            

        <?php echo Form::close(); ?>



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