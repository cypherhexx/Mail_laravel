@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')

@endsection

{{-- Content --}}
@section('main')




<div class="panel panel-flat" >
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">{{trans('products.add_new_product')}} </h4> 
                        </div>
                        <div class="panel-body"> 

                          @include('utils.errors.list')
                          @include('flash::message')


                        <form action="{{ url('admin/product/add')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="form-label col-sm-3">{{trans('products.product_name')}}</label>
                                <div class="col-sm-6">
                                   
                                        <input type="text" autocomplete="off" class="form-control  " name="name" id="name" >
                                       
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="form-label col-sm-3">{{trans('products.size')}}</label>
                                <div class="col-sm-6">
                                  
                                        <input type="text" autocomplete="off" class="form-control  " name="size" id="size" >
                                       
                                </div>
                            </div>

                             <div class="form-group col-sm-12">
                                <label class="form-label col-sm-3">{{trans('products.member_price')}}</label>
                                <div class="col-sm-6">                                   
                                        <input type="text" autocomplete="off" class="form-control  " name="member_prize" id="member_prize" >
                                       
                                   
                                </div>
                            </div>

                                 <div class="form-group col-sm-12">
                                <label class="form-label col-sm-3">{{trans('products.non_member_price')}}</label>
                                <div class="col-sm-6">                                  
                                        <input type="text" autocomplete="off" class="form-control  " name="non_member_prize" id="non_member_prize" >
                                       
                                    
                                </div>
                            </div>

                              <div class="form-group col-sm-12">
                                <label class="form-label col-sm-3">{{trans('products.pv')}}</label>
                                <div class="col-sm-6">                                  
                                        <input type="text" autocomplete="off" class="form-control  " name="pv" id="pv" >
                                       
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-offset-6">
                            <button type="submit" class="btn btn-primary">{{trans('products.add_product')}} </button>
                        </div>
                    </form>

                   
                        
                        
                       
                </div>
            </div>

<div class="panel panel-flat" >
                        <div class="panel-heading">
                            
                            <h4 class="panel-title">{{trans('products.products_management')}} </h4> 
                            <div class="heading-elements"> 
                            <button id="enable" type="submit" class="btn btn-primary">     {{trans('products.enable_edit_mode')}}</button> 
                            </div>


    


                        </div>
                        <div class="panel-body"> 
                          <form id="settings">  


                          <table class="table table-striped">
                            <thead> 
                                <th>{{trans('products.product')}}</th>
                                <th>{{trans('products.size')}}</th>
                                <th>{{trans('products.member_amount_rm')}} </th>
                                <th>{{trans('products.non_member_amount_rm')}} </th>
                                <th>{{trans('products.pv')}} </th>
                                <th>{{trans('products.action')}}</th>

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
                                    <td><a class="settings" id="nonmember_amount{{$item->id}}" data-pk="{{$item->id}}" data-type='text' data-title='Enter non member amount' data-name="nonmember_amount">
                                                
                                            {{$item->nonmember_amount}}</a> </td>
                                    <td><a class="settings" id="stock_products{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title='Enter bonus' data-name="pv">
                                                
                                           {{$item->pv}} </a> </td>
                                   
                                    

                                 <td> <a href="{{url('admin/product/delete/'.$item->id) }}" class="btn btn-danger"> 
                                    <i class="fa fa-trash" > </i> {{trans('products.delete')}}
                                  </a> </td>
                                </tr> 


                                @endforeach
                                
                            </tbody>


                          </table>                           
                       
                    
                    </form>

                        
                        
                       
                </div>
            </div>
                  

            
@endsection



@section('scripts') @parent
<script src="{{ asset('assets/admin/js/product-editable.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();           
        });
       

        
    </script>
    @endsection