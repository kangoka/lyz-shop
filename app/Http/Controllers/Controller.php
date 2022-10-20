<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Post;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Product;
use Auth;
use Midtrans;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;
    public function __construct()
    {
        // Admin
        $this->blog_category = BlogCategory::get();
        $this->category = Category::get();
        $this->count_transaction = count(Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0));
        $this->count_product = count(Product::get());
        $this->count_category = count(Category::get());

        // Midtrans
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }
}
