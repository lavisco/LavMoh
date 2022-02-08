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
        return Product::with(['category:id,name', 'user.shop', 'product_image'])->latest()->filter(request(['searchText']))->paginate(25);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        $product = Product::with(['user.shop', 'category:id,name', 'materials', 'shippings',  'product_images', 'product_image'])->findOrFail($productId);
        $variations = ProductVariation::where('product_id', $productId)->get()->groupBy('type');

        return response()->json([
            'product' => $product,
            'variations' => $variations,
        ]);
    }
}
