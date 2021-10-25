<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'title' => "Products",
            'cart' => Cart::content(),
            'products' => Product::orderby('name')->filter(request(["search", "category"]))->get()
        ]);
    }

    public function show(Product $product)
    {
        return view('product.show', [
            'title' => $product->name,
            'product' => $product,
            'cart' => Cart::content(),
            'latestProducts' => Product::latest()->get()->take(4)
        ]);
    }
}
