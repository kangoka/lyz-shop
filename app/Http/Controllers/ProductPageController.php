<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;

class ProductPageController extends Controller
{
    public function page(Product $product)
    {
        $product = Product::with('Category')->get()->where('slug', $product->slug)->where('is_listed', 1);
        
        if ($product->isEmpty()) {
            return abort(404);
        }

        $category = Category::get();

        $reviews = Review::where('product_id', $product->first()->id)->latest()->take(5)->get();

        $product->first()->increment('views');

        return view('product', [
            'product'  => $product,
            'category' => $category,
            'reviews'  => $reviews
        ]);
    }
}
