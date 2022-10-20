@extends('layouts.app')

@section('content')
<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-result bg-gray">
                    <h2>Menampilkan produk dengan kategori: {{ $cat_name }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="category-sidebar">
                    <div class="widget category-list">
                        <h4 class="widget-header">Kategori</h4>
                        <ul class="category-list">
                            <li><a href="{{ route('shop.all') }}">Semua <span>{{ $all }}</span></a></li>
                            @foreach ($category as $category)
                                @if (count(App\Models\Product::with('Category')->get()->where('category_id', $category->id)->where('is_listed', 1)->where('stock', '>', 0)) > 0)
                                    <li><a href="/shop/{{ $category->name }}">{{ $category->name }} <span>{{ count(App\Models\Product::with('Category')->get()->where('category_id', $category->id)->where('is_listed', 1)->where('stock', '>', 0)) }}</span></a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="category-search-filter">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Tampilkan</strong>
                            <select id="sort">
                                <option>Terbaru</option>
                                <option value="1">Populer</option>
                                <option value="2">Harga Terendah</option>
                                <option value="3">Harga Termahal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="product-grid-list">
                    <div class="row mt-30">
                        @foreach ($product as $product)
                        <div class="col-sm-12 col-lg-4 col-md-6">
                            <!-- product card -->
                            <div class="product-item bg-light">
                                <div class="card">
                                    <div class="thumb-content">
                                        <div class="price">Rp. {{ number_format($product->price, 0, '', '.') }}</div>
                                        <a href="/shop/product/{{ $product->slug }}">
                                            <img class="card-img-top img-fluid" src="{{ url($product->image) }}"
                                                alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="/shop/product/{{ $product->slug }}">{{ $product->name }}</a></h4>
                                        <ul class="list-inline product-meta">
                                            <li class="list-inline-item">
                                                <a href="/shop/{{ $product->Category->name }}"><i class="fa fa-folder-open-o"></i>{{ $product->Category->name }}</a>
                                            </li>
                                        </ul>
                                        <!-- <div class="product-ratings">
                                            <ul class="list-inline">
                                                <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                                <li class="list-inline-item selected"><i class="fa fa-star"></i></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="pagination justify-content-center">
                {{ $product_pagination->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
