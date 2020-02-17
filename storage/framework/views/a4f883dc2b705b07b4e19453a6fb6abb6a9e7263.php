<?php $__env->startSection('title'); ?>  ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('main'); ?>




<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title"><?php echo e(trans('payout.payout')); ?>  </h4> 
                        </div>
                        <div class="panel-body"> 
                       <?php echo $__env->make('app.admin.layouts.payoutrecord', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



    <table id="data-table" class="table table-striped ">
                                    <?php if($count_requests > 0): ?>
                                    <thead>
                                        <tr role="row">
                                            <th><?php echo e(trans('payout.username')); ?> </th>
                                            <th ><?php echo e(trans('payout.user_balance')); ?></th>
                                            <th ><?php echo e(trans('register.bank_account_details')); ?></th>
                                            <!-- <th style="background-color: #008A8A;"><?php echo e(trans('ticket_config.request_date')); ?></th> -->
                                            <!-- <th style="background-color: #008A8A;"><?php echo e(trans('ticket_config.status')); ?></th> -->
                                            <th ><?php echo e(trans('payout.amount')); ?>(<?php echo e($currency_sy); ?>)</th> 
                                           <th></th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>    
                                    <?php $__currentLoopData = $vocherrquest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeC " role="row">
                                            <td class="sorting_1"><?php echo e($request->username); ?></td>
                                            <td><?php echo e(round($request->balance,2)); ?></td>
                                            <td><?php echo e(trans('register.account_number')); ?> &nbsp;&nbsp;&nbsp;         : <?php echo e($request->account_number); ?><br>
                                                <?php echo e(trans('register.account_holder_name')); ?>: <?php echo e($request->account_holder_name); ?><br>
                                                <?php echo e(trans('register.bank_code')); ?> &nbsp;&nbsp;&nbsp;          : <?php echo e($request->bank_code); ?><br>
                                            <!-- <td><?php echo e($request->created_at); ?></td> -->
                                            <td>
                                                <form action="<?php echo e(URL::to('admin/payoutconfirm')); ?>" method="post">
                                                    <!-- <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token">
                                                    
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"value="<?php echo e($request->count); ?>" name="count">                                     
                                                    </div> -->
                                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                    <input type="hidden" value="<?php echo e($request->payout_id); ?>" name="requestid">
                                                    <input type="hidden" value="<?php echo e($request->user_id); ?>" name="user_id">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                             <input type="text" class="form-control" value="<?php echo e(round($request->amount,2)); ?>" name="amount">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-success" value="<?php echo e(round($request->amount,2)); ?>" name="submit"><i class="fa fa-check" aria-hidden="true"></i> </button>
                                                            
                                                        </div>
                                                         <div class="col-sm-2">
                                                            <a type="submit" class="btn btn-danger" href="<?php echo e(URL::to('admin/payoutreject/'.$request->payout_id.'/'.$request->amount)); ?>" name="reject"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                                            
                                                        </div>
                                                        

                                                    </div>
                                                   
                                                    
                                                </form>
                                            </td>                                                                                    
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  



                                    </tbody>
                                    <?php else: ?>
                                      <?php echo e(trans('ticket_config.no_payout_request_so_far')); ?> !!
                                    <?php endif; ?>
                                </table>


                             <div class="text-center">   <?php echo $vocherrquest->render(); ?> </div>


                       
                </div>
            </div>
  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript"> 
     
             App.init();
             TableManageDefault.init();
       
    </script>

<script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>