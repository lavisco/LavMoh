<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomProductInquiryRequest;
use App\Models\CustomProductInquiry;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomProductInquiryController extends Controller
{
    public function update(CustomProductInquiryRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        $request->merge([
            'status' => "pending",
            'country' => "Sri Lanka",
            'product_id' => $product->id,
            'user_id' => $product->user_id,
        ]);

        return CustomProductInquiry::create($request->all());
    }
}
