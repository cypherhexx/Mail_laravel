@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')



{!! Form::open(array('action' => 'Admin\Helpdesk\kb\ArticleController@store' , 'method' => 'post','class'=>'form-vertical kbarticleform ','data-parsley-validate'=>'true','role'=>'form') )!!}
<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default border-top-xlg border-top-warning">
            <div class="panel-heading">
                <h5 class="panel-title">
                    {!! trans('article.add_article') !!}
                </h5>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name',trans('article.name')) !!}
                        <span class="text-red">
                            *
                        </span>
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    {!! Form::label('description',trans('article.description')) !!}
                    <span class="text-red">
                        *
                    </span>
                    <div class="form-group" style="background-color:white">
                        {!! Form::textarea('description',null,['class' => 'form-control summernote','id'=>'editor','size' => '128x20','placeholder'=>trans('article.enter_the_description')]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="col-sm-12">
            <div class="panel panel-default border-top-xlg border-top-warning">
                <div class="panel-heading panel-border-top">
                    <h5 class="panel-title">
                        {{trans('article.publish')}}
                    </h5>
                </div>
                <div class="panel-body">
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        {!! Form::label('type',trans('article.status')) !!}
                        <div class="row">
                            <div class="col-xs-1">
                                {!! Form::radio('type','1',true,['class'=>'styled']) !!}
                            </div>
                            <div class="col-xs-4">
                                {{trans('article.published')}}
                            </div>
                            <div class="col-xs-1">
                                {!! Form::radio('type','0',null,['class'=>'styled']) !!}
                            </div>
                            <div class="col-xs-4">
                                {{trans('article.draft')}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        {!! Form::label('status',trans('article.visibility')) !!}
                        <div class="row">
                            <div class="col-xs-1">
                                {!! Form::radio('status','1',true,['class'=>'styled']) !!}
                            </div>
                            <div class="col-xs-4">
                                {{trans('article.public')}}
                            </div>
                            <div class="row">
                                <div class="col-xs-1">
                                    {!! Form::radio('status','0',null,['class'=>'styled']) !!}
                                </div>
                                <div class="col-xs-4">
                                    {{trans('article.private')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $format = 'H:i:s';
                        $tz = 'Asia/Kolkata';
                        date_default_timezone_set($tz);
                        $date = date($format);
                        $dateparse = date_parse_from_format($format, $date);
                        $month = $dateparse['month'];
                        $day = $dateparse['day'];
                        $year = $dateparse['year'];
                        $hour = $dateparse['hour'];
                        $minute = $dateparse['minute'];
                        @endphp
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::label('month',trans('article.publish_immediately')) !!}
                        </div>
                        <div class="col-md-12">
                            <span class="form-inline">
                                    {!! Form::selectMonth('month', $month,['style'=>'width: 98px;','class'=>'form-control'])  !!}
                                    {!! Form::selectRange('day', 1, 31, $day,['class'=>'form-control'])  !!}
                                    {!! Form::text('year',date('Y'),['style'=>'width: 60px;','class' => 'form-control'])  !!}@
                                <input name="hour" class="form-control" style="width: 40px;" type="text" value="{{$hour}}"/>
                                :
                                <input name="minute" class="form-control" style="width: 40px;" type="text" value="{{$minute}}"/>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="background-color:#f5f5f5;">
                    <div class="col-sm-12">                        
                        {!! Form::submit(trans('article.publish'),['class'=>'btn btn-primary'])!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default border-top-xlg border-top-warning">
                <div class="panel-heading panel-border-top">
                    <h5 class="panel-title">
                        {{trans('article.category')}}
                        <span class="text-red">
                            *
                        </span>
                    </h5>
                </div>
                <div class="panel-body" style="height:190px; overflow-y:auto;">
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        @foreach($category as $key=>$val)
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <input name="category_id[]" type="radio" class="styled" value="<?php echo $key; ?>"/>
                                </div>
                                <div class="col-md-10">
                                    <?php echo $val; ?>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer" style="background-color:#f5f5f5;">
                    <div class="col-sm-12">                                            
                    <span class="btn btn-info btn-sm" data-target="#j" data-toggle="modal">
                        {{trans('article.addcategory')}}
                    </span>
                </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

 <div class="modal" id="j">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!! Form::open(['method'=>'post','action'=>'Admin\Helpdesk\kb\CategoryController@store']) !!}
                                <div class="modal-header">
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                        <span aria-hidden="true">
                                            ×
                                        </span>
                                    </button>
                                    <h4 class="modal-title">
                                        {{trans('article.addcategory')}}
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-4 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            {!! Form::label('name',trans('article.name')) !!}
                                                            {!! $errors->first('name', '
                                            <spam class="help-block">
                                                :message
                                            </spam>
                                            ') !!}
                                                            {!! Form::text('name',null,['class' => 'form-control']) !!}
                                        </div>
                                        {{--  --}}
                                        <div class="col-xs-8 form-group {{ $errors->has('status') ? 'has-error' : '' }}">

                                    {!! Form::label('status',trans('article.status')) !!}
                                    {!! $errors->first('status', '<spam class="help-block">:message</spam>') !!}

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    {!! Form::radio('status','1',true,['class'=>'styled']) !!}&nbsp;{!! trans('article.active') !!}
                                                </div>
                                                <div class="col-xs-6">
                                                    {!! Form::radio('status','0',null,['class'=>'styled']) !!}&nbsp;{!! trans('article.inactive') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                        {!! Form::label('description',trans('article.description')) !!}
                                                                {!! $errors->first('description', '
                                        <spam class="help-block">
                                            :message
                                        </spam>
                                        ') !!}

                                        {!! Form::textarea('description',null,['class' => 'form-control summernote','size' => '50x10','id'=>'myNicEditor','placeholder'=>trans('article.enter_the_description')]) !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-group">
                                        {!! Form::submit('Add')!!}
                                    </div>
                                    <button class="btn btn-default pull-left" data-dismiss="modal" type="button">
                                        Close
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">
            {{trans('kb.all_articles')}}
        </h5>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table datatable-basic table-striped table-hover editable-table" data-search="false" id="kb-article-table">
                        <thead>
                            <tr>
                                <th>
                                    {{trans('kb.article_title')}}
                                </th>
                                <th>
                                    {{trans('kb.publish_time')}}
                                </th>                                
                                <th>
                                    {{trans('kb.actions')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
