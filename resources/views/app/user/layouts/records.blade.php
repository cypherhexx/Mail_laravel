

<div class="row">
                        <div class="col-lg-4">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$GLOBAL_RANK}}</h3>
                                       {{trans('dashboard.member_current_position')}}
                                    <div class="text-muted text-size-small"> {{trans('dashboard.member_current_position')}}</div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                        </div>
                        <!-- <div class="col-lg-3"> -->

                            <!-- Area chart in colored panel -->
                            <!-- <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$left_bv}}</h3>
                                       {{trans('dashboard.left_group_accumulate_bv')}} 
                                    <div class="text-muted text-size-small"> {{trans('dashboard.left_group_accumulate_bv')}} </div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div> -->
                            <!-- /area chart in colored panel -->

                        <!-- </div> -->
                        <!-- <div class="col-lg-3"> -->

                            <!-- Area chart in colored panel -->
                          <!--   <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{ $right_bv }}</h3>
                                        {{trans('dashboard.right_group_accumulate_bv')}}
                                    <div class="text-muted text-size-small"> {{trans('dashboard.right_group_accumulate_bv')}}</div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div> -->
                            <!-- /area chart in colored panel -->

                        <!-- </div> -->
                       
                        <div class="col-lg-4">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}} {{round($balance,2)}}</h3>
                                        {{trans('dashboard.total_income')}}
                                    <div class="text-muted text-size-small"> {{trans('dashboard.total_income')}}</div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Bar chart in colored panel -->
                            <div class="panel bg-danger-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold"> {{$currency_sy}}{{$total_rs or 0}}</h3>
                                   {{trans('dashboard.total_fund_credit')}}
                                    <div class="text-muted text-size-small"> {{trans('dashboard.total_fund_credit')}}</div>
                                </div>

                                <div class="container-fluid">
                                    <div id="chart_bar_color"></div>
                                </div>
                            </div>
                            <!-- /bar chart in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Line chart in colored panel -->
                            <div class="panel bg-blue-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                       
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}} {{$payout or 0}}</h3>
                                    {{trans('dashboard.total_payout')}}
                                    <div class="text-muted text-size-small"> {{trans('dashboard.total_payout')}}</div>
                                </div>

                                <div id="line_chart_color"></div>
                            </div>
                            <!-- /line chart in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Sparklines in colored panel -->
                            <div class="panel bg-success-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}} {{$total_invest}}</h3>
                                   {{trans('dashboard.total_investment')}}
                                    <div class="text-muted text-size-small">{{trans('dashboard.total_investment')}}</div>
                                </div>

                                <div id="sparklines_color"></div>
                            </div>
                            <!-- /sparklines in colored panel -->

                        </div>

                        <div class="col-lg-4">

                            <!-- Sparklines in colored panel -->
                            <div class="panel bg-success-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$total_top_up or 0}}</h3>
                                   {{trans('dashboard.voucher_balance')}}
                                    <div class="text-muted text-size-small">{{trans('dashboard.voucher_balance')}}</div>
                                </div>

                                <div id="sparklines_color"></div>
                            </div>
                            <!-- /sparklines in colored panel -->

                        </div>
                </div>


                       