@extends('layouts.app')

@section('content')
<!--================================
=            Page Title            =
=================================-->
<section class="page-title">
    <!-- Container Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Title text -->
                <h3>Blog</h3>
            </div>
        </div>
    </div>
    <!-- Container End -->
</section>
<!--==================================
=            Blog Section            =
===================================-->

<section class="blog section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
                @foreach ($data as $post)
                <article>
                    <!-- Post Image -->
                    <div class="image">
                        <img src="{{ url($post->image) }}" alt="Gambar postingan">
                    </div>
                    <!-- Post Title -->
                    <h3>{{ $post->title }}</h3>
                    <ul class="list-inline">
                        <li class="list-inline-item">Diposting oleh Admin</p></li>
                        <li class="list-inline-item">{{ date('d M Y', strtotime($post->created_at)) }}</li>
                    </ul>
                    <!-- Post Description -->
                    <p>{!! substr($post->content, 0, 300) !!}</p>
                    <!-- Read more button -->
                    <a href="/blog/{{ $post->slug }}" class="btn btn-transparent">Baca Selengkapnya</a>
                </article>
                @endforeach
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    {{ $data->links() }}
                </nav>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
                <div class="sidebar">
                    <!-- Search Widget -->
                    <!-- <div class="widget search p-0">
                        <div class="input-group">
                            <input type="text" class="form-control" id="expire" placeholder="Search...">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        </div>
                    </div> -->
                    <!-- Category Widget -->
                    <div class="widget category">
                        <!-- Widget Header -->
                        <h5 class="widget-header">Kategori</h5>
                        <ul class="category-list">
                            @foreach ($category as $cat)
                            <li><a href="/blog/category/{{ $cat->name }}">{{ $cat->name }} <span class="float-right">({{ count(App\Models\Post::with('BlogCategory')->get()->where('category_id', $cat->id)->where('status', 1)) }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
