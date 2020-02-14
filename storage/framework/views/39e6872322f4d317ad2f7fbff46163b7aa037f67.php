<?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>











<?php $__env->startSection('main'); ?>







 <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

     



  <div class="panel panel-flat" >



    <div class="panel-heading">






        <h4 class="panel-title"><?php echo e($title); ?></h4>



    </div>



    <div class="panel-body">

<?php if(isset($data) and count($data)>0): ?>

      <table class="table table-stripped">

        <thead>

          <th><?php echo e(trans('products.product')); ?> </th>
          <th><?php echo e(trans('products.username')); ?> </th>

          <th><?php echo e(trans('products.number_of_products')); ?> </th>

          <!-- <th> Product amount</th> -->

        <!--   <th><?php echo e(trans('products.pv')); ?> </th> -->
          <th><?php echo e(trans('products.total_amount')); ?> </th>

          <th> <?php echo e(trans('products.purchase_date')); ?></th>

          <th> <?php echo e(trans('products.paid_by')); ?></th>

          <!-- <th> <?php echo e(trans('products.purchase_status')); ?></th> -->

          <th> <?php echo e(trans('products.action')); ?></th>
         

        </thead>



        <tbody>

          <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

           <tr>

             <td> <?php echo e($item->package); ?></td>
             
             <td> <?php echo e($item->username); ?></td>

             <td> 1</td>

             <!-- <td> <?php echo e($item->member_amount); ?></td> -->

             <!-- <td> <?php echo e($item->BV); ?></td> -->
             <td> <?php echo e($item->total_amount); ?></td>

             <td> <?php echo e(Date('d M Y',strtotime($item->created_at))); ?></td>

             <td> <?php echo e($item->pay_by); ?></td>

             <!-- <td> <?php echo e($item->status); ?></td>  -->

             <td>
              <a href="<?php echo e(url('admin/view-invoice/'.$item->id)); ?>" target="_blank" class="btn btn-primary">
                <i class="fa fa-file-word-o"></i>
              
              </a>
        
             </td>
           </tr>



           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





           



 

        </tbody>


      </table>
      
        <?php echo $data->render(); ?>


      <?php else: ?> 

           <?php echo e(trans('products.no_data_found')); ?> 



<?php endif; ?>







    </div>



</div> 



           







       



  



<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?> ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##











<?php $__env->stopSection(); ?>











<?php $__env->startSection('scripts'); ?> ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695## 



<script src="<?php echo e(asset('assets/admin/js/plugins/jquery-validation/dist/jquery.validate.min.js')); ?>"></script>



<script src="<?php echo e(asset('vendor\bllim\laravalid\public/jquery.validate.laravalid.js')); ?>"></script>



<script type="text/javascript">



$('form').validate({onkeyup: false});



App.init();

var arra;

$.get( 

        'getAllUsers',

         { sponsor: 'ghjgj' },

            function(response) {

                    if (response) {

                        month_users=response;

arra = month_users.split(",");

$("#username").autocomplete({source:arra});

}

});

</script>







<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>