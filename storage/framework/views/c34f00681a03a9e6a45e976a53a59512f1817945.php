  <?php $__env->startSection('title'); ?> <?php echo e($title); ?> :: ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8## <?php $__env->stopSection(); ?>   <?php $__env->startSection('main'); ?> <?php echo $__env->make('app.admin.layouts.records', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('styles'); ?> 

<style type="text/css">
    .carousel-indicators li {
        border: 1px solid #89160b;
    }
    .slide{
            width: 44%;
            height: 6%;
    }
    .test {
 
  display:flex;
  align-items:center;
  justify-content:center;
}
.item {
    display: none;
    position: relative;
    .transition(.6s ease-in-out left);
}

</style>

##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669## 

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695## 

<?php $__env->stopSection(); ?>


<div class="row">
    <div class="col-lg-7">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">
                <?php echo e(trans('dashboard.join_time')); ?>

                </h6>
                <div class="heading-elements">
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold"><?php echo e(trans('dashboard.week_join')); ?></div>
                                <div class="text-muted"><?php echo e($weekly_users_count); ?></div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold"><?php echo e(trans('dashboard.month_join')); ?></div>
                                <div class="text-muted"><?php echo e($monthly_users_count); ?></div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold"><?php echo e(trans('dashboard.year_join')); ?></div>
                                <div class="text-muted"> <?php echo e($yearly_users_count); ?> </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="chart-container">
                <div class="chart has-fixed-height" id="users_join" style="height:350px">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <!-- Sales stats -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title"><?php echo e(trans('dashboard.package_purchase')); ?></h6>
                <div class="heading-elements">
                </div>
            </div>
            <div class="container-fluid">
                <div class="row text-center">
                    <?php $__currentLoopData = $packages_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="content-group">
                            <h5 class="text-semibold no-margin">
                                  <?php echo e($package->purchase_history_r_count); ?>

                                  <br>
                                <img src="<?php echo e(url('img/cache/original/'.$package->image)); ?>" class="img-circle" style="width: 80px;" alt="<?php echo e(config('app.name', 'Cloud MLM Software')); ?>">

                            <?php if($package->special == 'yes'): ?>
                            <!-- <span class="label label-flat border-green-400 label-icon text-green-400" style="display: inline-block;"><i class="icon-stars"></i> <?php echo e(trans('dashboard.special')); ?></span> -->
                            <?php endif; ?>
                            </h5>
                            <span class="text-muted text-size-small"><?php echo e($package->package); ?> <?php echo e(trans('dashboard.purchases')); ?></span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="content-group-sm" id="package_purchase_graph" style="height:350px"></div>
        </div>
        <!-- /sales stats -->
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
           <div class="panel ">
             <div class="panel-heading">
                <h6 class="panel-title"><?php echo e(trans('dashboard.global_view')); ?></h6>
            </div>
            <div class="panel-body ">
                <div class="has-fixed-height map-choropleth"></div>                
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
    <div class="panel ">
        <div class="panel-heading">
            <h6 class="panel-title"><?php echo e(trans('dashboard.referral_link')); ?></h6>
        </div>
        <div class="panel-body">
            <div class="input-group">
                <!-- input id="referrallink" type="text" readonly="true" class="selectall form-control" spellcheck="false" value="<?php echo e(url('/',Auth::user()->username)); ?>" /> -->
                <input id="referrallink" type="text" readonly="true" class="selectall form-control" spellcheck="false" value="https://algolight.net/<?php echo e(Auth::user()->username); ?>" />
                <span class="input-group-addon copylink">
                    <button class="btn btn-link btn-copy"  style="margin: 0 auto;padding: 0px;font-size: 12px;" data-clipboard-target="#referrallink">
                    <i class="fa fa-copy"></i>
                    </button>
                </span>
            </div>
        </div>
        <!-- <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a> -->
      <!--   <div class="">
            <div class="text-semibold text-center"><?php echo e(trans('dashboard.share')); ?></div>
            <hr class="mb-5 mt-5" />
            <div class="panel-body text-center">
                <button class="btn btn-info btn-labeled btn-xs btn-modal"
                data-toggle="modal"
                data-target="#fsModal">
                <b><i class="icon-share2"></i></b>
                <?php echo e(trans('dashboard.share_link')); ?>! 
                </button>
                <div id="fsModal" class="sharemodal modal animated bounceIn"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title"> <?php echo e(trans('dashboard.share_web')); ?>!!</h5>
                            </div>
                            <div class="modal-body">
                                <div class="share_target social_links" data-title="Cloud MLM Software for multilevel network marketing, direct selling business"  data-url="<?php echo e(url('/',Auth::user()->username)); ?>"  data-img="https://cloudmlmsoftware.com/sites/default/files/mlm-software.jpg" data-desc="Best MLM Software that is customizable for any type of online business , multilevel marketing and direct selling business with best support, Try our free MLM software demo today!" data-rurl="<?php echo e(url('/',Auth::user()->username)); ?>" data-via="cloudmlmsoft" data-hashtags="MLM,Software"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    </div>
