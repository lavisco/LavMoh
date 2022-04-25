<?php

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
// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/emailTest', [EmailController::class, 'sendWelcomeEmail']);

Auth::routes();

//Auth::routes(['verify' => true]);

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
    // Route::get('/seller/{path}', [HomeController::class, 'sellerIndex'])->where('path', '.*')->middleware(['is_seller', 'verified']);
    Route::get('/buyer/{path}', [HomeController::class, 'buyerIndex'])->where('path', '.*')->middleware(['is_buyer']);

});


/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/employee/{path}', [HomeController::class, 'employeeIndex'])->where('path', '.*');
Route::get('/merchant/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');

Route::get('/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');


/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/

Route::fallback(FallbackController::class);
