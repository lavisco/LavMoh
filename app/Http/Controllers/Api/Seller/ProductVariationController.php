<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariationRequest;
use App\Models\ProductVariation;
use Illuminate\Validation\Rule;

class ProductVariationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', ProductVariation::class);
        return ProductVariation::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(ProductVariationRequest $request)
    {
        $this->authorize('create', ProductVariation::class);
        return ProductVariation::create($request->all());
    }

    public function show($productId)
    {
        ///$this->authorize('view', $productvariation);
        return ProductVariation::where('product_id', $productId)->latest()->get();
    }

    public function update(ProductVariationRequest $request, $productId)
    {
        ///$this->authorize('update', $productvariation);
       
        for ($i=0; $i < count($request->variation_id); $i++) { 
            $productVariation = ProductVariation::findOrFail($request->variation_id[$i]);

            $request->validate([
                // 'variation_sku'.$i => [
                //     'nullable',
                //     'max:16',
                //     Rule::unique('product_variations', 'sku')->ignore($productVariation->id),
                // ],
                'variation_sku.' . $i => "nullable|max:16|unique:product_variations,sku,{$productVariation->id},id",
            ]);
            
            $productVariation->update([
                'product_id' => $productId,
                'type' => $request->variation_type[$i],
                'type_option' => $request->variation_type_option[$i],
                'sku' => $request->variation_sku[$i] ?? null,
                'description' => $request->variation_description[$i] ?? null,
                'price' => $request->variation_price[$i] ?? '0.00',
                'quantity' => $request->variation_quantity[$i] ?? '0',
            ]);
        }
    }

    public function destroy($id)
    {
        ///$this->authorize('delete', $productvariation);
        $productvariation = ProductVariation::findOrFail($id);
        $productvariation->delete();
    }
}