</div>    
   

   <div class="col-md-6 col-sm-12">
           <div class="panel">
             
            <div class="panel-body ">                


              
  <div id="myCarousel" class="carousel slide col-md-4 col-md-offset-3 " data-ride="carousel">
    <!-- Indicators -->
   
<?php if(isset($top_earners[0])&&isset($top_recruiters[0])): ?>
    <!-- Wrapper for slides -->
    <div class="carousel-inner cb-slideshow text-center">

      <div class="item active ">
     <h3><?php echo e(trans('dashboard.top_earner')); ?></h3>
        
         
          <p><div class="media-left media-middle text-center test" >
                                        <?php echo e(Html::image(route('imagecache', ['template' => 'original', 'filename' => $top_earners[0]->profile]), 'Admin', array('class' => 'img-circle  img-ab '))); ?>

                                        
                                    </div>
                              
                                        <div class="media-heading text-semibold text-center " valign="middle">
                                            <a href="<?php echo e(url('admin/userprofiles/')); ?>/<?php echo e($user->username); ?>" target="_blank" class="letter-icon-title"><?php echo e($top_earners[0]->username); ?></a>
                                           <br> <?php echo e($top_earners[0]->email); ?>

                                        <br> <?php echo e($currency_sy); ?> <?php echo e($top_earners[0]->balance); ?>

                                        </div>
                                    </p>
      
      </div>

      <div class="item">
    
   
          <h3><?php echo e(trans('dashboard.top_recruiter')); ?></h3>
          <p><div class="media-left media-middle text-center test"  >
                                        <?php echo e(Html::image(route('imagecache', ['template' => 'original', 'filename' => $top_recruiters[0]->profile]), 'Admin', array('class' => 'img-circle  img-ab'))); ?>

                                        
                                    </div>
                              
                                        <div class="media-heading text-semibold text-center " >
                                            <a href="<?php echo e(url('admin/userprofiles/')); ?>/<?php echo e($user->username); ?>" target="_blank" class="letter-icon-title"><?php echo e($top_recruiters[0]->username); ?></a>
                                           <br> <?php echo e($top_recruiters[0]->email); ?>

                                        <br><?php echo e($top_recruiters[0]->count); ?>

                                        </div>
                                    </p>
        
      </div>
    
     
  
    </div>
<?php endif; ?>
    <!-- Left and right controls -->
   
  </div>            





            </div>
             <ol class="carousel-indicators">
      <!-- <li data-target="#myCarousel" data-slide-to="0" ></li>
      <li data-target="#myCarousel" data-slide-to="1"></li> -->
     
    </ol>
        </div>
    </div>





</div>

<div class="row">

<?php echo $__env->make('app.admin.layouts.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="col-md-4 col-sm-12">
<!-- Pie with legend -->
<div class="panel panel-body text-center">
<div class="panel-heading">
    <h6 class="panel-title text-semibold"><?php echo e(trans('dashboard.gender_ratio')); ?></h6>
</div>
<div class="text-size-small text-muted content-group-sm">
</div>
<div class="svg-center has-fixed-height" id="pie_gender_legend" style="height: 300px">
</div>
<script type="text/javascript">
var pie_gender_legend_data = [{
"name": "Male",
"value": <?php echo e($male_users_count); ?>,
"color": "#66BB6A"
}, {
"name": "Female",
"value": <?php echo e($female_users_count); ?>,
"color": "#EF5350"
}];
</script>
</div>
<!-- /pie with legend -->

<div class="panel panel-body border-top-danger">

<div class="panel-heading">
    <h6 class="panel-title text-semibold"><?php echo e(trans('dashboard.recent_activities')); ?></h6>
</div>
<div class="row"> 
<?php $__currentLoopData = $all_activities->chunk(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-sm-12">
    <ul class="list-feed media-list">
        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        
        
        <li class="media">
            <div class="media-body">
                <a href="<?php echo e(url('admin/userprofiles/')); ?>/<?php echo e($activity->username); ?>" target="_blank"><?php echo e($activity->name); ?></a> <?php echo e($activity->description); ?>

            </div>
           <!--  <div class="media-right">
                <ul class="icons-list icons-list-extended text-nowrap">
                    <li>
                        <a href="#"><i class="icon-bubble-dots4"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-circle-right2"></i></a>
                    </li>
                </ul>
            </div> -->
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </ul>
    
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<hr class="mb-10 mt-10"/>
<div class="text-center">
    <a href="<?php echo e(url('admin/all_activities')); ?>" class="btn btn-primary"><i class="icon-make-group position-left"></i> <?php echo e(trans('dashboard.view_all_activities')); ?> </a>
</div>

</div>

</div>
<!-- Dashboard content -->
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

<script type="text/javascript"> 
    


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.admin.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>