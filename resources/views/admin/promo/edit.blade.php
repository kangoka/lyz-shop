@extends('layouts.app')

@section('assets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css"> 
@endsection

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
                    <h3 class="widget-header">Edit Produk</h3>
                    <form action="{{ url('admin/dashboard/promo/edit/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="p-4">
                            <label for="code">Kode</label><br>
                            <input type="text" name="code" id="code" class="border p-3 w-50 my-2" value="{{ $data->code }}">
                            <a href="#" onclick="generateCode()" class="py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">Generate</a><br>
                            <label for="max_use">Discount (%)</label>
                            <input type="number" name="discount" class="border p-3 w-100 my-2" value="{{ $data->discount }}">
                            <label for="max_use">Batas Penggunaan (per user)</label>
                            <input type="number" name="max_use" class="border p-3 w-100 my-2" value="{{ $data->max_use }}">
                            <label for="expired_at">Kadaluwarsa</label>
                            <!-- <input type="text" name="expired_at" id="CalendarDateTime" class="border p-3 w-100 my-2" /> -->
                            <input type="datetime-local" name="expired_at" class="border p-3 w-100 my-2" value="{{ date('Y-m-d\TH:i:s', strtotime($data->expired_at)) }}" />
                            <br>
                            <input type="submit"
                                class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold"
                                value="Ubah Kode" name="submit">
                            <br>
                            <a href="{{ route('admin.promo.index') }}"
                                class="d-block py-3 px-4 bg-danger text-white border-0 rounded font-weight-bold">Batal</a>
                        </fieldset>
                    </form>
                </div>

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#CalendarDateTime').datetimepicker({
            format: "YYYY-MM-DD hh:mm:ss"
        });
    });
</script>

<script>
    function generateCode(){
        var code = 'LYZ-' + (Math.random().toString(36).substr(2, 5)).toUpperCase();
        document.getElementById("code").value = code;
    }
</script>
@endsection
