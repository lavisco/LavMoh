<?php

use App\Http\Controllers\Api\Admin\AnalyticController;
use App\Http\Controllers\Api\Admin\AreaController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\BuyerProfileController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CityController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\CurrencyController;
use App\Http\Controllers\Api\Admin\CustomProductInquiryController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\DistrictController;
use App\Http\Controllers\Api\Admin\GiftboxController;
use App\Http\Controllers\Api\Admin\GiftwrapController;
use App\Http\Controllers\Api\Admin\HomeSliderController;
use App\Http\Controllers\Api\Admin\OccasionController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\OrderStateController;
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
use App\Http\Controllers\Api\Admin\SubCategoryController;
use App\Http\Controllers\Api\Admin\TransactionController;
use App\Http\Controllers\Api\Admin\TransactionStateController;
use App\Http\Controllers\Api\Admin\VariationController;
use App\Http\Controllers\Api\Admin\VariationOptionController;
use App\Http\Controllers\Api\Buyer\BuyerProfileController as BuyerBuyerProfileController;
use App\Http\Controllers\Api\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Api\Email\EmailController;
use App\Http\Controllers\Api\Seller\CustomProductInquiryController as SellerCustomProductInquiryController;
use App\Http\Controllers\Api\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Api\Seller\GiftboxController as SellerGiftboxController;
use App\Http\Controllers\Api\Seller\LocationController as SellerLocationController;
use App\Http\Controllers\Api\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Api\Seller\OrderStateController as SellerOrderStateController;
use App\Http\Controllers\Api\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Api\Seller\ProductImageController as SellerProductImageController;
use App\Http\Controllers\Api\Seller\ProductStateController as SellerProductStateController;
use App\Http\Controllers\Api\Seller\ProductVariationController as SellerProductVariationController;
use App\Http\Controllers\Api\Seller\ReceiptController as SellerReceiptController;
use App\Http\Controllers\Api\Seller\SellerProfileController as SellerSellerProfileController;
use App\Http\Controllers\Api\Seller\ShopController as SellerShopController;
use App\Http\Controllers\Api\Seller\TransactionController as SellerTransactionController;
use App\Http\Controllers\Api\Seller\TransactionStateController as SellerTransactionStateController;
use App\Http\Controllers\Api\Seller\UserController as SellerUserController;
use App\Http\Controllers\Api\Seller\VariationController as SellerVariationController;
use App\Http\Controllers\Api\Seller\VariationOptionController as SellerVariationOptionController;
use App\Http\Controllers\Api\Website\CategoryController as WebsiteCategoryController;
use App\Http\Controllers\Api\Website\ContactController;
use App\Http\Controllers\Api\Website\CurrencyController as WebsiteCurrencyController;
use App\Http\Controllers\Api\Website\CustomProductInquiryController as WebsiteCustomProductInquiryController;
use App\Http\Controllers\Api\Website\HomeController as WebsiteHomeController;
use App\Http\Controllers\Api\Website\LocationController;
use App\Http\Controllers\Api\Website\OccasionController as WebsiteOccasionController;
use App\Http\Controllers\Api\Website\OrderController as WebsiteOrderController;
use App\Http\Controllers\Api\Website\ProductController as WebsiteProductController;
use App\Http\Controllers\Api\Website\RecipientController as WebsiteRecipientController;
use App\Http\Controllers\Api\Website\SellerProfileController as WebsiteSellerProfileController;
use App\Http\Controllers\Api\Website\ShopController as WebsiteShopController;
use App\Http\Controllers\Api\Website\SitetextController as WebsiteSitetextController;
use App\Http\Controllers\Api\Website\SubCategoryController as WebsiteSubCategoryController;
use App\Http\Controllers\Api\Website\TransactionController as WebsiteTransactionController;
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

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::apiResource('/analytics', AnalyticController::class);
    Route::get('/areas/cities', [AreaController::class, 'getCities']);
    Route::apiResource('/areas', AreaController::class);
    Route::apiResource('/buyerprofiles', BuyerProfileController::class);
    Route::apiResource('/cities', CityController::class);
    Route::apiResource('/countries', CountryController::class);
    Route::apiResource('/categories', CategoryController::class);

    //Route::get('/currencies/exchangerate', [CurrencyController::class, 'getExchangerate']);
    Route::apiResource('/currencies', CurrencyController::class);
    Route::apiResource('/custom_product_inquiries', CustomProductInquiryController::class);
    Route::apiResource('/dashboard', DashboardController::class);
    Route::apiResource('/districts', DistrictController::class);
    Route::put('/giftboxes/updateState/{product}', [GiftboxController::class, 'updateState']);
    Route::get('/giftboxes/details', [GiftboxController::class, 'getDetails']);
    Route::apiResource('/giftboxes', GiftboxController::class);
    Route::apiResource('/giftwraps', GiftwrapController::class);
    Route::apiResource('/homesliders', HomeSliderController::class);
    Route::apiResource('/occasions', OccasionController::class);
    Route::put('/orders/updateStatus/{order}', [OrderController::class, 'updateStatus']);
    Route::apiResource('/orders', OrderController::class);
    Route::apiResource('/order_states', OrderStateController::class);
    Route::apiResource('/permissions', PermissionController::class);
    //store new image for existing product
    Route::put('/products/storeNewImage/{productId}', [ProductController::class, 'storeNewImage']);
    Route::put('/products/updateState/{product}', [ProductController::class, 'updateState']);
    Route::get('/products/details', [ProductController::class, 'getDetails']);
    Route::get('/products/sub_categories/{categoryId}', [ProductController::class, 'getSubcategories']);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/product_images', ProductImageController::class);
    Route::apiResource('/product_variations', ProductVariationController::class);
    Route::apiResource('/product_videos', ProductVideoController::class);
    Route::apiResource('/productstates', ProductStateController::class);
    Route::apiResource('/provinces', ProvinceController::class);
    Route::apiResource('/receipts', ReceiptController::class);
    Route::apiResource('/recipients', RecipientController::class);
    Route::apiResource('/roles', RoleController::class);
    Route::get('/sellerprofiles/list', [SellerProfileController::class, 'list']);
    Route::apiResource('/sellerprofiles', SellerProfileController::class);
    Route::apiResource('/settings', SettingController::class);
    Route::apiResource('/sitetexts', SitetextController::class);
    Route::apiResource('/shippings', ShippingController::class);
    Route::put('/shops/updateState/{shop}', [ShopController::class, 'updateState']);
    Route::get('/shops/shippings', [ShopController::class, 'getShippings']);
    Route::apiResource('/shops', ShopController::class);
    Route::apiResource('/sub_categories', SubCategoryController::class);
    Route::apiResource('/transactions', TransactionController::class);
    Route::apiResource('/transaction_states', TransactionStateController::class);
    Route::apiResource('/variations', VariationController::class);
    Route::apiResource('/variation_options', VariationOptionController::class);

    /* User */
    Route::get('/users/list', [UserController::class, 'list']);
    Route::get('/users/buyer', [UserController::class, 'buyer']);
    Route::get('/users/seller', [UserController::class, 'seller']);
    Route::put('/users/password_reset/{user}', [UserController::class, 'updatePassword']);
    Route::apiResource('/users', UserController::class);
});

