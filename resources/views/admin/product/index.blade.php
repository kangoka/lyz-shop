@extends('layouts.app')

@section('assets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css">
@endsection

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Produk
                    <a class="float-right mr-4" data-toggle="tooltip" data-placement="top"
                                                        title="Tambah Produk" href="{{ route('admin.product.create') }}">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                    </h3>
                    <table class="table table-responsive product-dashboard-table" id="tabelProduk">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $product)
                                <tr>
                                    <td class="product-thumb">
                                        <img width="80px" height="auto" src="{{ url($product->image) }}"
                                            alt="image description"></td>
                                    <td class="product-details">
                                        <h3 class="title"><a href="{{ url('') }}/shop/product/{{ $product->slug }}">{{ $product->name }}</a></h3>
                                        @if ($product->is_listed == 1)
                                            <span class="status active"><strong>Status</strong>Listed</span>
                                        @else
                                            <span class="status" style="color: red"><strong>Status</strong>Unlisted</span>
                                        @endif
                                        <span class="location"><strong>Harga</strong>{{ $product->price }}</span>
                                        @if ($product->stock > 1)
                                            <span class="location"><strong>Stock</strong>{{ $product->stock }}</span>
                                        @else
                                            <span class="location" style="color: red"><strong>Stock</strong>{{ $product->stock }}</span>
                                        @endif
                                        <span class="location"><strong>Dibeli</strong>{{ $product->sold }} kali</span>
                                        <span class="location"><strong>Dilihat</strong>{{ $product->views }} kali</span>
                                    </td>
                                    <td class="product-category"><span class="categories">{{ $product->Category->name }}</span></td>
                                    <td class="action" data-title="Action">
                                        <div class="">
                                            <ul class="list-inline justify-content-center">
                                                <li class="list-inline-item">
                                                    <a class="edit" data-toggle="tooltip" data-placement="top" title="Ubah"
                                                        href="{{ url('admin/dashboard/product/edit/' . $product->id) }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="delete" data-toggle="tooltip" data-placement="top"
                                                        title="Hapus" href="{{ url('admin/dashboard/product/delete/' . $product->id) }}">
                                                        <i class="fa fa-trash"></i>
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
                {{-- <div class="pagination justify-content-center">
                {{ $data->links() }}
                </div> --}}
                <!-- pagination -->

            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>

<script>
    $(document).ready( function () {
        $('#tabelProduk').DataTable({
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });
});
</script>

@endsection
