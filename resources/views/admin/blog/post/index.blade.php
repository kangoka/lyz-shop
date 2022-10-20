@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Blog
                        <a class="float-right mr-4" data-toggle="tooltip" data-placement="top"
                                                        title="Tambah Blog Post" href="{{ route('admin.blog.post.create') }}">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                    </h3>
                    <table class="table table-responsive product-dashboard-table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Post</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $post)
                                <tr>
                                    <td class="product-thumb">
                                        <img width="80px" height="auto" src="{{ url($post->image) }}"
                                            alt="image description"></td>
                                    <td class="product-details">
                                        <h3 class="title">{{ $post->title }}</h3>
                                        @if ($post->status == 1)
                                            <span class="status active"><strong>Status</strong>Published</span>
                                        @else
                                            <span class="status" style="color: red"><strong>Status</strong>Not published</span>
                                        @endif
                                        <span class="location"><strong>Views</strong>{{ $post->views }}</span>
                                        <span class="location"><strong>Created</strong>{{ $post->created_at }}</span>
                                    </td>
                                    <td class="product-category"><span class="categories">{{ $post->category_id }}</span></td>
                                    <td class="action" data-title="Action">
                                        <div class="">
                                            <ul class="list-inline justify-content-center">
                                                <li class="list-inline-item">
                                                    <a class="edit" data-toggle="tooltip" data-placement="top" title="Ubah"
                                                        href="{{ url('admin/dashboard/blog/post/edit/' . $post->id) }}">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="delete" data-toggle="tooltip" data-placement="top"
                                                        title="Hapus" href="{{ url('admin/dashboard/blog/post/delete/' . $post->id) }}">
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
