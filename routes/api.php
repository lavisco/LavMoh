<?php

use App\Http\Controllers\Api\Admin\AnalyticController;
use App\Http\Controllers\Api\Admin\AreaController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\BuyerProfileController;
use App\Http\Controllers\Api\Admin\CartController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\DistrictController;
use App\Http\Controllers\Api\Admin\GiftwrapController;
use App\Http\Controllers\Api\Admin\HomeSliderController;
use App\Http\Controllers\Api\Admin\MaterialController;
use App\Http\Controllers\Api\Admin\OccasionController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\ProductImageController;
use App\Http\Controllers\Api\Admin\ProductStateController;
use App\Http\Controllers\Api\Admin\ProductVariationController;
use App\Http\Controllers\Api\Admin\ProductVideoController;
use App\Http\Controllers\Api\Admin\ProvinceController;
use App\Http\Controllers\Api\Admin\ReceiptController;
use App\Http\Controllers\Api\Admin\RecipientController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\SellerProfileController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\Admin\ShippingController;
use App\Http\Controllers\Api\Admin\ShopController;
use App\Http\Controllers\Api\Admin\SitetextController;
use App\Http\Controllers\Api\Admin\VariationController;
use App\Http\Controllers\Api\Admin\VariationOptionController;
use App\Http\Controllers\Api\Buyer\BuyerProfileController as BuyerBuyerProfileController;
use App\Http\Controllers\Api\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Api\Seller\CartController as SellerCartController;
use App\Http\Controllers\Api\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Api\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Api\Seller\ProductImageController as SellerProductImageController;
use App\Http\Controllers\Api\Seller\ProductStateController as SellerProductStateController;
use App\Http\Controllers\Api\Seller\ProductVariationController as SellerProductVariationController;
use App\Http\Controllers\Api\Seller\ProductVideoController as SellerProductVideoController;
use App\Http\Controllers\Api\Seller\ReceiptController as SellerReceiptController;
use App\Http\Controllers\Api\Seller\SellerProfileController as SellerSellerProfileController;
use App\Http\Controllers\Api\Seller\ShopController as SellerShopController;
use App\Http\Controllers\Api\Seller\UserController as SellerUserController;
use App\Http\Controllers\Api\Website\CategoryController as WebsiteCategoryController;
use App\Http\Controllers\Api\Website\HomeController as WebsiteHomeController;
use App\Http\Controllers\Api\Website\LocationController;
use App\Http\Controllers\Api\Website\OccasionController as WebsiteOccasionController;
use App\Http\Controllers\Api\Website\OrderController as WebsiteOrderController;
use App\Http\Controllers\Api\Website\ProductController as WebsiteProductController;
use App\Http\Controllers\Api\Website\RecipientController as WebsiteRecipientController;
use App\Http\Controllers\Api\Website\SellerProfileController as WebsiteSellerProfileController;
use App\Http\Controllers\Api\Website\ShopController as WebsiteShopController;
use App\Http\Controllers\Api\Website\SitetextController as WebsiteSitetextController;
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
    Route::apiResource('/analytics', AnalyticController::class);
    Route::apiResource('/areas', AreaController::class);
    Route::apiResource('/buyerprofiles', BuyerProfileController::class);
    Route::apiResource('/cities', CityController::class);
    Route::apiResource('/countries', CountryController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/dashboard', DashboardController::class);
    Route::apiResource('/districts', DistrictController::class);
    Route::apiResource('/giftwraps', GiftwrapController::class);
    Route::apiResource('/homesliders', HomeSliderController::class);
    Route::apiResource('/occasions', OccasionController::class);
    Route::apiResource('/orders', OrderController::class);
    Route::apiResource('/permissions', PermissionController::class);
    Route::put('/products/updateState/{product}', [ProductController::class, 'updateState']);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/product_images', ProductImageController::class);
    Route::apiResource('/product_variations', ProductVariationController::class);
    Route::apiResource('/product_videos', ProductVideoController::class);
    Route::apiResource('/productstates', ProductStateController::class);
    Route::apiResource('/provinces', ProvinceController::class);
    Route::apiResource('/receipts', ReceiptController::class);
    Route::apiResource('/recipients', RecipientController::class);
    Route::apiResource('/roles', RoleController::class);
    Route::apiResource('/sellerprofiles', SellerProfileController::class);
    Route::apiResource('/settings', SettingController::class);
    Route::apiResource('/sitetexts', SitetextController::class);
    Route::apiResource('/shippings', ShippingController::class);
    Route::apiResource('/shops', ShopController::class);
    /* User */
    Route::get('/users/buyer', [UserController::class, 'buyer']);
    Route::get('/users/seller', [UserController::class, 'seller']);
    Route::put('/users/password_reset/{user}', [UserController::class, 'updatePassword']);
    Route::apiResource('/users', UserController::class);
});

/*Buyer routes*/

Route::prefix('buyer')->group(function () {
    Route::apiResource('/buyerprofile', BuyerBuyerProfileController::class);
    Route::apiResource('/orders', BuyerOrderController::class);
});

/*Seller routes*/

Route::prefix('seller')->group(function () {
    Route::apiResource('/carts', SellerCartController::class);
    Route::get('/products/details', [SellerProductController::class, 'getDetails']);
    Route::put('/products/updateState/{product}', [SellerProductController::class, 'updateState']);
    Route::apiResource('/products', SellerProductController::class);
    Route::apiResource('/productstates', SellerProductStateController::class);
    Route::apiResource('/product_images', SellerProductImageController::class);
    Route::apiResource('/product_variations', SellerProductVariationController::class);
    //Route::apiResource('/product_videos', SellerProductVideoController::class);
    Route::apiResource('/receipts', SellerReceiptController::class);
    Route::apiResource('/sellerprofile', SellerSellerProfileController::class);
    Route::apiResource('/shop', SellerShopController::class);
    Route::post('/user/password_reset', [SellerUserController::class, 'updatePassword']);
    Route::post('/user/shop_setup', [SellerUserController::class, 'storeShopSetup']);
    Route::apiResource('/user', SellerUserController::class);
    Route::apiResource('/dashboard', SellerDashboardController::class);
});

/*Website routes*/

Route::apiResource('/home', WebsiteHomeController::class);
Route::apiResource('/products', WebsiteProductController::class);
Route::get('/categories/products/{id}/{location}', [WebsiteCategoryController::class, 'getLocationWiseProducts']);
Route::apiResource('/categories', WebsiteCategoryController::class);
Route::apiResource('/sellerprofiles', WebsiteSellerProfileController::class);
Route::apiResource('/occasions', WebsiteOccasionController::class);
Route::apiResource('/orders', WebsiteOrderController::class);
Route::apiResource('/recipients', WebsiteRecipientController::class);
Route::apiResource('/shops', WebsiteShopController::class);
Route::apiResource('/sitetexts', WebsiteSitetextController::class);
//location
Route::get('/locations/countries', [LocationController::class, 'indexCountry']);
Route::get('/locations/provinces', [LocationController::class, 'indexProvince']);
Route::get('/locations/districts/{province}', [LocationController::class, 'indexDistrict']);
Route::get('/locations/cities/{district}', [LocationController::class, 'indexCity']);
Route::get('/locations/areas/{city}', [LocationController::class, 'indexArea']);