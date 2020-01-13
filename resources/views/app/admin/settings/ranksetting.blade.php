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
                          <form id="settings">                             
                        <legend>{{ trans('settings.rank_settings') }}</legend>

                        <table class="table table-hover">
                            <thead>
                                <th>{{ trans('settings.no') }}</th>
                                <th>{{ trans('settings.rank_name') }}</th>
                                <th>Rule 1(Min.users)</th>
                                <th>Rule 2(Min.users)</th>
                                <th>Rule 3(Min.users)</th>
                                <th>Rule 4(Min.users)</th>
                              
                               
                                <th>Gain</th>
                                <th>Level</th>

                              

                            </thead>
                            <tbody>
                                @foreach($settings as $key=>$rank)
                           
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="rank_name" data-title='Enter Rank name' data-name="rank_name">
                                                 {{$rank->rank_name}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_users1" data-title='Enter count of direct referrals' data-name="minimum_users1">
                                                 {{$rank->minimum_users1}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_users2" data-title='Enter count of  referrals' data-name="minimum_users2">
                                                 {{$rank->minimum_users2}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_users3" data-title='Enter count of  referrals' data-name="minimum_users3">
                                                 {{$rank->minimum_users3}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="minimum_users4" data-title='Enter count of  referrals' data-name="minimum_users4">
                                                 {{$rank->minimum_users4}}
                                        </a>
                                    </td>
                                   
                                      <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="gain" data-title='Enter gain percent' data-name="gain">
                                                 {{$rank->gain}}
                                        </a>
                                    </td>
                                      <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="tree_level" data-title='Enter levels' data-name="tree_level">
                                                 {{$rank->tree_level}}
                                        </a>
                                    </td>
                                    
                                </tr>
                                @endforeach

                            </tbody>    

                        </table>
                        
                        </form>

                        
                        
                     
                    
                </div>
            </div>
                  

            
@endsection



