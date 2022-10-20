@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Edit Blog Post</h3>
                    <form action="{{ url('admin/dashboard/blog/post/edit/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="p-4">
                            <label for="title">Judul</label>
                            <input type="text" name="title" class="border p-3 w-100 my-2" value="{{ $data->title }}">
                            <label for="category_id">Kategori</label>
                            <br>
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $data->category_id ? 'selected' : '' }}>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="status">Status</label>
                            <br>
                            <select class="form-control" name="status" id="status">
                                    <option value="1">Published</option>
                                    <option value="0">Not Published</option>
                            </select>
                            <br>
                            <label for="content">Konten</label>
                            <br>
                            <textarea name="content" id="content" cols="50" rows="10"
                            class="form-control">{{ $data->content }}</textarea>
                            <div class="container mt-2">
                                <div class="row justify-content-between">
                                    <input type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold" value="Edit Data" name="submit">
                                    <a href="{{ route('admin.blog.post.index') }}" class="d-block py-3 px-4 bg-danger text-white border-0 rounded font-weight-bold">Batal</a>
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
        var content = document.getElementById('content');
        CKEDITOR.replace(content, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;
    </script>
@endsection
