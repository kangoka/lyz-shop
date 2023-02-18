@extends('layouts.app')

@section('content')
<!--================================
=            Page Title            =
=================================-->
<section class="page-title">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2 text-center">
				<!-- Title text -->
				<h3>Tentang Kami</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-img">
                    <img src="{{ asset('assets/images/logo_about.gif') }}" class="img-fluid w-100 rounded" alt="">
                </div>
            </div>
            <div class="col-lg-6 pt-5 pt-lg-0">
                <div class="about-content">
                    <h3 class="font-weight-bold">Perkenalan</h3>
                    <p>Lyz Shop bermula dengan satu orang saja, didirikan dengan berjualan melalui media sosial media dan chat. 
                        Seiring berjalan waktu, Lyz Shop mulai mencoba memperluas area penjualan ke marketplace yang tersedia, 
                        akan tetapi, beberapa marketplace mengambil <i>fee</i> yang cukup besar mengingat komitmen kami untuk
                        memberikan pelayanan yang maksimal namun dengan harga yang <strong>sangat berani untuk bersaing</strong>. 
                        Maka dari itu, Lyz Shop akhirnya memiliki website sendiri untuk berjualan sehingga kami memiliki kontrol 
                        lebih atas apa yang kami jual (hal ini termasuk dengan fleksibilitas dan harga produk).
                    </p>
                    <h3 class="font-weight-bold">Bagaimana cara menghubungi kami</h3>
                    <p>Untuk saat ini, kamu bisa menghubungi kami melalui <br>
                    <i class="fa fa-whatsapp"></i> <a href="https://api.whatsapp.com/send?phone=6281327705067">WhatsApp</a> <br>
                    Untuk keperluan pertanyaan, komplain, dan saran sementara fitur chat sedang dalam pengembangan.
                </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading text-center text-capitalize font-weight-bold py-5">
                    <h2>our team</h2>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card my-3 my-lg-0">
                    <img class="card-img-top" src="{{ asset('assets/images/team/team1.jpg') }}" class="img-fluid w-100" alt="Card image cap">
                    <div class="card-body bg-gray text-center">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">Founder / CEO</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card my-3 my-lg-0">
                    <img class="card-img-top" src="{{ asset('assets/images/team/team2.jpg') }}" class="img-fluid w-100" alt="Card image cap">
                    <div class="card-body bg-gray text-center">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">Founder / CEO</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card my-3 my-lg-0">
                    <img class="card-img-top" src="{{ asset('assets/images/team/team3.jpg') }}" class="img-fluid w-100" alt="Card image cap">
                    <div class="card-body bg-gray text-center">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">Founder / CEO</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card my-3 my-lg-0">
                    <img class="card-img-top" src="{{ asset('assets/images/team/team4.jpg') }}" class="img-fluid w-100" alt="Card image cap">
                    <div class="card-body bg-gray text-center">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">Founder / CEO</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="counter-content text-center bg-light py-4 rounded">
                    <i class="fa fa-user-o d-block"></i>
                    <span class="counter my-2 d-block" data-count="{{ $count_user }}">0</span>
                    <h5>Pengguna</h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="counter-content text-center bg-light py-4 rounded">
                    <i class="fa fa-shopping-cart d-block"></i>
                    <span class="counter my-2 d-block" data-count="{{ $count_transaction }}">0</span>
                    <h5>Transaksi Selesai</h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="counter-content text-center bg-light py-4 rounded">
                    <i class="fa fa-calendar d-block"></i>
                    <span class="counter my-2 d-block" data-count="2019">0</span>
                    <h5>Berdiri Sejak</h5>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection