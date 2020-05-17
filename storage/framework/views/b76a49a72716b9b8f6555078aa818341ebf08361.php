  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?> <?php $__env->startSection('styles'); ?> ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669## <?php $__env->stopSection(); ?>  <?php $__env->startSection('main'); ?>
<div class="panel panel-flat border-top-success">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo e(trans('tree.binary_genealogy')); ?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div id="searchtreeholder" class="row mb-10">
            <div class="col-sm-12">
                <span class="input-group">   
                    <input type="text" class="form-control " id="key-word-user-binary" name="key-word-user-binary" placeholder="Search Member">
                    <input type="hidden" id="key_user_hidden" name="key_user_hidden" >
                    <span class="input-group-btn">                    
                        <button class="btn-icon btn btn-info" type="button" id="btn-filter-node"><i class="fa fa-search position-left"></i><?php echo e(trans('tree.search')); ?>  </button>
                    </span>
                <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"  id="btn-cancel"><i class="icon-cross"></i></button>
                    </span>
                </span>
            </div>
        </div>
        <div class="row mb-10">
            <div class="col-lg-12">
                <div id="" class="input-group view-state panel-title">
                    <span class="input-group-addon">
                    <div class="checkbox checkbox-switch">
                  <label>
                      <input id="toggle-images" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Images" data-off-text="No Images" class="switch-images" >
                  </label>
                 </div>
                  </span>
              <!--       <span class="input-group-addon">
                   <div class="checkbox checkbox-switch">
                  <label>
                      <input id="toggle-grid" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Grid On" data-off-text="Grid Off" class="switch">                     
                  </label>
                 </div>
                  </span> -->
                    <span class="input-group-addon">

                    <button data-action="reloads" type="button" id="btn-restart-genealogy-node" class="btn btn-default btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20"><span class="ladda-label"><i class="icon-spinner4 position-left"></i><?php echo e(trans('tree.reset_tree')); ?></span></button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="tree-guide-bar col-sm-12">
                <div class="badge  bar bar-active "><?php echo e(trans('tree.active')); ?></div>
                <div class="badge  bar bar-inactive "><?php echo e(trans('tree.inactive')); ?></div>
                <div class="badge  bar bar-vacant "><?php echo e(trans('tree.vacant')); ?></div>
            </div>
        </div>
        <div class="overflow" style="background-image:url('https://office.algolight.net/img/cache/original/genology-bg.jpg'); background-repeat:no-repeat; background-size:cover;">
            <div id="treediv">
            </div>
            <div class="hidden hide">
                {-- $tree --}
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

<script>
    $(document).ready(function(){
        $('#btn-cancel').click(function(){  
            $(' #input[type="text"]').val('');
            $(' #key-word-user-binary').val('');
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.user.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>