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
                <div class="widget dashboard-container my-adslist" id="result">
                    <h3 class="widget-header">Cek Order</h3>
                    <form action="{{ url('admin/dashboard/promo/create') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset class="p-4">
                            <label for="code">Kode Pembelian</label><br>
                            <input type="text" name="code" id="code" class="border p-3 w-50 my-2">
                            <a href="#" onclick="checkOrder()" class="py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">Cek</a><br>
                        </fieldset>
                    </form>
                    {{-- <div id="result">

                    </div> --}}
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

<script>
    function checkOrder(){
        let code = document.getElementById("code").value;
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.get('/admin/dashboard/check/orderf/' + code  + '/', function(data) {
                if (data.length != 0) {
                    let date = new Date(data[0].created_at)
                    let is_delivered = ''
                    let rating = ''
                    let comment = ''
                    let orderDetail = ''
                    if (data[0].is_delivered == 1) {
                        is_delivered = 'delivered'
                    } else {
                        is_delivered = 'not delivered'
                    }

                    if (data[0].is_reviewed == 0) {
                        rating = 'Belum ada review'
                        comment = 'Belum ada review'
                    } else {
                        rating = data[0].review.rating
                        comment = data[0].review.comment
                    }

                    if (data[0].is_delivered == 0) {
                        orderDetail = 'Tidak tersedia'
                    } else {
                        orderDetail = data[0].order_modal
                    }
                    var html = '<div id="resultDiv">' + 
                    '<table class="table table-responsive product-dashboard-table">' + 
                    '                        <tbody>' + 
                    '                            <tr>' + 
                    '                                <td class="product-thumb">' + 
                    '                                    <img width="80px" height="auto" src="http://localhost:8000/' + data[0].product.image + '"' + 
                    '                                        alt="image description"></td>' + 
                    '                                <td class="product-details">' + 
                    '                                    <h3 class="title"></h3>' + 
                    '                                    <span class="add-id"><strong class="mr-2">Order ID</strong>' + data[0].midtrans_booking_code + '</span>' + 
                    '                                    <span><strong class="mr-2">Tangal</strong><time>' + date.toLocaleString() + '</time> </span>' + 
                    '                                    <span class="status"><strong class="mr-2">Status</strong>' + data[0].payment_status + ' / ' + is_delivered + '</span>' + 
                    '                                    <span class="location"><strong class="mr-2">Harga</strong>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data[0].product.price) + '</span>' + 
                    '                                    <span class="location"><strong class="mr-2">User</strong>' + data[0].user.name + '</span>' + 
                    '                                </td>' + 
                    '                            </tr>' + 
                    '                        </tbody>' + 
                    '                    </table>' +  
                    '<strong>Detail Pesanan</strong><br>' + 
                    orderDetail + '<br>' +
                    '<strong>Review</strong><br>' + 
                    'Rating: ' + rating + '<br>' +
                    'Komentar: ' + comment + 
                    '</div>'

                    if (document.getElementById("resultDiv") == null) {
                        if (document.getElementById("notFound") !== null) {
                            document.getElementById("notFound").remove()
                        }
                        document.getElementById("result").innerHTML += html
                    } else {
                        document.getElementById("resultDiv").remove()
                        document.getElementById("result").innerHTML += html
                    }
                    
                } else {
                    if (document.getElementById("notFound") == null) {
                        if (document.getElementById("resultDiv") !== null) {
                            document.getElementById("resultDiv").remove() 
                        }    
                        document.getElementById("result").innerHTML += '<p id="notFound">Data tidak ditemukan</p>'
                    } else {
                        document.getElementById("notFound").remove()
                        document.getElementById("result").innerHTML += '<p id="notFound">Data tidak ditemukan</p>'
                    }
                }
            })
    }
</script>
@endsection