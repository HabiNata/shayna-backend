<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductsGalleryController;
use App\Http\Controllers\TransactionsController;
use App\Models\Products;
use App\Models\ProductsGallery;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('Dash');

// Menampilkan Product Galler sesuai dengan product;
Route::get('products/{id}/galleries', [ProductsController::class, 'galleries'])->name('products.gallery');

// Get Gallery Json berdasarkan product;
Route::get('galleryJson/{id}', [ProductsController::class, 'galleries_json']);

// Mengubah status transaksi;
Route::get('transaction/{id}/setStatus', [TransactionsController::class, 'setStatus'])->name('transactions.status');

// Get All Products Json
Route::get('products/json', [ProductsController::class, 'json']);

// Get All ProductsGallery
Route::get('gallery/json', [ProductsGalleryController::class, 'json']);

Route::resource('products', ProductsController::class)->middleware('auth');

Route::resource('productsgallery', ProductsGalleryController::class)->middleware('auth');

Route::resource('transactions', TransactionsController::class)->middleware('auth');

Auth::routes(['register' => false]);
