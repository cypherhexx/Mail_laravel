<?php $__env->startSection('content'); ?>

  <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <!--  <h3 class="panel-title">
                        Payment Details  
                    </h3> -->
                         <center> <span class="loader-text" style="font-size: 18px">Bank Payment</span></center>
                    
                </div>
                <div class="panel-body centerDiv">
                    
                   <p style="margin: 0 auto!important;display: block!important;">

                       <center>
                      <img src="<?php echo e(url('img/cache/original/Internationaltransfer.jpg')); ?>" style="width: 1000px;width:1000px;">
                      </center>

                      <br>
                       <br>
                      Payment Of Amount <b>€ <?php echo e($joiningfee); ?></b> as <b>Joining Fee 
                      <br>
                       <br>
         
                      <b>Note! :</b><code> Registration will be completed once payment is done  </code>                          
                    </p>

                    <p>

              

                </div>

            </div>
            
       
                 
        </div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('scripts'); ?> ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695## 
 <script type="text/javascript">
     setInterval(function(){
            $.get("<?php echo e(url('get-bankpayment-status/'.$trans_id)); ?>", function( data ) { 
                 if(data['status'] == 'complete'){
                        window.location.href = 'register/preview/'+data['id'];
                 }
                 
            });
     }, 4000);

 </script>
  
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>