@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

@endsection

{{-- Content --}}
@section('main')
@include('utils.vendor.flash.message')
<div class="panel panel-flat" >
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">{{ trans('settings.settings') }}</h4>
                        </div>
                        <div class="panel-body"> 
                          <form id="settings" method = 'POST' action="{{URL::to('admin/themesettings')}}"> 
                        <input type="hidden" name="_token"  value="{{csrf_token()}}">                            
                        <legend>{{ trans('settings.theme_settings') }}</legend>
                        <div class="col-sm-6">                          
                                <fieldset>                                   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label  class="form-label" for="company_name">{{ trans('settings.select_theme') }}:</label>    
                                            </div>
                                            <div class="col-sm-8">
                                                 <input type="radio" name="theme" value="default" @if($theme == 'default')checked @endif> {{ trans('settings.default') }}
                                                 <br>
                                                 <br>
                                                 <input type="radio" name="theme" value="dark" @if($theme == 'dark')checked @endif>{{ trans('settings.big_dark') }}
                                            </div>
                                        </div>
                                    </div>

                           <div class="form-group" >
     		                <button type="submit" class="btn btn-primary">{{ trans('settings.apply') }}</button>
     	                   </div>
                                   
                                               



                                                                                                                                                 
                                </fieldset>
                                </div>
                             
                    </form>
                     <div class="form-group">
  {!! Form::open(array('route' => 'admin.upload', 'method' => 'POST', 'id' => 'my-dropzone', 'class' => 'form single-dropzone', 'files' => true)) !!}
        
  {!! Form::close() !!}


</div>



</div>



                                    </div> 
                                 </div>

                        


                                </div>
                    
                </div>
            </div>
                  

            
@endsection



@section('scripts') @parent

<script type="text/javascript">
	$(document).ready(function() {
		App.init();      
	});
</script>
<!--
<script type="text/javascript">
$(document).ready(function() {
 
 /*Dropzone.js Options - Upload an image via AJAX.*/
  Dropzone.options.myDropzone = {
    uploadMultiple: false,
    /* previewTemplate: '',*/
    addRemoveLinks: false,
    /* maxFiles: 1,*/
    dictDefaultMessage: '',
    init: function() {
     
      
      this.on("addedfile", function(file) {
        /*console.log('addedfile...');*/
        var r = confirm("Upload ?? ");
        if (r == true) {
            
          } else {
            exit;
          }
      });
      this.on("thumbnail", function(file, dataUrl) {
       /* console.log('thumbnail...');*/

        $('.dz-image-preview').hide();
        $('.dz-file-preview').hide();
      });
      this.on("success", function(file, res) {
        console.log('upload success...');
        $('#img-thumb').attr('src', res.path);
        $('input[name="pic_url"]').val(res.path);
      });
      
    }
  };
  var myDropzone = new Dropzone("#my-dropzone");
 
  $('#upload-submit').on('click', function(e) {

    e.preventDefault();
    /*trigger file upload select*/

    $("#my-dropzone").trigger('click');
  });
 
});
 
//*we want to manually init the dropzone.*/
Dropzone.autoDiscover = false;
</script>
-->
@endsection