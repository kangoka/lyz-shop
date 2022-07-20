<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Review\Store;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\Category;
use App\Models\Review;
use Auth;

class ReviewController extends Controller
{
    public function get($id)
    {
        $data = Checkout::get()->where('midtrans_booking_code', $id);

        if ($data->isEmpty()) {
            return view('errors.404');
        }

        $data_waiting = Checkout::with('Product')->get()->where('payment_status', 'waiting')->where('is_delivered', 0);
        $data_success = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0);
        $data_complete = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 1);
        $data_failed = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->get();

        $count_waiting = count($data_waiting);
        $count_success = count($data_success);
        $count_complete = count($data_complete);
        $count_failed = count($data_failed);
        return view('user.review', compact('data', 'count_waiting', 'count_success','count_complete', 'count_failed'));
    }

    public function store(Store $request, $id)
    {
        $data = Checkout::get()->where('midtrans_booking_code', $id);

        $requests = $request->all();
        $requests['product_id'] = (int)$data->first()->product_id;
        $requests['order_id'] = $data->first()->midtrans_booking_code;
        $requests['user_id'] = $data->first()->user_id;

        $data->first()->is_reviewed = 1;
        $data->first()->save();

        $review = Review::create($requests);
        if($review){
            return redirect('user/dashboard/order_complete');
        }

        return redirect('user/dashboard/order_complete');
    }
}
