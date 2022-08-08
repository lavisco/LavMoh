<?php

use App\Http\Controllers\Api\Website\OrderController as WebsiteOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FallbackController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\OrderController;
use App\Mail\StoreActiveApplicationMail;
use App\Mail\WelcomeMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

Route::get('/paymenttest', function () {
    require(public_path() . "/testFile.php");
})->name('paymenttest');

Route::get('/paymenttest-response', function () {
    return view('payment.payment-response');
});

Route::post('/paymenttest', function () {
    $response = Http::post('https://webxpay.com/index.php?route=checkout/billing');
    return $response;
});

Route::get('/payment-gateway', function () {
    return view('payment.payment');
});

Route::post('/payment-gateway', [HomeController::class, 'paymentProcess'])->name('paymentgate');


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Auth::routes();
Route::post('/buyer-login', [LoginController::class, 'loginBuyer']);
Route::post('/seller-login', [LoginController::class, 'loginSeller']);
Route::post('/guest-logout', [LoginController::class, 'logoutGuest']);
//Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| Email Routes
|--------------------------------------------------------------------------
*/

//Route::get('/emailTest', [EmailController::class, 'sendWelcomeEmail']);


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
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'],function () {

    Route::get('/admin/{path}', [HomeController::class, 'adminIndex'])->where('path', '.*')->middleware('is_admin');
    Route::get('/seller/{path}', [HomeController::class, 'sellerIndex'])->where('path', '.*')->middleware(['is_seller']);
    Route::get('/buyer/{path}', [HomeController::class, 'buyerIndex'])->where('path', '.*')->middleware(['is_buyer']);
    // add email verified middleware to route e.g. ->middleware(['is_buyer', 'verified']);

});


/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

//route entry for login pages
Route::get('/employee/{path}', [HomeController::class, 'employeeIndex'])->where('path', '.*');
Route::get('/merchant/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');

//main route entry for website
Route::get('/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');



/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/

Route::fallback(FallbackController::class);
