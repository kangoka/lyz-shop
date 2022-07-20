@extends('layouts.app')

@section('content')
<!--==================================
=            User Profile            =
===================================-->
<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                <div class="sidebar">
                    <!-- User Widget -->
                    <div class="widget user-dashboard-profile">
                        <!-- User Image -->
                        <div class="profile-thumb">
                            <img src="{{ Auth::user()->avatar }}" alt="" class="rounded-circle">
                        </div>
                        <!-- User Name -->
                        <h5 class="text-center">{{ Auth::user()->name }}</h5>
                        <p>Bergabung pada {{ Auth::user()->email_verified_at }}</p>
                    </div>
                    <!-- Dashboard Links -->
                    <div class="widget user-dashboard-menu">
                        <ul>
                            <li><a href="{{ route('user.dashboard') }}"></i> Dashboard</a></li>
                            <li><a href="{{ route('user.transaction.waiting') }}"></i> Menunggu Pembayaran
                                    <span>{{ $count_waiting }}</span></a></li>
                            <li><a href="{{ route('user.transaction.success') }}"></i> Belum Dikirim
                                    <span>{{ $count_success }}</span></a></li>
                            <li><a href="{{ route('user.transaction.complete') }}"></i> Transaksi Selesai
                                    <span>{{ $count_complete }}</span></a></li>
                            <li><a href="{{ route('user.transaction.failed') }}"></i>Transaksi Gagal
                                    <span>{{ $count_failed }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Dashboard</h3>
                    <h4>Halo, maaf sementara menu ini sedang dalam tahap pengembangan</h4>
                </div>

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
@endsection
