@extends('app.admin.layouts.default')


@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

<link href="{{ asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css') }}" rel="stylesheet"/>

<link href="{{ asset('assets/admin/css/plugins/bootstrap-wysihtml5-0.0.3.css') }}" rel="stylesheet"/>


@endsection


@section('main')

<h1>Welcome to the Edit template page.</h1>
<form action="{{url('admin/welcomeemail')}}" method="post" data-parsley-validate="true" name="form-wizard">
 <input type="hidden" name="_token" value="{{csrf_token()}}"> 
  <p></p>
  <span>Subject: </span><input type="text" name="subject" value="">
  <textarea id="bodyField" name="content"></textarea>
  <input type="submit" value="submit">
</form>

<table class="table datatable-basic table-striped table-hover" id="templates-table">
    <thead>
        <tr>
            <th>
                No
            </th>
            <th>
                Mail_title
            </th>
            <th>
                Content
            </th>
            <th>
                Edit
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach($templates as $key=> $template)
        <tr>
          <th>
            {{$key + 1}}
          </th>
          <th>
            {{$template->subject}}
          </th>
          <th>
            {!!$template->text!!}
          </th>
          <th>
             <a  class="btn btn-sm btn-primary m-b-10" href="{{ URL::to('admin/edittemplate/'.$template->id) }}"><i class="icon-pencil4"></i></a>
            <a class="btn btn-sm btn-primary m-b-10" href="{{ URL::to('admin/deletetemplate/'.$template->id) }}"><i class="fa fa-trash"></i></a>
          </th>
        </tr>
      @endforeach
    </tbody>
</table>




@ckeditor('bodyField');

@endsection

@section('scripts') @parent
      <script src="{{ asset('assets/admin/js/welcome-settings-editable.js') }}"></script>
    @endsection 
<!-- <script type="text/javascript">
      window.onload = function () {
          
              var edt = CKEDITOR.replace('bodyField', { toolbar: 'Basic' });
CKFinder.setupCKEditor(edt, '/ckfinder/');

              var t = <%="how to set the data" %>;
              CKEDITOR.instances.editor1.setData(t);
              
}
<script type="text/javascript">

  CKEDITOR.instances['bodyField'].setData("how to start the email template");

</script> -->