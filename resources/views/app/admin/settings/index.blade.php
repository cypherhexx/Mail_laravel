
@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


{{-- Content --}}
@section('main')

<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">{{trans('settings.commission_settings')}}</h4>
<div class="heading-elements">
                            <button id="enable_settings" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
</div>


                            
                        </div>

                        <div class="panel-body"> 
                          <form id="settings">                             
                        <legend>{{trans('A-Matrix bonus')}}</legend>
                                       
                                <fieldset>   


                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Matrix Bonus (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="matrix" data-type='text' data-pk="{{$settings->id}}" data-title='matrix' data-name="matrix">
                                                 {{ $settings->matrix}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   




                                   

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Direct Referral (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="direct_referral" data-type='text' data-pk="{{$settings->id}}" data-title='Direct Referral' data-name="direct_referral">
                                                 {{ $settings->direct_referral}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Joining Fee:</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="joinfee" data-type='text' data-pk="{{$settings->id}}" data-title='Joining Fee' data-name="joinfee">
                                                 {{ $settings->joinfee}}
                                                </a>


                                           
                                           
                                        </div>
                                    </div>        

                                </fieldset>                            
                 
                     
                    </form>
                        
                        
                       
                </div>
              

          </div>


  

                                      <div class="panel panel-flat" >
                        



                  

                                   <div class="panel-body"> 
                          <form id="settings">                             
                        <legend>{{trans(' Withdraw Settings')}}</legend>

                         <fieldset>  

                                                               <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Withdraw Percent (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="withdraw_percent" data-type='text' data-pk="{{$settings->id}}" data-title='withdraw percent' data-name="withdraw_percent">
                                                 {{ $settings->withdraw_percent}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div> 

                                         <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Withdraw Period (days):</label>
                                            </div> 
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="withdraw_days" data-type='number' data-pk="{{$settings->id}}" data-title='Days' data-name="withdraw_days">
                                                 {{ $settings->withdraw_days}}
                                                </a>


                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>



</div><br><br>


                                  
                                    <!--   <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Three Friends (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="three_friends" data-type='text' data-pk="{{$settings->id}}" data-title='three friends' data-name="three_friends">
                                                 {{ $settings->three_friends}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>    -->
<!-- 
                                         <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Eight Friends (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="eight_friends" data-type='text' data-pk="{{$settings->id}}" data-title='eight friends' data-name="eight_friends">
                                                 {{ $settings->eight_friends}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   -->

                                 
                              

                              
<!--           <div class="panel panel-flat" >
    <div class="panel-heading">
      <h4 class="panel-title">
         <div class="heading-elements"> 
        <button id="enable_settings1" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button>
       
      </div>
    </div>
    <div class="panel-body"> 
        <form id="settings" method="post">  
        <table class="table table-striped">
          <thead> 
             <th>{{ trans('Category') }} </th>
             <th>{{ trans('Percentage') }} </th>
            
          </thead>
          <tbody>                
        @foreach($category as $item)
            <tr>
                <td>{{$item->category_name}}</td>   
                <td>  <a class="settings" id="settings{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="percentage" data-name="percentage">

                {{$item->percentage}}  </a> 
               </td>
                </tr> 
          @endforeach
          </tbody>
        </table>
      </form>
    </div>
  </div>
 -->

                   
                                 
                            <!--  <form id="settings">
                                             <legend>{{trans('C-Extra bonus')}}</legend>

                                            <table class="table table-striped">
                            <thead> 
                                <th>{{ trans('Category') }} </th>
                                <th>{{ trans('Percentage') }} </th>
                                                              
                            </thead>
                            <tbody>
                                @foreach($category as $item)

                                <tr>
                                    <td>  
                                  
                                              {{$item->category_name}} 
                                                </td>    
                                    <td>  <a class="settings" id="settings{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="percentage" data-name="percentage">
                                                
                                              {{$item->percentage}}  </a> </td>



                                   @endforeach
                               </tr>
                           </tbody>
                       </table>
                   </form>
      -->

                                <!-- <fieldset>    -->


                                    


                                   

                                     

                                    


                                            

                   <div class="panel panel-flat" >
                    <div class="panel-heading">
                      <h4 class="panel-title">
                         <div class="heading-elements"> 
                        <button id="enable_settings1" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button>
                       
                      </div>
                    </div>
                    <div class="panel-body"> 
                                                 
                        
                                 
                             <form id="settings1">
                                             <legend>{{trans('C-Extra bonus')}}</legend>

                                            <table class="table table-striped">
                            <thead>
                                 <th>{{ trans('Image') }} </th> 
                                <th>{{ trans('Category') }} </th>
                                 <th>{{ trans('Count') }} </th>
                                <th>{{ trans('Percentage') }} </th>
                               
                                <th>{{trans('Action')}}</th>
                                                              
                            </thead>
                            <tbody>
                                @foreach($category as $item)

                                <tr>
                                     <td><img src="{{ url('assets/uploads/'.$item->image) }}" style="width:100px;height:100px;"/>
                                                </td>   
                                    <td>  <a class="settings1" id="settings1{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="category_name" data-name="category_name">
                                  
                                              {{$item->category_name}} 
                                                </td>   
                                     <td>  <a class="settings1" id="settings1{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="count" data-name="count">
                                                
                                              {{$item->count}}  </a> </td>            
                                    <td>  <a class="settings1" id="settings1{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="percentage" data-name="percentage">
                                                
                                              {{$item->percentage}}  </a> </td>
                                      <td> 

                                </form>
                                    <button type="button" class="btn btn-info updateimage" data-userid="{{$item->id}}" data-toggle="modal" data-target="#myModal{{$item->id}}" >{{trans('update_image')}} </button>
                                     <div id="myModal{{$item->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            </div>
                            <div class="modal-body">
                           
                               <form action="{{url('admin/updatcategory_image')}}" method="POST"  enctype="multipart/form-data" >
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <input type="hidden" value="{{csrf_token() }}" name="_token">

                                <input type="hidden" value="{{$item->id}}" name="requestid" id="requestid">
                                  <div class="row">

                                    <div class="form-group">

                                        <label class="col-md-3 control-label">{{trans('select_image')}}:</label>

                                            <div class="col-sm-6 control-label"> 
                                              <input type="file" name="file">
                                                                               
                                            </div>

                                    </div>

                                  </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success" name="submit">{{trans('update')}}</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('close')}}</button>
                            </div>
                            </div>
                            </form>
                          </div>

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




           



              

         
                  

            
@endsection



