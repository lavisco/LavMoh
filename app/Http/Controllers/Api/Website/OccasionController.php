<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Occasion;
use App\Models\Product;

class OccasionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Occasion::with('latestProducts.product_image')
                ->where('status', 1)
                ->latest()->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($occasionId, $location)
    {
        $occasion = Occasion::findOrFail($occasionId);
        $occasionName = $occasion->name;

        $sortParameter = request('sortValue');
        
        $products = Product::where('product_state_id', '1')
                    ->with(['category:id,name', 'user.shop', 'product_image'])
                    ->where(function($q) use($location, $occasionName) {
                        $q->where('category_id', '=', '1')
                        ->whereRelation('occasions', 'name', $occasionName)
                        ->whereRelation('user.shop', 'status', 1)
                        ->whereRelation('user.districts', 'name', $location);
                    })
                    ->orWhere(function($q) use ($occasionName) {
                        $q->where('category_id', '!=', '1')
                            ->whereRelation('user.shop', 'status', 1)
                           ->whereRelation('occasions', 'name', $occasionName);
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
            'occasion' => $occasion,
        ]);
    }
}
