@extends('app.admin.layouts.default')







{{-- Web site Title --}}



@section('title') {{{ $title }}} :: @parent @stop







{{-- Content --}}



@section('main')







 @include('flash::message')

     



  <div class="panel panel-flat" >



    <div class="panel-heading">






        <h4 class="panel-title">{{$title}}</h4>



    </div>

    <div class="container-fluid">

        <div class="row">

        <form class="col-sm-10 col-sm-offset-1" method="post"

  action="{{ URL::to('admin/purchase-history') }}"

  autocomplete="off">

  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  

            <div class="form-group">

            {!!  Form::label('user', 'Select User',array('class'=>'control-label'))  !!}  

            <input type="text" name="user" id="username" class ="form-control" required>

            </div>

        {!! Form::submit('submit',array('class'=>'btn btn-primary m-r-5')) !!}         

        </form>

        </div>

    </div>

    <div class="panel-body">

@if(isset($data) and count($data)>0)

      <table class="table table-stripped">

        <thead>

          <th>{{trans('products.product')}} </th>
          <th>{{trans('products.username')}} </th>

          <th>{{trans('products.number_of_products')}} </th>

          <!-- <th> Product amount</th> -->

          <th>{{trans('products.pv')}} </th>
          <th>{{trans('products.total_amount')}} </th>

          <th> {{trans('products.purchase_date')}}</th>

          <th> {{trans('products.paid_by')}}</th>

          <th> {{trans('products.purchase_status')}}</th>

          <th> {{trans('products.action')}}</th>
         

        </thead>



        <tbody>

          @foreach($data as $item)

           <tr>

             <td> {{ $item->product}}</td>
             
             <td> {{ $item->username}}</td>

             <td> {{ $item->count}}</td>

             <!-- <td> {{ $item->member_amount}}</td> -->

             <td> {{ $item->BV}}</td>
             <td> {{ $item->total_amount}}</td>

             <td> {{ Date('d M Y',strtotime($item->created_at))}}</td>

             <td> @if($item->pay_by == 'credits')

                {{trans('products.by_product_credits')}}

              @elseif($item->pay_by  == 'redeem')
                {{trans('products.by_credit_points')}}
              @else
                  {{trans('products.pay_by_cash')}}  
              @endif</td>

             <td> {{ $item->status}}</td> 

             <td>
             <div class="col-sm-12">
               <!--  <div class="col-sm-4">
                  <button class="btn btn-warning">Edit</button>                  
                </div> -->
                @if($item->status != 'approved')
                  <div class="col-sm-6">
                    <a href="{{ url('admin/purchase-history/'.$item->id.'/confirm')}}" class="btn btn-primary">{{trans('products.paid')}}</a>                    
                  </div>

                   <div class="col-sm-6">                  
                    <a class="btn btn-danger" href="{{ url('admin/purchase-history/'.$item->id.'/delete')}}">{{trans('products.delete')}}</a>                  
                </div> 
                
                 @endif

                            
             </div>
             </td>
           </tr>



           @endforeach





           



 

        </tbody>


      </table>
      
        {!! $data->render() !!}

      @else 

           {{trans('products.no_data_found')}} 



@endif







    </div>



</div> 



           







       



  



@endsection



@section('scripts') @parent











@stop











@section('scripts') @parent 



<script src="{{ asset('assets/admin/js/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>



<script src="{{ asset('vendor\bllim\laravalid\public/jquery.validate.laravalid.js') }}"></script>



<script type="text/javascript">



$('form').validate({onkeyup: false});



App.init();

var arra;

$.get( 

        'getAllUsers',

         { sponsor: 'ghjgj' },

            function(response) {

                    if (response) {

                        month_users=response;

arra = month_users.split(",");

$("#username").autocomplete({source:arra});

}

});

</script>







@stop