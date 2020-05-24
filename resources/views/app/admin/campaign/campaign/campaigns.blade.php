@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('page_class', 'sidebar-main-hidden ') 

@section('styles')
@parent
@endsection

@section('sidebar')
@parent


@include('app.admin.campaign.sidebar')

@endsection




{{-- Content --}}
@section('main')
<!-- Single line -->

		

<div id="campaigns-page">

    <div class="row">
    	
    	<div class="col-sm-6">
    		<div class="mt-10 mb-10">
							<a href="{{url('admin/campaign/create')}}" class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-paperplane"></i></b> Start new campaign</a>							
						</div>
    	</div>
    </div>
    <div class="row campaign-list">

        @forelse($emailcampaignlist as $item)
                    <div class="col-md-6">
            <div class="panel invoice-grid">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="text-semibold no-margin-top">
                                                {{$item->name}}
                            </h6>
                            <ul class="list list-unstyled">
                                <li>
                                    Campaign ID #:  {{str_pad($item->id, 4, '0', STR_PAD_LEFT)}}
                                </li>
                                <li>
                                    Campaign created on:
                                    <span class="text-semibold">
                                         {{date('Y/m/d',strtotime($item->created_at))}}
                                    </span>
                                </li>
                                <li>
                                    Customer Group:
                                    <span class="text-semibold">
                                        All
                                    </span>
                                </li>
                                <li>
                                    Unique Clicks:
                                    <span class="text-semibold">
                                        12
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-semibold text-right no-margin-top">
                                352 Recipients
                            </h6>
                            <ul class="list list-unstyled text-right">
                                <li>
                                    Scheduled:
                                    <span class="text-semibold">
                                       {{date('Y/m/d',strtotime($item->datetime))}}   12:00:00
                                    </span>
                                </li>
                                
                                <li class="dropdown">
                                    Status:
                                    <a class="label  statusname  {{($item->status == 'pending')? 'bg-success-400' : 'bg-danger-400'  }} dropdown-toggle" data-toggle="dropdown" href="#">
                                        {{$item->status}}
                                        <span class="caret">
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right active statusdropbtn">
                                        <li>
                                        	@if($item->status == 'pending')
                                            <a class="changecampaignstatus" data-id="{{$item->id}}"   data-status="complete" href="#"><i class="icon-alarm"></i>Complete</a>
                                            @else
                                            <a class="changecampaignstatus" data-id="{{$item->id}}"   data-status="pending" href="#"><i class="icon-alarm"></i>Pending</a>

                                            @endif
                                        </li>
                                        <li>
                                            <a href="#"><i class="icon-checkmark3"></i>Delete</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#"><i class="icon-cross3"></i>Delete</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-footer panel-footer-condensed">
                    <a class="heading-elements-toggle">
                        <i class="icon-more">
                        </i>
                    </a>
                    <div class="heading-elements">
                        <span class="heading-text">
                            <span class="status-mark border-danger position-left">
                            </span>
                            Ends on:
                            <span class="text-semibold">
                                2018/02/25
                            </span>
                        </span>
                        <ul class="list-inline list-inline-condensed heading-text pull-right">
                            <li>
                                <a class="text-default" data-target="#invoice" data-toggle="modal" href="#">
                                    <i class="icon-eye8">
                                    </i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a class="text-default dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="icon-menu7">
                                    </i>
                                    <span class="caret">
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="#">
                                            <i class="icon-printer">
                                            </i>
                                            View campaign
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('admin/campaign/edit',$item->id)}}">
                                            <i class="icon-file-download">
                                            </i>
                                            Edit Campaign
                                        </a>
                                    </li>
                                    <li class="divider">
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-file-plus">
                                            </i>
                                            View report
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> 

        @empty

        <div class="col-md-6">
            <div class="panel invoice-grid">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="text-semibold no-margin-top">
                                                Cloud MLM email campaign
                            </h6>
                            <ul class="list list-unstyled">
                                <li>
                                    Campaign ID #:  0003
                                </li>
                                <li>
                                    Campaign created on:
                                    <span class="text-semibold">
                                         2018/07/21
                                    </span>
                                </li>
                                <li>
                                    Unique Opens:
                                    <span class="text-semibold">
                                        23
                                    </span>
                                </li>
                                <li>
                                    Unique Clicks:
                                    <span class="text-semibold">
                                        12
                                    </span>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                 
            </div>
        </div>


        @endforelse

        
        
    </div>
</div>
<!-- /single line -->
@stop

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
</script>
@stop
