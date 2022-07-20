<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class CheckController extends Controller
{
    public function orderPage()
    {
        $data_product = Product::get();
        $category = Category::get();
        $data_transaction = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);

        $count_transaction = count($data_transaction);
        $count_product = count($data_product);
        $count_category = count($category);
        return view('admin.check.order', [
            'count_transaction' => $count_transaction,
            'count_product'     => $count_product,
            'count_category'    => $count_category,
        ]);
    }

    public function order($code)
    {
        $data = Checkout::with('Product', 'User', 'Review')->where('midtrans_booking_code', $code)->get();
        return $data;
    }

    public function user()
    {
        return view('admin.check.user');
    }
}
