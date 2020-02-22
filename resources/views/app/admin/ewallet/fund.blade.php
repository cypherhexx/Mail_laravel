@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main') @include('flash::message') @include('utils.errors.list')
<div class="panel panel-flat ">
    <div class="panel-heading col-sm-offset-3">
        <h4 class="panel-title">
            Credit Fund To Users
        </h4>
    </div>
    <div class="panel-body col-sm-offset-2">

  
        <form action="{{url('admin/credit-fund')}}" class="smart-wizard form-horizontal" method="post">
            <input name="_token" type="hidden" value="{{csrf_token()}}">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="username">
                    {{trans('ewallet.enter_username')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control autocompleteusers" id="username" name="autocompleteusers" type="text">
                    <input class="form-control key_user_hidden" name="username" type="hidden">
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="amount">
                    {{trans('ewallet.amount')}}:
                    <span class="symbol required">
                        </span>
                </label>
                <div class="col-sm-4">
                    <input class="form-control" id="amount" name="amount" type="text">
                    </input>
                </div>
            </div>
      <!--        <div class="form-group">
                <label class="col-sm-3 control-label" for="current_password">
                    {{trans('ewallet.transaction_password')}} 
                </label>
                 <div class="col-sm-4">
                <input class="form-control" name="oldpass" id="oldpass" autocomplete="new-password"  type="password"  >
                </input>
                </div>
            </div> -->
            <div class="col-sm-offset-2">
                <div class="form-group" style="float: left; margin-right: 0px;">
                    <div class="col-sm-2">
                        <button class="btn btn-info" id="add_amount" name="add_amount" tabindex="4" type="submit" value="{{trans('ewallet.add_amount')}}">
                            {{trans('ewallet.add_amount')}}
                        </button>
                    </div>
                </div>
            </div>
            </input>
        </form>
    </div>
</div>

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

                                                    <th>Sl.no</th>
                                                    <th>{{trans('wallet.username')}}</th>

                                                    <th>{{trans('wallet.amount')}}</th>


                                                    <th>{{trans('wallet.date')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            @foreach ($data as $key=>$item)

                                                <tr >

                                                    <td>{{$key+1}}</td>

                                                    <td>{{$item->username}}</td>

                                                    <td>{{$currency_sy}} {{$item->payable_amount}}</td>

                                                    

                                                     <td>{{ date('d M Y',strtotime($item->created_at))}}</td>

                                                </tr>

                                            @endforeach

                                            </tbody>



                                        </table>





                            {!! $data->render() !!}

  </div>
@endsection @section('overscripts') @parent

@endsection 
@section('scripts')
 @parent
 <script type="text/javascript">
$(document).on('submit', 'form', function() {
   $(this).find('button:submit, input:submit').attr('disabled','disabled');
 });
</script>

 @endsection