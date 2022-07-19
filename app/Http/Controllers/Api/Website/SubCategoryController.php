<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function show($subCategoryId)
    {
        $subCategory = SubCategory::findOrFail($subCategoryId);

        $sortParameter = request('sortValue');

        $query = $subCategory->products()
                    ->whereHas('user.shop', function($q) {
                        return $q->where('status', 1);
                    })
                    ->where('product_state_id', '1')
                    ->with(['category:id,name,slug', 'user.shop', 'product_image']);

        return response()->json([
            'products' => $sortParameter == 'base_price_low' ? $query->oldest('base_price')->paginate(25) : $query->latest(request('sortValue'))->paginate(25),
            'sub_category' => $subCategory,
        ]);
    }

    public function getLocationWiseProducts($id, $location)
    {
        $subCategory = SubCategory::findOrFail($id);

        $products = $subCategory->products()->where('product_state_id', '1')
            ->whereHas('user.shop', function($q) {
                return $q->where('status', 1);
            })
            ->whereHas('user', function($query) use($location){
                $query->whereHas('shop', function($query) use($location) {
                    $query->where('district', $location);
                });
            })
            ->with(['user' => function($q) use($location) {
                $q->whereHas('shop', function($query) use($location) {
                        $query->where('district', $location);
                });
            }])
            ->with(['user.shop', 'product_image'])->latest()->paginate(25);

        return response()->json([
            'products' => $products,
            'loc' => $location,
        ]);
    }
}
