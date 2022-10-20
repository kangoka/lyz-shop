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

        return view('blog', [
            'data' => $data,
            'category' => $this->blog_category
        ]);
    }

    public function blog_page(Post $post) {
        $data = Post::get()->where('slug', $post->slug);
        $data->first()->increment('views');

        return view('blog_view', [
            'data' => $data,
            'category' => $this->blog_category
        ]);
    }

    public function blog_category($category) {
        $category = BlogCategory::get()->where('name', $category);
        $data = Post::where('category_id', $category->first()->id)->where('status', 1)->paginate(5);
        
        return view('blog', [
            'data' => $data,
            'category' => $this->blog_category
        ]);
    }

    // Post
    public function index_post() {
        $data = Post::paginate(5);

        return view('admin.blog.post.index', [
            'data' => $data,
            'category' => $this->category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function create_post() {
        return view('admin.blog.post.create', [
            'category' => $this->blog_category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
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
        
        return view('admin.blog.post.edit', [
            'data' => $data,
            'category' => $this->category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
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
        return view('admin.blog.category.index', [
            'data' => $this->blog_category,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function create_category() {
        return view('admin.blog.category.create', [
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
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
        
        return view('admin.blog.category.edit', [
            'data' => $data,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
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
