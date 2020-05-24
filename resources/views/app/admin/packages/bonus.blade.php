@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


{{-- Content --}}
@section('main')




<div class="panel panel-flat" >
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">{{trans('packages.leadership_management')}}</h4> 

                            

                             <div class="heading-elements"> 
  <button id="leadership" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
</div>


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
                    
                        
                        
                       
                </div>
            </div>






<div class="panel panel-flat" >
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">{{trans('packages.matching_bonus')}}</h4> 
<div class="heading-elements"> 
  <button id="matching-enable" type="submit" class="btn btn-primary">{{trans('packages.enable_edit_mode')}}</button> 
</div>




                                 


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

                        
                        
                       
                </div>
            </div>            
@endsection
