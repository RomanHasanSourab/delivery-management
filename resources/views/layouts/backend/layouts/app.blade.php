<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{asset('/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    City Express
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  @include('layouts.backend.partials.global-styles')
  @stack('styles')

</head>

<body class="">
    <!-- preloader -->
<div class="preloader">
    <div class="status">
        <div class="status-mes"></div>
    </div>
</div>

  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

      <div style="text-align: -webkit-center; text-align: -moz-center" class="logo">
        <a href="{{url('/')}}">
            <img style="height: 2em; padding: 0;" class="simple-text logo-normal" src="{{asset('/img/cityv1.png')}}" alt="">
        </a>
        </div>
        @include('layouts.backend.partials.side-nav')
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      @include('layouts.backend.partials.nav')
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">



            @yield('content')





        </div>
    </div>
<!--   Core JS Files   -->
@include('layouts.backend.partials.footer')
<!--   Core JS Files   -->
@include('layouts.backend.partials.global-scripts')
@stack('scripts')

</body>

</html>
