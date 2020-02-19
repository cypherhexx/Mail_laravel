
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
               Available Balance
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /members online -->
    </div>
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
                    {{$currency_sy}} {{$payout_balance}}
                </h3>
                Withdrawable amount
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /members online -->
    </div>

    @if($date_today < $date_creat_sum)

        <div class="col-lg-4">
        <!-- Members online -->
        <div class="panel bg-teal-400 has-bg-image">
            <div class="panel-body">
                <div class="heading-elements">
                    <!-- <span class="heading-text badge bg-teal-800">
                        {{trans('users.member_current_plan')}}
                    </span> -->
                </div>
                <p id="demo" style="font-size: 31px;"></p>
                Time For Next Payout
                <div class="text-muted text-size-small">
                    
                </div>
            </div>
            
        </div>
        <!-- /members online -->
    </div>
    @endif


   
   

   


  
</div>
<!-- /quick stats boxes -->


                