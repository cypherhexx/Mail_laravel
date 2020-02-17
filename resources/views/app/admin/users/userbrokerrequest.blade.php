@extends('app.admin.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')


 @include('utils.errors.list')

 @include('flash::message')

 <div class="panel panel-border panel-primary" data-sortable-id="ui-widget-11">
    <div class="panel-heading">
        <h4 class="panel-title">User Request</h4>
    </div>
            <div class="panel-body">
                <form action="" method="">
                    <div class="invoice-content">
                        <div class="table-responsive">
                            <table class="table table-invoice" id="table">
                                <thead>
                                    <tr>

                                        <th>No</th>
                                        <th>Username</th>  
                                        <th>Broker</th> 
                                        <th>Account</th>
                                         <th>Password</th>
                                          <th>Status</th>
                                            <th>Created</th>

                                    </tr>

                                </thead>
                                    <tbody>

                                            @foreach($all_req as $key=> $user)

                                                <tr>

                                                <td>{{$key + 1}}</td>
                                                <td>{{$user->username}}</td>
                                                  <td>{{$user->name}}</td>
                                                    <td>{{$user->account}}</td>
                                                      <td>{{$user->password}}</td>
                                                        <td>{{$user->status}}</td>

                                               <td> {{ date('d M Y H:i:s',strtotime($user->created_at))}}</td>
                                              
                                                </tr>

                                            @endforeach  

                                                @if(!count($all_req))

                                                <tr><td>No Data</td></tr>

                                                @endif  

                                                          

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </form>

                 {!! $all_req->render() !!} 

            </div>
        </div>

@endsection

