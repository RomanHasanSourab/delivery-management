<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  {{-- <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/mg/apple-icon.png')}}"> --}}
  {{-- <link rel="icon" type="image/png" href="{{asset('/img/favicon.png')}}"> --}}
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    City Express
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="{{asset('/backend/css/toastr.min.css')}}" rel="stylesheet" />
  <link href="{{asset('/backend/css/select2.min.css')}}" rel="stylesheet" />

  <link href="{{asset('/css/resource_css_preloader.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('/css/material-kit.css?v=2.0.7')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('/demo/demo.css')}}" rel="stylesheet" />
  {{-- <link href="{{asset('/css/custom.css')}}" rel="stylesheet" /> --}}
</head>

<body class="login-page sidebar-collapse">
<!-- preloader -->
<div class="preloader">
    <div class="status">
        <div class="status-mes"></div>
    </div>
</div>
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top" color-on-scroll="100" id="sectionsNav">
  </nav>
  {{-- <div class="page-header header-filter" style="background-image: url({{url('/img/pexels-photoscom-93398_4_40.jpg')}}); background-size: cover; background-position: top center;"> --}}
  <div class="page-header header-filter" style="background-image: url({{asset('/img/landing2.jpg')}}); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        @if (url()->current() == url('/login'))
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        @else
            <div class="col-lg-8 col-md-8 ml-auto mr-auto">
        @endif
            @yield('content')
        </div>
      </div>
    </div>
    <br><br>
    <footer class="footer">
      <div class="container">
        <nav class="float-left">
          <ul>
            <li>
              <a href="{{url('/')}}">
                Home
              </a>
            </li>
          </ul>
        </nav>
        <div class="copyright float-right">
          &copy;
          <script>
            document.write(new Date().getFullYear())
          </script>, made with <i class="material-icons">favorite</i> by
          <a href="#" target="_blank">Monster Code</a> for a better web.
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('/js/core/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('/js/plugins/moment.min.js')}}"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="{{asset('/js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('backend/js/toastr.min.js')}}" type="text/javascript"></script>
  <!--  Preloader    -->
  <script src="{{asset('/js/resource_js_preloader.js')}}" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('/js/material-kit.js?v=2.0.7')}}" type="text/javascript"></script>
  <script src="{{asset('backend/js/select2.min.js')}}" type="text/javascript"></script>
  <script>
      $('.role').select2({
        placeholder: "Select an option",
        allowClear: true
      });
  </script>

@if (Session::has('success'))
<script>
    toastr.success("{!!Session::get('success')!!}")
</script>
@elseif (Session::has('error'))
<script>
    toastr.error("{!!Session::get('error')!!}")
</script>
@endif
</body>

</html>
