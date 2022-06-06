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
                    ->latest()->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $sortParameter = request('sortValue');

        $query = Product::where('category_id', $categoryId)->where('product_state_id', '1')->with(['category:id,name', 'user.shop', 'product_image']);

        return response()->json([
            'products' => $sortParameter == 'base_price_low' ? $query->oldest('base_price')->paginate(25) : $query->latest(request('sortValue'))->paginate(25),
            'category' => $category,
            'sub_categories' => SubCategory::where('category_id', $categoryId)->get(),
        ]);
    }

    public function filterSubCategory($categoryId)
    {
        $subCategory = SubCategory::findOrFail(request('subCategoryValue'));

        $sortParameter = request('sortValue');

        $query = $subCategory->products()->where('category_id', $categoryId)->where('product_state_id', '1')->with(['category:id,name', 'user.shop', 'product_image']);

        return response()->json([
            'products' => $sortParameter == 'base_price_low' ? $query->oldest('base_price')->paginate(25) : $query->latest(request('sortValue'))->paginate(25),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLocationWiseProducts($id, $location)
    {
        $products = Product::where('category_id', $id)->where('product_state_id', '1')
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
