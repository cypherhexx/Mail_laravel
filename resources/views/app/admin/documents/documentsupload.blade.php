@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{trans('ticket_config.file_upload')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
     <div class="panel-body">

    <form action="{{URL::to('admin/uploadfile')}}" enctype="multipart/form-data" method="post">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="user-edit-image-buttons" files="true">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">
                                    {{trans('ticket_config.doc_title')}} :
                                </label>
                                <div class="col-sm-6 control-label">
                                    <input class="form-control" id="name" name="title" required="" type="text">
                                     
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="form-group">
                                    <label class="col-md-3 control-label">{{trans('ticket_config.select_file')}} (doc,pdf,docx,ppt,pptx,png,jpeg,jpg files only): </label>
                                     <div class="col-sm-6 control-label">
                                    <input type="file" name="file" class="file-input" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary" data-remove-class="btn btn-light" data-fouc>
                                    </div>
                            </div>
                        </div>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                         
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                        </label>
                        <div class="col-sm-6 control-label">
                            <button class="btn btn-primary p-l-40 p-r-40" id="btn_submit" type="submit">
                                {{trans('ticket_config.upload')}}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div  class="table-responsive">
        <table class="table table-invoice">
            <thead>
                <tr>
                    <th>{{trans('ticket_config.no')}}</th>
                    <th>{{trans('ticket_config.file_title')}}</th>
                    <th>{{trans('ticket_config.name')}}</th>
                    <th>{{trans('ticket_config.download')}}</th>
                    <th>{{trans('ticket_config.created_at')}}</th>
                    <th>{{trans('ticket_config.action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($uploads as $key=> $request)
                <tr>
                    <td>{{$key +1 }}</td>
                    <td>{{$request->file_title}}</td>
                    <td>{{$request->name}}</td>
                    <td>
                        <a class="btn btn-success" href="{{url('admin/download/'.$request->name)}}" name="requestid">
                            {{trans('ticket_config.download')}}
                        </a>
                    </td>
                    <td>{{$request->created_at}}</td>
                    <td> <a class="btn btn-danger" href="{{url('admin/document/delete/'.$request->id)}}" name="requestid">
                            {{trans('ticket_config.delete')}}
                        </a></td>                          
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
  </div>
</div>
                  
@stop  