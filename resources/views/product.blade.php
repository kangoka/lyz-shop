@extends('layouts.app')

@section('content')
    <section class="section bg-gray">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <!-- Left sidebar -->
                <div class="col-md-8">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->first()->name }}</h1>
                        <div class="product-meta">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Kategori<a
                                        href="/shop/{{ $product->first()->Category->name }}">{{ $product->first()->Category->name }}</a>
                                </li>
                            </ul>
                        </div>

                        <!-- product slider -->
                        <div class="product-slider mt-2">
                            <div class="product-slider-item my-4" data-image="{{ url($product->first()->image) }}">
                                <!-- <img class="img-fluid w-100" src="{{-- url($product->first()->image) --}}" alt="product-img"> -->
                            </div>
                        </div>
                        <!-- product slider -->

                        <div class="content mt-5 pt-5">
                            <ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                        role="tab" aria-controls="pills-home" aria-selected="true">Detail Produk</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                        role="tab" aria-controls="pills-profile" aria-selected="false">Specifications</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                        href="#pills-contact" role="tab" aria-controls="pills-contact"
                                        aria-selected="false">Ulasan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <h3 class="tab-title">Deskripsi Produk</h3>
                                    {!! $product->first()->details !!}
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <h3 class="tab-title">Ulasan Produk</h3>
                                    @if ($reviews->isEmpty())
                                        <div class="product-review">
                                            <h4>Belum ada ulasan untuk produk ini</h4>
                                        </div>
                                    @else
                                        <div class="product-review">
                                            @foreach ($reviews as $review)
                                                <div class="media">
                                                    <!-- Avatar -->
                                                    <img src="{{ url(App\Models\User::find($review->user_id)->avatar) }}"
                                                        alt="Avatar">
                                                    <div class="media-body">
                                                        <!-- Ratings -->
                                                        <div class="ratings">
                                                            <ul class="list-inline">
                                                                @for ($i = 1; $i <= $review->rating; $i++)
                                                                    <li class="list-inline-item">
                                                                        <i class="fa fa-star"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                        <div class="name">
                                                            <h5>{{ App\Models\User::find($review->user_id)->name }}</h5>
                                                        </div>
                                                        <div class="date">
                                                            <p>{{date('d M Y', strtotime($review->created_at)) }}</p>
                                                        </div>
                                                        <div class="review-comment">
                                                            <p>
                                                                {{ $review->comment }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="widget price text-center" id="check">
                            <div class="row">
                                <div class="col-sm">
                                    <h4>Harga</h4>
                                    <p>{{ number_format($product->first()->price, 0, '', '.') }}</p>
                                </div>
                                <div class="col-sm">
                                    <h4>Stok</h4>
                                    <p>{{ $product->first()->stock }}</p>
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- User Profile widget -->
                        <div class="widget user text-center">
                            @if (Auth::user() != '')
                                <ul class="list-inline">
                                    <li>
                                        <form action="{{ route('shop.checkout', $product->first()->id) }}"
                                            class="basic-form" method="post">
                                            @csrf
                                            <li class="list-inline-item">
                                                <?php if (session()->has('errors')) : ?>
                                                    <div class="alert alert-danger">
                                                        <p class="h3 text-black">Kesalahan</p>
                                                        <ul>
                                                            <?php foreach (session('errors') as $error) : ?>
                                                            <li><?= $error ?></li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    </div>
                                                <?php endif ?>
                                            </li>
                                            @if ($product->first()->field != NULL)
                                                <div>
                                                    <label for="field" class=""><strong>{{ $product->first()->field }}</strong></label>
                                                </div>
                                                <div> 
                                                    <input class="border p-1 w-50 my-2 " type="text" name="field" id="field"
                                                    style="text-align: center" maxlength="255">
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col">
                                                    <label for="quantity" class="col-6"><strong>Jumlah</strong></label>
                                                </div>
                                                <div class="col">
                                                    <label for="code" class="text-justify col-6"><strong>Kode Promo</strong></label>
                                                </div>
                                                <div class="w-100"></div>
                                                <div class="col">
                                                    <input class="border p-1 w-50 my-2 col-6" type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->first()->stock }}"
                                                    style="text-align: center">
                                                </div>
                                                <div class="col"> 
                                                    <input class="border p-1 w-50 my-2 col-6" type="text" name="code" id="code"
                                                    style="text-align: center" maxlength="9">
                                                </div>
                                            </div>
                                            <br>
                                            <a href="#check" onclick="checkCode()">Cek kode</a>
                                            <p id="result"></p>
                                            <button type="submit"
                                                class="btn btn-offer d-inline-block btn-primary ml-n1 my-1 px-lg-4 px-md-3"
                                                id="buy">Beli</button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <h3>Waduh, kamu harus login dulu untuk membeli produk ini</h3>
                            @endif
                        </div>
                        <!-- Coupon Widget -->
                        <div class="widget coupon text-center">
                            <!-- Coupon description -->
                            <p>Bukan produk yang kamu cari?
                            </p>
                            <!-- Submii button -->
                            <a href="{{ route('shop.all') }}" class="btn btn-transparent-white">Cari Lainnya</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- Container End -->
    </section>
@endsection

@if (Auth::user() != '')
    @section('js')
    <script>
        document.getElementById("code").addEventListener("change", myFunction);

        function myFunction() {
            if (document.getElementById("code").value.length == 0) {
                return $('#buy').removeAttr('disabled');
            }
            document.getElementById("buy").disabled = true;
        }
    </script>
    <script>
        function checkCode() {
            var thenCD = localStorage.getItem("ccc");
            var millis = Date.now() - thenCD;
            var seconds = Math.floor(millis / 1000);
            if (seconds < 10) {
                document.getElementById("result").innerHTML = 'Tunggu ' + (10 - seconds) +
                ' detik lagi untuk mengecek lagi';
                document.getElementById("result").style.color = "red";
                return;
            }
            localStorage.setItem("ccc", Date.now());
            var code = document.getElementById("code").value;
            if (code.length <= 0) {
                document.getElementById("result").innerHTML = "";
                return;
            }
            if (code.length > 9) {
                document.getElementById("result").innerHTML = "Waduh, kamu lagi ngapain sih?";
                document.getElementById("result").style.color = "red";
                return;
            }

            if (code.length < 9) {
                document.getElementById("result").innerHTML = "Kode tidak valid";
                document.getElementById("result").style.color = "red";
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.get('/promo/check/' + code  + '/' + {{ Auth::user()->id }}, function(data) {
                if (data == 'V') {
                    document.getElementById("result").innerHTML = "Kode valid";
                    document.getElementById("result").style.color = "green";
                    $('#buy').removeAttr('disabled');
                } else if (data == 'NA') {
                    document.getElementById("result").innerHTML = "Kamu nggak bisa pake kode ini lagi";
                    document.getElementById("result").style.color = "red";

                } else if (data == 'EX') {
                    document.getElementById("result").innerHTML = "Kode sudah kadaluwarsa";
                    document.getElementById("result").style.color = "red";
                } else {
                    document.getElementById("result").innerHTML = "Kode tidak valid";
                    document.getElementById("result").style.color = "red";
                }
            })
        }
    </script>
@endsection
@endif
