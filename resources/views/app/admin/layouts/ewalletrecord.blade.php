<div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}}{{$balance}}</h3>
                                <!--    {{trans('dashboard.network_members')}} -->
                                    <div class="text-muted text-size-small"> {{trans('ewallet.total_income')}}</div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <!-- Bar chart in colored panel -->
                            <div class="panel bg-danger-400 has-bg-image">
                                <div class="panel-body">
                                    

                                    <h3 class="no-margin text-semibold">  {{$currency_sy}}{{ $fast_start }}  </h3>
                                   <!--  {{trans('dashboard.members_income')}} -->
                                    <div class="text-muted text-size-small">{{trans('ewallet.total_fast_start_bonus')}}</div>
                                </div>

                                <div class="container-fluid">
                                    <div id="chart_bar_color"></div>
                                </div>
                            </div>
                            <!-- /bar chart in colored panel -->

                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <!-- Line chart in colored panel -->
                            <div class="panel bg-blue-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                       
                                    </div>

                                    <h3 class="no-margin text-semibold"> {{$currency_sy}}{{$indirect_start}} </h3>
                                   
                                    <div class="text-muted text-size-small">{{trans('ewallet.total_indirect_fast_start_bonus')}}</div>
                                </div>

                                <div id="line_chart_color"></div>
                            </div>
                            <!-- /line chart in colored panel -->

                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <!-- Sparklines in colored panel -->
                            <div class="panel bg-success-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}}{{$payout_rel}}</h3>
                                    <div class="text-muted text-size-small">{{trans('ewallet.total_payout_released')}}</div>
                                </div>

                                <div id="sparklines_color"></div>
                            </div>
                            <!-- /sparklines in colored panel -->

                        </div>
                </div>


                       