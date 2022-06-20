<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomProductInquiryRequest;
use App\Models\CustomProductInquiry;
use Illuminate\Http\Request;

class CustomProductInquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        return CustomProductInquiry::where('user_id', auth()->id())->with('product')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function show($id)
    {
        return CustomProductInquiry::findOrFail($id);
    }

    public function update(CustomProductInquiryRequest $request, CustomProductInquiry $customProduct)
    {
        $customProduct->update($request->all());
    }
}
