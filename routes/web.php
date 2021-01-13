<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
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
Route::middleware(['web'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'attempt'])->name('login.attempt');


    Route::middleware(['customer.auth'])->group(function () {
        Route::get('cart', [CartController::class, 'index'])->name('cart');
        Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('add_to_cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('remove_from_cart/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('remove_from_cart/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
