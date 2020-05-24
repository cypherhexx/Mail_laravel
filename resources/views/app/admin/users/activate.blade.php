@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')


 @include('utils.errors.list')

 @include('flash::message')
  <div class="panel panel-flat" >
    <div class="panel-heading">
        <div class="panel-heading-btn">
            
            
            

            
        </div>
        <h4 class="panel-title">{{$title}}</h4>
    </div>
    <div class="container-fluid">
    </div>
    <div class="panel-body">
@if(isset($users) and count($users)>0)
      <table class="table table-stripped">
        <thead>
          <th> {{trans('users.username') }} </th>
          <th> {{trans('users.name') }} </th>
          <th> {{trans('users.email') }} </th>
          <th> {{trans('users.sponsor_username') }} </th>
          <th> {{trans('users.member_purchased_plan') }} </th>
          <th> {{trans('users.date_joined') }} </th>
          <th> {{trans('users.action') }} </th>
          
        </thead>
        <tbody>
          @foreach($users as $item)
           <tr>
             <td> {{ $item->username}}</td>             
             <td> {{ $item->name}} {{ $item->lastname}}</td>
             <td> {{ $item->email}}</td>
             <td> {{ $item->sponsors}}</td>
             <td> {{ $item->package}}</td>
             <td> {{ Date('d M Y',strtotime($item->created_at))}}</td>
             <td>
              <form action="{{ url('admin/users/'.$item->id.'/activate')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user" value="{{ $item->id }}">
                  <button type="submit"  class="btn btn-primary"> {{trans('users.mark_as_paid') }}  </button> 
              </form>                
             </td>
           </tr>
           @endforeach
        </tbody>
      </table>      
        {!! $users->render() !!}
      @else 
           {{trans('products.no_data_found')}} 
      @endif
    </div>
</div> 
@endsection

