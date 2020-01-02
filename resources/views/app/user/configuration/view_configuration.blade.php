@extends('app.user.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ trans('site/user.register') }}} :: @parent @stop

@section('styles')@parent 

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

      <h3 class = "panel-title"> {{trans('ticket.view_config')}}</h3>

    </div>

<div class = "panel-body">
  <div class="invoice-content">
    <ul class="nav nav-tabs" id="myTab">
      <li class="col-md-3 active"><a data-toggle="tab" href="#ticket_categories">{{trans('ticket.category')}}</a></li>
      <li  class="col-md-3"><a data-toggle="tab" href="#ticket_tags">{{trans('ticket.tags')}}</a></li>
      <li  class="col-md-3"><a data-toggle="tab" href="#ticket_statuses" >{{trans('ticket.status')}}</a></li>
      <li  class="col-md-3"><a data-toggle="tab" href="#ticket_priority" >{{trans('ticket.priority')}}</a></li>
    </ul>

<div class="tab-content">       

 <!-- Category   -->

 <div id="ticket_categories" class="tab-pane active" >  

  <form id="category">  

   <div class="tab-content panel panel-default panel-block">                            

                <table class="table table-invoice">

                  <thead>

                            <tr>

                                <th>{{trans('ticket.category')}}</th>

                         

  <td>

         </td>  

       </tr>
   
    </thead>

                                          

                                          
      <tbody>  

                                 
                 
              @foreach($ticket_categories as $data)

                    <tr>   

                        <td>

            <a class="category"  data-type='text' data-url='save_ticket_categories' data-pk="{{$data->id}}" data-title="Enter category" data-name="category_level">{{$data->category}} </a>

                </td> 

                    <td>

        
          
                    </td>

                 </tr>

                            @endforeach               
                      

                    @if(!count($ticket_categories))

                           <tr><td>{{trans('ticket.no_data')}}</td></tr>

                    @endif                

                  

                          </tbody>  

                     </table> 


    

        </div>  

         </form>

          </div>




                                
                   
<!--  Tags   -->

<div id="ticket_tags" class="tab-pane fade" >

  <form id="tags">  

    <div class="tab-content panel panel-default panel-block">         

      <table class="table table-invoice">

        <thead>

          <tr>

                      <th>{{trans('ticket.tags')}}</th>                       

            <td>  
                                                  
            </td>

          </tr>
             
        </thead>                                                          

        <tbody>  

                                           
                 
                @foreach($ticket_tags as $data)

              <tr>   

              <td><a class="tags" data-type='text' data-url='save_ticket_tags' data-pk="{{$data->id}}" data-title="Enter tags" data-name="tags_level">{{$data->tags}} </a></td> 

                     
                    <td>                 
              

                   </td>

                </tr>

                      @endforeach  

                          

                       @if(!count($ticket_tags))

                            <tr><td>{{trans('ticket.no_data')}} </td></tr>

                       @endif


               

        </tbody>                       

      </table>

    
    </div>

   </form>
     
   </div>       


<!--  Status   -->

<div id="ticket_statuses" class="tab-pane fade" >  

  <form id="status">     

    <div class="tab-content panel panel-default panel-block">     

      <table class="table table-invoice">

       <thead>

        <tr>

            <th>{{trans('ticket.status')}}</th>

           

              <td>
                    
         </td>

      </tr>
   
   </thead>

                              

          <tbody>  

                                            
                 
              @foreach($ticket_statuses as $data)

                <tr>   

          <td><a class="status" data-type='text' data-url='save_ticket_status' data-pk="{{$data->id}}" data-title="Enter status" data-name="status_level">{{$data->status}} </a></td> 

                     
                <td>           

          
                    </td>

                    </tr>

                      @endforeach  

                     

                          @if(!count($ticket_statuses))

                            <tr><td>{{trans('ticket.no_data')}} </td></tr>

                          @endif


                          </tbody>      

                      </table>  

         </div>          

             </form>  

               </div>              

<!--  Priority   -->

<div id="ticket_priority" class="tab-pane fade">

  <form id="priority">   

    <div class="tab-content panel panel-default panel-block">      

        <table class="table table-invoice">

        <thead>

          <tr>

              <th>{{trans('ticket.priority')}}</th>           

              <td> 

           </td>

        </tr>
   
      </thead>                  

   <tbody>  

                                                      
                 
              @foreach($ticket_priority as $data)

                <tr>   

             <td><a class="priority" data-type='text' data-url='save_ticket_priority' data-pk="{{$data->id}}" data-title="Enter priority" data-name="priority_level">{{$data->priority}} </a></td> 

                     
                  <td>

           
          
                    </td>

                  </tr>

                      @endforeach  
                   

                    @if(!count($ticket_priority))

                    <tr><td>{{trans('ticket.no_data')}} </td></tr>

                    @endif

                     

                        </tbody> 

                   </table>

              </div>       

            </form>  

           </div>  

        </div>  


        </div>

        </div>

        </div>


                @endsection


                 
@section('scripts') @parent


   <script type="text/javascript">

        $(document).ready(function(){
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('#myTab a[href="' + activeTab + '"]').tab('show');
            }
        });
</script>


      <script type="text/javascript"> 
     
           $(document).ready(function() {
            App.init();           
        });
       
    </script>
    
 @endsection



