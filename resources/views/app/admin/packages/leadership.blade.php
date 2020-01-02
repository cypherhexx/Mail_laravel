@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

@endsection

{{-- Content --}}
@section('main')




<div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">{{trans('packages.leadership_management')}}</h4> 


                           <div class="heading-elements"> 
                             <button id="enable" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
                           </div>


                        </div>
                        <div class="panel-body"> 
                          <form id="settings">  


                          <table class="table table-striped">
                            <thead> 
                                <th>{{trans('packages.position_title')}}</th>
                                
                                <th>{{trans('packages.week_limit')}}</th>
                                
                                <th>{{trans('packages.first_limit')}}</th>                                
                                <th>{{trans('packages.first_percent')}}</th>                                
                                <th>{{trans('packages.second_limit')}}</th>                                
                                <th>{{trans('packages.second_percent')}}</th>                                
                                <th>{{trans('packages.third_limit')}}</th>                                
                                <th>{{trans('packages.third_percent')}}</th>                                 
                            </thead>
                            <tbody>
                                @foreach($settings as $item)

                                <tr>
                                    <td>  {{$item->package}}  </td>

                                    <td> <a class="settings" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('packages.week_limit')}}" data-name="week_limit">
                                                
                                             {{$item->week_limit}}  </a> </td>

                                    <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('packages.first_limit')}}" data-name="first_limit">
                                                
                                           {{$item->first_limit}} </a> </td>
                                   <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('packages.first_percent')}}" data-name="first_percent">
                                                
                                           {{$item->first_percent}} </a> %</td>

                                  <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('packages.second_limit')}}" data-name="second_limit">
                                                
                                           {{$item->second_limit}} </a> </td>
                                  <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('packages.second_percent')}}" data-name="second_percent">
                                                
                                           {{$item->second_percent}} </a>% </td>

                                 <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('packages.third_limit')}}" data-name="third_limit">
                                                
                                           {{$item->third_limit}} </a> </td>

                                  <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="{{trans('packages.third_percent')}}" data-name="third_percent">
                                                
                                           {{$item->third_percent}} </a> %</td>


                                </tr> 
                                @endforeach                                
                            </tbody>
                         </table>                                               
                    </form>
                    
                        
                        
                       
                </div>
            </div>
                  

            
@endsection



@section('scripts') @parent
<script src="{{ asset('assets/admin/js/leadership-editable.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();           
        });
       

        
    </script>
    @endsection