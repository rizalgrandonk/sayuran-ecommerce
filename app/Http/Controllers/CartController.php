<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function index()
    {
        $subtotal = (int)Cart::subtotal(0, '', '');
        $total = $subtotal;
        return view('cart', [
            'cart' => Cart::content(),
            'total' => $total,
            'subtotal' => $subtotal
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $image = $product->image
            ?  asset('storage/' . $product->image)
            : asset('storage/product-image/product-default.jpg');

        $options = [
            'image' => $image
        ];
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->input('quantity'),
            'price' => $product->price,
            'weight' => 1,
            'options' => $options
        ]);

        return redirect()->back();
    }

    public function update(Request $request)
    {
        Cart::update($request->input('rowId'), $request->input('quantity'));
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        Cart::remove($request->input('rowId'), $request->input('quantity'));
        return redirect()->back();
    }
}
