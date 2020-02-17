  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>  <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?>
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo e(trans("users.users")); ?></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <table  class="table datatable-basic table-striped table-hover">
            <!-- id="pending-users" -->
                    <thead>
                        <tr>
                             <th>
                               No
                            </th>
                              <th>
                               Name
                            </th>
                            
                            <th>
                               <?php echo e(trans("users.username")); ?>

                            </th>
                            <th>
                               <?php echo e(trans("users.email")); ?>

                            </th>
                             <th>
                               View
                            </th>
                             <th>
                          Created At
                            </th>
                            <th>Verification Number</th>
                              <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <form action="<?php echo e(url('admin/verifydocuser')); ?>" method="post" class="form-control">
                                <?php echo csrf_field(); ?>

                        <input type="hidden" name="user_id" id="user_id" value="<?php echo e($user->id); ?>">
                      
                            <tr>
                        <td><?php echo e($key +1); ?></td>   

                         <td><?php echo e($user->name); ?> <?php echo e($user->lastname); ?></td>   
                        <td><?php echo e($user->username); ?></td>
                          <td><?php echo e($user->email); ?></td>
                            <td><?php if($user->document != NULL): ?>
                              <a href="<?php echo e(url('assets/uploads/'.$user->document)); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                              <?php else: ?>
                            No Document
                          <?php endif; ?></td>
                        
                        
                        <td><?php echo e(date('d M Y H:i:s',strtotime($user->created_at))); ?></td>
                          <td>
                            <input type="number" name="verification_number" class="form-control" style="width: 90px;">
                          
                          </td>
                          <td>
                             <button type="submit"  class="btn btn-primary" > <span class="fa fa-check "></span>   </button>
                          </td>
                                 
                                        
                     
                    </tr>
                    </form>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </tbody>
                        </table>
                    </div>
                </div>
                  
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script type="text/javascript ">
   

</script>
<?php $__env->stopSection(); ?>

            
<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>