<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Cart::content()->count()) {
            return redirect()->route('cart.index');
        }

        $res = Http::withHeaders([
            'key' => 'f26ecb1fd37bc662a35832e653f4a3fa',
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => '444',
            'destination' => auth()->user()->city_id,
            'weight' => 1000,
            'courier' => 'jne'
        ]);
        if ($res->failed()) {
            return redirect()->back();
        }
        $data = $res->json();
        $listCost = $data['rajaongkir']['results'][0]['costs'];

        $subtotal = (int)Cart::subtotal(0, '', '');
        $total = $subtotal;

        return view('checkout', [
            'listCost' => $listCost,
            'total' => $total,
            'subtotal' => $subtotal
        ]);
    }

    public function get_token()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-nDv_Z65iSjuX0xw6zXK6MeuD';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $transaction_details = [
            'order_id' => 'ID_' . rand(),
            'gross_amount' => (int)Cart::subtotal(0, '', '') + (int)request('delivery_cost'),
        ];

        $item_details = [];
        foreach (Cart::content() as $cart) {
            $product = Product::find($cart->id);

            $item = [
                "id" => $product->id,
                "price" => $product->price,
                "quantity" => $cart->qty,
                "name" => $product->name
            ];
            array_push($item_details, $item);
        }

        array_push($item_details, [
            "id" => "DELIVERY_" . rand(),
            "price" => (int)request('delivery_cost'),
            "quantity" => 1,
            "name" => request('delivery_service') . ' to ' . auth()->user()->city
        ]);

        $customer_details = [
            'first_name'    => auth()->user()->firstname,
            'last_name'     => auth()->user()->lastname,
            'email'         => auth()->user()->email,
            'phone'         => auth()->user()->phone,
        ];

        $shipping_address = [
            'first_name'    => auth()->user()->firstname,
            'last_name'     => auth()->user()->lastname,
            'email'         => auth()->user()->email,
            'phone'         => auth()->user()->phone,
            "address"  => auth()->user()->address,
            "city" => auth()->user()->city,
            "postal_code" => auth()->user()->postal_code,
            "country_code" => "IDN"
        ];

        $customer_details["shipping_address"] = $shipping_address;

        $enable_payments = ["bca_va", "bni_va", "bri_va", "other_va",  "Indomaret", "alfamart", "gopay"];

        $transaction = [
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($transaction);

        return response()->json(['token' => $snapToken]);
    }

    public function finish(Request $request)
    {
        $result = json_decode($request->input('result-data'), true);
        $delivery_cost = $request->input('delivery-cost');
        $delivery_service = $request->input('delivery-service');

        if ($result['payment_type'] == 'bank_transfer') {
            $paymentCode = $result['va_numbers'][0]['va_number'];
            $payType = 'BANK TRANSFER';
        } elseif ($result['payment_type'] == 'cstore') {
            $paymentCode = $result['payment_code'];
            $payType = 'ALFAMART / INDOMARET';
        } else {
            $paymentCode = '';
            $payType = 'GOPAY';
        }

        if (array_key_exists('pdf_url', $result)) {
            $url = $result['pdf_url'];
        } else {
            $url = '';
        }

        $data = [
            'serial_order' => $result['order_id'],
            'transaction_id' => $result['transaction_id'],
            'user_id' => auth()->user()->id,
            'status' => $result['transaction_status'],
            'status_code' => $result['status_code'],
            'total' => $result['gross_amount'],
            'payment_type' => $payType,
            'payment_code' => $paymentCode,
            'pdf_url' => $url,
            'delivery_cost' => (int)$delivery_cost,
            'delivery_service' => $delivery_service
        ];


        $orders = [];
        foreach (Cart::content() as $cart) {
            $product = Product::find($cart->id);
            $item = [
                "product_id" => $product->id,
                "quantity" => $cart->qty,
            ];
            array_push($orders, $item);
        }

        $transaction = Transaction::create($data);
        $transaction->orders()->createMany($orders);

        Cart::destroy();

        return redirect()->route('admin.profile.transaction')->with("success", "Order Created");
    }
}
