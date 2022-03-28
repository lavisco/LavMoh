<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        return Order::where('seller_id', auth()->id())->with(['buyer', 'order_products', 'order_products.product', 'order_products.order_product_variations.variation_option.variation', 'receipt'])->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function show($id)
    {
        return Order::with(['products', 'receipt'])->findOrFail($id);
    }

    public function update(Request $request, Order $order)
    {
        //$this->authorize('update', $order);
        $order->update([
            'status' => request('status'),
        ]);
    }
}
