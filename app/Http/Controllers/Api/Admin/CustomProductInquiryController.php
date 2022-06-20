<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomProductInquiryRequest;
use App\Models\CustomProductInquiry;
use Illuminate\Http\Request;

class CustomProductInquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return CustomProductInquiry::with('product')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(CustomProductInquiryRequest $request)
    {
        return CustomProductInquiry::create($request->all());
    }

    public function show($id)
    {
        return CustomProductInquiry::findOrFail($id);
    }

    public function update(CustomProductInquiryRequest $request, CustomProductInquiry $customProduct)
    {
        $customProduct->update($request->all());
    }

    public function destroy(CustomProductInquiry $customProduct)
    {
        $customProduct->delete();
    }
}
