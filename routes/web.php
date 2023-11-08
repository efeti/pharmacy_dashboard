<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', [UsersController::class, 'login'])->middleware('guest');
Route::get('/', 'UsersController@login')->name('login')->middleware('guest');
Route::post('/login', [UsersController::class, 'login_submit'])->name('login_submit');
Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/add_product', function () {
    return view('add_product');
})->name('add_product');

Route::post('/add_product_submit', 'ProductsController@add_product_submit')->name('add_product_submit');
Route::get('/manage_products', 'ProductsController@manage_products')->name('manage_products');
Route::get('/edit_product/{id}', 'ProductsController@edit_product')->name('edit_product');
Route::post('/edit_product_submit', 'ProductsController@edit_product_submit')->name('edit_product_submit');
Route::delete('/delete_product/{id}', 'ProductsController@delete_product')->name('delete_product');

Route::get('/add_orders', 'OrdersController@add_orders')->name('add_orders');
Route::get('/find_customer/{phone_number}', 'OrdersController@find_customer')->name('find_customer');
Route::post('/add_order_submit', 'OrdersController@add_order_submit')->name('add_order_submit');
Route::get('/manage_orders', 'OrdersController@manage_orders')->name('manage_orders');
Route::post('/delete_order/{id}', 'OrdersController@delete_order')->name('delete_order');
Route::post('/paid_order/{id}', 'OrdersController@paid_order')->name('paid_order');
Route::get('/prescriptions', 'OrdersController@prescriptions')->name('prescriptions');
});