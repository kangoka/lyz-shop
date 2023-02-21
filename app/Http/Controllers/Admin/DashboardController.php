<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        $user_joined = count(User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get());
        $product_sold = count(Checkout::where('payment_status', 'paid')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get());
        $sales = Checkout::where('payment_status', 'paid')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('price');
        $popular_products = Product::orderBy('sold', 'DESC')->take(5)->get();
        DB::statement("SET SQL_MODE=''");
        $loyal_users = Checkout::with('User')->where('payment_status', 'paid')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->selectRaw('count(id) as number_of_orders, user_id')->groupBy('user_id')->orderBy('number_of_orders', 'DESC')->take(5)->get();

        $data_hari = array(
            "Monday" => "Senin",
            "Tuesday" => "Selasa",
            "Wednesday" => "Rabu",
            "Thursday" => "Kamis",
            "Friday" => "Jumat",
            "Saturday" => "Sabtu",
            "Sunday" => "Minggu"
        );
        DB::statement("SET SQL_MODE=''");
        $query =  DB::select(DB::raw("SELECT created_at as y_date, DAYNAME(created_at) as day_name, COUNT(id) as count FROM checkouts WHERE payment_status = 'paid' AND date(created_at) > (DATE(NOW()) - INTERVAL 7 DAY) AND MONTH(created_at) = '" . date('m') . "' AND YEAR(created_at) = '" . date('Y') . "' GROUP BY DAYNAME(created_at) ORDER BY (y_date) ASC")); 

        $record = $query;
        $chart = [];

        foreach($record as $row) {
            $chart['label'][] = $data_hari[$row->day_name];
            $chart['data'][] = (int) $row->count;
        }
        $chart['chart_data'] = json_encode($chart);

        return view('admin.dashboard', [
            'user_joined'           => $user_joined,
            'product_sold'          => $product_sold,
            'sales'                 => $sales,
            'chart'                 => $chart,
            'popular_products'      => $popular_products,
            'loyal_users'           => $loyal_users,
            'count_transaction'     => $this->count_transaction,
            'count_product'         => $this->count_product,
            'count_category'        => $this->count_category
        ]);
    }

    public function order() {
        $data = Checkout::with('Product')->where('payment_status', 'paid')->where('is_delivered', 0)->paginate(5);

        return view('admin.transaction.order', [
            'data'              => $data,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function orderAll() {
        $data = Checkout::with('Product')->get();

        return view('admin.transaction.order_all', [
            'data'              => $data,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }
}
