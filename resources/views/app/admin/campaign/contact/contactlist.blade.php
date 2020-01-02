@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('page_class', 'sidebar-main-hidden ') 

@section('styles')
@parent
@endsection
@section('sidebar')
@parent
@include('app.admin.campaign.sidebar')
@endsection





{{-- Content --}}
@section('main')
  
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Add New Contact</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>
             <div class="panel-body">
            {!! Form::open(array('action' => array('Admin\Marketing\Contacts\ContactsController@store','id'=>$id) , 'method' => 'post','class'=>'form-vertical contactlistform ','data-parsley-validate'=>'true','role'=>'form') )!!}


                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" value="{{ $id }}" />

                        <div class="row">
                            <div class="col-sm-6">

                                <div class="required form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                  {!! Form::label('firstname', trans("contact.firstname"), array('class' => 'control-label')) !!} 
                                  {!! Form::text('firstname', Input::old('firstname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.firstname")]) !!}                                           
                                </div>
                                <div class="required form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  {!! Form::label('name', trans("contact.email"), array('class' => 'control-label')) !!} 
                                  {!! Form::email('email', Input::old('email'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.email")]) !!}                                           
                                </div>
                                <div class="required form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                  {!! Form::label('mobile', trans("contact.mobile"), array('class' => 'control-label')) !!} 
                                  {!! Form::text('mobile', Input::old('mobile'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.mobile")]) !!}                                           
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="required form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                  {!! Form::label('name', trans("contact.lastname"), array('class' => 'control-label')) !!} 
                                  {!! Form::text('lastname', Input::old('lastname'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.lastname")]) !!}                                           
                                </div>
                                 <div class="required form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                  {!! Form::label('name', trans("contact.address"), array('class' => 'control-label')) !!} 
                                  {!! Form::text('address', Input::old('address'), ['class' => 'form-control','required' => 'required','data-parsley-required-message' => trans("contact.address")]) !!}                                           
                                </div>
                            </div>
                        </div>
                                 

                                

                                         
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-department"><b><i class=" icon-folder-plus2"></i></b> {{trans('contact.add_contact')}}</button>
                        </div>
                    </form>
        </div>
       
        </div>
    </div>
 
<div class="col-sm-12">
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{$contactgroup->name}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        
    
    
        
    
    <table class="table datatable-basic table-striped table-hover" id="contact-list-table" data-search="false">
            <thead>
                <tr>
                    <th>{{trans('contact.firstname')}}</th>           
                    <th>{{trans('contact.lastname')}}</th>           
                    <th>{{trans('contact.email')}}</th>           
                    <th>{{trans('contact.mobile')}}</th>           
                    <th>{{trans('contact.address')}}</th>           
                    <th>{{trans('contact.created')}}</th>           
                    <th>{{trans('contact.actions')}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

       

        </div>

    </div>
</div>
@endsection		 

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
</script>
@stop
