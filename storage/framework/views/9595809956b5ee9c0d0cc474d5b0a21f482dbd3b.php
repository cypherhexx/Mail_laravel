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

                  <img src="<?php echo e(url('img/cache/original/Internationaltransfer.jpg')); ?>" style="width: 1000px;width:1000px;">




                   <!--    1 .Payment to this account <br><br>
                       <center>
                        
                        
                        Bank name: <b>Wirecard Bank AG</b><br>
                        Bank address: <b>Einsteinring 35 85609 Aschheim, Germany</b><br> 
                        BIC: <b>WIREDEMM</b><br>
                        IBAN:<b>DE25512308006506628444</b><br>
                        Bank country:<b>Germany</b><br>
                        Beneficiary name:<b>gold   y ltd</b><br>
                    <br>
                      </center>
                
                      <center>
                      <b>שם בעל החשבון : גולד וי בעמ</b><br>
                      <b>בנק: הבינלאומי הראשון (31</b>)<br>
                      <b>סניף אם המושבות (124)</b><br>
                      <b>מס חשבון :273082</b><br>
                      </center> -->

                     <br>
                       <br> 
                      2.Payment Of Amount <b>€<?php echo e($package_amount); ?></b> for the Package <b><?php echo e($package->package); ?></b> worth €<?php echo e($package->amount); ?> for <?php echo e($period); ?>ly.
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
                  
<?php $__env->stopSection(); ?> <?php $__env->startSection('scripts'); ?> ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695## 
 <script type="text/javascript">
     setInterval(function(){
            $.get("<?php echo e(url('user/get-purchasepayment-status/'.$trans_id)); ?>", function( data ) { 
                 if(data['status'] == 'complete'){
                        window.location.href = 'purchase/preview/'+data['id'];
                 }
                 
            });
     }, 4000);

 </script>
  
<?php $__env->stopSection(); ?>
 
 
 
<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>