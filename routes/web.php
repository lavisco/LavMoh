<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;

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

Route::get('/data', function () {
    abort(401);
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


Route::get('/lavisco/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');
Route::get('/admin/{path}', [HomeController::class, 'adminIndex'])->where('path', '.*')->middleware('is_admin');
Route::get('/seller/{path}', [HomeController::class, 'sellerIndex'])->where('path', '.*')->middleware('is_seller');
Route::get('/buyer/{path}', [HomeController::class, 'buyerIndex'])->where('path', '.*')->middleware('is_buyer');

Auth::routes();

