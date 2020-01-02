@extends('app.user.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section ('styles')

     
<style type="text/css">

      button.accordion {
          background-color: lightblue;
          color: #444;
          cursor: pointer;
          padding: 18px;
          width: 100%;
          border: none;
          text-align: left;
          outline: none;
          font-size: 15px;
          transition: 0.4s;
      }

      button.accordion.active, button.accordion:hover {
          background-color: #ddd;
      }

      button.accordion:after {
          content: '\002B';
          color: #777;
          font-weight: bold;
          float: right;
          margin-left: 5px;
          margin-top: 8px;
      }

      button.accordion.active:after {
          content: "\2212";
      }

      div.description {
          padding: 0 18px;
          background-color: white;
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.2s ease-out;
      }

     

</style>
@parent 

 @stop
                             
{{-- Content --}}

@section('main')

@include('utils.vendor.flash.message')         

@include('utils.errors.list')   

<div class = "panel panel-primary">

    <div class="panel-heading">

        <div class="panel-heading-btn">
            
            
            
            

        </div>

                <h3 class = "panel-title"> {{trans('ticket.view_faq')}} </h3>

    </div>

        <div class = "panel-body">  

            <div class="invoice-content">
          

                  @foreach($ticket_faq as $data)

                      <button class="accordion active ">{{$data->faq}}</button> 
                     
                        <div class="description">{!!$data->description!!}</div>  

                  @endforeach 
          
    

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

<script type="text/javascript">   

        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].onclick = function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight){
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            } 
          }
        }

</script>
    
@endsection
   

