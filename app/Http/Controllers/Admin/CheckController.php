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
        return view('admin.check.order', [
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
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
