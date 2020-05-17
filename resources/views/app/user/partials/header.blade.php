<style type="text/css">
       
    
    .test {
 
  display:flex;
  align-items:center;
  justify-content:center;
}
  .img-ab {
  width: 35px !important;
  height: 28px !important;
   }

</style>
    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header media-middle text-center test"style="background-color:white">
            <img src="{{ url('img/cache/original/'.$logo)}}" class="inpagelogo-smallx img-ab" alt="{{ config('app.name', 'Cloud MLM Software') }}">

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>
    
 @if(Auth::check())
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li>
                    <a class="sidebar-control sidebar-main-hide hidden-xs">
                        <i class="icon-lan3"></i>
                    </a>
                </li>
                <!-- <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li> -->
            </ul>
            <p class="navbar-text">           
           <!--  <span class="checkbox checkbox-switch">
                <label>
                    <input id="toggleOnlineStatus" type="checkbox" class="switch primary" data-on-color="success" data-off-color="warning" data-on-text="Online" data-off-text="Offline" data-size="mini" {{$presence == "true"? "checked=true":"" }}/>                    
                </label>
            </span -->>

            <!-- <span class="label bg-success">Online</span> -->
            </p>

            <ul class="nav navbar-nav navbar-right">
<!--                
                 <li class="dropdown currency-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                             <i class="fa fa-{{strtolower(currency()->getUserCurrency())}}"></i>
                                {{currency()->getUserCurrency()}} - {{currency()->__get('name')}}
                             </span>                     
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu"> -->

                    <!--TODO : http://lyften.com/projects/laravel-currency/doc/methods.html -->
             <!--         @foreach (currency()->getActiveCurrencies() as $curr => $currency)
                        @if ($curr != strtolower(currency()->getUserCurrency()))
                        @endif                        
                        <li><a class="{{ $curr == strtolower(currency()->getUserCurrency()) ? 'active' : '' }}" href="{{url('/')}}/{{Route::getFacadeRoot()->current()->uri()}}/?currency={{$curr}}">  <span class="currency-symbol">{{$currency['symbol']}}</span> <span class="currency-code"> {{strtoupper($curr)}}</span><span class="currency-name"> {{$currency['name']}}</span></a></li>
                     @endforeach
                    </ul>
                </li>  -->              

                <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                             <span class="lang-xs lang-lbl" lang="{{App::getLocale()}}"></span>                     
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                     @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        @endif

                        <li><a class="deutsch {{ $lang == App::getLocale() ? 'active' : '' }}" href="{{ route('lang.switch', $lang) }}"> <span class="lang-xs lang-lbl" lang="{{$language}}"></span></a></li>
                    @endforeach
                    </ul>
                </li>

           <!--      <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="visible-xs-inline-block position-right">Messages</span>
                        <span class="badge bg-warning-400">   
                            @if($unread_count > 0){!!$unread_count!!} @else 0 @endif
                        </span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-content width-350">
                        <div class="dropdown-content-heading">
                            @if($unread_count == 0) {{trans('all.no_unread_msg')}} @else({!!$unread_count!!}) {{trans('all.unread_msg')}} @endif
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-compose"></i></a></li>
                            </ul>
                        </div>
                          @if(isset($unread_mail))
                        <ul class="media-list dropdown-content-body">
                              @foreach($unread_mail as $mail)
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{url('img/cache/profile/')}}/{{$image}}" class="img-circle img-sm" alt="">
                                </div>

                                <div class="media-body">
                                    <a href="#" class="media-heading">
                                        <span class="text-semibold">{!!$mail->username!!}</span>
                                        <span class="media-annotation pull-right">04:58</span>
                                    </a>

                                    <span class="text-muted">{!!$mail->message_subject!!}...</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <div class="dropdown-content-footer">
                            <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li> -->

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">

                     {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $image]), 'Admin', array('class' => 'thumb','style'=>'width:16px;display: inline-block;')) }}

                        

                        <span>{{ ucfirst(Auth::user()->name) }}</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                     @if(Auth::user()->id==1)
                        <li><a href="{{ URL::to('admin/userprofile') }}"><i class="icon-user-plus"></i>{{trans('all.my_profile')}}</a></li>
                        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="icon-user-plus"></i> {{trans('all.dashboard')}} </a></li>
                        <li><a href="{{ URL::to('admin/settings') }}"><i class="icon-cog5"></i> {{trans('all.account_settings')}}</a></li>
                    @else 
                        <li><a href="{{ URL::to('user/profile') }}"><i class="icon-user-plus"></i>{{trans('all.my_profile')}}</a></li>
                        <li><a href="{{ URL::to('user/dashboard') }}"><i class="icon-user-plus"></i> {{trans('all.dashboard')}} </a></li>
                    @endif
                    
                    <li><a href="{{ url('/logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a></li>

                    
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    
                    

                    </ul>
                </li>
            </ul>
        </div>
@endif
    </div>
   
