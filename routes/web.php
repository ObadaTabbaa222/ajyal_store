<?php

use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ HomeController::class, 'index' ])
    ->name('home');

Route::get('/products', [ProductsController::class, 'index'])
    ->name('products.index');
Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
    ->name('products.show');
Route::delete('/product/delete', [ProductsController::class, 'delete']);

Route::resource('cart', CartController::class);

Route::get( 'checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post( 'checkout', [CheckoutController::class, 'store'])->name('checkout');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
