<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariationNewOptionRequest;
use App\Http\Requests\VariationOptionRequest;
use App\Models\VariationOption;
use Illuminate\Http\Request;

class VariationOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }
    
    public function index()
    {
        //
    }

    public function store(VariationNewOptionRequest $request)
    {
        $newOptions = $request->input('productNewOption.*');
        $productId = $request->id;

        for ($i=0; $i < 3; $i++) { 

            //if new option at index $i is filled
            if ($newOptions[$i]['new_option_variation_id']) {
                $variation_id = $newOptions[$i]['new_option_variation_id'];
                $option_name = $newOptions[$i]['new_option_name'];
                $option_sku = $newOptions[$i]['new_option_sku'];
                $option_price = $newOptions[$i]['new_option_price'];
                $option_quantity = $newOptions[$i]['new_option_quantity'];

                //create options for the newly created variation
                for ($j=0; $j < count($newOptions[$i]['new_option_name']); $j++) { 

                    $option = new VariationOption([
                        //repeating
                        'variation_id' => $variation_id,
                        'product_id' => $productId,
                        'product_state_id' => 1,
                        'user_id' => auth()->id(),
                        //non-repeating
                        'name' => $option_name[$j],
                        'sku' => $option_sku[$j] ?? null,
                        'price' => $option_price[$j] ?? '0.00',
                        'quantity' => $option_quantity[$j] ?? '0',
                    ]);

                    $option->save();
                }
            }
        }
        
    }

    public function show($id)
    {
        //
    }

    public function update(VariationOptionRequest $request, $productId)
    {
        ///$this->authorize('update', $variationoption);
       
        for ($i=0; $i < count($request->option_id); $i++) { 
            $option = VariationOption::findOrFail($request->option_id[$i]);

            $request->validate([
                'option_sku.' . $i => "nullable|max:16|unique:variation_options,sku,{$option->id},id",
            ]);
            
            $option->update([
                'name' => $request->option_name[$i],
                'sku' => $request->option_sku[$i] ?? null,
                'price' => $request->option_price[$i] ?? '0.00',
                'quantity' => $request->option_quantity[$i] ?? '0',
                'product_state_id' => $request->option_state[$i],
            ]);
        }
    }

    public function destroy($id)
    {
        //
    }
}
