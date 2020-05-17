<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]>   <![endif]-->
<html class="no-js" lang="{{ app()->getLocale() }}" itemscope itemtype="http://schema.org/website"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="">    
    <!-- Favicon /-->
    <link rel="shortcut icon" href="{{ url('img/cache/original/'.$logo_ico)}}" type="image/x-icon" /> <!-- Favicon /-->
    <!-- Facebook Metadata /-->
    <meta property="fb:page_id" content="" />
    <meta property="og:image" content="" />
    <meta property="og:description" content=""/>
    <meta property="og:title" content=""/>
    <!-- Google+ Metadata /-->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="">
    <link rel="shortcut icon" href="{{url($logo_ico)}}" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
     <title>@section('title') {{$company_name}}@show</title>
    @section('meta_keywords')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="keywords" content="MLM Software, Multilevel Marketing software"/>
    @show @section('meta_author')
    @show @section('meta_description')
    <meta name="description" content="The best MLM Software in the market"/>
    @show
    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
    @yield('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{{ asset('assets/site/ico/favicon.ico') }}}"/>
    @yield('headerscripts')
</head>
<body class="@yield('page_class')">
    @yield('content')
    @yield('overscripts')
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

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-70977094-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-70977094-2');
</script>




</body>
</html>