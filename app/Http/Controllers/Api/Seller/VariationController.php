<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariationAndOptionStoreRequest;
use App\Http\Requests\VariationRequest;
use App\Models\Variation;
use App\Models\VariationOption;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }
    
    public function index()
    {
        //
    }

    /**
     * Store newly created variation resources along with their respective options in storage.
     */
    public function store(VariationAndOptionStoreRequest $request)
    {
        ///$this->authorize('create', ProductVariation::class);

        if ($request->has('productVariation.0.new_variation_option_name.0')) {

            $totalVariations = $request->input('productVariation.*.new_variation_name');
            $variationDescriptions = $request->input('productVariation.*.new_variation_description');
            $productVariations = $request->input('productVariation.*');
            $productId = $request->id;
            
            $counter = 0;
            for ($i = 0; $i < 3; $i++) {
                if ($totalVariations[$i]) {
                    $counter += 1;
                }
            }
    
            for ($i=0; $i < $counter; $i++) { 
                
                //form fields - variation
                $variation_name = $totalVariations[$i];
                $variation_description = $variationDescriptions[$i];

                //form fields - variation options
                $option_name = $productVariations[$i]['new_variation_option_name'];
                $option_sku = $productVariations[$i]['new_variation_option_sku'];
                $option_price = $productVariations[$i]['new_variation_option_price'];
                $option_quantity = $productVariations[$i]['new_variation_option_quantity'];

                //create variation
                $variation = new Variation([
                    'name' => $variation_name,
                    'description' => $variation_description,
                    'product_id' => $productId,
                    'product_state_id' => 1,
                ]);
                $variation->save();
    
                //create options for the newly created variation
                for ($j=0; $j < count($option_name); $j++) { 
                    VariationOption::create([
                        //repeating
                        'variation_id' => $variation->id,
                        'product_id' => $productId,
                        'product_state_id' => 1,
                        'user_id' => auth()->id(),
                        //non-repeating
                        'name' => $option_name[$j],
                        'sku' => $option_sku[$j] ?? null,
                        'price' => $option_price[$j] ?? '0.00',
                        'quantity' => $option_quantity[$j] ?? '0',
                    ]);
                }
            }
        }
    }

    /**
     * Display all the variations of the specified product.
     */

    public function show($productId)
    {
        ///$this->authorize('view', $productvariation);
        return response()->json([
            'variations' => Variation::where('product_id', $productId)->get(),
            'variation_options' => VariationOption::where('product_id', $productId)->latest()->get(),
        ]);
    }

    /**
     * Update all the variations of a particular product in storage.
     */
    public function update(VariationRequest $request, $productId)
    {
        ///$this->authorize('update', $productvariation);
       
        for ($i=0; $i < count($request->variation_id); $i++) { 
            $productVariation = Variation::findOrFail($request->variation_id[$i]);
            
            $productVariation->update([
                'product_state_id' => $request->variation_state[$i],
                'name' => $request->variation_name[$i],
                'description' => $request->variation_description[$i] ?? null,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
