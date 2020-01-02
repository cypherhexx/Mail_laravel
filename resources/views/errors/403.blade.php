@extends('no-layout')
{{-- Content --}}
@section('content')
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content">
                <!-- Error title -->
                <div class="text-center content-group">
                    <h1 class="error-title">
                        403
                    </h1>
                    <h5>
                        Oops, an error has occurred. Service unavailable!
                    </h5>
                </div>
                <!-- /error title -->
                <!-- Error content -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <a class="btn btn-primary btn-block content-group" href="{{url('/')}}">
                                    <i class="icon-circle-left2 position-left">
                                    </i>
                                    {{trans('all.go_home')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /error wrapper -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->
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
