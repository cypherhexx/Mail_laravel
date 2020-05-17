@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')


 @include('utils.errors.list')

 @include('flash::message')


<div class="panel panel-border panel-primary" data-sortable-id="ui-widget-11">

    <div class="panel-heading">      

        <h4 class="panel-title">Edit News</h4>

    </div>

    <div class="panel-body">

    <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/updatenews') }}" enctype="multipart/form-data">

        <input type="hidden" name="_token"  value="{{csrf_token()}}">       



           <div class="form-group">
                <label class="col-sm-2 control-label" for="amount">
                  Title:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-md-9">
                    <input class="form-control" id="title" name="title" value="{{$edit_news[0]->title}}" type="text">
                    </input>
                </div>
            </div>


    <div class="form-group">

        <label class="col-md-2 control-label">Description</label>

        <div class="col-md-9">

            <label class="control-label">Content:</label>

                <div class="m-b-15">

               

                      <textarea name="description" class="summernote" required="">
                      {!!$edit_news[0]->description!!}
                      </textarea>
                          
                    <input type="hidden" name="id" value="{{$edit_news[0]->id}}">
                                  
                </div>
        </div>

    </div>  

   



    <div class="form-group">

        <div class="col-md-6 col-md-offset-2">

                <button class="btn btn-primary"  type="submit">Update News</button>

        </div>

    </div>     
          

          
            
        </form>
        
    </div>
</div>

@endsection
@section('scripts') @parent
   
  
    @endsection 

