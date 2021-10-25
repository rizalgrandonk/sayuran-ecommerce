<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::latest()->get()->take(8);
        $latestCategories = Category::latest()->get()->take(6);
        return view('index', [
            'title' => 'Sok Kabeh',
            'cart' => Cart::content(),
            'latestProducts' => $latestProducts,
            'latestCategories' => $latestCategories
        ]);
    }
}
