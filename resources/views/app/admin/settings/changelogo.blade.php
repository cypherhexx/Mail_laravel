@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')
<link href="{{ asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css') }}" rel="stylesheet"/>
@endsection

{{-- Content --}}
<!--@section('main')

<div class="panel panel-flat" >
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">{{ trans('settings.rank_settings') }}</h4>
                        </div>
                        <div class="panel-body"> 
                          <form id="settings">                             
                        <legend>{{ trans('settings.rank_settings') }}</legend>

                        <table class="table table-hover">
                            <thead>
                                <th>{{ trans('settings.no') }}</th>
                                <th>{{ trans('settings.rank_name') }}</th>
                                <th>{{ trans('settings.top_up_count') }}</th>
                                <th>{{ trans('settings.downline_rank') }} </th>
                                <th>{{ trans('settings.downline_rank_count') }} </th>
                                <th>{{ trans('settings.rank_bonus') }} </th>

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
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' 
                                            id="top_up" data-title='Enter number of personal enrollies need to achieve this rank' data-name="top_up">
                                                 {{$rank->top_up}}
                                        </a>
                                    </td> 
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='select' 
                                            data-source="{{URL::to('admin/getallranks')}}"  id="quali_rank_id" data-title='Enter number of personal enrollies need to achieve this rank' data-name="quali_rank_id">
                                            @if($rank->quali_rank_id)
                                                 {{$settings[$rank->quali_rank_id - 1]->rank_name}}
                                            @else
                                                 NA
                                            @endif
                                                
                                        </a>
                                    </td>
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' 
                                            id="quali_rank_count" data-title='Enter number of ranks under them to achive this rank ' data-name="quali_rank_count">
                                                 {{$rank->quali_rank_count}}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="settings form-control" data-pk="{{$rank->id}}" data-type='text' 
                                            id="rank_bonus" data-title='Enter rank bonus ' data-name="rank_bonus">
                                                 {{$rank->rank_bonus}}
                                        </a>
                                    </td>
                                    
                                </tr>
                                @endforeach

                            </tbody>    

                        </table>
                        
                        </form>

                        <div class="row ">
                            <div class="col-sm-offset-4">
                                <button id="enable" class="btn btn-primary">{{ trans('settings.enable_edit_mode') }}</button>
                            </div>
                        </div>
                        
                        
                     
                    
                </div>
            </div>
                  

            
@endsection-->



@section('scripts') @parent

<script src="{{ asset('assets/globals/plugins/x-editables/js/bootstrap-editable.min.js') }}"></script><!-- jQuery vectormap-->
<script src="{{ asset('assets/admin/js/rank-settings-editable.js') }}"></script><!-- jQuery vectormap-->

   <script>
        $(document).ready(function() {
            App.init();           
        });
       

        
    </script>
    @endsection