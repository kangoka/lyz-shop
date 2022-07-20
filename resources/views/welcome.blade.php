@extends('layouts.app')

@section('content')
<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Header Contetnt -->
                <div class="content-block">
                    <h1>CARI YANG KAMU BUTUHIN</h1>
                    <p>Menjual berbagai macam kebutuhan dengan harga bersaing</p>
                    <!-- <div class="short-popular-category-list text-center">
						<h2>Popular Category</h2>
						<ul class="list-inline">
							<li class="list-inline-item">
								<a href="category.html"><i class="fa fa-bed"></i> Hotel</a></li>
							<li class="list-inline-item">
								<a href="category.html"><i class="fa fa-grav"></i> Fitness</a>
							</li>
							<li class="list-inline-item">
								<a href="category.html"><i class="fa fa-car"></i> Cars</a>
							</li>
							<li class="list-inline-item">
								<a href="category.html"><i class="fa fa-cutlery"></i> Restaurants</a>
							</li>
							<li class="list-inline-item">
								<a href="category.html"><i class="fa fa-coffee"></i> Cafe</a>
							</li>
						</ul>
					</div> -->

                </div>
                <!-- Advance Search -->
                <div class="advance-search">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 align-content-center">
                                @if ($is_expired != "1")
                                    <h3>Gunakan kode promo <strong>{{ $promo->code }}</strong> untuk mendapatkan diskon <strong>{{ $promo->discount }}%</strong></h3>
                                @else
                                    <h3>{{ $promo }}</h3>
                                @endif
                                <!-- <form>
											<div class="form-row">
												<div class="form-group col-md-4">
													<input type="text" class="form-control my-2 my-lg-1" id="inputtext4" placeholder="What are you looking for">
												</div>
												<div class="form-group col-md-3">
													<select class="w-100 form-control mt-lg-1 mt-md-2">
														<option>Category</option>
														<option value="1">Top rated</option>
														<option value="2">Lowest Price</option>
														<option value="4">Highest Price</option>
													</select>
												</div>
												<div class="form-group col-md-3">
													<input type="text" class="form-control my-2 my-lg-1" id="inputLocation4" placeholder="Location">
												</div>
												<div class="form-group col-md-2 align-self-center">
													<button type="submit" class="btn btn-primary">Search Now</button>
												</div>
											</div>
										</form> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>BANYAK YANG BELI</h2>
                    <p>Item dibawah ini yang paling banyak dibeli orang</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- offer 01 -->
            <div class="col-lg-12">
                <div class="trending-ads-slide">
                    @foreach ($product as $product)
                    <div class="col-sm-12 col-lg-4">
                        <!-- product card -->
                        <div class="product-item bg-light">
                            <div class="card">
                                <div class="thumb-content">
                                    <div class="price">Rp. {{ number_format($product->price, 0, '', '.') }}</div>
                                    <a href="/shop/product/{{ $product->slug }}">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url($product->image) }}"
                                            alt="Card image cap">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><a href="/shop/product/{{ $product->slug }}">{{ $product->name }}</a></h4>
                                    <ul class="list-inline product-meta">
                                        <li class="list-inline-item">
                                            <a href="/shop/{{ $product->Category->name }}"><i class="fa fa-folder-open-o"></i>{{ $product->Category->name }}</a>
                                        </li>
                                    </ul>
                                    <!-- <div class="product-ratings">
                                        <ul class="list-inline">
                                            <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                            <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection