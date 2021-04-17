<?php

use App\Http\Controllers\homeController;
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

Route::get('/', [homeController::class, 'home']);
Route::get('/products/', [homeController::class, 'products']);
Route::get('/products/{id}', [homeController::class, 'show']);
Route::middleware(['auth'])->group(function () {
    Route::post('/product/transaction', [homeController::class, 'transaction']);
    Route::get('/checkout', [homeController::class, 'checkout']);
    Route::get('/keranjang', [homeController::class, 'keranjang']);
    Route::post('/cart', [homeController::class, 'cart']);
    Route::delete('/cart/{id}', [homeController::class, 'destroyCart']);
});
