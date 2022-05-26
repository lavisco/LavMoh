<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Occasion;

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
        $sortParameter = request('sortValue');
        $query = $occasion->products()->where('product_state_id', '1')->with(['category:id,name', 'user.shop', 'product_image']);

        return response()->json([
            'products' => $sortParameter == 'base_price_low' ? $query->oldest('base_price')->paginate(25) : $query->latest(request('sortValue'))->paginate(25),
            'occasion' => $occasion,
        ]);
    }
}
