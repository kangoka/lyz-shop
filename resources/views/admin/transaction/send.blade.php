@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Kirim Pesanan</h3>
                    <form action="{{ route('admin.send.deliver', $data->id) }}" method="POST">
                        @csrf
                        <fieldset class="p-4">
                            <label for="category_id">Detail Pesanan</label>
                            <br>
                            <textarea name="order_modal" id="order_modal" cols="50" rows="10"
                            class="form-control"></textarea>
                            <div class="container mt-2">
                                <div class="row justify-content-between">
                                    <input type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold" value="Kirim Pesanan" name="submit">
                                    <a href="{{ route('admin.product.index') }}" class="d-block py-3 px-4 bg-danger text-white border-0 rounded font-weight-bold">Batal</a>
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


