  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?> <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669## <?php $__env->stopSection(); ?>  <?php $__env->startSection('main'); ?> <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php echo $__env->make('utils.errors.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="panel panel-flat ">
    <div class="panel-heading col-sm-offset-3">
        <h4 class="panel-title">
           
        </h4>
    </div>
    <div class="panel-body col-sm-offset-2">

        <form action="<?php echo e(url('admin/users/deleteusers')); ?>" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="username">
                    <?php echo e(trans('ewallet.enter_username')); ?>:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control autocompleteusers" id="username" name="autocompleteusers" type="text">
                    <input class="form-control key_user_hidden" name="username" type="hidden">
                    </input>
                </div>
            </div>
           
    
            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                        <button class="btn btn-info" id="add_amount" name="add_amount" tabindex="4" type="submit" onclick="checkNegativeValue()" value="<?php echo e(trans('ewallet.add_amount')); ?>">
                            Delete 
                        </button>
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>


<?php $__env->stopSection(); ?> <?php $__env->startSection('overscripts'); ?> ##parent-placeholder-cf3aa7a97dccc92dae72236fb07ec31668edf210##

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?>
 ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>

<script type="text/javascript">
function checkNegativeValue()
{
  var value = parseFloat(document.getElementById("amount").value);
  if(value<1)
  {
   alert("Negative Value is not allowed");
   return false;
  }
}
</script>

 <?php $__env->stopSection(); ?>
<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>