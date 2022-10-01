<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductVariation;
use App\Models\Receipt;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }
    
    public function index()
    {
        return Order::with(['buyer', 'seller', 'seller.shop', 'order_state', 'order_products', 'order_products.product', 'order_products.order_product_variations.variation_option.variation', 'receipt', 'shipping'])
                ->latest()
                ->filterstatus(request(['statusFilter']))
                ->filter(request(['searchText']))
                ->paginate(25);
    }

    public function store(OrderRequest $request)
    {
        return Order::create($request->all());
    }

    public function show($id)
    {
        return Order::with(['products', 'receipt'])->findOrFail($id);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->all());
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'order_state_id' => request('order_state_id'),
        ]);
    }

    public function destroy(Order $order)
    {
        //delete order record if payment fails
        Transaction::where('order_id', $order->id)->delete();
        Receipt::where('order_id', $order->id)->delete();
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        foreach ($orderProducts as $orderProduct) {
            OrderProductVariation::where('order_product_id', $orderProduct->id)->delete();
            $orderProduct->delete();
        }
       
        $order->delete();
    }
}
