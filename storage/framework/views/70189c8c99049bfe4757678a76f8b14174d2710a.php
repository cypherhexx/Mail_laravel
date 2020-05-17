<?php $__env->startSection('content'); ?>

    <div class="col-md-4 col-md-offset-4">
<div class="row" style="align-items: center;">
        <div class="panel panel-default">
             <div class="panel-body">
                <div class="text-center">
                
               
                <h5 class="mb-0">Bitcoin Payment</h5>
                                <!-- <span class="d-block text-muted">All fields are required</span> -->
                </div>
       
                    <div class="form-group">
                       <div class="text-center">
                        <label for="cardNumber">BTC <?php echo e($package_amount); ?> </label>
                        <div class="input-group" style="margin: 0 auto;">

                            <input type="text" class="form-control selectall copyfrom form-control" readonly="" id="cardNumber" value="<?php echo e($payment_details->address); ?>" style="width:318px;" 
                                required autofocus />
                          <!--   <span class="input-group-addon"  data-clipboard-target="#replicationlink"> <i class="fa fa-copy"></i> </span> -->
                        </div>
                      </div>
                    </div>
                    <div class="row">
                         <div class="text-center" style="margin: 0 auto;">
                            <img src="https://bitaps.com/api/qrcode/png/<?php echo e($payment_details->address); ?>">
                        </div>                         
                    </div>                     

                    <p>
                     Make your payment <b>BTC <?php echo e($package_amount); ?></b>to the above wallet, when your payment processed, you will redirect to preview

                    </p>


            <span> <img class="ajax-loader" src="<?php echo e(url('assets/pp.gif')); ?>"> <span class="loader-text">Waiting for you payment</span></span>
                                                        
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('topscripts'); ?>
##parent-placeholder-204b327729daa0c40aca3239e7b481cea6da9dc3##

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
 
 <script type="text/javascript">
     setInterval(function(){
            $.get("<?php echo e(url('ajax/get-bitaps-status/'.$trans_id)); ?>", function( data ) { 
                 if(data['status'] == 'complete'){
                        window.location.href = 'register/preview/'+data['id'];
                 }
                 
            });
     }, 4000);

 </script>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>