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

            <?php echo Form::text('req_amount',$payout_balance, array('class'=>'form-control','required'=>'true' )); ?>


              </div>

            </div>

            <?php if($flag == 0 && $date_today >= $date_creat_sum): ?>

          
            <div class="row">
                <div class="col-sm-4 col-md-offset-5">

              <?php echo Form::submit(trans('payout.request'),array('class'=>'btn btn-success','style'=>'MARGIN: 20PX ;margin-left:-50px;')

                  ); ?>


         

              </div>
            </div>
                  <?php endif; ?>
            <?php if($flag == 1): ?>
            <br>

              <div class="row">
        <div class="col-sm-6">
            <div class="alert alert-warning fade in m-b-15">
                <strong> <?php echo e(trans('wallet.caution')); ?>!</strong>
                    Please save bank details
                    <span class="close" data-dismiss="alert">×</span>
            </div>
        </div>
            </div>
            <?php endif; ?>

             <?php if($date_today < $date_creat_sum): ?>
            <br>

              <div class="row">
        <div class="col-sm-6">
            <div class="alert alert-warning fade in m-b-15">
                <strong> <?php echo e(trans('wallet.caution')); ?>!</strong>
                   Please Wait until the specified time
                    <span class="close" data-dismiss="alert">×</span>
            </div>
        </div>
            </div>
            <?php endif; ?>

            

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

  <script type="text/javascript">
// Set the date we're counting down to

var tim="<?php echo e($hourly); ?>"
var countDownDate = new Date(tim).getTime();
console.log(countDownDate);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>