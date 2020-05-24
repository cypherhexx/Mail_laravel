@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
.run-table{
  margin-top: 340px;
}

.border{
  border: 2px solid #000000;
  padding: 20px;
}
.run-backg{
        background-image: url('/img/cache/original/runsoft-bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
            /*color: #fdfdfd;*/
      background-position: center;

    }
.panel-flat > .panel-heading{
     background-color: transparent;
}
.btn{
  padding: 7px 34px;
}
@media (min-width:1025px) and (max-width:1081px) {
 
  .btn {
    padding: 7px 29px;
}
}
@media (min-width:769px) and (max-width:828px) {
 
  .btn {
    padding: 7px 26px;
}
}
@media (min-width: 320px) and (max-width:926px) {
.run-backg{
height: 358px;
}
.run-table {
/*margin-top: 129px;*/
margin-top: 137px;
} 
}
</style>
@endsection @section('main')
@include('flash::message') 
@include('utils.errors.list')

<div>
    <h1>Soon Coming</h1>
</div>



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
