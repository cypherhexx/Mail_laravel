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
                                                <label for="">Joining Fee Referral (%):</label>
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
                                    <legend>{{trans('  B - Trading volume level Bonus plan')}}</legend>
                          <form id="settings">
                                             <legend>{{trans('Monthly-profits')}}</legend>

                                            <table class="table table-striped">
                            <thead> 
                                <th>{{ trans('Matrix') }} </th>
                                <th>{{ trans('Percent (%)') }}</th>
                                
                           <!--      <th>{{ trans('packages.revenue_share_rs') }}</th>
                                <th>{{ trans('packages.binary_percentage') }} </th>                                
                                <th>{{ trans('packages.daily_pv_limit') }} </th> -->                                
                            </thead>
                            <tbody>
                                @foreach($sett as $item)

                                <tr>
                                    <td>  <a class="settings" id="settings{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter  matrix level " data-name="package">
                                                
                                              {{$item->matrixlevel}}  </a> </td>

                                    

                                    <td><a class="settings" id="level_percent{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter level percent" data-name="level_percent">
                                                
                                           {{$item->percent}} </a> </td>

                                
                                           
                                </tr> 


                                @endforeach
                                
                            </tbody>


                          </table>                           
                                        </form>   
                                        </div>
                                    </div>  


                                  
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

                                 
                              

                              
          


                      <div class="panel panel-flat" >
                        <div class="panel-body"> 
                          <form id="settings">                             
                        <legend>{{trans('C-Extra bonus')}}</legend>
                                       
                                <fieldset>   


                                    <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Trader (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="trader" data-type='text' data-pk="{{$settings->id}}" data-title='trader' data-name="trader">
                                                 {{ $settings->trader}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   




                                   

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Star (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="star" data-type='text' data-pk="{{$settings->id}}" data-title='star' data-name="star">
                                                 {{ $settings->star}}
                                                </a>


                                            </div>
                                           
                                        </div>
                                    </div>   

                                      <div class="form-group">
                                         <div class="row">
                                            <div class="col-sm-6">
                                                <label for="">Superstar (%):</label>
                                            </div>
                                            <div class="col-sm-4">
                                                 <a class="settings form-control"  id="superstar" data-type='text' data-pk="{{$settings->id}}" data-title='superstar' data-name="superstar">
                                                 {{ $settings->superstar}}
                                                </a>


                                            </div>


                                            <br><br> <br><br> 

                                            <table class="table table-striped">
                            <thead> 
                                <th>{{ trans('Matrix') }} </th>
                                <th>{{ trans('Percent (%)') }}</th>
                                
                           <!--      <th>{{ trans('packages.revenue_share_rs') }}</th>
                                <th>{{ trans('packages.binary_percentage') }} </th>                                
                                <th>{{ trans('packages.daily_pv_limit') }} </th> -->                                
                            </thead>
                            <tbody>
                                @foreach($sett as $item)

                                <tr>
                                    <td>  <a class="settings" id="settings{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter  matrix level " data-name="package">
                                                
                                              {{$item->matrixlevel}}  </a> </td>

                                    

                                    <td><a class="settings" id="level_percent{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter level percent" data-name="level_percent">
                                                
                                           {{$item->cpercent}} </a> </td>

                                
                                           
                                </tr> 


                                @endforeach
                                
                            </tbody>


                          </table>                           
                                           
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



              

         
                  

            
@endsection

