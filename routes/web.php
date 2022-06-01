<?php

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


//     $plaintext = '525|10';
//     $publickey = "-----BEGIN PUBLIC KEY-----
// MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC9l2HykxDIDVZeyDPJU4pA0imf
// 3nWsvyJgb3zTsnN8B0mFX6u5squ5NQcnQ03L8uQ56b4/isHBgiyKwfMr4cpEpCTY
// /t1WSdJ5EokCI/F7hCM7aSSSY85S7IYOiC6pKR4WbaOYMvAMKn5gCobEPtosmPLz
// gh8Lo3b8UsjPq2W26QIDAQAB
// -----END PUBLIC KEY-----";
//     openssl_public_encrypt($plaintext, $encrypt, $publickey);

//     $payment = base64_encode($encrypt);
//     $custom_fields = base64_encode('cus_1|cus_2|cus_3|cus_4');

//     return view('payment', [$payment, $custom_fields]);

})->name('paymenttest');

Route::post('/paymenttest', function () {
    $response = Http::post('https://webxpay.com/index.php?route=checkout/billing');
    return $response;
});


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
