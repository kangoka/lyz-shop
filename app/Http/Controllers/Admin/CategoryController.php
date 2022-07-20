<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Product;
use Str;

class CategoryController extends Controller
{
    public function index() {
        $data = Category::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($data);
        return view('admin.category.index', compact('data', 'count_transaction', 'count_product', 'count_category'));
    }
    
    public function create() {
        $category = Category::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.category.create', compact('count_transaction', 'count_product', 'count_category'));
    }

    public function insert(Request $request) {
        // $request->validate(Product::$rules);
        $requests = $request->all();

        $category = Category::create($requests);
        if($category){
            return redirect('admin/dashboard/category');
        }

        return redirect('admin/dashboard/category');
    }

    public function edit($id) {
        $data = Category::find($id);
        $category = Category::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.category.edit', compact('data', 'category', 'count_transaction', 'count_product', 'count_category'));
    }

    public function update(Request $request, $id) {
        $d = Category::find($id);
        if ($d == null) {
            return redirect('admin/dashboard/category');
        }

        $req = $request->all();

        $data = Category::find($id)->update($req);
        if($data) {
            return redirect('admin/dashboard/category');
        }
        
        return redirect('admin/dashboard/category');
    }

    public function delete($id) {
        $data = Category::find($id);
        if($data == null){
            return redirect('admin/dashboard/category');
        }
        $delete = $data->delete();
        if($delete) {
            return redirect('admin/dashboard/category');
        }
        return redirect('admin/dashboard/category');
    }
}

