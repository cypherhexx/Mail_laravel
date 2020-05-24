@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')
<link href="{{ asset('assets/globals/plugins/x-editables/css/bootstrap-editable.css') }}" rel="stylesheet"/>
@endsection

{{-- Content --}}
@section('main')<!-- 

<div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">Bonus settings </h4> 
                        </div>
                        <div class="panel-body"> 
                          <form id="settings">  


                          <table class="table table-striped">
                            <thead> 
                                <th>Bonus title</th>
                                <th>Bonus %</th>
                              <th>{{trans('packages.direct_sponosr_bonus_level_2')}}</th> --
                                

                            </thead>
                            <tbody>
                                <tr>
                                    <td>Direct Sponsor</td>
                                    <td>
                                      <a class="directrefer" id="amount{{$item->id}}" data-type='text' data-pk="1" data-title="Enter" data-name="sponsor_Commisions">
                                      {{$item->sponsor_Commisions}}
                                    </a>
                                  </td>
                                </tr> 
                                <tr>
                                    <td>Matching Bonus</td>
                                    <td>
                                      <a class="directrefer" id="amount{{$item->id}}" data-type='text' data-pk="1" data-title="" data-name="pair_amount">
                                      {{$item->pair_amount}}
                                    </a>
                                  </td>
                                </tr>
                                
                            </tbody>


                          </table>                           
                       
                    
                    </form>

                    <div class="form-group">
                     <label class="control-label col-md-4 col-sm-4"> </label> 
                         <div class="col-md-6 col-sm-6">
                          <button id="enable" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
                      </div> 
                  </div>
                        
                        
                       
                </div>
            </div> -->











<div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">{{trans('packages.leadership_management')}}</h4> 
                        </div>
                        <div class="panel-body"> 
                          <form id="leadership-form">  


                          <table class="table table-striped">
                            <thead> 
                                                               
                                <th>{{trans('packages.package')}}</th>                                 
                                <th>{{trans('packages.level_1')}}</th>                                 
                                <th>{{trans('packages.level_2')}}</th>                                 
                                <th>{{trans('packages.level_3')}}</th>                                 
                            </thead>
                            <tbody>
                                @foreach($settings as $item)

                                <tr>
                                    <td>  {{$item->package}}  </td>

                                    <td> <a class="leadership" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter level 1" data-name="level_1">
                                                
                                             {{$item->level_1}}  </a> </td>

                                    <td><a class="leadership" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter level 2" data-name="level_2">
                                                
                                           {{$item->level_2}} </a> </td>
                                   <td><a class="leadership" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter level 3" data-name="level_3">
                                                
                                           {{$item->level_3}} </a></td>


                                </tr> 
                                @endforeach                                
                            </tbody>
                         </table>                                               
                    </form>
                    <div class="form-group">
                     <label class="control-label col-md-4 col-sm-4"> </label> 
                         <div class="col-md-6 col-sm-6">
                          <button id="leadership" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
                      </div> 
                  </div>
                        
                        
                       
                </div>
            </div>



<div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">{{trans('packages.direct_sponsor_bonus')}} </h4> 
                        </div>
                        <div class="panel-body"> 
                          <form id="settings">  


                          <table class="table table-striped">
                            <thead> 
                                <th>{{trans('packages.position_title')}}</th>
                                <th>{{trans('packages.sponsor_pv')}}%</th>
                                <th>{{trans('packages.sponsor_rs')}}</th>
                                

                            </thead>
                            <tbody>
                                @foreach($direct_sponsor as $item)

                                <tr>
                                    <td>  
                                              {{$item->package}} </td>
                                    <td>
                                        <a class="directrefer" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter direct sonsor PV " data-name="pv">
                                                
                                             {{$item->pv}}  </a>
                                      </td>
                                      <td>
                                        <a class="directrefer" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter direct sonsor RS" data-name="rs">
                                                
                                             {{$item->rs}}  </a>
                                      </td>
                                    
                                </tr> 


                                @endforeach
                                
                            </tbody>


                          </table>                           
                       
                    
                    </form>

                    <div class="form-group">
                     <label class="control-label col-md-4 col-sm-4"> </label> 
                         <div class="col-md-6 col-sm-6">
                          <button id="enable" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
                      </div> 
                  </div>
                        
                        
                       
                </div>
            </div>


<div class="panel panel-success" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">{{trans('packages.matching_bonus')}}</h4> 
                        </div>
                        <div class="panel-body"> 
                          <form id="matching">  


                          <table class="table table-striped">
                            <thead> 
                                <th>{{trans('packages.position_title')}}</th>
                                <th> PV %</th>
                                <!-- <th>Sponsor RS</th> -->
                                

                            </thead>
                            <tbody>
                                @foreach($matching_bonus as $item)

                                <tr>
                                    <td>  
                                              {{$item->package}} </td>
                                    <td>
                                        <a class="matching" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title="Enter matching bonus PV %" data-name="pv">
                                                
                                             {{$item->pv}}  </a>
                                      </td>
                                     
                                      </td>
                                    
                                </tr> 


                                @endforeach
                                
                            </tbody>


                          </table>                           
                       
                    
                    </form>

                    <div class="form-group">
                     <label class="control-label col-md-4 col-sm-4"> </label> 
                         <div class="col-md-6 col-sm-6">
                          <button id="matching-enable" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
                      </div> 
                  </div>
                        
                        
                       
                </div>
            </div>


                  

            
@endsection



@section('scripts') @parent
<script src="{{ asset('assets/admin/js/directrefer-editable.js') }}"></script>
<script src="{{ asset('assets/admin/js/leadership-editable.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();           
        });
       

        
    </script>
    @endsection