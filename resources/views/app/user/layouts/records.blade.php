<style type="text/css">
    
.rank-bg-image{
        background-image: url('/img/cache/original/norang1-bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        color: #fdfdfd;

    }
    .bg-success-400{
        background-color: #8e948e;
        border-color:#8e948e;
    }

    .grant-bg-image{
        background-image: url('/img/cache/original/grant1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
            color: #1b0e0e;

    }

    .rem-bg-image{
        background-image: url('/img/cache/original/box-bann.jpg');
        background-repeat: no-repeat;
        background-size: cover;
            color: #1b0e0e;

    }
  .panel[class*=bg-] .text-muted, .panel[class*=bg-] .help-block, .panel[class*=bg-] .help-inline {
    color: rgb(48, 14, 13);
}

  .panel[class*=bg-] .text-mut, .panel[class*=bg-] .help-block, .panel[class*=bg-] .help-inline {
    color: rgb(255, 255, 255);
}
</style>

<div class="row">
                        <div class="col-lg-4">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-success-400 grant-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}}{{$total_grants or 0}}</h3>
                                     My Grants
                                    <!-- <div class="text-muted text-size-small"> My Grants</div> -->
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                        </div>
                      
                        <div class="col-lg-4">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-success-400 rem-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}}{{$balance or 0}}</h3>
                                      My Money
                                    <!-- <div class="text-muted text-size-small"> My Money</div> -->
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Bar chart in colored panel -->
                            <div class="panel bg-success-400 rem-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}}{{$pending_payout or 0}} </h3>
                                 Available For Withdrawal
                                    <!-- <div class="text-muted text-size-small">  Available For Withdrawal</div> -->
                                </div>

                                <div class="container-fluid">
                                    <div id="chart_bar_color"></div>
                                </div>
                            </div>
                            <!-- /bar chart in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Line chart in colored panel -->
                            <div class="panel bg-success-400 rem-bg-image">
                                <div class="panel-body">
                                  
                                    <h3 class="no-margin text-semibold">{{$pack_name}} {{$level_percent}}%</h3> 

                                   My Track
                                     <img src="{{url('img/cache/original/'.$pac_image)}}" style="width: 80px;margin-top: -41px;float:right;">
                                    <!-- <div class="text-muted text-size-small">  My Track</div> -->
                                </div>

                                <div id="line_chart_color">
                                    
                                </div>


                            </div>
                            <!-- /line chart in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Sparklines in colored panel -->
                            <div class="panel bg-success-400 rem-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>


                                    <h3 class="no-margin text-semibold"> {{$category}}</h3>
                                   My Category
                                    @if($category != null)
                                   <img src="{{url('/assets/uploads/'.$cat_image)}}" style="width: 80px;margin-top: -41px;float:right;">
                                   @else
                                   <h3 class="no-margin text-semibold"> No category</h3>
                                   @endif                                       



                                    <!-- <div class="text-muted text-size-small">   My Category</div> -->
                                </div>

                                <div id="sparklines_color"></div>
                            </div>
                            <!-- /sparklines in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Sparklines in colored panel -->
                            <div class="panel bg-success-400 rem-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$rank_name}}</h3>
                                 My Rank

                                 @if($rank_name != 'No rank')
        <img src="{{ url('assets/uploads/'.$rank_image) }}" style="width:80px;height :auto;margin-top:-41px;float:right;height:78px;">
    
                                  @endif
                                    <!-- <div class="text-mut text-size-small">My Rank</div> -->
                                </div>

                                <div id="sparklines_color"></div>
                            </div>
                            <!-- /sparklines in colored panel -->

                        </div>
                </div>


                       