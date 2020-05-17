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
                               ID
                            </th>
                            <th>
                               <?php echo e(trans("users.username")); ?>

                            </th>
                            <th>
                               <?php echo e(trans("users.email")); ?>

                            </th>
                             <th>
                              Package
                            </th>
                            <th>
                              Payment Type
                            </th>
                            <th>
                               Amount
                            </th>
                             <th>
                        Created At
                            </th>
                            <th>
                                <?php echo e(trans("users.action")); ?>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                        <td><?php echo e($key +1); ?></td>   

                         <td><?php echo e($user->order_id); ?></td>   
                        <td><?php echo e($user->username); ?></td>
                          <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->package); ?></td>
                              <td><?php echo e($user->payment_type); ?></td>
                                 <td><?php echo e($user->amount); ?></td>
                        <td><?php echo e(date('d M Y H:i:s',strtotime($user->created_at))); ?></td>
                                 <td>  <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php echo e($user->id); ?>"> <span class="fa fa-check "></span>   </button>

                                      <!-- Modal -->

                                <div id="myModal<?php echo e($user->id); ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                              <!-- Modal content-->

                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>

                                <div class="modal-body" style="overflow: auto !important;">

                               <center> 

                               Do you want to confirm this payment??
                              

                                </center>

                                
                                </div>                 
                                </form>
                                <div class="modal-footer">
                                <div class="row">
                                
                                <a href="<?php echo e(url('admin/activatependinguser/'.$user->id)); ?>" class="btn btn-success" ></span>Confirm </a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>

                                 </td>
                                 

                                    <td>  <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#modaltrash<?php echo e($user->id); ?>"> <span class="fa fa-trash"></span>   </button>

                                      <!-- Modal -->

                                <div id="modaltrash<?php echo e($user->id); ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                              <!-- Modal content-->

                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>

                                <div class="modal-body" style="overflow: auto !important;">

                               <center> 

                               Do you want to Delete ?
                              

                                </center>

                                
                                </div>                 
                                
                                <div class="modal-footer">
                                <div class="row">
                                
                                <a href="<?php echo e(url('admin/deletependinguser/'.$user->id)); ?>" class="btn btn-success" ></span>Confirm </a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>

                                 </td>
                                        
                     
                    </tr>
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