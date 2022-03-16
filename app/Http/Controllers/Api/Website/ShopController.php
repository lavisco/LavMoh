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
        return Shop::with('products')->latest()->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($shopId)
    {               
        $shop = Shop::findOrFail($shopId);
        $products = Product::where('user_id', $shop->user_id)->where('product_state_id', '1')->with('product_image')->latest()->paginate(25);

        return response()->json([
            'products' => $products,
            'shop' => $shop,
        ]);
    }
}
