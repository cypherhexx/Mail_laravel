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

                     <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/save_ticket_statuses') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="id" value="{{$ticket_statuses[0]->id}}"> 

                        <div class="form-group">

                        <label class="col-md-2 control-label">Status</label>

                        <div class="col-md-6">

                        <input type="text" class="form-control" value="{{$ticket_statuses[0]->status}}" name="status" required>

                        </div>

                        </div>

                       
                        <div class="form-group">

                        <div class="col-md-6 control-label">

                        <button type="submit" class="btn btn-primary">

                        Update 

                        </button>
                                    
                        </div>

                        </div>

                    

                        </form>

                    <form class="form-horizontal" role="form" method="get" action="{{ URL::to('admin/ticket_configuration') }}">

                            <div class="form-group">

                            <div class="col-md-6 control-label">

                            <button type="submit" class="btn btn-primary" style="width: 74px;">
                                    
                            Cancel

                            </button>

                            </div>

                            </div>

                            </form>

                           

                    {{--</div>--}}

                {{--</div>--}}

            {{--</div>--}}

        </div>

    </div>

@endsection
