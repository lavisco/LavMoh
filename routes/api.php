<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\BuyerProfileController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\GiftwrapController;
use App\Http\Controllers\Api\Admin\HomeSliderController;
use App\Http\Controllers\Api\Admin\MaterialController;
use App\Http\Controllers\Api\Admin\OccasionController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\ProductImageController;
use App\Http\Controllers\Api\Admin\ProductStateController;
use App\Http\Controllers\Api\Admin\ProductVariationController;
use App\Http\Controllers\Api\Admin\ProductVideoController;
use App\Http\Controllers\Api\Admin\RecipientController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\SellerProfileController;
use App\Http\Controllers\Api\Admin\ShippingController;
use App\Http\Controllers\Api\Admin\ShopController;
use App\Http\Controllers\Api\Admin\VariationController;
use App\Http\Controllers\Api\Admin\VariationOptionController;
use App\Http\Controllers\Api\Buyer\BuyerProfileController as BuyerBuyerProfileController;
use App\Http\Controllers\Api\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Api\Seller\ProductImageController as SellerProductImageController;
use App\Http\Controllers\Api\Seller\ProductVariationController as SellerProductVariationController;
use App\Http\Controllers\Api\Seller\ProductVideoController as SellerProductVideoController;
use App\Http\Controllers\Api\Seller\SellerProfileController as SellerSellerProfileController;
use App\Http\Controllers\Api\Seller\ShopController as SellerShopController;
use App\Http\Controllers\Api\Seller\UserController as SellerUserController;
use App\Http\Controllers\Api\Website\CategoryController as WebsiteCategoryController;
use App\Http\Controllers\Api\Website\HomeController as WebsiteHomeController;
use App\Http\Controllers\Api\Website\OccasionController as WebsiteOccasionController;
use App\Http\Controllers\Api\Website\ProductController as WebsiteProductController;
use App\Http\Controllers\Api\Website\RecipientController as WebsiteRecipientController;
use App\Http\Controllers\Api\Website\SellerProfileController as WebsiteSellerProfileController;
use App\Http\Controllers\Website\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Admin routes*/

Route::prefix('admin')->group(function () {
    Route::apiResource('/buyerprofiles', BuyerProfileController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/dashboard', DashboardController::class);
    Route::apiResource('/giftwraps', GiftwrapController::class);
    Route::apiResource('/homesliders', HomeSliderController::class);
    Route::apiResource('/materials', MaterialController::class);
    Route::apiResource('/occasions', OccasionController::class);
    Route::apiResource('/permissions', PermissionController::class);
    /* Product */
    Route::put('/products/updateState/{product}', [ProductController::class, 'updateState']);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/product_images', ProductImageController::class);
    Route::apiResource('/product_variations', ProductVariationController::class);
    Route::apiResource('/product_videos', ProductVideoController::class);
    Route::apiResource('/productstates', ProductStateController::class);
    Route::get('/variations/options', [VariationController::class, 'getOptions']);
    Route::apiResource('/variations', VariationController::class);
    Route::apiResource('/variation_options', VariationOptionController::class);
    
    Route::apiResource('/recipients', RecipientController::class);
    Route::apiResource('/roles', RoleController::class);
    Route::apiResource('/sellerprofiles', SellerProfileController::class);
    Route::apiResource('/shippings', ShippingController::class);
    Route::apiResource('/shops', ShopController::class);
    /* User */
    Route::get('/users/buyer', [UserController::class, 'buyer']);
    Route::get('/users/seller', [UserController::class, 'seller']);
    Route::apiResource('/users', UserController::class);
});

/*Buyer routes*/
Route::prefix('buyer')->group(function () {
    Route::apiResource('/buyerprofile', BuyerBuyerProfileController::class);
});

/*Seller routes*/
Route::prefix('seller')->group(function () {
    Route::put('/products/updateState/{product}', [ProductController::class, 'updateState']);
    Route::apiResource('/products', SellerProductController::class);
    Route::apiResource('/product_images', SellerProductImageController::class);
    Route::apiResource('/product_variations', SellerProductVariationController::class);
    Route::apiResource('/product_videos', SellerProductVideoController::class);
    Route::apiResource('/sellerprofile', SellerSellerProfileController::class);
    Route::apiResource('/shop', SellerShopController::class);
    Route::apiResource('/user', SellerUserController::class);
});

/*Website routes*/
Route::apiResource('/home', WebsiteHomeController::class);
Route::apiResource('/products', WebsiteProductController::class);
Route::apiResource('/categories', WebsiteCategoryController::class);
Route::apiResource('/sellerprofiles', WebsiteSellerProfileController::class);
Route::apiResource('/occasions', WebsiteOccasionController::class);
Route::apiResource('/recipients', WebsiteRecipientController::class);