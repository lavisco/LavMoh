<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariationRequest;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        ///$this->authorize('viewAny', ProductVariation::class);
        ///ProductVariation::latest()->filter(request('keywords'))->paginate(25);

        return ProductVariation::latest()->paginate(25);
    }

    public function store(ProductVariationRequest $request)
    {
        $this->authorize('create', ProductVariation::class);
        return ProductVariation::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $productvariation);
        return ProductVariation::findOrFail($id);
    }

    public function update(ProductVariationRequest $request, ProductVariation $productvariation)
    {
        ///$this->authorize('update', $productvariation);
        $productvariation->update($request->all());
    }

    public function destroy(ProductVariation $productvariation)
    {
        ///$this->authorize('delete', $productvariation);
        $productvariation->delete();
    }
}
