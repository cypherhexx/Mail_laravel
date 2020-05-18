@extends('app.admin.layouts.default')


@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

<link href="{{ asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css') }}" rel="stylesheet"/>

<link href="{{ asset('assets/admin/css/plugins/bootstrap-wysihtml5-0.0.3.css') }}" rel="stylesheet"/>


@endsection


@section('main')

<h1>Welcome to the Edit template page.</h1>
<form action="{{url('admin/savetemplate')}}" method="post" data-parsley-validate="true" name="form-wizard">
  <input type="hidden" name="_token" value="{{csrf_token()}}"> 
  <p></p>
  <input type="hidden" name="id" value="{{$template->id}}">
  <textarea id="bodyField" name="content">{!!$template->text!!}</textarea>
  <input type="submit" value="submit">
</form>

<h2>Table for Variables</h2>

<table class="table datatable-basic table-striped table-hover" id="templates-table">
    <thead>
        <tr>
            <th>
                No
            </th>
            <th>
                Mail_type
            </th>
            <th>
                Variable Name
            </th>
            <th>
                Comment
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach($variables as $key=> $variable)
        <tr>
          <th>
            {{$key + 1}}
          </th>
          <th>
            {{$variable->mail_type}}
          </th>
          <th>
            {{$variable->var_name}}
          </th>
          <th>
            {{$variable->comment}}
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