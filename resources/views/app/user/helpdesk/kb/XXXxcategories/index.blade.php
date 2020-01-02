@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('page_class', 'sidebar-main-hidden ') @section('styles') @parent @endsection @section('sidebar') @parent
@include('app.admin.helpdesk.tickets.layout.sidebar')
@endsection {{-- Content --}} @section('main')

<!-- Basic datatable -->
<div class="col-sm-8">
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Knowledge Base - Categories</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
    	
    
    
    	
    
    <table class="table datatable-basic table-striped table-hover" id="kb-categories-table" data-search="false">
            <thead>
                <tr>
                    <th>
                        {{trans('kb.category')}}
                    </th>           
                    <th>
                        {{trans('kb.description')}}
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
<div class="col-sm-4">
	<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Add category</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
    	 <form class="form-vertical categoryform" role="form" method="POST" action="{{ URL::to('admin/helpdesk/kb/categories/store') }}" data-parsley-validate="true">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                   <div class="required form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          {!! Form::label('name', trans("kb.category_name"), array('class' => 'control-label')) !!} 
                          {!! Form::text('name', Input::old('name'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("kb.category_name")]) !!}                                           
                    </div>                    

                    <div class="required form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          {!! Form::label('description', trans("kb.category_description"), array('class' => 'control-label')) !!} 
                          {!! Form::text('description', Input::old('description'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("kb.category_description")]) !!}                                           
                    </div>           

                                     
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-department"><b><i class=" icon-folder-plus2"></i></b> {{trans('kb.add_category')}}</button>
                    </div>
                </form>
    </div>
</div>
</div>
@endsection @section('scripts') @endsection