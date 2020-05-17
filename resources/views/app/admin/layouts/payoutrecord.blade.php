<div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <!-- Area chart in colored panel -->
                            <div class="panel bg-indigo-400 has-bg-image">
                                <div class="panel-body">
                                    <div class="heading-elements">
                                        
                                    </div>

                                    <h3 class="no-margin text-semibold">{{$currency_sy}} {{$total_pending}}</h3>
                                   {{trans('dashboard.total_pending_request_amount')}}
                                   </div>
                                </div>

                                <div id="chart_area_color"></div>
                            </div>
                            <!-- /area chart in colored panel -->

                       

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                            <!-- Bar chart in colored panel -->
                            <div class="panel bg-danger-400 has-bg-image">
                                <div class="panel-body">
                                    

                                    <h3 class="no-margin text-semibold"> {{$currency_sy}}{{ round($total_payout) }} </h3>
                                    {{trans('dashboard.total_payout_done')}}
                                    </div>
                                </div>

                                <div class="container-fluid">
                                    <div id="chart_bar_color"></div>
                                </div>
                        </div>
                            <!-- /bar chart in colored panel -->

    </div>

                   

                       