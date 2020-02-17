  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>  <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
<style type="text/css">
</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?>
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('utils.errors.list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="panel panel-flat ">
    <div class="panel-heading">
        <h4 class="panel-title">
          Run Software
        </h4>
    </div>
    <div class="panel-body">
      <div class="row">
    <div class="col-sm-6">

                     <table class="table" id="table">
                                <thead>
                                    <tr>

                                     
                                        <th>Broker</th> 
                                        <th>URL</th>
                                      

                                    </tr>

                                </thead>
                                    <tbody>

                                            <?php $__currentLoopData = $broker_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $busers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <tr>

                                             
                                                <td><?php echo e($busers->name); ?></td>
                                                  <td> <a href="<?php echo e($busers->url); ?>" target="_blank"> <?php echo e($busers->url); ?></a></td>
                                                 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

                                                <?php if(!count($broker_users)): ?>

                                                <tr><td>No Data</td></tr>

                                                <?php endif; ?>  

                                                          

                                    </tbody>
                            </table>
     
      
    </div>
    <div class="col-sm-6">
   

          <?php if($status == "stopped"): ?>
        <a class="btn btn-success" data-toggle="modal" data-target="#myModalstart">Start</span> </a>
       
              <!-- Modal -->

                <div id="myModalstart" class="modal fade" role="dialog">
                <div class="modal-dialog">

              <!-- Modal content-->

                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div class="modal-body" style="overflow: auto !important;">
           <form action="<?php echo e(url('user/savebrokerdetails')); ?>" class="smart-wizard form-horizontal" method="post"  >
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <div class="form-group">
                <label class="col-sm-4 control-label" for="username">
                    Choose Broker: <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <select name="user" id="user" class="form-control" required="true">
                      <option value="">Choose User</option>
                      <?php $__currentLoopData = $broker_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $busers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($busers->id); ?>"><?php echo e($busers->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
     
            <div class="form-group">
                <label class="col-sm-4 control-label" for="account">
                    Number Account: <span class="symbol required"></span>
                </label>
                <div class="col-sm-5">
                    <input type="text" id="account" name="account" class="form-control" required="true">
                </div>
            </div>
     
              <div class="form-group">
                <label class="col-sm-4 control-label" for="current_password">
                      Password Account
                </label>
                 <div class="col-sm-5">
                <input class="form-control" name="password" id="password"  type="password" required="true">
                </input>
                </div>
            </div>
         
   
                <div class="modal-footer">
                <div class="row">
              <button class="btn btn-info" tabindex="4" name="start" id="start" type="submit" value="start"> Start</button >       
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
        </form>
                </div>
                </div>
                </div>

                 <?php endif; ?>

                <?php if($status == "started"): ?>

                 <a href="<?php echo e(url('user/changestatus')); ?>" class="btn btn-danger">Stop</span> </a>
                 <?php endif; ?>
    </div>
        
      </div>

 
        </div>

      
</div>




<?php $__env->stopSection(); ?> <?php $__env->startSection('overscripts'); ?> ##parent-placeholder-cf3aa7a97dccc92dae72236fb07ec31668edf210##

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

<script type="text/javascript"> 

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>