<?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>





<?php $__env->startSection('main'); ?>


<div class="panel panel-flat" >
  <div class="panel-heading">
    <h4 class="panel-title"><?php echo e(trans('ticket_config.change_company_details')); ?></h4>
    <div class="heading-elements">
      <button id="enable" type="submit"  class="btn btn-primary"><?php echo e(trans('settings.enable_edit_mode')); ?></button>
    </div>
  </div>
  <div class="panel-body"> 
    <legend><?php echo e(trans('ticket_config.updations')); ?></legend>
    <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                          <form id="settings"> 
                         
                               <div class="form-group">
                                    <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value"><?php echo e(trans('ticket_config.company_name')); ?>: </label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="<?php echo e($rank->id); ?>" data-type='text' id="company_name" data-title='Enter Company name' data-name="company_name">
                                                 <?php echo e($rank->company_name); ?>

                                                 </a>
                                           </div>
                                            
                                    </div>
                              </div> 


                           

                                 <div class="form-group">
                                       <div class="row">
                                       
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value"><?php echo e(trans('ticket_config.company_address')); ?>: </label>    
                                           </div>
                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="<?php echo e($rank->id); ?>" data-type='text' id="company_address" data-title='Enter Company Address' data-name="company_address">
                                                 <?php echo e($rank->company_address); ?>

                                                 </a>
                                           </div>
                                          
                                       </div>
                                 </div> 

                            <div class="form-group">
                                       <div class="row">
                                      
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value"><?php echo e(trans('ticket_config.email_address')); ?>: </label>    
                                           </div>

                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="<?php echo e($rank->id); ?>" data-type='text' id="email_address" data-title='Enter Email Address' data-name="email_address">
                                                 <?php echo e($rank->email_address); ?>

                                                 </a>
                                           </div>
                                           
                                       </div>
                            </div>
                            <div class="form-group">
                                       <div class="row">
                                      
                                           <div class="col-sm-4">
                                               <label  class="form-label" for="point_value"><?php echo e(trans('ticket_config.currency')); ?>: </label>    
                                           </div>

                                           <div class="col-sm-8">
                                               <a class="settings form-control" data-pk="<?php echo e($currency_sy); ?>" data-type='text' id="currency" data-title='Enter currency' data-name="currency">
                                                 <?php echo e($currency_sy); ?>

                                                 </a>
                                           </div>
                                           
                                       </div>
                            </div>
                       
                      

                        
                      </form>
                        <br>
                      
                       </div>
                       </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

<div class="panel panel-flat" >
    <div class="panel-heading">
      <h4 class="panel-title"><?php echo e(trans('ticket_config.change_logo')); ?> </h4> 
    </div>
    <div class="panel-body"> 
       <div class="col-sm-6">
        <fieldset>
          <h4><?php echo e(trans('ticket_config.change_your_logo')); ?>:</h4>           
          <div class="media-left">
            <div class="avatar">
                <div class="avatarin ajxloaderouter">
                    <div class="img-circle" id="logopreview" style="width:100px;height:100px;margin:0px auto;background-image:url(<?php echo e(url('img/cache/logo/'.$logo)); ?>">
                    </div>
                    
                    <div class="profileuploadwrapper">
                        <form id="logoform" method="post" name="logoform">
                            <?php echo Form::file('file', ['class' => 'inputfile profilepic','id'=>'logo']); ?>

                            <?php echo Form::hidden('type', 'logo'); ?>

                            <?php echo Form::hidden('user_id', 1); ?> 
                            <?php echo csrf_field(); ?>

                            <label for="logo">
                                <i class="icon-file-plus position-left" style="color: red;">
                                </i>
                                <span>
                                </span>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
          </div>
      </fieldset> 
    </div>
    <div class="col-sm-6">
      <fieldset>
        <h4><?php echo e(trans('ticket_config.change_your_logo_icon')); ?>: </h4>
        <div class="col-md-10">
          <div class="media-left">
            <div class="avatar">
                <div class="avatarin ajxloaderouter">
                    <div class="img-circle" id="logoiconpreview" style="width:100px;height:100px;margin:0px auto;background-image:url(<?php echo e(url('img/cache/logo/'.$logo_ico)); ?>">
                    </div>
                    
                    <div class="profileuploadwrapper">
                        <form id="logoiconform" method="post" name="logoiconform">
                            <?php echo Form::file('file', ['class' => 'inputfile profilepic','id'=>'logoicon']); ?>

                            <?php echo Form::hidden('type', 'logoicon'); ?>

                            <?php echo Form::hidden('user_id', 1); ?> 
                            <?php echo csrf_field(); ?>

                            <label for="logoicon">
                                <i class="icon-file-plus position-left" style="color: red;">
                                </i>
                                <span>
                                </span>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
      </div>  
    </fieldset>            
  </div> 

    </div>
                        
<?php $__env->stopSection(); ?>







<?php $__env->startSection('scripts'); ?> ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<!-- <script src="<?php echo e(asset('assets/globals/plugins/x-editables/js/bootstrap-editable.min.js')); ?>"></script> -->
<script src="<?php echo e(asset('assets/admin/js/appsettings-editable.js')); ?>">
</script>
<script>
    $(document).ready(function() {

            // App.init();     
            // $('#enable').click(function() {

            //     $("#upload-submit").editable('toggleDisabled');

            //      $('#settings .settings').editable('toggleDisabled');

            //       $('#enable').text(function(i, text){

            //          return text === "Enable edit mode" ? "Disable edit mode" : "Enable edit mode";

            //     });

            // });
             

        });
</script>

<script type="text/javascript">


</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>