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
                    <h3 class="widget-header">Promo
                    <a class="float-right mr-4" data-toggle="tooltip" data-placement="top"
                                                        title="Tambah Produk" href="{{ route('admin.promo.create') }}">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                    </h3>
                    <table class="table table-responsive product-dashboard-table" id="tabelPromo">
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
        $('#tabelPromo').DataTable({
            pageLength : 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]]
        });
});
</script>

@endsection
