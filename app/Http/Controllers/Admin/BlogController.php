<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Product;
use Str;
use File;

class BlogController extends Controller
{
    public function index() {
        $data = Post::where('status', 1)->latest()->paginate(5);
        $category = BlogCategory::get();
        return view('blog', compact('data', 'category'));
    }

    public function blog_page(Post $post) {
        $data = Post::get()->where('slug', $post->slug);

        $data->first()->increment('views');
        $category = BlogCategory::get();
        return view('blog_view', compact('data', 'category'));
    }

    public function blog_category($category) {
        $category = BlogCategory::get()->where('name', $category);
        $data = Post::where('category_id', $category->first()->id)->where('status', 1)->paginate(5);
        $category = BlogCategory::get();
        
        return view('blog', [
            'data'               => $data,
            'category'           => $category,
        ]);
    }

    // Post
    public function index_post() {
        $data_product = Product::get();
        $data = Post::paginate(5);
        $category = Category::get();

        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.blog.post.index', compact('data', 'category', 'count_transaction', 'count_product', 'count_category'));
    }

    public function create_post() {
        $category = BlogCategory::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.blog.post.create', compact('category', 'count_transaction', 'count_product', 'count_category'));
    }

    public function insert_post(Request $request) {
        // $request->validate(Product::$rules);
        $requests = $request->all();
        $requests['slug'] = "";
        $requests['slug'] = Str::slug($request->title);
        $requests['image'] = "";
        if ($request->hasFile('image')) {
            $files = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/blog", $files);
            $requests['image'] = "file/blog/" . $files;
        }

        $post = Post::create($requests);
        if($post){
            return redirect('admin/dashboard/blog/post');
        }

        return redirect('admin/dashboard/blog/post');
    }

    public function edit_post($id) {
        $data = Post::find($id);
        $category = BlogCategory::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.blog.post.edit', compact('data', 'category', 'count_transaction', 'count_product', 'count_category'));
    }

    public function update_post(Request $request, $id) {
        $d = Post::find($id);
        if ($d == null) {
            return redirect('admin/dashboard/blog/post');
        }

        $req = $request->all();

        $req['slug'] = "";
        $req['slug'] = Str::slug($request->title);

        if($request->hasFile('image')){
            if($d->image !== null) {
                File::delete("$d->image");
            }
            $post = Str::random("20") . "-" . $request->image->getClientOriginalName();
            $request->file('image')->move("file/post/", $post);
            $req['image'] = "file/post/" . $post;
        }

        $data = Post::find($id)->update($req);
        if($data) {
            return redirect('admin/dashboard/blog/post');
        }
        
        return redirect('admin/dashboard/blog/post');
    }

    public function delete_post($id) {
        $data = Post::find($id);
        if($data == null){
            return redirect('admin/dashboard/blog/post');
        }
        if($data->image !== null || $data->image !== "") {
            File::delete("$data->image");
        }
        $delete = $data->delete();
        if($delete) {
            return redirect('admin/dashboard/blog/post');
        }
        return redirect('admin/dashboard/blog/post');
    }

    // Category
    public function index_category() {
        $data = BlogCategory::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($data);
        return view('admin.blog.category.index', compact('data', 'count_transaction', 'count_product', 'count_category'));
    }

    public function create_category() {
        $category = Category::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.blog.category.create', compact('count_transaction', 'count_product', 'count_category'));
    }

    public function insert_category(Request $request) {
        // $request->validate(Product::$rules);
        $requests = $request->all();

        $category = BlogCategory::create($requests);
        if($category){
            return redirect('admin/dashboard/blog/category');
        }

        return redirect('admin/dashboard/blog/category');
    }

    public function edit_category($id) {
        $data = BlogCategory::find($id);
        $category = Category::get();

        $data_product = Product::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.blog.category.edit', compact('data', 'category', 'count_transaction', 'count_product', 'count_category'));
    }

    public function update_category(Request $request, $id) {
        $d = BlogCategory::find($id);
        if ($d == null) {
            return redirect('admin/dashboard/blog/category');
        }

        $req = $request->all();

        $data = BlogCategory::find($id)->update($req);
        if($data) {
            return redirect('admin/dashboard/blog/category');
        }
        
        return redirect('admin/dashboard/blog/category');
    }

    public function delete_category($id) {
        $data = BlogCategory::find($id);
        if($data == null){
            return redirect('admin/dashboard/blog/category');
        }
        $delete = $data->delete();
        if($delete) {
            return redirect('admin/dashboard/blog/category');
        }
        return redirect('admin/dashboard/blog/category');
    }
}
