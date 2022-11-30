<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\Website\ExcelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PaymentController;
use App\Mail\BuyerOrderDeliveredMail;
use App\Mail\BuyerOrderProductionMail;
use App\Mail\BuyerOrderShippedMail;
use App\Mail\BuyerOrderShippingMail;
use App\Mail\OrderMail;
use App\Mail\SellerNewOrderMail;
use App\Mail\SellerOrderDeliveredMail;
use App\Mail\SellerOrderDispatchMail;
use App\Mail\SellerProductDelistedMail;
use App\Mail\SellerProductReviewingMail;
use App\Mail\SellerProductReviseMail;
use App\Mail\SellerTransactionClearedMail;
use App\Mail\SellerTransactionRequestMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
| Payment Routes
|--------------------------------------------------------------------------
*/

// Route::get('/paymenttest', function () {
//     require(public_path() . "/testFile.php");
// })->name('paymenttest');

Route::get('/payment', [PaymentController::class, 'showShipping'])->name('paymentShipping');
// Route::get('/payment-resp-test', [PaymentController::class, 'paymentResponseTest']);
Route::post('/payment', [PaymentController::class, 'storeOrder'])->name('storeOrder');
Route::post('/payment/response', [PaymentController::class, 'paymentResponse']);

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

Route::get('/export/users/buyer', [ExcelController::class, 'exportBuyerUsers']);
Route::get('/export/users/seller', [ExcelController::class, 'exportSellerUsers']);
Route::get('/export/users', [ExcelController::class, 'exportAllUsers']);
Route::get('/export/orders', [ExcelController::class, 'exportOrders']);
Route::get('/export/products', [ExcelController::class, 'exportProducts']);
Route::get('/export/shops', [ExcelController::class, 'exportShops']);
Route::get('/export/transactions', [ExcelController::class, 'exportTransactions']);


/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

//route entry for login pages
Route::get('/employee/{path}', [HomeController::class, 'employeeIndex'])->where('path', '.*');
Route::get('/merchant/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');

//main route entry for website
Route::get('/products/{productId}/{location}/{slug}', [HomeController::class, 'websiteProductIndex']);
Route::get('/{path}', [HomeController::class, 'websiteIndex'])->where('path', '.*');

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
*/

Route::fallback(FallbackController::class);