/*
|--------------------------------------------------------------------------
| Buyer Routes
|--------------------------------------------------------------------------
*/

Route::prefix('buyer')->group(function () {
    Route::apiResource('/buyerprofile', BuyerBuyerProfileController::class);
    //Route::apiResource('/orders', BuyerOrderController::class);
});

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
*/

Route::prefix('seller')->group(function () {
    Route::apiResource('/custom_product_inquiries', SellerCustomProductInquiryController::class);
    Route::get('/dashboard/coming_soon', [SellerDashboardController::class, 'indexComingSoon']);
    Route::apiResource('/dashboard', SellerDashboardController::class);
    Route::put('/giftboxes/updateState/{product}', [SellerGiftboxController::class, 'updateState']);
    Route::get('/giftboxes/details', [SellerGiftboxController::class, 'getDetails']);
    Route::apiResource('/giftboxes', SellerGiftboxController::class);
    Route::apiResource('/orders', SellerOrderController::class);
    Route::get('/order_states', [SellerOrderStateController::class, 'index']);
    Route::get('/products/details', [SellerProductController::class, 'getDetails']);
    Route::get('/products/sub_categories/{categoryId}', [SellerProductController::class, 'getSubcategories']);
    //store new image for existing product
    Route::put('/products/storeNewImage/{productId}', [SellerProductController::class, 'storeNewImage']);
    Route::put('/products/updateState/{product}', [SellerProductController::class, 'updateState']);
    Route::apiResource('/products', SellerProductController::class);
    Route::apiResource('/productstates', SellerProductStateController::class);
    Route::apiResource('/product_images', SellerProductImageController::class);
    Route::post('/product_variations/store_new_option', [SellerProductVariationController::class, 'storeOption']);
    Route::apiResource('/product_variations', SellerProductVariationController::class);
    //Route::apiResource('/product_videos', SellerProductVideoController::class);
    Route::apiResource('/receipts', SellerReceiptController::class);
    Route::apiResource('/sellerprofile', SellerSellerProfileController::class);
    Route::get('/shop/shippings', [SellerShopController::class, 'getShippings']);
    Route::apiResource('/shop', SellerShopController::class);
    Route::apiResource('/transactions', SellerTransactionController::class);
    Route::apiResource('/transaction_states', SellerTransactionStateController::class);
    Route::post('/user/password_reset', [SellerUserController::class, 'updatePassword']);
    Route::post('/user/shop_setup_validate_profile', [SellerUserController::class, 'sellerProfileValidate']);
    Route::post('/user/shop_setup', [SellerUserController::class, 'storeShopSetup']);
    Route::apiResource('/user', SellerUserController::class);
    Route::apiResource('/variations', SellerVariationController::class);
    Route::apiResource('/variation_options', SellerVariationOptionController::class);
    Route::get('/locations/cities', [SellerLocationController::class, 'indexCity']);
});

