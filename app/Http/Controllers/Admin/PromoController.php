<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\PromoLog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Checkout;
use App\Models\user;
use Response;
use Auth;
use DateTime;
use DateTimeZone;

class PromoController extends Controller
{
    public function index() {
        $data = Promo::latest()->get();

        return view('admin.promo.index', [
            'data' => $data,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }
    
    public function create() {
        return view('admin.promo.create', [
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function insert(Request $request) {
        // $request->validate(Product::$rules);
        $requests = $request->all();
        // return $requests;

        $promo = Promo::create($requests);
        if($promo){
            return redirect('admin/dashboard/promo');
        }

        return redirect('admin/dashboard/promo');
    }

    public function edit($id) {
        $data = Promo::find($id);

        return view('admin.promo.edit', [
            'data' => $data,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function update(Request $request, $id) {
        $d = Promo::find($id);
        if ($d == null) {
            return redirect('admin/dashboard/promo');
        }

        $req = $request->all();

        $data = Promo::find($id)->update($req);
        if($data) {
            return redirect('admin/dashboard/promo');
        }
        
        return redirect('admin/dashboard/promo');
    }

    public function checkCode($code, $id)
    {
        if (!isset($code) || !isset($id)) return 'MP';
        if ($id != Auth::user()->id) return 'WOW';
        if (strlen($code) > 9) {
            return 'NS';
        }
        
        $data = Promo::where('code', $code)->first();

        if ($data == []) return 'E';
    
        if ($data->max_use == 0) return 'V';
        $log = PromoLog::where('user_id', $id)->where('code', $code);

        if ($log->count() >= $data->max_use) return 'NA';

        $date_now = (new DateTime("now", new DateTimeZone('Asia/Jakarta')))->format("Y-m-d\TH:i:s");
        $expired = date("Y-m-d\TH:i:s", strtotime($data->expired_at));
        if ($date_now > $expired) return 'EX';

        return 'V';
    }
}
