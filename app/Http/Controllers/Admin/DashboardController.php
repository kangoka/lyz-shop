<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);
        $data_product = Product::get();
        $data_category = Category::get();

        $count_transaction = count($data);
        $count_product = count($data_product);
        $count_category = count($data_category);

        return view('admin.dashboard', [
            'count_transaction' => $count_transaction,
            'count_product'     => $count_product,
            'count_category'    => $count_category,
        ]);
    }

    public function order() {
        $data = Checkout::with('Product')->where('payment_status', 'paid')->where('is_delivered', 0)->paginate(5);
        $data_product = Product::get();
        $data_category = Category::get();

        $count_transaction = count($data);
        $count_product = count($data_product);
        $count_category = count($data_category);

        return view('admin.order', [
            'data'              => $data,
            'count_transaction' => $count_transaction,
            'count_product'     => $count_product,
            'count_category'    => $count_category,
        ]);
    }
}
