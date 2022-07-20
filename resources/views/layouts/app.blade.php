<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lyz Shop</title>
  
  <!-- FAVICON -->
  <link href="{{ asset('assets/images/favicon.png') }}" rel="shortcut icon">
  <!-- PLUGINS CSS STYLE -->
  <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-slider.css') }}">
  <!-- Font Awesome -->
  <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="{{ asset('assets/slick-carousel/slick/slick.css') }}" rel="stylesheet">
  <link href="{{ asset('assetsplugins/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="{{ asset('assets/fancybox/jquery.fancybox.pack.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="{{ asset('assets/styles/style.css') }}" rel="stylesheet">

  @yield('assets')


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">

    @include('components.navbar')

    @yield('content')

</footer>
<!-- Footer Bottom -->
<footer class="footer-bottom">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-12">
        <!-- Copyright -->
        <div class="copyright">
          <p>Copyright © <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script>. All Rights Reserved</p>
        </div>
      </div>
      <div class="col-sm-6 col-12">
        <!-- Social Icons -->
        <ul class="social-media-icons text-right">
          <li><a class="fa fa-instagram" href="https://www.instagram.com/lyz.id/" target="_blank"></a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Container End -->
  <!-- To Top -->
  <div class="top-to">
    <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
  </div>
</footer>

<!-- JAVASCRIPTS -->
<script src="{{ asset('assets/jQuery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap-slider.js') }}"></script>
  <!-- tether js -->
<script src="{{ asset('assets/tether/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/raty/jquery.raty-fa.js') }}"></script>
<script src="{{ asset('assets/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/fancybox/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset('assets/smoothscroll/SmoothScroll.min.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('js')

</body>

</html>



