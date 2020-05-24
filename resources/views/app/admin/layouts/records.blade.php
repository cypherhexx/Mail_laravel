<div class="row">
                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$total_users}}</h3>
                                   {{trans('dashboard.network_members')}}
                                    <div class="text-muted text-size-small">{{round($per_users,2)}}% Referred by Admin</div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                        </div>
<!-- 
                        <div class="col-lg- col-md-3 col-sm-6 col-xs-12">

                            
                            <div class="panel bg-danger-400 has-bg-image">
                                <div class="panel-body">
                                    

                                    <h3 class="no-margin text-semibold"> {{$currency_sy}}{{ round($total_amount) }} </h3>
                                    {{trans('dashboard.members_income')}}
                                    <div class="text-muted text-size-small">{{round($per_payout,2)}}% Payout done</div>
                                </div>

                                <div class="container-fluid">
                                    <div id="chart_bar_color"></div>
                                </div>
                            </div>
                            

                        </div> -->

                         <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

                            <!-- Sparklines in colored panel -->
                            <div class="panel bg-success-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$turnover}}</h3>
                                  Total company income
                                    <div class="text-muted text-size-small">Total company income</div>
                                </div>

                                <div id="sparklines_color"></div>
                            </div>
                            <!-- /sparklines in colored panel -->

                        </div>

                        <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">

                            <!-- Line chart in colored panel -->
                            <div class="panel bg-blue-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                       
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$total_voucher}}</h3>
                                    {{trans('dashboard.vouchers')}}
                                    <div class="text-muted text-size-small">{{trans('dashboard.vouchers_in_system')}}</div>
                                </div>

                                <div id="line_chart_color"></div>
                            </div>
                            <!-- /line chart in colored panel -->

                        </div>

                       
                </div>