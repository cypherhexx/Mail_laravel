@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

@endsection

{{-- Content --}}
@section('main')




<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">{{ trans('packages.plan_settings') }} </h4> 
<div class="heading-elements"> 
  <button id="enable-package-edit" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
</div>



                             


                        </div>
                        <div class="panel-body"> 
                          <form id="settings">  


                          <table class="table table-striped">
                            <thead> 
                                <th>{{ trans('packages.spot_plan_name') }} </th>
                                <th>{{ trans('packages.fee') }}</th>
                                <th>{{ trans('packages.level_percent') }}</th>
                           <!--      <th>{{ trans('packages.revenue_share_rs') }}</th>
                                <th>{{ trans('packages.binary_percentage') }} </th>                                
                                <th>{{ trans('packages.daily_pv_limit') }} </th> -->                                
                            </thead>
                            <tbody>
                                @foreach($settings as $item)

                                <tr>
                                    <td>  <a class="settings" id="package{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter  Spot plan name " data-name="package">
                                                
                                              {{$item->package}}  </a> </td>

                                    <td> <a class="settings" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter amount" data-name="amount">
                                                
                                             {{$item->amount}}  </a> </td>

                                    <td><a class="settings" id="level_percent{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter level percent" data-name="level_percent">
                                                
                                           {{$item->level_percent}} </a> </td>

                                  <!--   <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter  Revenue share (RS)" data-name="rs">
                                                
                                           {{$item->rs}} </a> </td>
                                    <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter  Serial Code  count" data-name="code">
                                                
                                           {{$item->code}} </a> </td>
                                     <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter  daily PV limit" data-name="daily_limit">
                                                
                                           {{$item->daily_limit}} </a> </td> -->

                                           
                                </tr> 


                                @endforeach
                                
                            </tbody>


                          </table>                           
                       
                    
                    </form>

                   
                        
                        
                       
                </div>
            </div>
                  

            
@endsection

