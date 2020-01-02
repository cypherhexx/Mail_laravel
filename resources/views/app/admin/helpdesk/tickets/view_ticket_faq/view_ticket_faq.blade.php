@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')
@parent 
<style type="text/css">
</style>
 @stop
                             
{{-- Content --}}
@section('main')
@include('utils.vendor.flash.message')

    
    <div class="container-fluid">

    <div class="row">
            

         @include('utils.errors.list')
                        

        <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/post_ticket_faq') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="col-sm-12">

                            <div class="form-group">

                            <label class="col-md-2 control-label">FAQ</label>

                            <div class="col-md-4">

                            <input type="text" class="form-control" name="faq" required >

                            </div>
                            </div>
                            </div>

                        <div class="col-sm-12">

                        <div class="form-group">

                        <div class="col-md-4  col-md-offset-2">

                        <button type="submit" class="btn btn-primary">

                        Add FAQ

                        </button>

                        </div>
                        </div>
                        </div>

                         
                       
                   {{--</div>--}}
                   {{--</div>--}}
                   {{--</div>--}}
                   </div>
                   </div>

              @endsection