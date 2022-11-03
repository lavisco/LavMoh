<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shop::with('products')->where('status', 1)->latest()->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($shopId, $location)
    {               
        $shop = Shop::findOrFail($shopId);
        $sortParameter = request('sortValue');

        $products = Product::with(['category:id,name', 'user.shop', 'product_image'])
                        ->where(function($q) use($location, $shop) {
                            $q->where('category_id', '=', '1')
                            ->where('user_id', $shop->user_id)
                            ->where('product_state_id', '1')
                            ->whereRelation('user.cities', 'name', $location);
                        })
                        ->orWhere(function($q) use($shop) {
                            $q->where('category_id', '!=', '1')
                                ->where('product_state_id', '1')
                                ->where('user_id', $shop->user_id);
                        })
                        ->when($sortParameter == 'base_price_low', function ($query) {
                            return $query->oldest('base_price');
                        })
                        ->when($sortParameter == 'base_price', function ($query) {
                            return $query->latest('base_price');
                        })
                        ->when($sortParameter == 'created_at', function ($query) {
                            return $query->latest();
                        })
                        ->latest()
                        ->paginate(10);

        $productslimited = Product::with(['product_image'])
                        ->where(function($q) use($location, $shop) {
                            $q->where('category_id', '=', '1')
                            ->where('user_id', $shop->user_id)
                            ->where('product_state_id', '1')
                            ->whereRelation('user.cities', 'name', $location);
                        })
                        ->orWhere(function($q) use($shop) {
                            $q->where('category_id', '!=', '1')
                                ->where('product_state_id', '1')
                                ->where('user_id', $shop->user_id);
                        })
                        ->latest()
                        ->take(10)
                        ->get();

        return response()->json([
            'products' => $products,
            'productslimited' => $productslimited,
            'shop' => $shop,
        ]);
    }
}
