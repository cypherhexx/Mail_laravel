@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.user.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

 
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
                    <table class="table datatable-basic table-striped table-hover editable-table" data-search="false" id="kb-article-table-user">
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
