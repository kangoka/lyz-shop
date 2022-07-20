<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\Category;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data_waiting = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'waiting')->where('is_delivered', 0);
        $data_success = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'paid')->where('is_delivered', 0);
        $data_complete = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'paid')->where('is_delivered', 1);
        $data_failed = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->get();

        $count_waiting = count($data_waiting);
        $count_success = count($data_success);
        $count_complete = count($data_complete);
        $count_failed = count($data_failed);
        return view('user.dashboard', compact('count_waiting', 'count_success','count_complete', 'count_failed'));
    }

    public function waiting_payment() {
        $data = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'waiting')->latest()->paginate(5);
        $data_pagination = Checkout::where('user_id', Auth::id())->where('payment_status', 'waiting')->latest()->paginate(5);
        $category = Category::get();

        $data_success = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'paid')->where('is_delivered', 0);
        $data_complete = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'paid')->where('is_delivered', 1);
        $data_failed = Checkout::with('Product')->where('user_id', Auth::id())->where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->get();

        $count_waiting = count($data);
        $count_success = count($data_success);
        $count_complete = count($data_complete);
        $count_failed = count($data_failed);
        return view('user.order', compact('data', 'data_pagination', 'category', 'count_waiting', 'count_success','count_complete', 'count_failed'));
    }

    // public function waiting_delivery() {
    //     $data = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 0)->paginate(5);
    //     $data_pagination = Checkout::where('payment_status', 'paid')->where('is_delivered', 0)->paginate(5);
    //     $category = Category::get();

    //     $data_waiting = Checkout::with('Product')->get()->where('payment_status', 'waiting')->where('is_delivered', 0);
    //     $data_complete = Checkout::with('Product')->get()->where('payment_status', 'paid')->where('is_delivered', 1);
    //     $data_failed = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->get();

    //     $count_waiting = count($data_waiting);
    //     $count_success = count($data);
    //     $count_complete = count($data_complete);
    //     $count_failed = count($data_failed);
    //     return view('user.order', compact('data', 'data_pagination', 'category', 'count_waiting', 'count_success','count_complete', 'count_failed'));
    // }

    public function success() {
        $data = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'paid')->where('is_delivered', 0)->latest()->paginate(5);
        $data_pagination = Checkout::where('user_id', Auth::id())->where('payment_status', 'paid')->where('is_delivered', 0)->latest()->paginate(5);
        $category = Category::get();

        $data_waiting = Checkout::with('Product')->get()->where('user_id', Auth::id())->where('payment_status', 'waiting')->where('is_delivered', 0);
        $data_complete = Checkout::with('Product')->get()->where('user_id', Auth::id())->where('payment_status', 'paid')->where('is_delivered', 1);
        $data_failed = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->get();

        $count_waiting = count($data_waiting);
        $count_success = count($data);
        $count_complete = count($data_complete);
        $count_failed = count($data_failed);
        return view('user.order', compact('data', 'data_pagination', 'category' ,'count_waiting', 'count_success','count_complete', 'count_failed'));
    }

    public function complete() {
        $data = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'paid')->where('is_delivered', 1)->latest()->paginate(5);
        $data_pagination = Checkout::where('user_id', Auth::id())->where('payment_status', 'paid')->where('is_delivered', 1)->latest()->paginate(5);
        $category = Category::get();

        $data_waiting = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'waiting')->where('is_delivered', 0);
        $data_success = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'paid')->where('is_delivered', 0);
        $data_failed = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->get();

        $count_waiting = count($data_waiting);
        $count_success = count($data_success);
        $count_complete = count($data);
        $count_failed = count($data_failed);
        return view('user.order', compact('data', 'data_pagination', 'category', 'count_waiting', 'count_success','count_complete', 'count_failed'));
    }

    public function failed() {
        $data = Checkout::with('Product')->where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->latest()->paginate(5);
        $data_pagination = Checkout::where('user_id', Auth::id())->where('payment_status', 'failed')->orWhere('payment_status', 'expire')->latest()->paginate(5);
        $category = Category::get();

        $data_waiting = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'waiting')->where('is_delivered', 0);
        $data_success = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'paid')->where('is_delivered', 0);
        $data_complete = Checkout::with('Product')->where('user_id', Auth::id())->get()->where('payment_status', 'paid')->where('is_delivered', 1);
        $count_waiting = count($data_waiting);
        $count_success = count($data_success);
        $count_complete = count($data_complete);
        $count_failed = count($data);
        return view('user.order', compact('data', 'data_pagination', 'category', 'count_waiting', 'count_success','count_complete', 'count_failed'));
    }

    
}