/*
|--------------------------------------------------------------------------
| Email Routes
|--------------------------------------------------------------------------
*/

Route::prefix('email')->group(function () {
    //order
    Route::get('/buyer_order_new/{orderId}', [EmailController::class, 'sendBuyerOrderMail']);
    Route::get('/buyer_order_delivered/{orderId}', [EmailController::class, 'sendBuyerOrderDeliveredMail']);
    Route::get('/buyer_order_production/{orderId}', [EmailController::class, 'sendBuyerOrderProductionMail']);
    Route::get('/buyer_order_shipped/{orderId}', [EmailController::class, 'sendBuyerOrderShippedMail']);

    Route::get('/seller_order_new/{orderId}', [EmailController::class, 'sendSellerOrderMail']);
    Route::get('/seller_order_delivered/{orderId}', [EmailController::class, 'sendSellerOrderDeliveredMail']);
    Route::get('/seller_order_dispatch/{orderId}', [EmailController::class, 'sendSellerOrderDispatchMail']);

    Route::get('/seller_welcome/{email}', [EmailController::class, 'sendSellerWelcomeMail']);
    Route::get('/store_active_application', [EmailController::class, 'sendStoreActiveApplicationMail']);
    Route::get('/store_active/{email}', [EmailController::class, 'sendStoreActiveMail']);
    Route::get('/new_product_listed', [EmailController::class, 'sendProductListingConfirmedMail']);
    Route::get('/password_reset', [EmailController::class, 'sendPasswordResetMail']);
    Route::get('/new_order', [EmailController::class, 'sendOrderMail']);
});

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

//home & nav
Route::get('/navdata', [WebsiteHomeController::class, 'getNavbarData']);
Route::apiResource('/home', WebsiteHomeController::class);
//search
Route::get('/search/{searchText}', [WebsiteHomeController::class, 'searchSuggestion']);
Route::get('/searchIndex/{searchText}', [WebsiteHomeController::class, 'searchIndex']);
//pages
Route::get('/categories/products/{id}/{location}', [WebsiteCategoryController::class, 'getLocationWiseProducts']);
Route::get('/categories/sub_category/{id}', [WebsiteCategoryController::class, 'filterSubCategory']);
Route::apiResource('/categories', WebsiteCategoryController::class);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/currencies', [WebsiteCurrencyController::class, 'index']);
Route::put('/custom_product_inquiries/{productId}', [WebsiteCustomProductInquiryController::class, 'update']);
Route::apiResource('/occasions', WebsiteOccasionController::class);
Route::get('/orders/shippings/{shopId}', [WebsiteOrderController::class, 'getShippings']);
Route::apiResource('/orders', WebsiteOrderController::class);

Route::get('/products/prices/{productIds}', [WebsiteProductController::class, 'getPrice']);
Route::apiResource('/products', WebsiteProductController::class);
Route::apiResource('/recipients', WebsiteRecipientController::class);
Route::apiResource('/sellerprofiles', WebsiteSellerProfileController::class);
Route::apiResource('/shops', WebsiteShopController::class);
Route::get('/sub_categories/products/{id}/{location}', [WebsiteSubCategoryController::class, 'getLocationWiseProducts']);
Route::apiResource('/sub_categories', WebsiteSubCategoryController::class);
Route::apiResource('/transactions', WebsiteTransactionController::class);
//sitetext
Route::get('/sitetexts/about_pictures', [WebsiteSitetextController::class, 'aboutusPictures']);
Route::get('/sitetexts/seller_pictures', [WebsiteSitetextController::class, 'sellerPictures']);
Route::apiResource('/sitetexts', WebsiteSitetextController::class);
//location
Route::get('/locations/countries', [LocationController::class, 'indexCountry']);
Route::get('/locations/provinces', [LocationController::class, 'indexProvince']);
Route::get('/locations/districts/{province}', [LocationController::class, 'getDistrict']);
Route::get('/locations/districts', [LocationController::class, 'indexDistrict']);
Route::get('/locations/cities/{district}', [LocationController::class, 'indexCity']);
Route::get('/locations/areas/{city}', [LocationController::class, 'indexArea']);