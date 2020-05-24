@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')

@endsection
{{-- Content --}}
@section('main')
<div class="panel panel-flat" >
    <div class="panel-heading">
        
        <h4 class="panel-title">{{trans('currency.add_new_currency')}} </h4>
    </div>
    <div class="panel-body">
        @include('utils.errors.list')
        @include('flash::message')
        <form action="{{ url('admin/currency/add')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="row">
                <div class="form-group col-sm-12">
                    <label class="form-label col-sm-3">{{trans('currency.currency_name')}}</label>
                    <div class="col-sm-6">
                        
                        <input type="text" autocomplete="off" class="form-control " name="name" id="name" >
                        
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label class="form-label col-sm-3">{{trans('currency.currency_code')}}</label>
                    <div class="col-sm-6">
                        
                        <input type="text" autocomplete="off" class="form-control " name="code" id="code" >
                        
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label class="form-label col-sm-3">{{trans('currency.symbol')}}</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="off" class="form-control " name="symbol" id="symbol" >
                        
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label class="form-label col-sm-3">{{trans('currency.format')}}</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="off" class="form-control " name="format" id="format" >
                        
                        
                    </div>
                </div>
                
                
                <div class="form-group col-sm-12">
                    <label class="form-label col-sm-3">{{trans('currency.exchange_rate')}}</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="off" class="form-control " name="exchange_rate" id="exchange_rate" >
                        
                        
                    </div>
                </div>
                
                <div class="form-group col-sm-12">
                    <label class="form-label col-sm-3">{{trans('currency.active')}}</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="off" class="form-control " name="active" id="active" >
                        
                        
                    </div>
                </div>
                
            </div>
            
            <div class="form-group col-sm-offset-6">
                <button type="submit" class="btn btn-primary">{{trans('currency.add_currency')}} </button>
            </div>
        </form>
        
        
        
        
    </div>
</div>
<div class="panel panel-flat" >
    <div class="panel-heading">
        
        <h4 class="panel-title">{{trans('currency.currency_management')}} </h4>

        <div class="heading-elements"> 
<button id="enable" type="submit" class="btn btn-primary">{{trans('currency.enable_edit_mode')}}</button>
</div>

    </div>
    <div class="panel-body">
        <form id="settings">
            <table class="table table-striped">
                <thead>
                    <th>{{trans('currency.name')}}</th>
                    <th>{{trans('currency.code')}}</th>
                    <th>{{trans('currency.symbol')}} </th>
                    <th>{{trans('currency.format')}} </th>
                    <th>{{trans('currency.exchange_rate')}}</th>
                    <th>{{trans('currency.active')}}</th>
                    <th>{{trans('currency.action')}}</th>
                </thead>
                <tbody>
                    @foreach($settings as $item)
                
                    <tr>
                        <td>  <a class="currency" id="package{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter currency name' data-name="name">
                            
                            {{$item->name}}  </a>   @if($item->id == 1) <span>(Default)</span>   @endif </td>
                            <td> <a class="currency" id="amount{{$item->id}}" data-type='text' data-pk="{{$item->id}}" data-title='Enter currency code' data-name="code">
                                
                            {{$item->code}}  </a> </td>
                            

                            <td><a class="currency" id="{{$item->id}}" data-pk="{{$item->id}}" data-type='text' data-title='Enter symbol' data-name="symbol">
                                
                            {{$item->symbol}}</a> </td>

                            <td><a class="currency" id="{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title='Enter format' data-name="format">                            
                            {{$item->format}} </a> </td>

                            <td><a class="currency" id="{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title='Enter exchange rate' data-name="exchange_rate">
                            {{$item->exchange_rate}} </a> </td>                            
                            <td><a class="currency" id="{{$item->id}}"  data-pk="{{$item->id}}" data-type='text' data-title='Enter active' data-name="active">
                            {{$item->active}} </a> </td>
                            <td>
                                @if($item->id > 1)
                                <a href="{{url('admin/currency/delete/'.$item->id) }}" class="btn btn-danger">
                                    <i class="fa fa-trash" > </i> {{trans('currency.delete')}}
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                
                
            </form>
         
            
            
            
        </div>
    </div>
    
    
    @endsection
