@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
@include('flash::message') 
@include('utils.errors.list')

  


   

<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">{{trans('register.register_new_memeber') }}</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

      @if(count($result) > 0)
    <div class="row">
      @foreach ($result as $key=>$video)
        <div class="col-sm-6">
            {!! $video['url'] !!}
            <br>
          <div class="text-center">
            {{ $video['title'] }}
          </div> 
            
        </div>
        @endforeach


</div>
@else
No Data
@endif
</div>
</div>
</h4>



@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
@parent

<script type="text/javascript"> 

   $(document).ready(function() {
            $('.summernote').summernote();
        });
</script>


@endsection
