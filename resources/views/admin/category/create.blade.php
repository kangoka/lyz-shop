@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Tambah Kategori</h3>
                    <form action="{{ url('admin/dashboard/category/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="p-4">
                            <label for="name">Nama Kategori</label>
                            <input type="text" name="name" class="border p-3 w-100 my-2">
                            <div class="container">
                                <div class="row justify-content-between">
                                    <input type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold" value="Tambah Data" name="submit">
                                    <a href="{{ route('admin.category.index') }}" class="d-block py-3 px-4 bg-danger text-white border-0 rounded font-weight-bold">Batal</a>
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
