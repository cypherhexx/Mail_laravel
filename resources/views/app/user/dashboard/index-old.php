@extends('app.user.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
{{-- Content --}}
@section('main')

<div class="row" >
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                        <div class="stats-title">{{trans('dashboard.member_current_position')}} </div>
                        <div class="stats-number">{{$GLOBAL_RANK}}</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 70%;"></div>
                        </div>
                        <div class="stats-desc"> {{trans('dashboard.member_current_position')}} </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-blue">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-tags fa-fw"></i></div>
                        <div class="stats-title">{{trans('dashboard.left_group_accumulate_bv')}} </div>
                        <div class="stats-number"> {{$left_bv}} </div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 70%;"></div>
                        </div>
                        <div class="stats-desc">{{trans('dashboard.left_group_accumulate_bv')}}</div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-purple">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-tags-cart fa-fw"></i></div>
                        <div class="stats-title">{{trans('dashboard.right_group_accumulate_bv')}}</div>
                        <div class="stats-number">{{ $right_bv }} </div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 70%;"></div>
                        </div>
                        <div class="stats-desc">{{trans('dashboard.right_group_accumulate_bv')}}</div>
                    </div>
                </div> 



               <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-black">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-google-wallet fa-fw"></i></div>
                        <div class="stats-title">{{trans('dashboard.total_income')}}</div>
                        <div class="stats-number">{{round($balance)}}   </div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 70%;"></div>
                        </div>
                        <div class="stats-desc">{{trans('dashboard.total_income')}}</div>
                    </div>
                </div> 
            </div>
       
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info">
                            <h4>{{trans('dashboard.total_fund_credit')}}</h4>
                           <p> {{$total_rs or 0}}</p>   
                        </div>
                        <div class="stats-link">                            
                        </div>
                    </div>
                </div>               
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-blue">
                        <div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
                        <div class="stats-info">
                            <h4>{{trans('dashboard.total_payout')}}</h4>
                            <p> {{$total_bv or 0}}</p>   
                        </div>
                        <div class="stats-link">                            
                        </div>
                    </div>
                </div>               
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-purple">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h4>{{trans('dashboard.total_investment')}}</h4>
                            <p> </p>   
                        </div>
                        <div class="stats-link">                            
                        </div>
                    </div>
                </div>                
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-red">
                        <div class="stats-icon"><i class="fa fa-clock-o"></i></div>
                        <div class="stats-info">
                            <h4>{{trans('dashboard.voucher_balance')}}</h4>
                           <p>{{$total_top_up or 0}}</p>   
                        </div>
                        <div class="stats-link">                            
                        </div>
                    </div>
                </div>                
            </div>



<div class="panel panel-inverse">
    <div class="panel-body"> 

    <div class="row">
            <div class="col-sm-8">
                <h4>{{trans('dashboard.your_refferal_link')}} :<a target="blank" href="{{url('/'.Auth::user()->username)}}">{{url('/'.Auth::user()->username)}}</a></h4>
            </div>
            <div class="col-sm-4">
                <button class="btn btn-primary btn-lg clipboard-button" data-clipboard-text="{{url('/'.Auth::user()->username)}}" >{{trans('dashboard.copy_link')}} </button>
            </div>
        </div>

     </div>
</div>

<div class="row">
                <div class="col-md-12">
                    <div class="widget-chart with-sidebar bg-black">
                        <div class="widget-chart-content">
                            <h4 class="chart-title">
                                {{trans('dashboard.users_join')}}
                                <small>{{trans('dashboard.number_of_users_joined')}}</small>
                            </h4>
                            <div id="visitors-line-chart" class="morris-inverse" style="height: 260px;"></div>
                        </div>
                        <div class="widget-chart-sidebar bg-black-darker">
                            <div class="chart-number">
                                {{trans('dashboard.income')}}
                                <small>{{trans('dashboard.payout')}}</small>
                            </div>
                            <div id="visitors-donut-chart" style="height: 160px"></div>
                            <ul class="chart-legend">
                                <li><i class="fa fa-circle-o fa-fw text-success m-r-5"></i> {!! $percentage_balance !!}% <span>{{trans('dashboard.user_balance')}}</span></li>
                                <li><i class="fa fa-circle-o fa-fw text-primary m-r-5"></i> {!! $percentage_released !!}% <span>{{trans('dashboard.payout_released')}}</span></li>
                            </ul>
                        </div> 
                    </div>
                </div>

             
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <!-- begin col-4 -->
                <div class="col-md-4">
                    <!-- begin panel -->
                       <div class="panel panel-inverse" data-sortable-id="index-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">{{trans('dashboard.activity_history')}}</h4>
                        </div>
                        <div id="schedule-calendar" class="bootstrap-calendar"></div>
                        <div class="list-group">
                            <a href="#" class="list-group-item text-ellipsis">
                                <span class="badge badge-success"></span> {{trans('dashboard.no_activity_so_far')}}
                            </a>                             
                        </div>
                    </div>                  
                </div>               
                <div class="col-md-4">                  
                    <div class="panel panel-inverse" data-sortable-id="index-3">
                        <div class="panel-heading">
                            <h4 class="panel-title">{{trans('dashboard.todays_schedule')}}</h4>
                        </div>
                        <div id="schedule-calendar" class="bootstrap-calendar"></div>
                        <div class="list-group">
                            <a href="#" class="list-group-item text-ellipsis">
                                <span class="badge badge-success"></span> {{trans('dashboard.no_schedules_so_far')}}
                            </a>                             
                        </div>
                    </div>                    
                </div>               
                <div class="col-md-4">                   
                    <div class="panel panel-inverse" data-sortable-id="index-4">
                        <div class="panel-heading">
                            <h4 class="panel-title">{{trans('dashboard.new_registered_users')}} <span class="pull-right label label-success"> </h4>
                        </div>
                        <ul class="registered-users-list clearfix">
                        @foreach ($new_users as $user)
                            <li>
                                <a href="javascript:;"><img src="/public/appfiles/images/profileimages/thumbs/{{ $user->image }}" alt="" width="50px" height="50px"/></a>
                                <h4 class="username text-ellipsis">
                                     {!! $user->username !!} 
                                       <small>{!! $user->country_name !!}</small>
                                </h4>
                            </li>
                        @endforeach
                        </ul>
                        <div class="panel-footer text-center">
                            <a href="javascript:;" class="text-inverse">{{trans('dashboard.view_all')}}</a>
                        </div>
                    </div>                    
                </div> 
    </div>
@endsection

