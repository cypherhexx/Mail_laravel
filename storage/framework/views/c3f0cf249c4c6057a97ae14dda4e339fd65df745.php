  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>  <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
.run-table{
  margin-top: 340px;
}

.border{
  border: 2px solid #000000;
  padding: 20px;
}
.run-backg{
        background-image: url('/img/cache/original/runsoft-bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
            /*color: #fdfdfd;*/
      background-position: center;

    }
.panel-flat > .panel-heading{
     background-color: transparent;
}
.btn{
  padding: 7px 34px;
}
.alert{
    display: block;
    margin-top: -150px;
    background-color: #fff;
    width: 470px;
    padding: 20px;
    border-radius: 3px;
    text-align: center;
    position: fixed;
    left: 50%;
    top: 50%;
    margin-left: -235px;
    /* margin-top: -200px; */
    overflow: hidden;
    /* display: none; */
    z-index: 1060;
}

@media (min-width:1025px) and (max-width:1081px) {
 
  .btn {
    padding: 7px 29px;
}
}
@media (min-width:769px) and (max-width:828px) {
 
  .btn {
    padding: 7px 26px;
}
}
@media (min-width: 320px) and (max-width:926px) {
.run-backg{
height: 358px;
}
.run-table {
/*margin-top: 129px;*/
margin-top: 137px;
} 
}
</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?>

<?php echo $__env->make('utils.errors.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div>
    <form action="<?php echo e(url('user/runsoftware')); ?>" method="post" data-parsley-validate="true" name="form-wizard">
     <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
      <input type="hidden" name="privateKey"  value="c553fef5bf159f3a57e984db2be954ce">
      <input type="hidden" name="issuer_key"  value="38da33fe1a9092e3ca4a0bc7be832cfd">
      <input type="submit" value="Download">
    </form>
</div>

<?php if(session()->has('success')): ?>
        <div class="alert alert-success">
            <img src="/images/smile.png" style="width: 100px; margin-top: 20px;">
           
            <p style="margin: 20px; font-size: 20px;">Please purchase the package to download.</p>
            <button class="btn btn-primary" id="alerting">Ok</button>
        </div>
<?php endif; ?>

<?php $__env->stopSection(); ?> <?php $__env->startSection('overscripts'); ?> ##parent-placeholder-cf3aa7a97dccc92dae72236fb07ec31668edf210##

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

<script type="text/javascript"> 

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>

<script type="text/javascript"> 

   $(document).ready(function() {
            $('#alerting').click(function(){
              $(this).parent().remove();
            });
        });
</script>

 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>