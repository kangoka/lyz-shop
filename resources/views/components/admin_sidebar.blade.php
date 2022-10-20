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
                            <li><a data-toggle="collapse" data-parent="#accordion" href="#transactionCol" role="button" aria-expanded="false"
                                aria-controls="transactionCol"></i> Transaksi</a></li>
                            <div class="collapse" id="transactionCol">
                                <div class="card card-body">
                                    <li><a href="{{ route('admin.order') }}"></i> Perlu Diproses<span>{{ $count_transaction }}</span></a></li>
                                    <li><a href="{{ route('admin.order.all') }}"></i> Semua Transaksi</a></li>
                                </div>
                            </div>
                            <li><a data-toggle="collapse" data-parent="#accordion" href="#productCol" role="button" aria-expanded="false"
                                    aria-controls="productCol"></i> Shop</a></li>
                            <div class="collapse" id="productCol">
                                <div class="card card-body">
                                    <li><a href="{{ route('admin.product.index') }}"></i> Produk<span>{{ $count_product }}</span></a></li>
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
                            <li><a data-toggle="collapse" data-parent="#accordion" href="#checkCol" role="button" aria-expanded="false"
                                aria-controls="checkCol"></i> Cek</a></li>
                            <div class="collapse" id="checkCol">
                                <div class="card card-body">
                                    <li><a href="{{ route('admin.check.order') }}"></i>
                                            Order</a></li>
                                    <li><a href="{{ route('admin.check.user') }}"></i> User</a></li>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>