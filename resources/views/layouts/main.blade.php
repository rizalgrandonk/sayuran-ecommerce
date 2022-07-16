<!DOCTYPE html>
<html lang="en">

<head>
  <title>Vege Food</title>
  <meta charset="utf-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @include('layouts.icons')
  @include('layouts.meta')


  <link
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet"
    href="{{ asset('home-asset/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('home-asset/css/animate.css') }}">

  <link rel="stylesheet"
    href="{{ asset('home-asset/css/owl.carousel.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('home-asset/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('home-asset/css/magnific-popup.css') }}">

  <link rel="stylesheet" href="{{ asset('home-asset/css/aos.css') }}">

  <link rel="stylesheet"
    href="{{ asset('home-asset/css/ionicons.min.css') }}">

  <link rel="stylesheet"
    href="{{ asset('home-asset/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet"
    href="{{ asset('home-asset/css/jquery.timepicker.css') }}">


  <link rel="stylesheet" href="{{ asset('home-asset/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('home-asset/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{ asset('home-asset/css/style.css') }}">
  <style>
    .link-disabled {
      pointer-events: none;
    }

    .separator {
      display: flex;
      align-items: center;
      text-align: center;
    }

    .separator::before,
    .separator::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid rgba(0, 0, 0, 0.3);
    }

    .separator::before {
      margin-right: .25em;
    }

    .separator::after {
      margin-left: .25em;
    }
  </style>


</head>

<body class="goto-here">
  @include('layouts.header')

  @yield('content')

  @include('layouts.footer')


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular"
      width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22"
        fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22"
        fill="none" stroke-width="4" stroke-miterlimit="10"
        stroke="#F96D00" />
    </svg></div>


  <script src="{{ asset('home-asset/js/jquery.min.js') }}"></script>
  <script src="{{ asset('home-asset/js/jquery-migrate-3.0.1.min.js') }}">
  </script>
  <script src="{{ asset('home-asset/js/popper.min.js') }}"></script>
  <script src="{{ asset('home-asset/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('home-asset/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('home-asset/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('home-asset/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('home-asset/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('home-asset/js/jquery.magnific-popup.min.js') }}">
  </script>
  <script src="{{ asset('home-asset/js/aos.js') }}"></script>
  <script src="{{ asset('home-asset/js/jquery.animateNumber.min.js') }}">
  </script>
  <script src="{{ asset('home-asset/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('home-asset/js/scrollax.min.js') }}"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
  </script>
  <script src="{{ asset('home-asset/js/google-map.js') }}"></script>
  <script src="{{ asset('home-asset/js/main.js') }}"></script>

  @yield('script')
</body>

</html>
