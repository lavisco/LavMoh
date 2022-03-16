<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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
        $products = Product::where('category_id', $categoryId)->where('product_state_id', '1')->with(['user.shop','product_image'])->latest()->filter(request(['searchText']))->paginate(25);

        return response()->json([
            'products' => $products,
            'category' => $category,
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
            ->whereHas('user', function($query){
                $query->whereHas('seller_profile', function($query) {
                    $query->where('city', 'Kandy');
                });
            })
            ->with(['user' => function($q) {
                $q->whereHas('seller_profile', function($query) {
                        $query->where('city', 'Kandy');
                });
            }])
            ->with(['user.shop','product_image'])->latest()->paginate(25);

        return response()->json([
            'products' => $products,
            'loc' => $location,
        ]);
    }
}
