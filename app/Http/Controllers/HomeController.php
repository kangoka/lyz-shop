<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\User;
use App\Models\Promo;
use DateTime;
use DateTimeZone;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::with('Category')->where('is_listed', 1)->where('stock', '>', 0)->orderBy('sold', 'desc')->get()->take(5);
        $promo = Promo::latest()->take(1)->get()->first();
        $date_now = (new DateTime("now", new DateTimeZone('Asia/Jakarta')))->format("Y-m-d\TH:i:s");
        $expired = date("Y-m-d\TH:i:s", strtotime($promo->expired_at));
        if ($date_now > $expired){
            $promo = Http::get('https://candaan-api.vercel.app/api/text/random');
            $promo = str_replace(':v', '', $promo['data']);
            return view('welcome', [
                'product'    => $product,
                'promo'      => $promo,
                'is_expired' => 1
            ]);
        }
        
        return view('welcome', [
            'product'    => $product,
            'promo'      => $promo,
            'is_expired' => 0
        ]);
    }

    public function about()
    {
        $data_transaction = Checkout::get()->where('payment_status', 'paid')->where('is_delivered', 1);
        $data_user = User::get()->where('is_admin', '0');

        $count_transaction = count($data_transaction);
        $count_user = count($data_user);
        return view('about_us', [
            'count_transaction' => $count_transaction,
            'count_user' => $count_user
        ]);
    }

    public function terms()
    {
        return view('terms');
    }
}
