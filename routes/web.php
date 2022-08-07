<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('Prodcut');
// Route::post('/store_product', [App\Http\Controllers\ProductController::class, 'store'])->name('store_product');
// Route::post('/update_product', [App\Http\Controllers\ProductController::class, 'update'])->name('update_product');
// Route::post('/delete_product', [App\Http\Controllers\ProductController::class, 'destroy'])->name('delete_product');
// Route::get('/edit_product/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit_product');

Route::resource('/product', ProductController::class);
