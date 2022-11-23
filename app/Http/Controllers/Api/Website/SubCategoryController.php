<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function show($subCategoryId, $location)
    {
        $subCategory = SubCategory::with('category')->findOrFail($subCategoryId);
        $subCategoryName = $subCategory->name;

        $sortParameter = request('sortValue');

        $products = Product::where('product_state_id', '1')
                    ->with(['category:id,name', 'user.shop', 'product_image'])
                    ->where(function($q) use($location, $subCategoryName) {
                        $q->where('category_id', '=', '1')
                        ->whereRelation('sub_categories', 'name', $subCategoryName)
                        ->whereRelation('user.shop', 'status', 1)
                        ->whereRelation('user.cities', 'name', $location);
                    })
                    ->orWhere(function($q) use ($subCategoryName) {
                        $q->where('category_id', '!=', '1')
                            ->whereRelation('user.shop', 'status', 1)
                           ->whereRelation('sub_categories', 'name', $subCategoryName);
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

        return response()->json([
            'products' => $products,
            'sub_category' => $subCategory,
        ]);
    }
}
