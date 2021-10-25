<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');

Route::post("/transaction/notification", [App\Http\Controllers\Admin\TransactionController::class, "notification"])
    ->name("transaction.notification");

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])
        ->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'store'])
        ->name('auth.store');

    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])
        ->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])
        ->name('authenticate');
});

Route::get('/cities', [App\Http\Controllers\AuthController::class, 'get_cities'])
    ->name('get_cities');

Route::group(["prefix" => "cart", "as" => "cart."], function () {
    Route::get('/', [App\Http\Controllers\CartController::class, 'index'])
        ->name('index');
    Route::post('/', [App\Http\Controllers\CartController::class, 'store'])
        ->name('store');
    Route::post('/update', [App\Http\Controllers\CartController::class, 'update'])
        ->name('update');
    Route::post('/delete', [App\Http\Controllers\CartController::class, 'delete'])
        ->name('delete');
});

Route::group(["prefix" => "product", "as" => "product."], function () {
    Route::get("/", [App\Http\Controllers\ProductController::class, "index"])
        ->name("index");
    Route::get("/{product:slug}", [App\Http\Controllers\ProductController::class, "show"])
        ->name("show");
});

Route::group(["prefix" => "admin", "as" => "admin.", 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.profile.index');
    })->name('home');

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])
        ->name('profile.index');
    Route::get('/profile/edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/profile/transaction', [App\Http\Controllers\Admin\ProfileController::class, 'transaction'])
        ->name('profile.transaction');

    Route::get('/checkout', [App\Http\Controllers\Admin\CheckoutController::class, 'index'])
        ->name('checkout.index');
    Route::get('/checkout/token', [App\Http\Controllers\Admin\CheckoutController::class, 'get_token'])
        ->name('checkout.token');
    Route::post('/checkout/finish', [App\Http\Controllers\Admin\CheckoutController::class, 'finish'])
        ->name('checkout.finish');

    Route::get("/transaction/{transaction}", [App\Http\Controllers\Admin\TransactionController::class, "show"])
        ->name("transaction.show");

    Route::group(['middleware' => 'admin'], function () {
        Route::get("/product/slug", [App\Http\Controllers\Admin\ProductController::class, "createSlug"])->name("product.slug");
        Route::get("/category/slug", [App\Http\Controllers\Admin\CategoryController::class, "createSlug"])->name("category.slug");

        Route::get("/transaction", [App\Http\Controllers\Admin\TransactionController::class, "index"])->name("transaction.index");
        Route::put("/transaction/reciept/{transaction}", [App\Http\Controllers\Admin\TransactionController::class, "set_reciept"])->name("transaction.reciept");

        Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
    });
});
