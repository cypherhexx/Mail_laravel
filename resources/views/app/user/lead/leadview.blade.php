



@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{$title}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
        
     <table class="table table-hover">
      <thead>
        <th>{{trans('lead.sl_no')}}</th>
        <th>{{trans('lead.name')}}</th>
        <th>{{trans('lead.email')}}</th>
        <th>{{trans('lead.mobile')}}</th>
        <th>{{trans('lead.created_at')}}</th>
        <th>{{trans('lead.status')}}</th>  
        <th>{{trans('lead.action')}}</th> 
      </thead>
      <tbody>
        @foreach($data as $key=>$value)
        <tr>
          <td> {{$key +1 }}</td>
          <td> {{$value->name}}</td> 
          <td>{{$value->email}}</td>
          <td>{{$value->mobile}}</td>
          <td>{{  date('Y-m-d',strtotime($value->created_at))}}</td>
          <td>@if($value->status == 0) pending  @else  complete @endif</td>
          <td>
              <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal2{{$value->id}}">{{trans('lead.delete')}} </a>
          </td>
        </tr>
      @endforeach
    </tbody>    
  </table>                    
  </div>
                  
@stop 
 


                                                

                                                        

                                    

                              