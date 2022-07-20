<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $product = Product::with('Category')->where('is_listed', 1)->paginate(9);
        $product_pagination = Product::where('is_listed', 1)->paginate(9);
        $category = Category::get();
        $cat_name = 'Semua';

        $all = count(Product::get()->where('is_listed', 1));

        return view('shop', [
            'product'  => $product,
            'category' => $category,
            'cat_name' => $cat_name,
            'all'      => $all,
            'product_pagination' => $product_pagination
        ]);
    }

    public function cheap()
    {
        $product = Product::with('Category')->where('is_listed', 1)->orderBy('price', 'asc')->paginate(9);
        $product_pagination = Product::where('is_listed', 1)->orderBy('price', 'asc')->paginate(9);
        $category = Category::get();
        $cat_name = 'Semua';

        return $product;

        $all = count(Product::get()->where('is_listed', 1));

        return view('shop', [
            'product'  => $product,
            'category' => $category,
            'cat_name' => $cat_name,
            'all'      => $all,
            'product_pagination' => $product_pagination
        ]);
    }

    public function category(Category $category)
    {
        $cat_name = $category->name;
        $product = Product::with('Category')->where('category_id', $category->id)->where('is_listed', 1)->paginate(9);
        $product_pagination = Product::where('category_id', $category->id)->where('is_listed', 1)->paginate(9);
        $category = Category::get();
        $all = count(Product::get()->where('is_listed', 1));
        
        return view('shop', [
            'product'            => $product,
            'category'           => $category,
            'cat_name'           => $cat_name,
            'all'                => $all,
            'product_pagination' => $product_pagination
        ]);
    }
}
