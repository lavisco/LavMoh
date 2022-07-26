<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sortParameter = request('sortValue');

        $query = Product::whereHas('user.shop', function($q) {
                        return $q->where('status', 1);
                    })
                    ->where('product_state_id', '1')
                    ->with(['category:id,name', 'user.shop', 'product_image']);

        return $sortParameter == 'base_price_low' ? $query->oldest('base_price')->paginate(25) : $query->latest(request('sortValue'))->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        return Product::with(['user.shop', 'category:id,name,slug', 'sub_categories:id,name', 'product_images', 'product_image', 'variations', 'variations.variation_options', 'variations.variation_options.variation:id,name', 'giftbox_products.childProduct.product_image'])->findOrFail($productId);
    }
}
