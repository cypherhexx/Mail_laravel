  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>  <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
    .centerDiv
    {
      margin: 0 auto;
     
    }
  </style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?>
<!-- Basic datatable -->
    
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






                      1 .Payment to this account <br><br>
                      <center>
                        
                        <b><?php echo e($bank_details->accound_holder_name); ?></b><br>
                        Account Number: <b><?php echo e($bank_details->account_number); ?></b><br>
                        Swift Code: <b><?php echo e($bank_details->swift); ?></b><br> 
                        Bank NAME: <b><?php echo e($bank_details->bank_name); ?></b><br>
                        BANK ADDRESS: <b><?php echo e($bank_details->bank_address); ?></b><br>
                    <br>
                      </center>
                      2.Payment Of Amount <b>€<?php echo e($euro_amount); ?></b> for the Package <b><?php echo e($package->package); ?></b> worth $<?php echo e($package->amount); ?>.
                      <br>
                       <br>
             <!--         3 . USE this as PAYMENT REFERENCE :
                     <div class="row" style="margin-top: 2%!important;">
                      <div class="col-sm-4">
                    <b><input type="text" value="<?php echo e($orderid); ?>" id="myInput" readonly=""  class="form-control"></b>
                    </div>
                    <div class="col-sm-2">

                   
                    <button class = "btn-copy form-control" onclick="myFunction()"  data-clipboard-target="#myInput" >Copy</button>
                    </div>
                    </div><br><br><br><br> -->

                      <b>Note! :</b><code> Package Upgrade will be completed once payment is done  </code>                          
                    </p>

                    <p>

              

                </div>

            </div>
            
       
                 
        </div>
                  
<?php $__env->stopSection(); ?>
 
 
 
<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>