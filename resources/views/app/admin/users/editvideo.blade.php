@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')


 @include('utils.errors.list')

 @include('flash::message')
<div class="panel" >

    <div class="panel-heading">      

        <h4 class="panel-title">Edit Video</h4>

    </div>

    <div class="panel-body">
             <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('admin/posteditvideo')}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
             <input type="hidden" name="id" value="{{$editvideo->id}}">
            
            <div class="form-group">
              <div class="row">
                
                <label class="col-sm-3">{{trans('users.title')}}</label>
                <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{$editvideo->title}}" />
                </div>
              </div>
            </div>  
                 <div class="form-group">
                <div class="row">
                    <div class="col-sm-3" >
                         <label class="form-label ">{{trans('packages.change_video')}}</label>
                    </div>
                    <div class="col-sm-9" >
                         <input type="text" name="videos" value="{{$editvideo->url}}" class="form-control name_list" />
                                   
                             
                        </div>
                    </div>
                </div>

           
           
            <div class="form-group">
                
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-sm btn-success">{{trans('users.save')}}</button>
                </div>
            </div>
            
        </form>
     
    </div>
    



    </div>

     

@endsection

