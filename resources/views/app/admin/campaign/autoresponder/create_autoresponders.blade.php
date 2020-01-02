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
							<a href="{{url('admin/campaign/autoresponders/create')}}" class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-paperplane"></i></b> Create new autoresponder</a>							
						</div>
    	</div>
    </div>
    <div class="row campaign-list">
    <div class="panel">

       
        <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px">Due</th>
                                            <th style="width: 300px;">User</th>
                                            <th>Description</th>
                                            <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="active border-double">
                                            <td colspan="3">Active tickets</td>
                                            <td class="text-right">
                                                <span class="badge bg-blue">24</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">
                                                <h6 class="no-margin">12 <small class="display-block text-size-small no-margin">hours</small></h6>
                                            </td>
                                            <td>
                                                <div class="media-left media-middle">
                                                    <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
                                                        <span class="letter-icon">A</span>
                                                    </a>
                                                </div>

                                                <div class="media-body">
                                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
                                                    <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="text-default display-inline-block">
                                                    <span class="text-semibold">[#1183] Workaround for OS X selects printing bug</span>
                                                    <span class="display-block text-muted">Chrome fixed the bug several versions ago, thus rendering this...</span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
                                                            <li><a href="#"><i class="icon-history"></i> Full history</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
                                                            <li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">
                                                <h6 class="no-margin">16 <small class="display-block text-size-small no-margin">hours</small></h6>
                                            </td>
                                            <td>
                                                <div class="media-left media-middle">
                                                    <a href="#"><img src="assets/images/placeholder.jpg" class="img-circle img-xs" alt=""></a>
                                                </div>

                                                <div class="media-body">
                                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Chris Macintyre</a>
                                                    <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="text-default display-inline-block">
                                                    <span class="text-semibold">[#1249] Vertically center carousel controls</span>
                                                    <span class="display-block text-muted">Try any carousel control and reduce the screen width below...</span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
                                                            <li><a href="#"><i class="icon-history"></i> Full history</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
                                                            <li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">
                                                <h6 class="no-margin">20 <small class="display-block text-size-small no-margin">hours</small></h6>
                                            </td>
                                            <td>
                                                <div class="media-left media-middle">
                                                    <a href="#" class="btn bg-blue btn-rounded btn-icon btn-xs">
                                                        <span class="letter-icon">R</span>
                                                    </a>
                                                </div>

                                                <div class="media-body">
                                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Robert Hauber</a>
                                                    <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="text-default display-inline-block">
                                                    <span class="text-semibold">[#1254] Inaccurate small pagination height</span>
                                                    <span class="display-block text-muted">The height of pagination elements is not consistent with...</span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
                                                            <li><a href="#"><i class="icon-history"></i> Full history</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
                                                            <li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-center">
                                                <h6 class="no-margin">40 <small class="display-block text-size-small no-margin">hours</small></h6>
                                            </td>
                                            <td>
                                                <div class="media-left media-middle">
                                                    <a href="#" class="btn bg-warning-400 btn-rounded btn-icon btn-xs">
                                                        <span class="letter-icon">D</span>
                                                    </a>
                                                </div>

                                                <div class="media-body">
                                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Dex Sponheim</a>
                                                    <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> Active</div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="text-default display-inline-block">
                                                    <span class="text-semibold">[#1184] Round grid column gutter operations</span>
                                                    <span class="display-block text-muted">Left rounds up, right rounds down. should keep everything...</span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#"><i class="icon-undo"></i> Quick reply</a></li>
                                                            <li><a href="#"><i class="icon-history"></i> Full history</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
                                                            <li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
        
    </div>
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
