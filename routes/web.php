<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/symbolic-link', function () {
    Artisan::call('storage:link');
})->middleware('auth');

Route::get('/', 'PageController@home')->name ('page.home')->middleware('guest');
Route::get('/dashboard', 'PageController@dashboard')->name ('page.dashboard')->middleware('auth');
Route::get('/help', 'PageController@help')->name ('page.help')->middleware('auth');
Route::get('/stock-supply/{id}', 'ProductController@edit_stock_supply')->name ('products.stock.supply.edit')->middleware('auth');
Route::get ('/report', 'ReportController@globalReport')->name ('global.report')->middleware('auth');
Route::get ('/invoice/{id}', 'ReportController@getInvoice')->name ('invoice.report')->middleware('auth');
Route::get ('/order-payment/{id}', 'OrderController@index_order_payment')->name ('orders.payment.index')->middleware('auth');
Route::get ('/stock-card-in-value/{id}', 'ProductController@card_stock_value')->name ('products.stock.card.value')->middleware('auth');
Route::get ('/stock-card-in-quantity/{id}', 'ProductController@card_stock_quantity')->name ('products.stock.card.quantity')->middleware('auth');

//Route::patch ('/orders/pay/{id}', 'OrderController@pay')->name ('orders.pay')->middleware('auth');
Route::patch ('/orders/trash/{id}', 'OrderController@trash')->name ('orders.trash')->middleware('auth');
Route::patch ('/stock-supply/{id}', 'ProductController@update_stock_supply')->name ('products.stock.supply.update')->middleware('auth');
Route::patch ('/profile/change-password', 'ProfileController@changePassword')->name ('profile.change.password')->middleware('auth');
Route::patch ('/order-payment/{id}', 'OrderController@update_order_payment')->name ('orders.payment.update')->middleware('auth');

Route::delete ('/users', 'UserController@delete_user')->name ('users.delete.user')->middleware('auth');

Route::post ('/', 'SearchController@search')->name ('search.product')->middleware('auth');


Route::resource('brands', 'BrandController')->middleware('auth');
Route::resource('categories', 'CategoryController')->middleware('auth');
Route::resource('products', 'ProductController')->middleware('auth');
Route::resource('orders', 'OrderController')->except(['edit', 'update', 'destroy'])->middleware('auth');
Route::resource('order-history', 'OrderHistoryController')->only(['index', 'show', 'destroy'])->middleware('auth');
Route::resource('product-history', 'ProductHistoryController')->only(['index', 'destroy'])->middleware('auth');
Route::resource('notifications', 'NotificationController')->only(['index', 'destroy'])->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');
Route::resource('profile', 'ProfileController')->middleware('auth');

Auth::routes(['reset' => false, 'verify' => false, 'confirm' => false, 'register' => false]);
