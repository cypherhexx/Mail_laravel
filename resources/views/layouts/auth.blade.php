<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cloud MLM Software') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

</head>

<body class="login-container">

<!-- Main navbar -->
    <div class="navbar navbar-inverse">
       <!--  <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>
 -->
        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">

       <!--      <li class="dropdown currency-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                             <i class="fa fa-{{strtolower(currency()->getUserCurrency())}}"></i>
                                {{currency()->getUserCurrency()}} - {{currency()->__get('name')}}
                             </span>                     
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu"> -->

                    <!--TODO : http://lyften.com/projects/laravel-currency/doc/methods.html -->
               <!--       @foreach (currency()->getActiveCurrencies() as $curr => $currency)
                        @if ($curr != strtolower(currency()->getUserCurrency()))
                        @endif                        
                        <li><a class="{{ $curr == strtolower(currency()->getUserCurrency()) ? 'active' : '' }}" href="{{url('/')}}/{{Route::getFacadeRoot()->current()->uri()}}/?currency={{$curr}}">  <span class="currency-symbol">{{$currency['symbol']}}</span> <span class="currency-code"> {{strtoupper($curr)}}</span><span class="currency-name"> {{$currency['name']}}</span></a></li>
                     @endforeach
                    </ul>
                </li>     -->           

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

                 @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>                        
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif


            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    @yield('content')

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->





@yield('overscripts')

<script>
    window.CLOUDMLMSOFTWARE = {
       "siteUrl":"{{ URL::to('/') }}"  
    };
</script>

<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}"></script>
@yield('scripts')
@if (isset($errors) && !$errors->isEmpty())
<script type="text/javascript">
swal("","@foreach ($errors->all() as $error){{ $error }}@endforeach","error");
</script>
@endif
@if (session()->has('flash_notification.message'))
  @if (session()->has('flash_notification.overlay'))
      <script type="text/javascript">
       swal("{!! Session::get('flash_notification.title') !!}","{!! Session::get('flash_notification.message') !!}","{!! Session::get('flash_notification.level') !!}");
      </script>
  @else
      <script type="text/javascript">
       swal("{!! session('flash_notification.level') !!}"," {!! session('flash_notification.message') !!}","{!! session('flash_notification.level') !!}");
      </script>
  @endif
@endif


</body>
</html>
