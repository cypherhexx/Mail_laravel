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



    <div class="panel-body">

@if(isset($data) and count($data)>0)

      <table class="table table-stripped">

        <thead>

          <th>{{trans('products.product')}} </th>
          <th>{{trans('products.username')}} </th>

          <th>{{trans('products.number_of_products')}} </th>

          <!-- <th> Product amount</th> -->

        <!--   <th>{{trans('products.pv')}} </th> -->
          <th>{{trans('products.total_amount')}} </th>

          <th> {{trans('products.purchase_date')}}</th>

          <th> {{trans('products.paid_by')}}</th>

          <!-- <th> {{trans('products.purchase_status')}}</th> -->

          <th> {{trans('products.action')}}</th>
         

        </thead>



        <tbody>

          @foreach($data as $item)

           <tr>

             <td> {{ $item->package}}</td>
             
             <td> {{ $item->username}}</td>

             <td> 1</td>

             <!-- <td> {{ $item->member_amount}}</td> -->

             <!-- <td> {{ $item->BV}}</td> -->
             <td> {{ $item->total_amount}}</td>

             <td> {{ Date('d M Y',strtotime($item->created_at))}}</td>

             <td> {{ $item->pay_by}}</td>

             <!-- <td> {{ $item->status}}</td>  -->

             <td>
              <a href="{{url('admin/view-invoice/'.$item->id)}}" target="_blank" class="btn btn-primary">
                <i class="fa fa-file-word-o"></i>
              
              </a>
        
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