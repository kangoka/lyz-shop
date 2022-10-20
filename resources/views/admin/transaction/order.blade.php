@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
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
                                    <span class="location"><strong class="mr-2">User</strong>{{ $datas->User->name }} ({{ $datas->user_id }})</span>
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
