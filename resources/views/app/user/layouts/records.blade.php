

<div class="row">
                        <div class="col-lg-4">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$total_grants or 0}}</h3>
                                     My Grants
                                    <div class="text-muted text-size-small"> My Grants</div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                        </div>
                      
                        <div class="col-lg-4">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$balance or 0}}</h3>
                                      My Money
                                    <div class="text-muted text-size-small"> My Money</div>
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

                                    <h3 class="no-margin text-semibold">{{$pending_payout or 0}} </h3>
                                 Available For Withdrawal
                                    <div class="text-muted text-size-small">  Available For Withdrawal</div>
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

                                    <h3 class="no-margin text-semibold">{{$pack_name}} {{$level_percent}}%</h3>

                                   My Track
                                    <div class="text-muted text-size-small">  My Track</div>
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

                                    <h3 class="no-margin text-semibold"> My Category</h3>
                                   My Category
                                    <div class="text-muted text-size-small">   My Category</div>
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

                                    <h3 class="no-margin text-semibold">{{$rank_name}}</h3>
                                 My Rank
                                    <div class="text-muted text-size-small">My Rank</div>
                                </div>

                                <div id="sparklines_color"></div>
                            </div>
                            <!-- /sparklines in colored panel -->

                        </div>
                </div>


                       