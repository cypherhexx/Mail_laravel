@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('main') @include('utils.vendor.flash.message')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h4 class="panel-title">
            {{ trans('autoresponse.auto_response_mail') }}
        </h4>
    </div>
    <div class="panel-body">
        <div class="wrapper">
            <div class="p-30 bg-white">
                <!-- begin email form -->
                <form action="{{URL::to('admin/updateresponse')}}" method="post">
                    <!-- begin email to -->
                    <input name="_token" type="hidden" value="{{{ csrf_token() }}}" />
                    <input name="id" type="hidden" value="{{$response[0]->id}}">
                    <!-- end email to -->
                    <!-- begin email subject -->
                    <label class="control-label">
                        {{ trans('autoresponse.subject') }}:
                    </label>
                    <div class="m-b-15">
                        <input autocomplete="off" class="form-control" name="subject" required="" type="text" value="{{$response[0]->subject}}">
                        </input>
                    </div>
                    <!-- end email subject -->
                    <!-- begin email content -->
                    <label class="control-label">
                        {{ trans('autoresponse.mail_content') }}:
                    </label>
                    <div class="m-b-15">
                        <textarea class="textarea form-control" id="wysihtml5" name="content" required="" rows="12" value="{{$response[0]->content}}">
                            {{$response[0]->content}}
                        </textarea>
                    </div>
                    <label class="control-label">
                        {{ trans('autoresponse.mail_send_date') }}:
                    </label>
                    <div class="m-b-15">
                        <select class="form-control" id="date" name="date" required="">
                            <option>
                                {{$response[0]->date}}
                            </option>
                            <?php for ($i = 1; $i <= 31; $i++) : ?>
                            <option value="<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    </input>
                </form>
            </div>
            <!-- end email content -->
            <button class="btn btn-primary p-l-40 p-r-40" id="btn_submit" type="submit">
                {{ trans('autoresponse.update') }}
            </button>
        </div>
    </div>
</div>
@stop