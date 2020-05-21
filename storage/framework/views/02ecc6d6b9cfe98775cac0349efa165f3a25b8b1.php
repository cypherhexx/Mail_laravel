 <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?> <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669## <style type="text/css"> </style> <?php $__env->stopSection(); ?> <?php $__env->startSection('main'); ?> <div class="panel panel-border panel-primary" data-sortable-id="ui-widget-11"> <div class="panel-heading"> <h4 class="panel-title">Read News</h4> </div> <div class="panel-body"> <?php if(count($read_news) > 0): ?> <div class="table-responsive"> <table class="table table-invoice" id="table"> <thead> <tr> <th>No</th> <th>Title</th> <th>Date</th> <th>Action</th> </tr> </thead> <tbody> <?php $__currentLoopData = $read_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <tr> <td><?php echo e($key + 1); ?></td> <td><?php echo e($report->title); ?></td> <td> <?php echo e(date('d M Y H:i:s',strtotime($report->created_at))); ?></td> <td><a class="btn btn-sm btn-primary m-b-10" href="<?php echo e(url('user/read_more',$report->id)); ?>">Read More</a></td> </tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </tbody> </table> </div> <?php echo $read_news->render(); ?> <?php else: ?> No data Found <?php endif; ?> </div> <br> <br> <br> </div> <?php $__env->stopSection(); ?> <?php $__env->startSection('scripts'); ?> ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695## <?php $__env->stopSection(); ?> 
<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>