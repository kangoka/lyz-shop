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
                    <h3 class="widget-header">Transaksi</h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $datas)
                            <tr>
                                <td class="product-thumb">
                                    <img width="80px" height="auto" src="{{ url($datas->Product->image) }}"
                                        alt="image description"></td>
                                <td class="product-details">
                                    <h3 class="title">{{ $datas->Product->name }}</h3>
                                    <span class="add-id"><strong class="mr-2">Order ID</strong>{{ $datas->midtrans_booking_code }}</span>
                                    <span><strong class="mr-2">Tangal</strong><time>{{ $datas->created_at }}</time> </span>
                                    <span class="status"><strong class="mr-2">Status</strong>{{ $datas->payment_status ?? '' }}</span>
                                    <span class="location"><strong class="mr-2">Harga</strong>Rp. {{ number_format($datas->Product->price, 0, '', '.') }}</span>
                                    <span class="location"><strong class="mr-2">User</strong>{{ $datas->user_id }}</span>
                                </td>
                                <td class="action" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                            <li class="list-inline-item">
                                                <a data-toggle="tooltip" data-placement="top" title="Kirim pesanan" class="view"
                                                    href="{{ route('admin.send.get', $datas->id) }}" disabled>
                                                    <i class="fa fa-paper-plane"></i>
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
