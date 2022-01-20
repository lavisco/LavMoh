<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Occasion;
use App\Models\Product;
use Illuminate\Http\Request;

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
        ->latest()->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($occasionId)
    {
        $occasion = Occasion::findOrFail($occasionId);
        $products = $occasion->products()->with('product_image')->latest()->paginate(25);

        return response()->json([
            'products' => $products,
            'occasion' => $occasion,
        ]);
    }
}
