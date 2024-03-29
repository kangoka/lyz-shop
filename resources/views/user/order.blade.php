@extends('layouts.app')

@section('content')
@include('components.user_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Transaksi</h3>
                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger">
                            <p class="h3 text-black">Kesalahan</p>
                            <ul>
                                <?php foreach (session('error') as $error) : ?>
                                <li><?= $error ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <td class="product-thumb">
                                    <img width="80px" height="auto" src="{{ url($data->Product->image) }}"
                                        alt="image description"></td>
                                <td class="product-details">
                                    <h3 class="title">{{ $data->Product->name }}</h3>
                                    <span class="add-id"><strong class="mr-2">Order
                                            ID</strong>{{ $data->midtrans_booking_code }}</span>
                                    <span><strong class="mr-2">Tangal</strong><time>{{ $data->created_at }}</time>
                                    </span>
                                    <span class="status"><strong
                                            class="mr-2">Status</strong>{{ $data->payment_status ?? '' }}</span>
                                    <span class="status"><strong
                                            class="mr-2">Kuantitas</strong>{{ $data->quantity ?? '' }}</span>
                                    <span class="location"><strong class="mr-2">Harga</strong>Rp.
                                        {{ number_format($data->price, 0, '', '.') }}</span>
                                </td>
                                <td class="action" data-title="Action">
                                    <div class="">
                                        <ul class="list-inline justify-content-center">
                                            @if ($data->payment_status == 'paid')
                                            @if ($data->is_delivered == 1)
                                            <!-- Modal Pesanan -->
                                            <div class="modal fade" id="orderModal{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                Pesanan
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <textarea cols="30" rows="10"
                                                                disabled>{{ $data->order_modal }}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <li class="list-inline-item">
                                                <a data-toggle="modal" data-target="#orderModal{{ $data->id }}"
                                                    class="view" href="#" disabled>
                                                    <i class="fa fa-eye" data-toggle="tooltip" data-placement="top"
                                                        title="Lihat pesanan"></i>
                                                </a>
                                                @if ($data->is_reviewed == 0)
                                                <a class="edit" href="{{ route('user.review.get', $data->midtrans_booking_code) }}" disabled>
                                                    <i class="fa fa-star" data-toggle="tooltip" data-placement="top"
                                                        title="Berikan review"></i>
                                                </a>
                                                @endif
                                                <a target="_blank"
                                                    class="delete" href="https://api.whatsapp.com/send?phone=6281327705067" disabled>
                                                    <i class="fa fa-exclamation" data-toggle="tooltip" data-placement="top"
                                                        title="Komplain"></i>
                                                </a>
                                            </li>
                                            @else
                                            <li class="list-inline-item">
                                                <a data-toggle="tooltip" data-placement="top"
                                                    title="Pesanan belum dikirim" class="delete" href="#" disabled>
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </li>
                                            @endif
                                            @elseif ($data->payment_status == 'waiting')
                                            <li class="list-inline-item">
                                                <a class="edit" data-toggle="tooltip" data-placement="top" title="Bayar"
                                                    href="{{ $data->midtrans_url }}">
                                                    <i class="fa fa-money"></i>
                                                </a>
                                            </li>
                                            @elseif ($data->payment_status == 'failed' || $data->payment_status ==
                                            'expire')
                                            <li class="list-inline-item">
                                                <a class="delete" data-toggle="tooltip" data-placement="top"
                                                    title="Transaksi gagal" href="#">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                            </li>
                                            @endif
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
                    {{ $data_pagination->links() }}
                </div>
                <!-- pagination -->

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
@endsection

@section('js')
<script>
    $('#addStar').change('.star', function (e) {
        $(this).submit();
    });

</script>
@endsection
