
<!-- Quick stats boxes -->
<div class="row">
    <div class="col-lg-4">
        <!-- Members online -->
        <div class="panel bg-teal-400 has-bg-image">
            <div class="panel-body">
                <div class="heading-elements">
                    <!-- <span class="heading-text badge bg-teal-800">
                        {{trans('users.member_current_plan')}}
                    </span> -->
                </div>
                <h3 class="no-margin">
                    {{$currency_sy}} {{$user_balance}}
                </h3>
                {{trans('payout.balance_amount')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /members online -->
    </div>
    <div class="col-lg-4">
        <!-- Current server load -->
        <div class="panel bg-pink-400 has-bg-image">
                   <div class="panel-body">
                <div class="heading-elements">
                   <!--  <span class="heading-text badge bg-teal-800">
                        {{trans('users.left_group_accumulate_bv')}}
                    </span> -->
                </div>
                <h3 class="no-margin">
                   {{$currency_sy}} {{$total_payout}}
                </h3>
               {{trans('payout.total_payout_done')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
        </div>
        <!-- /current server load -->
    </div>
    <div class="col-lg-4">
        <!-- Today's revenue -->
        <div class="panel bg-blue-400 has-bg-image">
                       <div class="panel-body">
                <div class="heading-elements">
                    <!-- <span class="heading-text badge bg-teal-800">
                        {{trans('users.right_group_accumulate_bv')}}
                    </span> -->
                </div>
                <h3 class="no-margin">
                   {{$currency_sy}} {{$total_pending}}
                </h3>
               {{trans('payout.total_pending_request')}}
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /today's revenue -->
    </div>    
  

   


  
</div>
<!-- /quick stats boxes -->


                