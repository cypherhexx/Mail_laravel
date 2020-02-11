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
    <button type="button" class="btn btn-xs btn-default text-white" id="filter" data-toggle="collapse" data-target="#filterticketpanel" title="Filter Users"><i class="fa fa-filter" style="color: #252323 !important; font-size: large;"></i>&nbsp;</button> <?php echo $users_data->contains('username',app('request')->input('username')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-user"></i> Username:&nbsp;'.app('request')->input('username').'</label>' : ''; ?>

            <?php echo $sponsor->contains('username',app('request')->input('sponsor')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-user"></i> Sponsor:&nbsp;'.app('request')->input('sponsor').'</label>' : ''; ?>

            <?php echo $package->contains('package',app('request')->input('package')) ? '
            <label class="label border-left-success label-striped"><i class="fa fa-gift"></i> Position:&nbsp;'.app('request')->input('package').'</label>' : ''; ?>

            
            <div id="filterticketpanel" class="collapse">
               
                <div class="panel-body">
                    <form method="GET" action="<?php echo e(url('admin/users/filter')); ?>" accept-charset="UTF-8" class="form-horizontal" id="filter-form">
                        <input type="hidden" name="showtickets" value="showtickets">
                        <div class="row">
                           
                            <div class="col-sm-3">
                                Username
                                <select class="select2 filter form-control" name="username" id="username-filter">
                                    <option value="all" selected>All</option>
                                    <?php $__currentLoopData = $users_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($priority->username); ?>"><?php echo e($priority->username); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                               Sponsor
                                <select class="select2 filter form-control" name="sponsor" id="sponsor-filter">
                                    <option value="all" selected>All</option>
                                    <?php $__currentLoopData = $sponsor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sponsors->username); ?>"><?php echo e($sponsors->username); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                             <div class="col-sm-3">
                                Position
                                <select class="select2 filter form-control" name="package" id="package-filter">
                                    <option value="all" selected>All</option>
                                    <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($packages->package); ?>"><?php echo e($packages->package); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                              <div class="col-sm-3">
                                <br>
                          <input id="apply-filter" class="btn btn-primary" type="submit" name="" value="Apply" onclick="removeEmptyValues()">
                        <input id="resetFilter" class="btn btn-default" type="reset" name="reset" value="Clear">
                         </div> 
                        </div>
                        <br/>
                        
                        <br/>
                       
                    </form>
                </div>
                </div>
            
    <table data-priority="<?php echo e(app('request')->input('username') ? app('request')->input('username') : 'all'); ?>" data-sponsor="<?php echo e(app('request')->input('sponsor') ? app('request')->input('sponsor') : 'all'); ?>" data-package="<?php echo e(app('request')->input('package') ? app('request')->input('package') : 'all'); ?>"class="table datatable-basic table-striped table-hover changestatuswrapper" id="users-table" data-search="false" >
                            <thead>
                                <tr>
                                    <th>
                                       <?php echo e(trans("users.no")); ?>

                                    </th>
                                    <th>
                                       <?php echo e(trans("users.name")); ?>

                                    </th>
                                    <th>
                                       <?php echo e(trans("users.username")); ?>

                                    </th>
                                    <th><?php echo e(trans("users.sponsor")); ?></th>
                                    <th>
                                       <?php echo e(trans("users.position")); ?>

                                    </th>
                                    <th>
                                       <?php echo e(trans("users.joined_level")); ?>

                                    </th>
                                    <th>
                                       <?php echo e(trans("users.email")); ?>

                                    </th>
                                    <th>
                                       <?php echo e(trans("users.join_at")); ?>

                                    </th>
                                    <th>
                                       <?php echo e(trans("users.view")); ?>

                                    </th>
                                    <th>
                                        <?php echo e(trans("users.action")); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
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