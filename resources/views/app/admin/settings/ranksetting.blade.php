@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}
@section('main')

<div class="panel panel-flat"  style="overflow: auto;">
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">{{ trans('settings.rank_settings') }}</h4>
<div class="heading-elements">
                             <button id="enable-ranksettings-edit" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
</div>



                             
                        </div>
                        <div class="panel-body"> 
                          <div id="settings">                             
                        <legend>{{ trans('settings.rank_settings') }}</legend>

                        <table class="table table-hover">
                          <thead>
                           <th colspan="3"></th> 
                         
                            <th colspan="2">Rule 1</th> 
                            <th colspan="2">Rule 2</th> 
                            <!-- <th colspan="2">Rule 3</th> -->
                             </thead>


                            <thead>
                                <th>{{ trans('settings.no') }}</th>
                                 <th>{{trans('Image')}}</th>
                                <th>{{ trans('settings.rank_name') }}</th>
                                <!-- <th>Direct Referrals</th> -->
                              
                               <th>Min.Users</th>
                                <th>Referrals For Each</th>

                           <!-- 
                               <th>Min.Users</th>
                                <th>Referrals For Each</th> -->

                          
                               <th>Min.Users</th>
                                <th>Referrals For Each</th>

                              
                                <th>Gain</th>
                               
                              <th>{{trans('Action')}}</th>
                           

                              

                            </thead>
                                             <tbody>
                                @foreach($settings as $key=>$rank)
                         
                                <tr>
                                    <td> {{$key+1}}</td>

                                <td><img src="{{ url('assets/uploads/'.$rank->image) }}" style="width:100px;height:100px;"/></td>
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="rank_name" data-title='Enter Rank name' data-name="rank_name">
                                                 {{$rank->rank_name}}
                                        </a>
                                    </td>
                                   <!--  <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="direct_referral" data-title='Enter count of direct referrals' data-name="direct_referral">
                                                 {{$rank->direct_referral}}
                                        </a>
                                    </td> -->
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_direct_ref1" data-title='Enter count of direct referrals' data-name="minimum_direct_ref1">
                                                 {{$rank->minimum_direct_ref1}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_ref_for_each1" data-title='Enter referrals for each' data-name="minimum_ref_for_each1">
                                                 {{$rank->minimum_ref_for_each1}}
                                        </a>
                                    </td>
                               <!--       <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_direct_ref2" data-title='Enter count of  referrals' data-name="minimum_direct_ref2">
                                                 {{$rank->minimum_direct_ref2}}
                                        </a>
                                    </td>
                                      <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_ref_for_each2" data-title='Enter referrals for each' data-name="minimum_ref_for_each2">
                                                 {{$rank->minimum_ref_for_each2}}
                                        </a>
                                    </td> -->
                                         <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_direct_ref3" data-title='Enter count of  referrals' data-name="minimum_direct_ref3">
                                                 {{$rank->minimum_direct_ref3}}
                                        </a>
                                    </td>
                                      <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_ref_for_each3" data-title='Enter referrals for each' data-name="minimum_ref_for_each3">
                                                 {{$rank->minimum_ref_for_each3}}
                                        </a>
                                    </td>

                                   
                                      <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="gain" data-title='Enter gain percent' data-name="gain">
                                                 {{$rank->gain}}
                                        </a>
                                    </td>
                                    

               <td>  
          
                <button type="button" class="btn btn-info updateimage" data-userid="{{$rank->id}}" data-toggle="modal" data-target="#myModal{{$rank->id}}" >{{trans('update_image')}} </button>
           

                  <div id="myModal{{$rank->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            </div>
                            <div class="modal-body">
                           
                               <form action="{{url('admin/updatpackage_image')}}" method="POST"  enctype="multipart/form-data" >
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <input type="hidden" value="{{csrf_token() }}" name="_token">

                                <input type="hidden" value="{{$rank->id}}" name="requestid" id="requestid">
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
            </div>
                  

            
@endsection



