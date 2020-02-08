@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')


 @include('utils.errors.list')

 @include('flash::message')


<div class="panel panel-border panel-primary" >

    <div class="panel-heading">      

        <h4 class="panel-title">Create news</h4>

    </div>

    <div class="panel-body">

    <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/create_news') }}">

        <input type="hidden" name="_token"  value="{{csrf_token()}}">       

  <div class="form-group">
                <label class="col-sm-2 control-label" for="amount">
                  Title:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-md-9">
                    <input class="form-control" id="title" name="title" type="text">
                    </input>
                </div>
            </div>

    <div class="form-group">

        <label class="col-md-2 control-label">Description</label>

        <div class="col-md-9">

            <label class="control-label">Content:</label>

                <div class="m-b-15">

                      <textarea name="description" class="summernote" required=""></textarea>
                                  
                </div>
        </div>

    </div> 

    <div class="form-group">

        <div class="col-md-6 col-md-offset-2">

                <button class="btn btn-primary" type="submit">Save</button>

        </div>

    </div>            
            
        </form>
        


    </div>
</div>


<div class="panel panel-border panel-primary" data-sortable-id="ui-widget-11">
    <div class="panel-heading">
        <h4 class="panel-title"> All News</h4>
    </div>
            <div class="panel-body">
                <form action="" method="">
 <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>News</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($create_news as $key=> $report)
                    <tr>
                        <td>{{$key +1 }}</td>

                        <td>{{$report->title}}</td>   

                        <td>{!! $report->description !!}</td>                     
                     
                    </tr>
                    @endforeach

                    @if(!count($create_news))

                        <tr><td>No data</td></tr>

                    @endif  

                </tbody>
            </table>
        </div>
       
    </div>

    </form>

  

    </div>

    </div>



@endsection
@section('scripts') @parent
   
      <script type="text/javascript"> 

    $(document).ready(function() {

            $('.summernote').summernote();
          
        });
</script>

    @endsection 

