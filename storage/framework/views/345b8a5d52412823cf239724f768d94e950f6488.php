  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?> <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669## <?php $__env->stopSection(); ?>  <?php $__env->startSection('main'); ?> <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php echo $__env->make('utils.errors.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="panel panel-flat ">
    <div class="panel-heading col-sm-offset-3">
        <h4 class="panel-title">
            Create Broker
        </h4>
    </div>
    <div class="panel-body col-sm-offset-2">

  
        <form action="<?php echo e(url('admin/upcreatebrokers')); ?>" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="name">
                  Name:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                  <input class="form-control" id="name" name="name" type="text" required="true">
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="url">
                    URL:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control" id="url" name="url" type="text" required="true">
                    </input>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-3 control-label" for="current_password">
                   Status 
                </label>
                 <div class="col-sm-4">
                    <select name="status" id=status class="form-control">
                       <option value="enabled">enabled</option>  
                       <option value="disabled">disabled</option>  
                    </select>
                   
               
                </div>
            </div>
            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                        <button class="btn btn-info" id="add" name="add" tabindex="4" type="submit" >
                          Save
                        </button>
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>

<?php if(count($all_brokers) > 0): ?>

 <div class="panel panel-flat" data-sortable-id="ui-widget-11">
    <div class="panel-heading">
        <h4 class="panel-title">All Brokers</h4>
    </div>
            <div class="panel-body">
                <form action="" method="">
                    <div class="invoice-content">
                        <div class="table-responsive">
                            <table class="table table-invoice" id="table">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Name</th> 
                                        <th>URL</th>  
                                        <th>Status</th>  
                                        <th>Created</th> 
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                    <tbody>

                                            <?php $__currentLoopData = $all_brokers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $broker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>

                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($broker->name); ?></td>
                                                <td><a href="<?php echo e($broker->url); ?>" target="_blank"> <?php echo e($broker->url); ?></a></td>
                                                <td><?php echo e($broker->status); ?></td>


                                               <td> <?php echo e(date('d M Y H:i:s',strtotime($broker->created_at))); ?></td>
                                                <td>
                                               

                                                 <a  class="btn btn-sm btn-primary m-b-10" href="<?php echo e(URL::to('admin/editbroker/'.$broker->id)); ?>"><i class="icon-pencil4"></i></a>

                                                  <a class="btn btn-sm btn-primary m-b-10" href="<?php echo e(URL::to('admin/deletebroker/'.$broker->id)); ?>"><i class="fa fa-trash"></i></a>

                                                </td>
                                              
                                                </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                                               

                                                          

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </form>

                 <?php echo $all_brokers->render(); ?> 

            </div>
        </div>

        <?php endif; ?>


<?php $__env->stopSection(); ?> <?php $__env->startSection('overscripts'); ?> ##parent-placeholder-cf3aa7a97dccc92dae72236fb07ec31668edf210##

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?>
 ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>

 <?php $__env->stopSection(); ?>
<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>