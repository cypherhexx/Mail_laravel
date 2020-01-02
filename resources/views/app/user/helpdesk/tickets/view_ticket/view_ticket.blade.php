@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')@parent 

    <link href="{{ asset('assets/admin/css/plugins/main.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/plugins/jquery.tagit.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/plugins/jquery.ui.min.css') }}" rel="stylesheet">

    <link href="{{asset('assets/globals/plugins/choosen/css/chosen.css')}}" rel="stylesheet">

    <link href="{{asset('assets/user/files/css/fileinput.css')}}" rel="stylesheet">

    <link href="{{asset('assets/user/files/css/fileinput.min.css')}}" rel="stylesheet">


<style type="text/css">
</style>
 @stop
                             
{{-- Content --}}

@section('main')

@include('utils.vendor.flash.message')       

@include('utils.errors.list')

    <link href="{{ asset('assets/admin/css/plugins/main.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/plugins/jquery.tagit.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/plugins/jquery.ui.min.css') }}" rel="stylesheet">


<div class = "panel panel-primary">

  <div class="panel-heading">

    <div class="panel-heading-btn">
            
            
            
            
    </div>

     <h3 class = "panel-title">All Tickets</h3>

  </div>  
                        

<div class = "panel-body">
    
<form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/save_ticket') }}" enctype="multipart/form-data">

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">

       <label class="col-md-2 control-label">Select Ticket</label>

         <div class="col-md-12">

      <select name="ticket" id="ticket" class="form-control" required>    

           <option value="">Select</option>

          @foreach($ticket as $data)

           <option value="{{$data->id}}">{{$data->id}}</option> 

          @endforeach

      </select>

         
        </div>

    </div>


<div class="form-group">

  <label class="col-md-2 control-label"> Category </label> 

  <div class="col-md-12">

    <select name="category" class="form-control" id="category" required>

                        <option value="">Select</option>

                        @foreach($ticket_all as $data)

                        <option value="{{$data->id}}">{{$data->category}}</option> 

                        @endforeach
      </select>
 
  </div>

</div>


<div class="form-group">

       <label class="col-md-2 control-label"> Priority </label>

         <div class="col-md-12">

           <select name="priority" class="form-control" id="priority" required>

                        <option value="">Select</option>

                        @foreach($ticket_all as $data)

                        <option value="{{$data->id}}">{{$data->priority}}</option> 

                        @endforeach
      </select>

        </div>

    </div>


<div class="form-group">

<label class=" col-md-2 control-label" for="tags"> Tags </label> 

 <div class="col-md-12">
    
 <select data-placeholder="Choose Your Tags"  name="tags[]" id="ticket_tags" class=" col-sm-6 form-control chosen-select" multiple   data-parsley-mincheck="0" required  data-parsley-trigger="change" >
                                               
   @foreach($ticket as $tags_item)   

  <option {{ (in_array($tags_item->id,$ticket_tag)) ? 'selected' : '' }} value="{{$tags_item->id}}">{{$tags_item->tags}}</option>

   @endforeach                                         

 </select>

 {!! $errors->first('tags', '<label class="control-label required " for="tags">:message</label>')!!}

  </div>

</div>


    <div class="form-group">

       <label class="col-md-2 control-label"> Subject </label>

         <div class="col-md-12">

          <input type="text" class="form-control" id="subject" name="ticket_subject" required >

        </div>

    </div>

<div class="form-group">

    <label class="col-md-2 control-label">Description</label>

        <div class="col-md-12">

            <label class="control-label">{{ trans('mail.content') }}:</label>

                <div class="m-b-15">

        <textarea id="wysihtml5"  class="textarea form-control"  rows="12" required name="ticket_description"></textarea>
                                  
                </div>
        </div>

</div>

<div class="form-group">

    <div class="col-md-8 col-md-offset-2">

             <input id="input-711" name="savefile" type="file" multiple class="file-loading">

    </div>

