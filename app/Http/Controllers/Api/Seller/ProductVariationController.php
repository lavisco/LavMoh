<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVariationRequest;
use App\Http\Requests\ProductVariationStoreRequest;
use App\Models\ProductVariation;
use Carbon\Carbon;
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

    public function store(ProductVariationStoreRequest $request)
    {
        ///$this->authorize('create', ProductVariation::class);

        if ($request->has('productVariation.0.variation_type_option.0')) {

            $variations = $request->input('productVariation.*.variationId');
            $variationDescriptions = $request->input('productVariation.*.variationDescription');
            $productVariations = $request->input('productVariation.*');
            $productId = $request->id;
            
            $counter = 0;
            for ($i = 0; $i < 3; $i++) {
                if ($variations[$i]) {
                    $counter += 1;
                }
            }
    
            for ($i=0; $i < $counter; $i++) { 
                $variation_type = $variations[$i];
                $variation_description = $variationDescriptions[$i];
                $type_option = $productVariations[$i]['variation_type_option'];
                $sku = $productVariations[$i]['sku'];
                $variation_price = $productVariations[$i]['variation_price'];
                $variation_quantity = $productVariations[$i]['variation_quantity'];
    
                for ($j=0; $j < count($type_option); $j++) { 
                    ProductVariation::create([
                        //repeating
                        'product_id' => $productId,
                        'product_state_id' => 1,
                        'user_id' => auth()->id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'type' => $variation_type,
                        'description' => $variation_description,
                        //non-repeating
                        'type_option' => $type_option[$j],
                        'sku' => $sku[$j] ?? null,
                        'price' => $variation_price[$j] ?? '0.00',
                        'quantity' => $variation_quantity[$j] ?? '0',
                    ]);
                }
            }
        }
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
