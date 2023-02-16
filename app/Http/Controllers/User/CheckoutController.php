<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\Checkout\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Product;
use App\Models\Category;
use App\Models\Promo;
use App\Models\PromoLog;
use Midtrans;
use Auth;
use Str;

class CheckoutController extends Controller
{
    public function deliverGet($id) {
        $data = Checkout::find($id);

        return view('admin.transaction.send', [
            'data' => $data,
            'count_transaction' => $this->count_transaction,
            'count_product' => $this->count_product,
            'count_category' => $this->count_category
        ]);
    }

    public function deliverStore(Request $request, $id) {
        $d = Checkout::find($id);
        if ($d == null) {
            return redirect('admin/dashboard/order');
        }

        $req = $request->all();

        $req['order_modal'] = $request->order_modal;
        $req['is_delivered'] = 1;

        $data = Checkout::find($id)->update($req);
        if($data) {
            return redirect('admin/dashboard/order');
        }
        
        return redirect('admin/dashboard/order');
    }

    public function store(Store $request, Product $product)
    {
        // return $request->all();
        $data = $request->all();
        // return $data;

        if (intval($data['quantity']) <= 0) {
            return redirect()->back()->with('errors', ['Kuantitas minimal adalah 1']);
        }
        
        if ((strlen($data['code']) < 9) && $data['code'] != null || strlen($data['code']) > 9) {
            return 'Ngapain?';
        }

        $check = Checkout::where('user_id', Auth::id())->where('payment_status', 'waiting')->get();
        if ((count($check) + 1) > 5) {
            return redirect(route('user.transaction.waiting'))->with('error', ['Kamu memiliki 5 pemesanan yang belum dibayar, silakan menyelesaikan pembayaran untuk pesanan sebelumnya']);
        }
        
        $data['user_id'] = Auth::id();
        $data['product_id'] = $product->id;
        $data['quantity'] = intval($data['quantity']);
        $data['price'] = $product->price;
        
        $checkout = Checkout::create($data);

        $this->getSnapRedirect($checkout, $data['code']);

        return redirect(route('user.transaction.waiting'));
    }

    public function getSnapRedirect(Checkout $checkout, $code)
    {
        $promo = Promo::get()->where('code', $code);
        $orderId = 'LYZ'.'-'.Str::upper(Str::random(7));
        if (!$promo->first()) {
            $price = $checkout->Product->price;
            $price_db = $checkout->Product->price * $checkout->quantity;
            // dd($price);
        } else {
            $promo = $promo->first();
            $promo_log['code_id'] = $promo->id;
            $promo_log['user_id'] = Auth::user()->id;
            $promo_log['code'] = $promo->code;
            $promo_log_save = PromoLog::create($promo_log);

            $promo->increment('used');
            $price = $checkout->Product->price * ($promo->discount / 100);
            $price_db = ($checkout->Product->price * $checkout->quantity) * ($promo->discount / 100);
            // $price = $checkout->Product->price;
            // dd($price);
        }
        $checkout->price = round($price_db);
        // dd($checkout->quantity);
        $checkout->midtrans_booking_code = $orderId;

        $transaction_details = [
            'order_id'          => $orderId,
            'gross_amount'      => round($price)
        ];
        
        $item_details[] = [
            'id'    => $orderId,
            'price' => round($price),
            'quantity' => $checkout->quantity,
            'name' => "x {$checkout->Product->name}"
        ];

        $userData = [
            "first_name" => $checkout->User->name,
            "last_name" => "",
            "address" => "",
            "city" => "",
            "postal_code" => "",
            "phone" => "",
            "country_code" => "IDN",
        ];

        $customer_details = [
            "first_name" => $checkout->User->name,
            "last_name" => "",
            "email" => $checkout->User->email,
            "phone" => "",
            "billing_address" => $userData,
            "shipping_address" => $userData,
        ];

        $midtrans_params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        try {
            // Get Snap Payment URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            return $paymentUrl;
        } catch (Exception $e) {
            return false;
        }
    }

    public function midtransCallback(Request $request)
    {
        $notif = $request->method() == 'POST' ? new Midtrans\Notification() : Midtrans\Transaction::status($request->order_id);

        $transaction_status = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $checkout_id = Checkout::where('midtrans_booking_code', $notif->order_id)->get();
        $checkout = Checkout::find($checkout_id->first()->id);

        if ($transaction_status == 'capture') {
            if ($fraud == 'challenge') {
                $checkout->payment_status = 'pending';
            }
            else if ($fraud == 'accept') {
                $checkout->payment_status = 'paid';
                if ($checkout->is_increased == 0){
                    $checkout_increased = Checkout::find($checkout_id->first()->id)->increment('is_increased');
                    $product = Product::find($checkout->product_id)->increment('sold', $checkout->quantity);
                    $product = Product::find($checkout->product_id)->decrement('stock', $checkout->quantity);
                }
            }
        }
        else if ($transaction_status == 'cancel') {
            if ($fraud == 'challenge') {
                $checkout->payment_status = 'failed';
            }
            else if ($fraud == 'accept') {
                $checkout->payment_status = 'failed';
            }
        }
        else if ($transaction_status == 'deny') {
            $checkout->payment_status = 'failed';
        }
        else if ($transaction_status == 'settlement') {
            $checkout->payment_status = 'paid';
            if ($checkout->is_increased == 0){
                $checkout_increased = Checkout::find($checkout_id->first()->id)->increment('is_increased');
                $product = Product::find($checkout->product_id)->increment('sold', $checkout->quantity);
                $product = Product::find($checkout->product_id)->decrement('stock', $checkout->quantity);
            }
        }
        else if ($transaction_status == 'pending') {
            $checkout->payment_status = 'pending';
        }
        else if ($transaction_status == 'expire') {
            $checkout->payment_status = 'expire';
        }

        $checkout->save();
        return redirect(route('user.transaction.waiting'));
    }
}
