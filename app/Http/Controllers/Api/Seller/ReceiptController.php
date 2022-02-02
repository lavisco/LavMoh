<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptRequest;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }
    
    public function index()
    {
        return Receipt::where('seller_id', auth()->id())->latest()->paginate(25);
    }

    public function show($id)
    {
        return Receipt::findOrFail($id);
    }

    public function update(ReceiptRequest $request, Receipt $receipt)
    {
        $receipt->update($request->all());
    }

}
