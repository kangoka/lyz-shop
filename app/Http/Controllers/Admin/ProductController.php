<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Checkout;
use Str;

class ProductController extends Controller
{
    protected $category;
    protected $count_transaction;
    protected $count_product;
    protected $count_category;

    public function __construct()
    {
        $this->category = Category::get();
        $this->count_transaction = count(Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0));
        $this->count_product = count(Product::get());
        $this->count_category = count(Category::get());
    }

    public function index() {
        $data = Product::paginate(5);
        
        return view('admin.product.index', [
            'data' => $data,
            'category' => $this->category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }
    
    public function create() {
        return view('admin.product.create', [
            'category' => $this->category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function insert(Request $request) {
        // $request->validate(Product::$rules);
        $requests = $request->all();
        $requests['slug'] = "";
        $requests['slug'] = Str::slug($request->name);
        $requests['image'] = "";
        if ($request->hasFile('image')) {
            $files = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/product", $files);
            $requests['image'] = "file/product/" . $files;
        }

        $product = Product::create($requests);
        if($product){
            return redirect('admin/dashboard/product');
        }

        return redirect('admin/dashboard/product');
    }

    public function edit($id) {
        $data = Product::find($id);

        return view('admin.product.edit', [
            'data' => $data,
            'category' => $this->category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function update(Request $request, $id) {
        $d = Product::find($id);
        if ($d == null) {
            return redirect('admin/dashboard/product');
        }

        $req = $request->all();

        $req['slug'] = "";
        $req['slug'] = Str::slug($request->name);

        if($request->hasFile('image')){
            if($d->image !== null) {
                File::delete("$d->image");
            }
            $product = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/product/", $product);
            $req['image'] = "file/product/" . $product;
        }

        $data = Product::find($id)->update($req);
        if($data) {
            return redirect('admin/dashboard/product');
        }
        
        return redirect('admin/dashboard/product');
    }

    public function delete($id) {
        $data = Product::find($id);
        if($data == null){
            return redirect('admin/dashboard/product');
        }
        if($data->image !== null || $data->image !== "") {
            File::delete("$data->image");
        }
        $delete = $data->delete();
        if($delete) {
            return redirect('admin/dashboard/product');
        }
        return redirect('admin/dashboard/product');
    }
}
