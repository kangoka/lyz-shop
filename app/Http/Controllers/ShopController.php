<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $product = Product::with('Category')->where('is_listed', 1)->where('stock', '>', 0)->orderBy('created_at', 'desc')->paginate(9);
        $product_pagination = Product::where('is_listed', 1)->where('stock', '>', 0)->orderBy('created_at', 'desc')->paginate(9);
        $category = Category::get();
        $cat_name = 'Semua';

        $all = count(Product::get()->where('is_listed', 1)->where('stock', '>', 0));

        return view('shop', [
            'product'  => $product,
            'category' => $category,
            'cat_name' => $cat_name,
            'all'      => $all,
            'count'    => count($product),
            'product_pagination' => $product_pagination
        ]);
    }

    public function category(Category $category)
    {
        $cat_name = $category->name;
        $product = Product::with('Category')->where('category_id', $category->id)->where('is_listed', 1)->where('stock', '>', 0)->paginate(9);
        $product_pagination = Product::where('category_id', $category->id)->where('is_listed', 1)->where('stock', '>', 0)->paginate(9);
        $category = Category::get();
        $all = count(Product::get()->where('is_listed', 1)->where('stock', '>', 0));
        
        return view('shop', [
            'product'            => $product,
            'category'           => $category,
            'cat_name'           => $cat_name,
            'all'                => $all,
            'count'              => count($product),
            'product_pagination' => $product_pagination
        ]);
    }

    public function sort($sort) {
        if ($sort == 'popular') {
            $product = Product::with('Category')->where('stock', '>', 0)->where('is_listed', 1)->orderBy('sold', 'desc')->paginate(9);
            $product_pagination = Product::where('is_listed', 1)->where('stock', '>', 0)->orderBy('sold', 'desc')->paginate(9);
        } else if ($sort == 'lowest') {
            $product = Product::with('Category')->where('stock', '>', 0)->where('is_listed', 1)->orderBy('price', 'asc')->paginate(9);
            $product_pagination = Product::where('is_listed', 1)->where('stock', '>', 0)->orderBy('price', 'asc')->paginate(9);
        } else if ($sort == 'highest') {
            $product = Product::with('Category')->where('stock', '>', 0)->where('is_listed', 1)->orderBy('price', 'desc')->paginate(9);
            $product_pagination = Product::where('is_listed', 1)->where('stock', '>', 0)->orderBy('price', 'desc')->paginate(9);
        } else if ($sort == 'newest') {
            $product = Product::with('Category')->where('stock', '>', 0)->where('is_listed', 1)->orderBy('created_at', 'desc')->paginate(9);
            $product_pagination = Product::where('is_listed', 1)->where('stock', '>', 0)->orderBy('created_at', 'desc')->paginate(9);
        }

        $category = Category::get();
        $cat_name = 'Semua';

        $all = count(Product::get()->where('is_listed', 1)->where('stock', '>', 0));

        return view('shop', [
            'product'  => $product,
            'category' => $category,
            'cat_name' => $cat_name,
            'all'      => $all,
            'count'    => count($product),
            'product_pagination' => $product_pagination
        ]);
    }
}
