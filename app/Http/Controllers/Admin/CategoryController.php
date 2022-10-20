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
        return view('admin.category.index', [
            'data' => $this->category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }
    
    public function create() {
        return view('admin.category.create', [
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
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

        return view('admin.category.edit', [
            'data' => $data,
            'category' => $this->category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
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

