<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="{{ route('welcome') }}">
						<img src="{{ asset('assets/images/logo.png') }}" alt="" style="max-width: 100px; max-height: 55px">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="/">Beranda</a>
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
									<a class="dropdown-item" href="{{ route('blog.index') }}">Blog</a>

								</div>
							</li>
						</ul>
						@auth
							<div class="d-flex navbar-nav ml-auto mt-10">
								<li class="nav-item dropdown dropdown-slide">
									<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">
										{{ Auth::user()->name }}
										<img src="{{ Auth::user()->avatar }}" alt="" style="width: 56px; height: 56px; margin-left: 10px; margin-bottom: 10px;">

										<div class="dropdown-menu">
										@if (Auth::user()->is_admin == 0)
											<a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a>
										@else
											<a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
										@endif
										<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Logout</a>
										<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
										</form>
										</div>
									</a>
								</li>
								
							</div>
						@else
							<ul class="navbar-nav ml-auto mt-10">
								<li class="nav-item">
									<a class="nav-link login-button" href="{{ route('login') }}">Login</a>
								</li>
							</ul>
						@endauth
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>