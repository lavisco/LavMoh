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
    public function index()
    {
        $sortParameter = request('sortValue');
        $location = request('location');

        $query = Product::whereHas('user.shop', function($q) {
                        return $q->where('status', 1);
                    })
                    ->where('product_state_id', '1')
                    ->with(['category:id,name', 'user.shop', 'product_image']);

        $products = Product::with(['category:id,name', 'user.shop', 'product_image'])
                    ->where(function($q) use($location) {
                        $q->where('category_id', '=', '1')
                            ->where('product_state_id', '1')
                            ->whereRelation('user.shop', 'status', 1)
                            ->whereRelation('user.cities', 'name', $location);
                    })
                    ->orWhere(function($q){ 
                        $q->where('category_id', '!=', '1')
                            ->where('product_state_id', '1')
                            ->whereRelation('user.shop', 'status', 1);
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
                    ->paginate(25);

        return $products;
    }

    public function show($productId, $location)
    {
        $product = Product::with(['user.shop', 'category:id,name,slug', 'sub_categories:id,name', 'product_images', 'product_image', 'variations', 'variations.variation_options', 'variations.variation_options.variation:id,name', 'giftbox_products.childProduct.product_image'])->findOrFail($productId);

        $availability = $product->where(function($q) use($location) {
                            $q->whereRelation('user.shop', 'status', 1)
                            ->whereRelation('user.cities', 'name', $location);
                        })->exists();

        return response()->json([
            'product' => $product,
            'availability' => $availability,
        ]);
    }

    public function getPrice($productIds)
    {
        $jsonArray = json_decode($productIds,true);

        return Product::with(['variation_options', 'product_image', 'user.shop'])->findMany($jsonArray);
    }
}
