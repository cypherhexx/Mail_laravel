

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
        


         <div class="table-responsive">
         <table class="table table-stripped">
        <thead>
          <th>{{trans('products.package')}} </th>
          <th>{{trans('products.pv')}}</th>
          <th> {{trans('products.total_amount')}}</th>
          <th> {{trans('products.paid_by')}}</th>
          <th> {{trans('products.purchase_date')}}</th>  
          <th>
            Invoice
          </th>       
         
        </thead>

        <tbody>
          
          @foreach($data as $item)


           <tr>
             <td> {{ $item->package}}</td>
             <td> {{ $item->pv}}</td>
             <td> {{  round($item->total_amount,2)}} </td>
             <td> {{$item->pay_by }}</td>
             <td> {{ Date('d M Y',strtotime($item->created_at))}}</td>  
             <td>
               <a href="{{url('user/purchase/invoice/'.$item->id)}}" target="_blank" class="btn btn-primary">
                <i class="fa fa-file-word-o"></i>
              
              </a>
             </td>          
           </tr>

           @endforeach


        </tbody>
      </table>
    </div>



                        
  </div>
                  
@stop
 
 
 