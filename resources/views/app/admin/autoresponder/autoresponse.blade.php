@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('main')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h4 class="panel-title">
            {{ trans('autoresponse.auto_response') }}
        </h4>
    </div>
    <div class="panel-body">
        <div class="wrapper">
            <div class="p-30 bg-white">
                <!--  begin email form -->
                <form action="{{URL::to('admin/autoresponse')}}" method="post">
                    <!-- begin email to -->
                    <input name="_token" type="hidden" value="{{{ csrf_token() }}}" />
                    <!-- end email to -->
                    <!-- begin email subject -->
                    <label class="control-label">
                        {{ trans('autoresponse.subject') }}:
                    </label>
                    <div class="m-b-15">
                        <input autocomplete="off" class="form-control" name="subject" required="" type="text">
                        </input>
                    </div>
                    <!-- end email subject -->
                    <!-- begin email content -->
                    <label class="control-label">
                        {{ trans('autoresponse.mail_content') }}:
                    </label>
                    <div class="m-b-15">
                        <textarea a="" class="textarea form-control" id="wysihtml5" name="content" required="" rows="12"></textarea>
                    </div>
                    <label class="control-label">
                        {{ trans('autoresponse.mail_send_date') }}:
                    </label>
                    <div class="m-b-15">
                        <select class="form-control" id="date" name="date" selected="selected">
                            <option>
                                -----------------{{ trans('autoresponse.select_date')}}----------------
                            </option>
                            <?php for ($i = 1; $i <= 31; $i++) : ?>
                            <option value="<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </form>
            </div>
            <!-- end email content -->
            <!--  <button type="submit" class="btn btn-primary p-l-40 p-r-40" id='btn_submit'>{{ trans('autoresponse.insert')}}</button> -->
            <button class="btn btn-primary p-l-40 p-r-40" id="btn_submit" type="submit">
                {{trans('ticket_config.insert')}}
            </button>
        </div>
    </div>
</div>
<div class="invoice-content">
    <div class="table-responsive">
        <table class="table table-invoice">
            <thead>
                <tr>
                    <th>
                        {{ trans('autoresponse.subject')}}
                    </th>
                    <th>
                        {{ trans('autoresponse.date')}}
                    </th>
                    <th>
                        {{ trans('autoresponse.action')}}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($res as $key=> $report)
                <tr>
                    <td>
                        {{$res[$key]->subject}}
                    </td>
                    <td>
                        {{$res[$key]->date}}
                    </td>
                    <td>
                        <a class="btn btn-success" href="response/edit/{{$res[$key]->id}}">
                            {{ trans('autoresponse.edit')}}
                        </a>
                        <a class="btn btn-danger" href="response/delete/{{$res[$key]->id}}">
                            {{ trans('autoresponse.delete')}}
                        </a>
                    </td>
                </tr>
                @endforeach @if(!count($res))
                <tr>
                    <td>
                        {{ trans('ticket_config.no_data')}}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- end email form -->
@stop