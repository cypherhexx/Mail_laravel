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
                                <th>Direct</th>
                                <th>Sub Direct1</th>
                                <th>Sub Direct2</th>
                                <th>Sub Direct3</th>
                                <th>Sub Direct4</th>
                                <th>Sub Direct5</th>
                                <th>Sub Direct6</th>
                                <th>Sub j Direct1</th>
                                <th>Sub j Direct2</th>
                                <th>Sub j Direct3</th>
                                <th>Sub j Direct4</th>
                                <th>Sub j Direct5</th> 
                                <th>Sub j Direct6</th>
                                <th>Gain</th>
                                <th>Level</th>

                              

                            </thead>
                            <tbody>
                                @foreach($settings as $rank)
                           
                                <tr>
                                    <td> {{$rank->id}}</td>
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' id="rank_name" data-title='Enter Rank name' data-name="rank_name">
                                                 {{$rank->rank_name}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="direct" data-title='Enter count of direct referrals' data-name="direct">
                                                 {{$rank->direct}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_direct1" data-title='Enter count of sub_direct1 referrals' data-name="sub_direct1">
                                                 {{$rank->sub_direct1}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_direct2" data-title='Enter count of sub_direct2 referrals' data-name="sub_direct2">
                                                 {{$rank->sub_direct2}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_direct3" data-title='Enter count of sub_direct3 referrals' data-name="sub_direct3">
                                                 {{$rank->sub_direct3}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_direct4" data-title='Enter count of sub_direct4 referrals' data-name="sub_direct4">
                                                 {{$rank->sub_direct4}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_direct5" data-title='Enter count of sub_direct5 referrals' data-name="sub_direct5">
                                                 {{$rank->sub_direct5}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_direct6" data-title='Enter count of sub_direct6 referrals' data-name="sub_direct6">
                                                 {{$rank->sub_direct6}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_junior_direct1" data-title='Enter count of sub_junior_direct1 referrals' data-name="sub_junior_direct1">
                                                 {{$rank->sub_junior_direct1}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_junior_direct2" data-title='Enter count of sub_junior_direct2 referrals' data-name="sub_junior_direct2">
                                                 {{$rank->sub_junior_direct2}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_junior_direct3" data-title='Enter count of sub_junior_direct3 referrals' data-name="sub_junior_direct3">
                                                 {{$rank->sub_junior_direct3}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_junior_direct4" data-title='Enter count of sub_junior_direct4 referrals' data-name="sub_junior_direct4">
                                                 {{$rank->sub_junior_direct4}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_junior_direct5" data-title='Enter count of sub_junior_direct5 referrals' data-name="sub_junior_direct5">
                                                 {{$rank->sub_junior_direct5}}
                                        </a>
                                    </td>
                                     <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='number' id="sub_junior_direct6" data-title='Enter count of sub_junior_direct6 referrals' data-name="sub_junior_direct6">
                                                 {{$rank->sub_junior_direct6}}
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