</div>

    <div class="form-group">

        <div class="col-md-6 col-md-offset-2">

                <button class="btn btn-primary" type="submit">Submit Ticket</button>

        </div>

    </div>

</form>                    
                  
</div>

</div>

        @endsection              

{{-- Scripts --}}

@section('scripts')@parent


     <script src="{{ asset('assets/admin/js/plugins/dataTables/jquery.colorbox.js') }}"></script>

        <script src="{{ asset('assets/admin/js/tag-it.min.js')}}"></script>

          <script src="{{ asset('assets/admin/js/wysihtml5-0.3.0.js') }}"></script>

              <script src="{{ asset('assets/admin/js/bootstrap-wysihtml5.js') }}"></script>

                <script src="{{ asset('assets/admin/js/email-compose.demo.min.js') }}"></script>

                  <script src="{{ asset('assets/admin/js/wysihtml5-0.3.0.min.js')}}"></script> 

                      <script src="{{ asset('assets/admin/js/bootstrap-wysihtml5-0.0.3.min.js')}}"></script>

                <script src="{{asset('assets/globals/plugins/choosen/js/chosen.jquery.js')}}"></script>


                <script src="{{asset('assets/user/files/js/fileinput.js')}}"></script>

                <script src="{{asset('assets/user/files/js/fileinput.min.js')}}"></script>


    <script src="{{asset('assets/user/files/js/plugins/canvas-to-blob.js')}}"></script>

        <script src="{{asset('assets/user/files/js/plugins/canvas-to-blob.min.js')}}"></script>

          <script src="{{asset('assets/user/files/js/plugins/purify.js')}}"></script>

    <script src="{{asset('assets/user/files/js/plugins/purify.min.js')}}"></script>

        <script src="{{asset('assets/user/files/js/plugins/sortable.js')}}"></script>

<script src="{{asset('assets/user/files/js/plugins/sortable.min.js')}}"></script>


    <script type="text/javascript">          

                $(document).ready(function() {

                        App.init();    

                        EmailCompose.init();   
                       

                    });


    </script>


<script type="text/javascript">

      $("#input-711").fileinput({
          uploadUrl: "admin/save_ticket", 
          uploadAsync: true,
          maxFileCount: 5,
          showBrowse: false,
          browseOnZoneClick: true
      });
      
</script>


  <script type="text/javascript">
           

    var config = {

      '.chosen-select'           : {},

      '.chosen-select-deselect'  : {allow_single_deselect:true},

      '.chosen-select-no-single' : {disable_search_threshold:10},

      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},

      '.chosen-select-width'     : {width:"95%"}

    }

    for (var selector in config) {

      $(selector).chosen(config[selector]);

    }

    $.listen('parsley:field:validate', function () { 

    });

    $('#ticket_tags').parsley('addConstraint', {
        required: true 
    });

    $('body').on('change', '#ticket_tags', function(){
        if( !$("#ticket_tags").val() ) {

        $(this).closest('.form-group').addClass('has-error');
       
        }else{
        $(this).closest('.form-group').removeClass('has-error');
        }
    });

  </script>


<script type="text/javascript"> 

$('body').on('change', '#ticket', function(){


        $.ajax({

            type: "POST",

            url: "{{url('save_ticket')}}",

            data: { data: $(this).val() , _token: "{{csrf_token()}}"} , 

            success: function(data){

                $('#category').empty();

                $('#priority').empty();  

                $('#ticket_tags').empty(); 

                $('#subject').empty(); 

                $('#wysihtml5').empty(); 

                $('#input-711').empty(); 


                $('#category').append($('<option>').text("Select category").attr('value', ""));

                $('#priority').append($('<option>').text("Select priority").attr('value', ""));

                $('#ticket_tags').append($('<option>').text("Select tags").attr('value', ""));   

                $.each($.parseJSON(data), function(i, value) {

                    $('#category').append($('<option>').text(value['category']).attr('value', value['id']));


                });
            }

        });

    }); 

</script>


@stop