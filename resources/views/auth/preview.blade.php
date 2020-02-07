@extends('layouts.auth')
@section('content')


 

 
<div class="alert bg-success alert-styled-left">
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Registration Completed!</span> You have successfully registered <strong>{{$userresult->username}} ({{$userresult->name}} {{$userresult->lastname}})</strong>  under sponsor, <strong>{{$sponsorUserName}}</strong>. Payment done via <strong>{{$userresult->register_by}} .</strong>
</div>
<div class="panel">
    <div class="panel-heading bg-primary">
        <h6 class="panel-title">Registration details</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <!-- $userresult->profile_info->city -->
        <div class="col-sm-6">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <th><strong class="h6">Network</strong></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>{{trans('register.username') }}</th>
                        <td>{{$userresult->username}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.email') }}</th>
                        <td>{{$userresult->email}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.password') }}</th>
                        <td>This password is <strong>Encrypted</strong> - You can change in settings if you've forgotten it!</td>
                    </tr>
                    <tr>
                        <th class="col-md-2">{{trans('register.sponsor') }}</th>
                        <td>{{$sponsorUserName}}</td>
                    </tr>
                    
                  <!--   <tr>
                        <th>{{trans('register.package') }}</th>
                        <td>{{$userresult->profile_info->package_detail->package}}</td>
                    </tr> -->
                    <tr>
                        <th>{{trans('register.firstname') }}</th>
                        <td>{{$userresult->name}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.lastname') }}</th>
                        <td>{{$userresult->lastname}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.gender') }}</th>
                        <td>
                            @if($userresult->profile_info->gender == 'm') {{trans('register.male') }} @else {{trans('register.female') }} @endif
                        </td>
                    </tr>
                    <tr>
                        <th>{{trans('register.phone') }}</th>
                        <td>{{$userresult->profile_info->mobile}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.wechat') }}</th>
                        <td>{{$userresult->id}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <!-- <h4 class=""> Coutry | {{$country}}</h4> -->
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <th><strong class="h6">Locale</strong></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>{{trans('register.country') }}</th>
                        <td>{{$country}}</td>
                    </tr>
                    <tr>
                        <th>
                            <div class="flag-icon flag-icon-{{strtolower($userresult->profile_info->country)}}" style="height:200px;width:200px"></div>
                        </th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>{{trans('register.state') }}</th>
                        <td>{{$state}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.zipcode') }}</th>
                        <td>{{$userresult->profile_info->zip}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.address') }}</th>
                        <td>{{$userresult->profile_info->address1}}</td>
                    </tr>
                    <tr>
                        <th>{{trans('register.city') }}</th>
                        <td>{{$userresult->profile_info->city}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
        <div class="heading-elements">
            <span class="heading-text text-semibold">
            
        </span>
            <div class="heading-btn pull-right">
                <a href="{{url('login')}}" class="btn btn-primary btn-labeled btn-xlg">
                <b>
                <i class="icon-circle-right2 position-right"></i>
                </b>
                Sign in
            </a>
            </div>
        </div>
    </div>
</div>   

 

        @endsection



 