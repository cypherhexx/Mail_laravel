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
                  <h5 class="panel-title">{{trans('ticket_config.lead')}}</h5>
                  <div class="heading-elements">
                     <a  id="enable" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</a>
                          </div>
                </div>
                
                      
              


                        <div class="panel-body"> 

                          <form id="settings" >                             

                        <legend>{{trans('ticket_config.lead')}}</legend>



                        <table class="table table-hover">

                            <thead>

                                                    <th>{{trans('ticket_config.no')}}</th>





                                                



                                                   
                                                    <th>{{trans('ticket_config.username')}}</th>

                                                     <th>{{trans('ticket_config.name')}}</th>





                                                    <th>{{trans('ticket_config.email')}}</th>



                                                    <th>{{trans('ticket_config.mobile')}}</th>



                                                     <th>{{trans('ticket_config.created_at')}}</th>



                                                    <th>{{trans('ticket_config.status')}}</th>  



                                                    <th>{{trans('ticket_config.action')}}</th> 



                            </thead>

                            <tbody>

                                @foreach($data as $key=>$value)



                                <tr>

                                    <td> {{$key +1 }}</td>

                                  

                                    

                                     <td>

                                        {{$value->username}}
                                  
                                    </td> 
                                     <td>

                                        <a class="settings form-control" data-pk="{{$value->id}}" data-type='text' 

                                            id="name" data-url="{{url('admin/lead')}}" data-title='Enter name' data-name="name">

                                                 {{$value->name}}

                                        </a>

                                    </td> 


                                   

                                    <td>

                                        <a class="settings form-control" data-pk="{{$value->id}}" data-type='text' 

                                            id="email" data-url="{{url('admin/lead')}}" data-title='Enter Email ' data-name="email">

                                                 {{$value->email}}

                                        </a>

                                    </td>

                                    <td>

                                        <a class="settings form-control" data-pk="{{$value->id}}" data-type='text' 

                                            id="mobile" data-url="{{url('admin/lead')}}" data-title='Enter mobile' data-name="mobile">

                                                 {{$value->mobile}}

                                        </a>

                                    </td>

                                     <td>

                                  <!-- {{  date('Y-m-d',strtotime($value->created_at))}} -->
                                    {{$value->created_at->toFormattedDateString()}} 


                                     </td>

                                      <td>

                                                          
                                                            <a class="settings form-control" data-pk="{{$value->id}}" data-type='select' data-source="{{URL::to('admin/getstatus')}}" id="status" data-title='Enter status' data-name="status">



                                                                  
                                                                      @if($value->status == 0)
                                                                            pending
                                                                             
                                                                        @else
                                                                             complete
                                                                        @endif


                                                            </a>

                                                     </td>



                                                     <td>








                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal2{{$value->id}}">{{trans('ticket_config.delete')}}</a>
                           <!--  <a href="#" class="btn btn-danger" >data-toggle="modal" data-target="#myModal2{{$value->id}}">{{trans('ticket_config.delete')}}</a> -->
                        

                             <div class="modal fade" id="myModal2{{$value->id}}" role="dialog" >
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header ">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title text-danger">{{trans('ticket_config.delete')}}</h4>
                                      </div>                                    
                                          <div class="modal-body">
                                           <p>Username :{{$value->username}}    :::    {{$value->email}}</p>
                                           <input type="hidden" value="{{csrf_token() }}" name="_token">
                                           <input type="hidden" value="{{$value->id}}" name="requestid">
                                           <center> <h4> {{trans('ticket_config.Are_You_Sure_You_Want_To_Delete')}} <h4></center>
                                           </div>
                                          <div class="modal-footer">
                                          <a type="submit" href="{{URL::to('admin/deletelead/'.$value->id.'/delete')}}" class="btn btn-success" name="submit">{{trans('ticket_config.delete')}} </a>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('ticket_config.cancel')}}</button>
                                          </div>
                                 
                                  </div>
                                </div>

                             </div>


                            </td>

                              </tr>



                  
                                @endforeach



                            </tbody>    



                        </table>
                       {!! $data->render() !!}

                        

                        </form>



                  </div>
            </div>                  



            

@endsection







                           



                  



                            



                                                

                                                        

                                    

                              