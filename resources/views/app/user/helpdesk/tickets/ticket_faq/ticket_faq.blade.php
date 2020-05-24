@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')@parent 

      <link href="{{ asset('assets/admin/css/plugins/main.css') }}" rel="stylesheet">

          <link href="{{ asset('assets/admin/css/plugins/jquery.tagit.css') }}" rel="stylesheet">

          <link href="{{ asset('assets/admin/css/plugins/jquery.ui.min.css') }}" rel="stylesheet">

       <link href="{{ asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css') }}" rel="stylesheet"/>

  <style type="text/css">

 
  </style>
 @stop
                             
{{-- Content --}}

@section('main')

@include('utils.vendor.flash.message')         

@include('utils.errors.list')   

<!-- <div class="container">   -->


    <div class = "panel panel-primary">

    <div class="panel-heading">

        <div class="panel-heading-btn">
            
            
            
            

        </div>

                <h3 class = "panel-title"> {{trans('ticket_details.ticket_faq')}} </h3>
                <div class="heading-elements"> 
                  <div id="faq_enable" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</div>                   
                </div>


    </div>

        <div class = "panel-body">  

            <div class="invoice-content">



            <ul class="nav nav-tabs" id="myTab">

                  <li class="col-md-6 active"><a data-toggle="tab" href="#faqs">{{trans('ticket_details.view_all')}}</a></li>

                  <li  class="col-md-6"><a data-toggle="tab" href="#create">{{trans('ticket_details.create_new')}}</a></li>

            </ul>

<div class="tab-content">

<!--View All-->

<div id="faqs" class="tab-pane active">

  <form id="faq">        

    <div class="tab-content panel panel-default panel-block">

        <table class="table table-invoice">

          <thead>

                <tr>

                        <th>{{trans('ticket_details.faqs')}}</th>
                        <th>{{trans('ticket_details.description')}}</th>
                        <th>{{trans('ticket_details.action')}}</th>

                </tr>
   
          </thead>

                  

  <tbody>                                                     
                 
            @foreach($ticket_faq as $data)

  <tr>  
     <td>
  
       <a class="faq" data-type='text' data-url='update_ticket_faq' data-pk="{{$data->id}}" data-title="Enter faq" data-name="faq_level"> {{$data->faq}} </a>  
     
     </td>
  <td>

   
 <a class="faq" data-type="wysihtml5" data-pk="{{$data->id}}" data-url='update_ticket_faq' data-name="description_level" name="message">{!!$data->description!!}</a>

  </td>                     
 <td>
                  
      <a class="btn btn-danger" onclick="return confirm('Are you Sure you want to do this Action!'); style.backgroundColor='#84DFC1';" href="delete_ticket_faq/{{$data->id}}">{{trans('ticket_details.delete')}}</a>
          
    </td>
 </tr>

            @endforeach                   

                              @if(!count($ticket_faq))

                               <tr><td>{{trans('ticket_config.no_data_found')}} </td></tr>

                              @endif
                   
             </tbody> 

        </table>

            

       </div>   

    </form>

  </div>

<!--End of View All -->

<!-- Create New-->


  <div id="create" class="tab-pane fade">

    <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('admin/save_ticket_faq') }}" id="form1">

      <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-sm-12">

          <div class="form-group">

            <label class="col-md-2 control-label">{{trans('ticket_details.ticket_faq')}}</label>

              <div class="col-md-10">

                <input type="text" class="form-control" name="faq" required>

          </div>

       </div>

    </div>
                      <label class="col-md-2 control-label">{{trans('ticket_details.ticket_faq')}}</label>

                          <div class="col-md-10">

                             <label class="control-label">{{ trans('mail.content') }}:</label>

                                <div class="m-b-15">

                                    <textarea id="wysihtml5"  class="textarea form-control"  rows="12" required name="message"></textarea>
                                   
                                </div>
                           </div>
                                  

      <div class="form-group">

          <div class="col-sm-4 control-label">

              <button type="submit" class="btn btn-primary"> {{trans('ticket_details.add_faq')}} </button>

         </div>

       </div> 

     </form> 

    </div>

<!--End of Create New -->

      </div>

    </div>

  </div>

</div>
               
  


    @endsection              

{{-- Scripts --}}

@section('scripts')@parent

  
   <script src="{{ asset('assets/admin/js/ticket-faq.js') }}"></script>

     <script src="{{ asset('assets/admin/js/plugins/dataTables/jquery.colorbox.js') }}"></script>

        <script src="{{ asset('assets/admin/js/tag-it.min.js')}}"></script>

          <script src="{{ asset('assets/admin/js/wysihtml5-0.3.0.js') }}"></script>

              <script src="{{ asset('assets/admin/js/bootstrap-wysihtml5.js') }}"></script>

                      <script src="{{ asset('assets/admin/js/email-compose.demo.min.js') }}"></script>

              <script src="{{ asset('assets/admin/js/bootstrap-editable.js') }}"></script>

          <script src="{{ asset('assets/globals/plugins/x-editables/js/bootstrap-editable.js') }}"></script>

      <script src="{{ asset('assets/globals/plugins/x-editables/js/bootstrap-editable.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/wysihtml5-0.3.0.min.js')}}"></script> 

  <script src="{{ asset('assets/admin/js/bootstrap-wysihtml5-0.0.3.min.js')}}"></script>  

<script src="{{ asset('assets/admin/js/wysihtml5-0.0.3.js')}}"></script>  

   
<script type="text/javascript">          

    $(document).ready(function() {

            App.init();    

            EmailCompose.init();   
           

        });


</script>

  <script type="text/javascript">

      $(document).ready(function() {

        if (location.hash) {

            $("a[href='" + location.hash + "']").tab("show");
        }

        $(document.body).on("click", "a[data-toggle]", function(event) {

            location.hash = this.getAttribute("href");

        });

      });

    $(window).on("myTab", function() {

        var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");

        $("a[href='" + anchor + "']").tab("show");

      });

  </script>

<script type="text/javascript">
    $(document).ready(
        function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.faq').editable({
                validate: function(value) {
                    if($.trim(value) == '')
                        return 'Value is required.';
                },
                type: 'wysihtml5',
                title: 'Edit Comment',
                placement: 'top',
                send:'always',
                ajaxOptions: {
                    dataType: 'json',
                    type: 'post'
                }
            });
        }
    );
</script>


    
@stop
