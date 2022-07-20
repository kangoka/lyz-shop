@extends('layouts.app')

@section('content')
<!--=================================
=            Single Blog            =
==================================-->


<section class="blog single-blog section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<article class="single-post">
					<h3>{{ $data->first()->title }}</h3>
					<ul class="list-inline">
						<li class="list-inline-item">Diposting oleh Admin</li>
						<li class="list-inline-item">{{ date('d M Y', strtotime($data->first()->created_at)) }}</li>
					</ul>
					<img src="{{ url($data->first()->image) }}" alt="article-01">
					{!! $data->first()->content !!}
					<ul class="social-circle-icons list-inline">
				  		<li class="list-inline-item text-center"><a class="fa fa-facebook" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-twitter" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-google-plus" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-pinterest-p" href=""></a></li>
				  		<li class="list-inline-item text-center"><a class="fa fa-linkedin" href=""></a></li>
				  	</ul>
				</article>
			</div>
			<div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
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