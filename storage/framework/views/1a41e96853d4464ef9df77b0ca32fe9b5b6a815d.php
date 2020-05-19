<div class="row"> <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12"> <div class="panel bg-indigo-400 has-bg-image"> <div class="panel-body"> <div class="heading-elements"> </div> <h3 class="no-margin text-semibold"><?php echo e($total_users); ?></h3> <?php echo e(trans('dashboard.network_members')); ?> <div class="text-muted text-size-small"><?php echo e(round($per_users,2)); ?>% Referred by Admin</div> </div> <div id="chart_area_color"></div> </div> </div> <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12"> <div class="panel bg-success-400 has-bg-image"> <div class="panel-body"> <div class="heading-elements"> </div> <h3 class="no-margin text-semibold"><?php echo e($turnover); ?></h3> Total company income <div class="text-muted text-size-small">Total company income</div> </div> <div id="sparklines_color"></div> </div> </div> <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12"> <div class="panel bg-blue-400 has-bg-image"> <div class="panel-body"> <div class="heading-elements"> </div> <h3 class="no-margin text-semibold"><?php echo e($total_voucher); ?></h3> <?php echo e(trans('dashboard.vouchers')); ?> <div class="text-muted text-size-small"><?php echo e(trans('dashboard.vouchers_in_system')); ?></div> </div> <div id="line_chart_color"></div> </div> </div> </div>