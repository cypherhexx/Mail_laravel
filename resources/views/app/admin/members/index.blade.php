@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

@endsection

{{-- Content --}}
@section('main')




<div class="panel panel-flat" >
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">Member Management </h4> 

<div class="heading-elements"> 
  <button id="enable" type="submit" class="btn btn-primary">Enable edit mode</button> 
</div>


                             


                        </div>
                        <div class="panel-body"> 

                          @include('utils.errors.list')
                          @include('flash::message')


                        <form action="{{ url('admin/member/search')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="form-label col-sm-4">User Name</label>
                                <div class="col-sm-9">
                                   
                                        <input type="text" autocomplete="off" class="form-control datetimepicker hasDatepicker" name="user_name" id="user_name" >
                                       
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label col-sm-4">Email</label>
                                <div class="col-sm-9">
                                  
                                        <input type="text" autocomplete="off" class="form-control datetimepicker hasDatepicker" name="email" id="email" >
                                       
                                </div>
                            </div>

                             <div class="col-sm-4">
                                <label class="form-label col-sm-4">Name</label>
                                <div class="col-sm-9">                                   
                                        <input type="text" autocomplete="off" class="form-control datetimepicker hasDatepicker" name="name" id="name" >
                            
                                </div>
                            </div>
                        </div>
                        
                        <div class="btn col-sm-offset-4">
                            <button type="submit" class="btn btn-primary">Search Member </button>
                        </div>
                    </form>     
                       
                </div>
            </div>

            <div class="panel panel-flat" >
                        <div class="panel-heading">
                           
                            <h4 class="panel-title">Member management </h4> 
                        </div>
                        <div class="panel-body"> 
                          <form id="settings">  


                          <table class="table table-striped">
                            <thead> 
                                <th>Product</th>
                                <th>Size</th>
                                <th>Member amount (RM) </th>
                                <th>Non member mount (RM) </th>
                                <th> PV</th>
                                <th>Redemption PV</th>
                                <th>Action</th>

                            </thead>
                            <tbody>
                                @foreach($settings as $item)

                                <tr>
                                    <td>  <a class="settings" id="package{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter Products name' data-name="product">
                                                
                                              {{$item->product}}  </a> </td>
                                    <td> <a class="settings" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter Products size' data-name="size">
                                                
                                             {{$item->size}}  </a> </td>
                                    <td><a class="settings" id="pv{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter member amount' data-name="member_amount">
                                                
                                           {{$item->member_amount}} </a> </td>
                                    <td><a class="settings" id="stock_pv{{$item->id}}" data-pk="{{$item->id}}" data-type='text' data-title='Enter non member amont PV' data-name="stock_pv">
                                                
                                            {{$item->nonmember_amount}}</a> </td>
                                    <td><a class="settings" id="stock_products{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title='Enter PV' data-name="pv">
                                                
                                           {{$item->pv}} </a> </td>
                                   <td><a class="settings" id="stock_products{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title='Enter redemption PV' data-name="redeption_pv">
                                                
                                           {{$item->redeption_pv}} </a> </td>
                                 <td> <a href="{{url('admin/product/delete/'.$item->id) }}" class="btn btn-danger"> 
                                    <i class="fa fa-trash" > </i> Delete
                                  </a> </td>
                                </tr> 


                                @endforeach
                                
                            </tbody>


                          </table>                           
                       
                    
                    </form>

                   
                        
                        
                       
                </div>
            </div>
                  

            
@endsection
