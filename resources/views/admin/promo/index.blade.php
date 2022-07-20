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
                    <div class="widget user-dashboard-menu accordion" id="accordion">
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}"></i> Dashboard</a></li>
                            <li><a href="{{ route('admin.order') }}"></i> Transaksi
                                    <span>{{ $count_transaction }}</span></a></li>
                            <li><a data-toggle="collapse" data-parent="#accordion" href="#productCol" role="button" aria-expanded="false"
                                    aria-controls="productCol"></i> Shop</a></li>
                            <div class="collapse" id="productCol">
                                <div class="card card-body">
                                    <li><a href="{{ route('admin.product.index') }}"></i>
                                            Produk<span>{{ $count_product }}</span></a></li>
                                            <li><a href="{{ route('admin.category.index') }}"></i> Kategori<span>{{ $count_category }}</span></a></li>
                                            <li><a href="{{ route('admin.promo.index') }}"></i> Promo</a></li>
                                        </div>
                            </div>
                            <li><a data-toggle="collapse" data-parent="#accordion" href="#blogCol" role="button" aria-expanded="false"
                                    aria-controls="blogCol"></i> Blog</a></li>
                            <div class="collapse" id="blogCol">
                                <div class="card card-body">
                                    <li><a href="{{ route('admin.blog.post.index') }}"></i>
                                            Post</a></li>
                                    <li><a href="{{ route('admin.blog.category.index') }}"></i> Kategori</a></li>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Promo
                    <a class="float-right mr-4" data-toggle="tooltip" data-placement="top"
                                                        title="Tambah Produk" href="{{ route('admin.promo.create') }}">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                    </h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Detail</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $promo)
                                <tr>
                                    <td class="product-thumb">
                                        {{ $promo->code }}</td>
                                    <td class="product-details">
                                        <span class="status"><strong>Diskon</strong>{{ $promo->discount }}%</span>
                                        <span class="status"><strong>Digunakan</strong>{{ $promo->used }} kali</span>
                                        <span class="location"><strong>Maksimal</strong>{{ $promo->max_use }}</span>
                                        @if ((new DateTime("now", new DateTimeZone('Asia/Jakarta')))->format("Y-m-d\TH:i:s") > date("Y-m-d\TH:i:s", strtotime($promo->expired_at)))
                                            <span class="location" style="color: red"><strong>Kadaluwarsa</strong>{{ $promo->expired_at }}</span>
                                        @else
                                            <span class="location" style="color: green"><strong>Kadaluwarsa</strong>{{ $promo->expired_at }}</span>
                                        @endif
                                    </td>
                                    <td class="action" data-title="Action">
                                        <div class="">
                                            <ul class="list-inline justify-content-center">
                                                <li class="list-inline-item">
                                                    <a class="edit" data-toggle="tooltip" data-placement="top" title="Ubah"
                                                        href="{{ url('admin/dashboard/promo/edit/' . $promo->id) }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <!-- pagination -->
                <div class="pagination justify-content-center">
                {{ $data->links() }}
                </div>
                <!-- pagination -->

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
@endsection
