@extends('app.user.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')@parent 

     
    <link href="{{ asset('assets/admin/css/plugins/main.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/plugins/jquery.tagit.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/plugins/jquery.ui.min.css') }}" rel="stylesheet">

    <link href="{{asset('assets/globals/plugins/choosen/css/chosen.css')}}" rel="stylesheet">

    <link href="{{asset('assets/user/files/css/fileinput.css')}}" rel="stylesheet">

    <link href="{{asset('assets/user/files/css/fileinput.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/user/css/wysiwyg-color.css')}}" rel="stylesheet">
    
    <link href="{{asset('assets/user/css/bootstrap-wysihtml5.css')}}" rel="stylesheet">

<style type="text/css">

</style>

 @stop
                             
{{-- Content --}}

@section('main')

@include('utils.vendor.flash.message')         

@include('utils.errors.list')   
 
<div class = "panel panel-primary">

<div class="panel-heading">

	<div class="panel-heading-btn">
            
            
            
            
    </div>

	 <h3 class = "panel-title">{{trans('ticket.create_new_ticket')}}</h3>

</div>


<div class = "panel-body">

<form class="form-horizontal" role="form" method="POST" action="{{ URL::to('user/save_ticket') }}" enctype="multipart/form-data">

<input type="hidden" name="_token" value="{{ csrf_token() }}">  

<div class="form-group">

  <label class="col-md-2 control-label"> {{trans('ticket.category')}} </label> 

	<div class="col-md-8">

	  <select name="category" class="form-control" required>

                        <option value="">{{trans('ticket.select')}}</option>

                        @foreach($category as $data)

                        <option value="{{$data->id}}">{{$data->category}}</option> 

                        @endforeach
      </select>
 
	</div>

</div>

<div class="form-group">

		<label class="col-md-2 control-label"> {{trans('ticket.priority')}} </label> 

			<div class="col-md-8"> 

 			<select name="priority" class="form-control" required>

                        <option value="">{{trans('ticket.select')}}</option>

                        @foreach($priority as $data)

                        <option value="{{$data->id}}">{{$data->priority}}</option> 

                        @endforeach
     			</select>            

  			</div>
</div>

<input type="hidden" name="status" value="{{$status}}">

<input type="hidden" name="id" value="{{$id}}">

<div class="form-group">

      <label class=" col-md-2 control-label" for="tags"> {{trans('ticket.tags')}} </label> 

           <div class="col-md-8">
		
 <select data-placeholder={{trans('ticket.choose_tags')}}  name="tags[]" id="ticket_tags" class=" col-sm-6 form-control chosen-select" multiple   data-parsley-mincheck="0" required  data-parsley-trigger="change" >
                                               
   @foreach($tags as $tags_item)   

  <option {{ (in_array($tags_item->id,$ticket_tag)) ? 'selected' : '' }} value="{{$tags_item->id}}">{{$tags_item->tags}}</option>

   @endforeach                                         

 </select>

 {!! $errors->first('tags', '<label class="control-label required " for="tags">:message</label>')!!}

	         </div>

</div>

  <div class="form-group">

       <label class="col-md-2 control-label"> {{trans('ticket.subject')}} </label>

         <div class="col-md-8">

          <input type="text" class="form-control" name="ticket_subject" required placeholder={{trans('ticket.pls_enter_subject')}}>

        </div>

    </div>

              
<div class="form-group">

    <label class="col-md-2 control-label">{{trans('ticket.description')}}</label>

        <div class="col-md-8">

            <label class="control-label">{{ trans('mail.content') }}:</label>

                <div class="m-b-15">

          <textarea id="wysihtml5"  class="textarea form-control"  rows="12" required name="ticket_description"></textarea>
                                  
        		</div>
        </div>

</div>

<div class="form-group">

        <div class="col-md-8 col-md-offset-2">

             <input id="input-711" name="savefile[]" type="file"  multiple class="file-loading" required>

        </div>

</div>
	
	<div class="form-group">

		<div class="col-md-6 col-md-offset-2">

				<button class="btn btn-primary" type="submit">{{trans('ticket.create_ticket')}}</button>

		</div>

	</div>

</form>

 </div>
</div>

 @endsection              

	@section('scripts') @parent

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



      <script type="text/javascript"> 
     
           $(document).ready(function() {

            App.init();             
	    EmailCompose.init();   
                 
        });
       
    </script>

	<script type="text/javascript">
	
		$("#input-711").fileinput({
		    uploadUrl: "{{ url('user/save_ticket') }}",
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
	
	    };
	
	    for (var selector in config) {
	
	      $(selector).chosen(config[selector]);
	
	    }
	
	   // $.listen('parsley:field:validate', function () { 
	
	   // });
	
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

 @endsection
   
    

   
