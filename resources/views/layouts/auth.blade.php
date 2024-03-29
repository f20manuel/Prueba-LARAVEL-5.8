<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/now-ui-dashboard.css?v=1.3.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
    <iink href="{{ asset('css/style.css') }}" rel="stylesheet" />
</head>
<body class="@yield('BodyClass')">
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

  <!--   Core JS Files   -->
  <script src="{{ ('assets/js/core/jquery.min.js') }}" defer></script>
  <script src="{{ ('assets/js/core/popper.min.js') }}" defer></script>
  <script src="{{ ('assets/js/core/bootstrap.min.js') }}" defer></script>
  <script src="{{ ('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}" defer></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE') }}" defer></script>
  <!-- Chart JS -->
  <script src="{{ ('assets/js/plugins/chartjs.min.js') }}" defer></script>
  <!--  Notifications Plugin    -->
  <script src="{{ ('assets/js/plugins/bootstrap-notify.js') }}" defer></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ ('assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript') }}" defer></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ ('assets/demo/demo.js') }}" defer></script>
</body>
</html>
