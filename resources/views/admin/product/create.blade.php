@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Tambah Produk</h3>
                    <form action="{{ url('admin/dashboard/product/create') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset class="p-4">
                            <label for="name">Nama Produk</label>
                            <input type="text" name="name" class="border p-3 w-100 my-2">
                            <label for="price">Harga Produk</label>
                            <input type="number" name="price" class="border p-3 w-100 my-2">
                            <label for="stock">Stok Produk</label>
                            <input type="number" name="stock" class="border p-3 w-100 my-2">
                            <label for="field">Field</label>
                            <input type="text" name="field" class="border p-3 w-100 my-2">
                            <label for="category_id">Kategori Produk</label>
                            <br>
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach ($category as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="category_id">Visibilitas</label>
                            <br>
                            <select class="form-control" name="is_listed" id="is_listed">
                                <option value="1">Listed</option>
                                <option value="0">Unlisted</option>
                            </select>
                            <br>
                            <label for="image">Gambar Produk</label>
                            <input type="file" name="image" class="form-control">
                            <label for="category_id">Detail Produk</label>
                            <br>
                            <textarea name="details" id="details" cols="50" rows="10" class="form-control"></textarea>
                            <div class="container mt-2">
                                <div class="row justify-content-between">
                                    <input type="submit"
                                        class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold"
                                        value="Tambah Data" name="submit">
                                    <a href="{{ route('admin.product.index') }}"
                                        class="d-block py-3 px-4 bg-danger text-white border-0 rounded font-weight-bold">Batal</a>
                                </div>
                            </div>
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
<script src="{{ url('assets/ckeditor/ckeditor.js') }}"></script>
<script>
    var details = document.getElementById('details');
    CKEDITOR.replace(details, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;

</script>
@endsection
