@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

 <div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Create article category</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">

{!! Form::open(array('action' => 'Admin\Helpdesk\kb\CategoryController@store' , 'method' => 'post','class'=>'form-vertical kbcategoryform ','data-parsley-validate'=>'true','role'=>'form') )!!}


        
        <div class="row">
            <div class="col-xs-3 form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {!! Form::label('name',trans('kb.name')) !!}<span class="text-red"> *</span>
                {!! Form::text('name',null,['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("ticket.please_fill_name")]) !!}
            </div>
            <div class="col-xs-3 form-group {{ $errors->has('parent') ? 'has-error' : '' }}">
                {!! Form::label('parent',trans('kb.parent')) !!}
                {!!Form::select('parent',['0'=>'Select a Category','Categories'=>$category],null,['class' => 'form-control select']) !!}
            </div>
            <div class="col-xs-3 form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                {!! Form::label('status',trans('kb.status')) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::radio('status','1',true) !!} {{ trans('kb.active')}}
                    </div>
                    <div class="col-md-6">
                        {!! Form::radio('status','0',null) !!} {{ trans('kb.inactive')}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                {!! Form::label('description',trans('kb.description')) !!}<span class="text-red"> *</span>
                {!! Form::textarea('description',null,['class' => 'form-control summernote','id'=>'description','placeholder'=>trans('kb.enter_the_description'),'required' => 'required','data-parsley-required-message' => trans("ticket.please_fill_name") ]) !!}
            </div>
        </div>
    
        {!! Form::submit(trans('kb.submit'),['class'=>'form-group btn btn-primary'])!!}
    </div>
</div>



<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{trans('kb.all_categories')}}</h5>
    </div>
    <div class="panel-body">
      
        <div class="row">
            <div class="col-sm-12">
               
        <div class="table-responsive">
        <table class="table datatable-basic table-striped table-hover editable-table" id="kb-category-table" data-search="false">
                <thead>
                    <tr>
                        <th>
                            {{trans('kb.category_name')}}
                        </th>           
                        <th>
                            {{trans('kb.category_slug')}}
                        </th>                         
                        <th>
                            {{trans('kb.category_description')}}
                        </th>
                        <th>
                            {{trans('kb.created_at')}}
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