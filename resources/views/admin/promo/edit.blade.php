@extends('layouts.app')

@section('assets')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  --}}
@endsection

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Edit Promo</h3>
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
                            <div class="container">
                                <div class="row justify-content-between">
                                    <input type="submit"
                                        class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold"
                                        value="Edit Promo" name="submit">
                                    <br>
                                    <a href="{{ route('admin.promo.index') }}"
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
