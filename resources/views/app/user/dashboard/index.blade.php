@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent 

@endsection {{-- Content --}} @section('main') @include('app.user.layouts.records')
<div class="row">
    <div class="col-sm-12">
        <div class="panel ">
            <div class="panel-heading">
                <h6 class="panel-title">{{trans('dashboard.referral_link')}}</h6>
            </div>
            <div class="panel-body">
                <div class="input-group">
                    <input id="replicationlink" type="text" readonly="true" class="selectall copyfrom form-control" spellcheck="false" value="https://algolight.net/{{Auth::user()->username}}" />
                    <span class="input-group-addon copylink">
                        <button class="btn btn-link btn-copy"  style="margin: 0 auto;padding: 0px;font-size: 12px;" data-clipboard-target="#replicationlink">
                        <i class="fa fa-copy"></i>
                        </button>
                    </span>
                </div>
            </div>
          <!--   <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
            <div class="">
                <div class="text-semibold text-center">{{trans('dashboard.share')}}</div>
                <hr class="mb-5 mt-5" />
                <div class="panel-body text-center">
                    <button class="btn btn-info btn-labeled btn-xs btn-modal"
                    data-toggle="modal"
                    data-target="#fsModal">
                    <b><i class="icon-share2"></i></b>
                    {{trans('dashboard.share_link')}}!
                    </button>
                    <div id="fsModal" class="sharemodal modal animated bounceIn"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title"> {{trans('dashboard.share_web')}}!!</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="share_target social_links" data-title="Cloud MLM Software for multilevel network marketing, direct selling business" data-url="https://cloudmlmsoftware.com/{{Auth::user()->username}}". data-img="https://cloudmlmsoftware.com/sites/default/files/mlm-software.jpg" data-desc="Best MLM Software that is customizable for any type of online business , multilevel marketing and direct selling business with best support, Try our free MLM software demo today!" data-rurl="https://cloudmlmsoftware.com/" data-via="cloudmlmsoft" data-hashtags="MLM,Software"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div> 
<!-- <div class="col-sm-6">
    <div class="panel border-top-purple-300 border-bottom-purple-300">
        <div class="panel-heading">
            <h6 class="panel-title">{{trans('dashboard.replication_page')}}</h6>
        </div>
        <div class="panel-body">
            <div class="input-group">
                <input id="replicationpagelink" type="text" readonly="true" class="copyfrom selectall form-control" spellcheck="false" value="{{url('/'.Auth::user()->username)}}" />
                <span class="input-group-addon copylink">
                    <button class="btn btn-link btn-copy"  style="margin: 0 auto;padding: 0px;font-size: 12px;" data-clipboard-target="#replicationpagelink">
                    <i class="fa fa-copy"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
        <div class="">
            <div class="text-semibold text-center">{{trans('dashboard.share')}}</div>
            <hr class="mb-5 mt-5" />
            <div class="panel-body text-center">
                <button class="btn btn-info btn-labeled btn-xs btn-modal"
                data-toggle="modal"
                data-target="#fsModalRepli">
                <b><i class="icon-share2"></i></b>
                {{trans('dashboard.share_link')}}!
                </button>
                <div id="fsModalRepli" class="sharemodal modal animated bounceIn"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title"> {{trans('dashboard.share_web')}}!!</h5>
                            </div>
                            <div class="modal-body">
                                <div class="share_target social_links" data-title="Cloud MLM Software for multilevel network marketing, direct selling business" data-url="https://cloudmlmsoftware.com" data-img="https://cloudmlmsoftware.com/sites/default/files/mlm-software.jpg" data-desc="Best MLM Software that is customizable for any type of online business , multilevel marketing and direct selling business with best support, Try our free MLM software demo today!" data-rurl="https://cloudmlmsoftware.com/" data-via="cloudmlmsoft" data-hashtags="MLM,Software"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> -->
<!-- </div> -->

@if($date_diff != 'na' && $numberdays != 'na')
@if($numberdays < 10 && $numberdays > 0 && $date_diff > 0)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type = "button" class="close" data-dismiss = "alert">x</button>
  Dear User, Your Package will expire in {{$numberdays}}. Please Upgrade the package on the expiration date to receive commissions.
</div>
</div>
</div>
@endif
@if($date_diff < 0)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type = "button" class="close" data-dismiss = "alert">x</button>
  Your Package Expired, Please Upgrade to receive commissions
</div>
</div>
</div>
@endif
    @endif
<div class="row">
<div class="col-lg-12">
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">
        {{trans('dashboard.users_join')}}
        </h6>
        <div class="heading-elements">
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                    </li>
                    <li class="text-left">
                        <div class="text-semibold">{{trans('dashboard.week_join')}}</div>
                        <div class="text-muted">{{$weekly_users_count}}</div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
                    </li>
                    <li class="text-left">
                        <div class="text-semibold">{{trans('dashboard.month_join')}}</div>
                        <div class="text-muted">{{$monthly_users_count}}</div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
                    </li>
                    <li class="text-left">
                        <div class="text-semibold">{{trans('dashboard.year_join')}}</div>
                        <div class="text-muted"> {{$yearly_users_count}} </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr/>
    <div class="chart-container">
        <div class="chart has-fixed-height" id="users_join_user" style="height:350px">
        </div>
    </div>
</div>
</div>

</div>
<div class="row">


<!-- end row -->
<!-- begin row -->
<div class="row">
<!-- begin col-4 -->
<div class="col-md-4">
    
    <div class="panel panel-body ">
        <div class="panel-heading">
            <h6 class="panel-title text-semibold">{{trans('dashboard.recent_activities')}}</h6>
        </div>
        
        <div class="col-sm-12">
            <ul class="list-feed media-list">
                <?php $key =0; ?>
                @foreach($activities as $activity)
                
                @if($key < 10)
                
                <li class="media">
                    <div class="media-body">
                        <a href="#" target="_blank">{{$activity->name}}</a> {{$activity->description}}
                    </div>
                   
                </li>
                <?php $key++; ?>
                @endif
                @endforeach
                
            </ul>
            
        </div>
     
    </div>
</div>

<div class="col-md-8">
    <div class="panel panel-inverse" data-sortable-id="index-4">
        <div class="panel-heading">
            <h4 class="panel-title">
            {{trans('dashboard.new-registered-users')}}
            <span class="pull-right label label-success">
                {!! $count_new !!} {{trans('dashboard.new-users')}}
            </span>
            </h4>
        </div>
        <div class="panel-body">
            
            @foreach($new_users->chunk(3) as $chunk)
            <div class="col-sm-4">
                <ul class="media-list media-list-linked">
                    @foreach($chunk as $user)
                    
                    <li class="media">
                        <a href="#" target="_blank" class="media-link">
                            <div class="media-left">
                                {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $user->image]), 'Admin', array('class' => 'img-circle img-xs')) }}
                            </div>
                            <div class="media-body">
                                <div class="media-heading text-semibold"> {!! $user->name !!}</div>
                                <span class="text-muted"> {!! $user->username !!}</span>
                            </div>
                            <div class="media-right media-middle text-nowrap">
                                <span class="text-muted">
                                    <i class="icon-pin-alt text-size-base"></i>
                                    &nbsp;{!! $user->country !!}
                                </span>
                            </div>
                        </a>
                    </li>
                    
                    @endforeach
                </ul>
            </div>
            @endforeach
        </ul>
        
    </div>
</div>
</div>
@endsection