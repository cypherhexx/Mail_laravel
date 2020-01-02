@extends('app.user.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
{{-- Content --}}
@section('main')

<div class="row">
		@include('utils.vendor.flash.message')
</div>
@include('utils.errors.list')
{!! Form::open(array('url' => '/updatepassword','enctype'=>'multipart/form-data'),$rules) !!}
<div class="col-md-6">
	<div class="row">
		<div class="form-group">
			{!!  Form::label('oldpas', 'Old Password',array('class'=>'control-label'))  !!}
			{!!  Form::password('oldpas',array('class'=>'form-control','required'=>'true'))  !!}
		</div>
		<div class="form-group">
			{!!  Form::label('newpas', 'New Password',array('class'=>'control-label'))  !!}
			{!!  Form::password('newpas',array('class'=>'form-control','required'=>'true'))  !!}
		</div>
		<div class="form-group">
			{!!  Form::label('confpas', 'Confirm Password',array('class'=>'control-label'))  !!}
			{!!  Form::password('confpas',array('class'=>'form-control','required'=>'true'))  !!}
		</div>
	</div>
</div>
{!! Form::submit("Update",array('class'=>'btn btn-teal btn-block')
) !!}
{!! Form::close() !!}
@endsection
