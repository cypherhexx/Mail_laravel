<div class="row"> <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <div class="panel bg-indigo-400 has-bg-image"> <div class="panel-body"> <div class="heading-elements"> </div> <h3 class="no-margin text-semibold"><?php echo e($currency_sy); ?><?php echo e($user_balance); ?></h3> <div class="text-muted text-size-small"> <?php echo e(trans('ewallet.balance')); ?></div> </div> <div id="chart_area_color"></div> </div> </div> <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <div class="panel bg-danger-400 has-bg-image"> <div class="panel-body"> <h3 class="no-margin text-semibold"> <?php echo e($currency_sy); ?><?php echo e($total_transfer); ?> </h3> <div class="text-muted text-size-small"><?php echo e(trans('ewallet.total_transfered_amount')); ?></div> </div> <div class="container-fluid"> <div id="chart_bar_color"></div> </div> </div> </div> <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <div class="panel bg-blue-400 has-bg-image"> <div class="panel-body"> <div class="heading-elements"> </div> <h3 class="no-margin text-semibold"> <?php echo e($currency_sy); ?><?php echo e($credit_by_admin); ?> </h3> <div class="text-muted text-size-small"><?php echo e(trans('ewallet.amount_credited_by_admin')); ?></div> </div> <div id="line_chart_color"></div> </div> </div> <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <div class="panel bg-success-400 has-bg-image"> <div class="panel-body"> <div class="heading-elements"> </div> <h3 class="no-margin text-semibold"><?php echo e($currency_sy); ?><?php echo e($credit_by_users); ?></h3> <div class="text-muted text-size-small"><?php echo e(trans('ewallet.amount_credited_by_users')); ?></div> </div> <div id="sparklines_color"></div> </div> </div> </div> 