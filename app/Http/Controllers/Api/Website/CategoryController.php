<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::with('latestProducts.product_image')
                ->where('status', 1)
                ->where('id', '!=', '11')
                ->latest()
                ->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId, $location)
    {
        $category = Category::findOrFail($categoryId);

        $sortParameter = request('sortValue');

        $products = Product::
                    whereRelation('user.shop', 'status', 1)
                    ->where('category_id', $categoryId)
                    ->where('product_state_id', '1')
                    ->with(['category:id,name', 'user.shop', 'product_image'])
                    ->when($categoryId == '1', function ($query) use($location) {
                        $query->whereRelation('user.districts', 'name', $location);
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
                    ->paginate(25);

        return response()->json([
            'products' => $products,
            'category' => $category,
            'sub_categories' => SubCategory::where('category_id', $categoryId)->get(),
        ]);
    }

    //temporary sub-category filter

    public function filterSubCategory($categoryId, $location)
    {
        $subCategory = SubCategory::findOrFail(request('subCategoryValue'));

        $sortParameter = request('sortValue');

        $products = $subCategory->products()
                    ->whereRelation('user.shop', 'status', 1)
                    ->where('category_id', $categoryId)
                    ->where('product_state_id', '1')
                    ->with(['category:id,name', 'user.shop', 'product_image'])
                    ->when($categoryId == '1', function ($query) use($location) {
                        $query->whereRelation('user.districts', 'name', $location);
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
                    ->paginate(25);

        return response()->json([
            'products' => $products,
        ]);
    }

    //not being used

    public function getLocationWiseProducts($id, $location)
    {
        // $products = Product::where('category_id', $id)
        //     ->where('product_state_id', '1')
        //     ->whereHas('user.shop', function($q) {
        //         return $q->where('status', 1);
        //     })
        //     ->whereHas('user', function($query) use($location){
        //         $query->whereHas('shop', function($query) use($location) {
        //             $query->where('district', $location);
        //         });
        //     })
        //     ->with(['user' => function($q) use($location) {
        //         $q->whereHas('shop', function($query) use($location) {
        //                 $query->where('district', $location);
        //         });
        //     }])
        //     ->with(['user.shop', 'product_image'])->latest()->paginate(25);


        $products = Product::where('category_id', $id)
            ->where('product_state_id', '1')
            ->whereHas('user.shop', function($q) {
                return $q->where('status', 1);
            })
            ->whereHas('user.districts', function($q) use($location) {
                return $q->where('name', $location);
            })
            ->with(['user.shop', 'user.districts', 'product_image'])->latest()->paginate(25);

        return response()->json([
            'products' => $products,
            'loc' => $location,
        ]);
    }
}
