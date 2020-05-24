
@extends('app.user.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop {{-- Content --}} @section('styles') @parent
<style type="text/css">
</style>
@endsection @section('main')
<!-- Basic datatable -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{trans('wallet.fund_transfer')}}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

         <table class="table table-condensed">

                                            <thead class="">

                                                <tr>

                                                    <th>{{trans('wallet.username')}}</th>

                                                    <th>{{trans('wallet.to_username')}}</th>

                                                    <th>{{trans('wallet.amount')}}</th>

                                                    <th>{{trans('wallet.description')}}</th>

                                                    <th>{{trans('wallet.date')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($data as $refs)

                                                <tr class="text-success text-bold">

                                                    <td>{{Auth::user()->username}}</td>

                                                    <td>{{$refs->tousername}}</td>

                                                    <td>{{$currency_sy}}{{$refs->payable_amount}}</td>

                                                    <td>{{Ucfirst(str_replace('_',' ',$refs->payment_type))}}</td>

                                                     <td>{{ date('d M Y',strtotime($refs->created_at))}}</td>

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>





                            {!! $data->render() !!}

  </div>
                  
@stop
 

