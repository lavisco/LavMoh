<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\UserController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/sellers', function () {
    return view('all_sellers');
});
Route::get('/terms_and_conditions', function () {
    return view('policy_terms_condition');
});
Route::get('/privacy_policy', function () {
    return view('policy_privacy');
});
Route::get('/returns_refunds_policy', function () {
    return view('policy_returns');
});
Route::get('/delivery_policy', function () {
    return view('policy_delivery');
});
Route::get('/cookie_policy', function () {
    return view('policy_cookie');
});
Route::get('/login', function () {
    return view('login');
});


Route::get('/lavisco/{path}', function(){
    return view('layouts.master');
})->where('path', '.*');

Route::get('/admin/{path}', function(){
    return view('layouts.admin_dashboard_master');
})->where('path', '.*');

Route::get('/seller/{path}', function(){
    return view('layouts.lavisco_dashboard_master');
})->where('path', '.*');

Route::get('/buyer/{path}', function(){
    return view('layouts.lavisco_dashboard_master');
})->where('path', '.*');


Auth::routes();

