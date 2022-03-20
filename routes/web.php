<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Mail\StoreActiveApplicationMail;
use App\Mail\WelcomeMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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


/*
|--------------------------------------------------------------------------
| Email & Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('login');
});

//Route::get('/emailTest', [EmailController::class, 'sendWelcomeEmail']);

Route::get('/email', function() {
    return new StoreActiveApplicationMail();
});

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
*/


Route::group(['middleware' => 'auth'],function () {

    Route::get('/admin/{path}', [HomeController::class, 'adminIndex'])->where('path', '.*')->middleware('is_admin');
    Route::get('/seller/{path}', [HomeController::class, 'sellerIndex'])->where('path', '.*')->middleware(['is_seller']);
    Route::get('/buyer/{path}', [HomeController::class, 'buyerIndex'])->where('path', '.*')->middleware(['is_buyer', 'verified']);

});

Route::get('/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');




