@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') Member profile:: @parent
@stop
{{-- Content --}}
@section('main')
<!-- Notes grid -->
<h6 class="content-group text-semibold">
    All activities
    <small class="display-block">
        All activities are listed here.
    </small>
</h6>



<div class="row mt-30">

    <div class="col-sm-12">
   <div class="timeline timeline-left">
                        <div class="timeline-container">

    	@if (!$all_activities->isEmpty())
    	

        
                                @foreach($all_activities as $activity)
                                <div class="timeline-row">
                                    <div class="timeline-icon">
                                        <a href="#">
                                            {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $activity->profile]), $activity->username, array('class' => '','style'=>'')) }}
                                        </a>
                                    </div>
                                    <div class="panel panel-flat timeline-content">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">
                                                <span class="text-bold">{{$activity->username}} </span>
                                                
                                                

                                            </h6>
                                            <div class="heading-elements">
                                                <span class="label label-default heading-text">
                                                    <i class="icon-history position-left text-white">
                                                    </i>
                                                    {{$activity->created_at->diffForHumans()}}
                                                </span>

                                                <a class="label label-success heading-text" href="{{url('admin/userprofiles/')}}/{{$activity->username}}" target="_blank"> View profile <i class="glyphicon glyphicon-link"></i></a>
                                                
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <span>{{$activity->description}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

		{{ $all_activities->links() }}

		@else
		<div class="row">
		<div class="alert alert-info no-border">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold"></span> No activity yet!
		</div>

		</div>
		
		@endif

       


	
        

    </div>
    </div>
</div>


@endsection

@section('styles')
@parent
<style type="text/css">

</style>
@endsection

@section('scripts')
<script type="text/javascript">
 
</script>
@endsection
