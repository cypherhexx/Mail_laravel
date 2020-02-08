@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')


 @include('utils.errors.list')

 @include('flash::message')
<div class="panel" >

    <div class="panel-heading">      

        <h4 class="panel-title">Create Videos</h4>

    </div>

    <div class="panel-body">
        <!-- @include('utils.errors.list') -->
     
        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('admin/postvideos')}}" onsubmit="return checkForm(this);">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            
            <div class="form-group">
              <div class="row">
                
                <label class="col-sm-3">{{trans('users.title')}}</label>
                <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="" />
                </div>
              </div>
            </div>  
                 <div class="form-group">
                <div class="row">
                    <div class="col-sm-3" >
                         <label class="form-label ">{{trans('packages.add_video')}}</label>
                    </div>
                    <div class="col-sm-9" >
                         <input type="text" name="videos" placeholder="add vimeo url . example : https://vimeo.com/63892510" class="form-control name_list" />
                                   
                             
                        </div>
                    </div>
                </div>

           
           
            <div class="form-group">
                
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" name="add_video" id="add_video" class="btn btn-sm btn-success">{{trans('users.add')}}</button>
                </div>
            </div>
            
        </form>
    </div>
    



    </div>

      @if(count($result) > 0)

<div class="panel">
    <div class="panel-heading">
        <h4 class="panel-title"> All Videos</h4>
    </div>
            <div class="panel-body">
         <div class="table-responsive">
           <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                    <th>Title</th>
                                                    <th>View</th>
                                                    <th>Created</th>
                                                    <th>Action</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($result as $key=>$video)
                                          

                                                <tr >

                                                   
                                                    <td>{{$video['title']}}</td>
                                                    <td>{!! $video['url'] !!}</td>
                                                   

                                                     <td>{{ date('d M Y',strtotime($video['created']))}}</td>
                                                     <td>
                                                   
                                         
                                                  <a href="{{url('admin/editvideo/'.$video['id'])}}"
                                                  class="btn btn-success"> <i class="icon-pencil3" aria-hidden="true"></i>
                                                 </a>
                                               
                                                   <a href="{{url('admin/videodelete/'.$video['id'])}}"  class="btn btn-danger" > <i class="fa fa-trash "></i>  </a>
                                                   
                        
                                                
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                             

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>
                                    </div>
                                    

                                  </div>
                              </div>
                                  @endif

@endsection

