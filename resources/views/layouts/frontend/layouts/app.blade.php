<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    City Express
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  @include('layouts.frontend.partials.global-styles')
  @stack('styles')
</head>

<body class="index-page sidebar-collapse">
           <!-- preloader -->
        <div class="preloader">
            <div class="status">
                <div class="status-mes"></div>
            </div>
        </div>

    @include('layouts.frontend.partials.nav')

@if (url()->current() == url('/home') || url()->current() == url('/'))
<div class="page-header" data-parallax="true" style="background-image: url({{url('/img/cartoon.jpg')}});">
    {{-- <div class="page-header header-filter" data-parallax="true" style="background-image: url('./assets/img/del.jpg');"> --}}
    {{-- <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1 class="orange">City Express</h1>
            <h3>Make your Delivery Faster</h3>
          </div>
        </div>
      </div>
    </div> --}}
</div>
  <div class="main main-raised">
    <div class="section section-basic">
        @yield('content')
    </div>
  </div>
@else
<div style="height: 32vh" class="page-header">
    @yield('breadcrumb')
</div>
  <div class="main main-raised">
    <div class="section section-basic">
        @yield('content')
    </div>
  </div>
@endif

  <!-- Classic Modal -->
  <!--  End Modal -->
  @include('layouts.frontend.partials.footer')
  <!--   Core JS Files   -->
  @include('layouts.frontend.partials.global-scripts')
  @stack('scripts')
</body>

</html>
