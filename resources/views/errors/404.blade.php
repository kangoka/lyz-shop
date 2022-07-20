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


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="{{ route('welcome') }}">
						<img src="{{ asset('assets/images/logo.png') }}" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="{{ route('welcome') }}">Berandaa</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('shop.all') }}">Toko</a>
							</li>
							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Lainnya <span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{ route('home.about') }}">Tentang Kami</a>
									<a class="dropdown-item" href="{{ route('home.terms') }}">Syarat dan Ketentuan</a>
									<a class="dropdown-item" href="">Blog</a>

								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center mx-auto">
                <div class="404-img">
                    <img src="{{ asset('assets/images/404/404.png') }}" class="img-fluid" alt="">
                </div>
                <div class="404-content">
                    <h1 class="display-1 pt-1 pb-2">Waduh</h1>
                    <p class="px-3 pb-2 text-dark">Sepertinya halaman yang kamu cari tidak ada, atau mungkin bukan ini yang kamu cari?</p>
                    <a href="{{ route('welcome') }}" class="btn btn-primary">BERANDA</a>
                </div>
            </div>
        </div>
    </div>
</section>
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

</body>

</html>