
<!-- Quick stats boxes -->
<div class="row">
    <div class="col-lg-4">
        <!-- Members online -->
        <div class="panel bg-teal-400">
            <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-teal-800">
                        Current Plan
                    </span>
                </div>
                <h3 class="no-margin">
                    {{$GLOBAL_PACAKGE}}
                </h3>
                {{trans('users.member_current_plan')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /members online -->
    </div>
    <!-- <div class="col-lg-4"> -->
        <!-- Current server load -->
       <!--  <div class="panel bg-pink-400">
                   <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-teal-800">
                        {{trans('users.left_group_accumulate_bv')}}
                    </span>
                </div>
                <h3 class="no-margin">
                   {{$left_bv}}
                </h3>
               {{trans('users.left_group_accumulate_bv')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
        </div> -->
        <!-- /current server load -->
    <!-- </div> -->
    <!-- <div class="col-lg-4"> -->
        <!-- Today's revenue -->
        <!-- <div class="panel bg-blue-400">
                       <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-teal-800">
                        {{trans('users.right_group_accumulate_bv')}}
                    </span>
                </div>
                <h3 class="no-margin">
                    {{$right_bv}}
                </h3>
               {{trans('users.right_group_accumulate_bv')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div> -->
        <!-- /today's revenue -->
    <!-- </div>     -->
    <div class="col-lg-4">
        <!-- Today's revenue -->
        <div class="panel bg-blue-400">
                       <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-teal-800">
                       {{trans('users.total_income')}}
                    </span>
                </div>
                <h3 class="no-margin">
                   $ {{number_format($balance,2)}}
                </h3>
                {{trans('users.total_income')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div>

    <div class="col-lg-4">
        <!-- Today's revenue -->
        <div class="panel bg-blue-400">
                       <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-teal-800">
                       {{trans('users.total_payout')}}
                    </span>
                </div>
                <h3 class="no-margin">
                   $ {{number_format($total_payout,2)}}
                </h3>
                {{trans('users.total_payout')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div>


    <!-- <div class="col-lg-4"> -->
        <!-- Today's revenue -->
        <!-- <div class="panel bg-blue-400">
                       <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-teal-800">
                       {{trans('users.vouchers')}}
                    </span>
                </div>
                <h3 class="no-margin">
                    {{$voucher_count}}
                </h3>
                {{trans('users.vouchers')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div> -->
        <!-- /today's revenue -->
    <!-- </div> -->
</div>
<!-- /quick stats boxes -->


                