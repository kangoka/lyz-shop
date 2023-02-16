@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist" id="result">
                    <h3 class="widget-header">Cek User</h3>
                    <form action="{{ url('admin/dashboard/promo/create') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset class="p-4">
                            <label for="userId">ID User</label><br>
                            <input type="text" name="userId" id="userId" class="border p-3 w-50 my-2">
                            <a href="#" onclick="checkUser()" class="py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">Cek</a><br>
                        </fieldset>
                    </form>
                    <div id="resultBox">

                    </div>
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
    function checkUser(){
        let userId = document.getElementById("userId").value;
        document.getElementById("resultDiv") != null ? document.getElementById("resultBox").innerHTML = '' : false
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.get('/admin/dashboard/check/userf/' + userId  + '/', function(data) {
                if (data.length != 0) {
                    let i = 0
                    while (i < data.length) {
                        let date = new Date(data[i].created_at)
                        let is_delivered = ''
                        let rating = ''
                        let comment = ''
                        let orderDetail = ''
                        if (data[i].is_delivered == 1) {
                            is_delivered = 'delivered'
                        } else {
                            is_delivered = 'not delivered'
                        }

                        if (data[i].is_reviewed == 0) {
                            rating = 'Belum ada review'
                            comment = 'Belum ada review'
                        } else {
                            rating = getRating(data[i].review.rating)
                            comment = data[i].review.comment
                        }

                        if (data[i].is_delivered == 0) {
                            orderDetail = 'Tidak tersedia'
                        } else {
                            orderDetail = data[i].order_modal
                        }
                        var html = '<div id="resultDiv">' + 
                        '<table class="table table-responsive product-dashboard-table">' + 
                        '                        <tbody>' + 
                        '                            <tr>' + 
                        '                                <td class="product-thumb">' + 
                        '                                    <img width="80px" height="auto" src="http://localhost:8000/' + data[i].product.image + '"' + 
                        '                                        alt="image description"></td>' + 
                        '                                <td class="product-details">' + 
                        '                                    <h3 class="title"></h3>' + 
                        '                                    <span class="add-id"><strong class="mr-2">Order ID</strong>' + data[i].midtrans_booking_code + '</span>' + 
                        '                                    <span><strong class="mr-2">Tangal</strong><time>' + date.toLocaleString() + '</time> </span>' + 
                        '                                    <span class="status"><strong class="mr-2">Status</strong>' + data[i].payment_status + ' / ' + is_delivered + '</span>' + 
                        '                                    <span class="location"><strong class="mr-2">Harga</strong>' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data[i].product.price) + '</span>' + 
                        '                                    <span class="location"><strong class="mr-2">User</strong>' + data[i].user.name + ' (' + data[i].user_id + ')</span>' + 
                        '                                </td>' + 
                        '                            </tr>' + 
                        '                        </tbody>' + 
                        '                    </table>' +  
                        '<strong>Detail Pesanan</strong><br>' + 
                        orderDetail + '<br>' +
                        '<strong>Review</strong><br>' + 
                        rating +
                        'Komentar: ' + comment + 
                        '</div>' + '<br>'

                        if (document.getElementById("resultDiv") == null) {
                            if (document.getElementById("notFound") !== null) {
                                document.getElementById("notFound").remove()
                            }
                            document.getElementById("resultBox").innerHTML += html
                        } else {
                            document.getElementById("resultBox").innerHTML += html
                        }

                        console.log("i", i)
                        i += 1
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

    function getRating(rating) {
        let star = ''
        for (let i = 1; i <= rating; i++) {
            star += '<li class="list-inline-item selected"><i class="fa fa-star"></i></li>'
        }

        let res = `<div class="product-ratings">
                        <ul class="list-inline">
                            ${star}
                        </ul>
                    </div>`

        return res
    }
</script>
@endsection