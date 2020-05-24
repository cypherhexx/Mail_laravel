<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <link rel='icon' href='https://office.algolight.net/img/cache/logo/logo-login.png' type='image/x-icon'/ >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cloud MLM Software') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

</head>


<style type="text/css">



/*.login-container .page-container{
  padding-top: 0;
}*/
.im_st{
  
  height: 100px;
  width: 220px;
  max-width: 220px;
}
.mana_top{
  margin-top: 25px;
}

/*.full_nav{
  background-color:#ffffff;
  border: 1px solid #e7e7e7 !important;
}*/

@media (min-width: 768px) and (max-width: 768px){
  .navbar-inverse .navbar-collapse {
    background-color: transparent;
}
.mar_tr{
  
  visibility: hidden;
}
}
.navbar-header{
  background-color: transparent;
}

@media (max-width: 767px){
  .navbar-inverse .navbar-collapse {
    background-color: transparent;
}
.mar_tr{
  margin-top: -66px;
}
}



/**/
.navbar-inverse .navbar-nav > li > a{
   color:#ffffff !important;

}
.full_nav{
   background-color: rgba(0,0,0,0.15)!important;;
}
.navbar.navbar-inverse{
  background-color: transparent;
}
.mana_top{
    font-weight: bold;
    letter-spacing: 1px;
    font-family: "Source Sans Pro";
    line-height: 24px;
    font-size: 16px;
    color:#ffffff !important;
}
@media (min-width: 320px) and (max-width: 767px) {
.im_st {
  
    width: 166px;
  
}

</style>

<body class="login-container">

<!-- Main navbar -->
<div class="full_nav">
<div class="container">
<div class="navbar navbar-inverse">
<div class="row">

         <div class="navbar-header">
           <!-- <a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a>-->
            <div class="col-lg-3 im_st">
            <img style="margin-top:-22px;" class="img-responsive " src="img/cache/original/algo-logo.png">
             
     </div>
     <div class="col-lg-3 mar_tr">
      <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile">&#9776;</a></li>
            </ul>
       
     </div>

     
       </div>




     <div class="navbar-collapse collapse" id="navbar-mobile">


   <!--  <div class="col-lg-3 im_st">
            <img style="margin-top: 10px;" class="img-responsive " src="http://comhumans.cloudmlmdemo.com/img/cache/original//comhumanlogo.jpg">
     </div>-->
      <div class="col-lg-9">

           
    

            <ul class="nav navbar-nav navbar-right mana_top">

                 <li> <a href="https://algolight.net">HOME</a></li>
                 <li> <a href="https://algolight.net/#about-us">ABOUT US</a></li>
                 <li> <a href="https://algolight.net/#vision">VISION</a></li>
                 <li> <a href="https://algolight.net/#services">SERVICES</a></li>
                 <li> <a href="https://algolight.net/new/">NEW</a></li>
                 <li> <a href="https://algolight.net/#contact-us">CONTACT US</a></li>
                 <li> <a href="https://office.algolight.net/login">LOGIN</a></li>
                 <li> <a href="https://office.algolight.net/register">REGISTER</a></li>

       
            </ul>

          </div>
        </div>

</div>

        </div>
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
