<?php

use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductsController::class, 'all']);

Route::post('checkout', [CheckoutController::class, 'checkout']);

Route::get('transaction/{id}', [TransactionController::class, 'get']);

