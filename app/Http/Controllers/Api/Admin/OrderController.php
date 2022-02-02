<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }
    
    public function index()
    {
        return Order::latest()->paginate(25);
    }

    public function store(OrderRequest $request)
    {
        return Order::create($request->all());
    }

    public function show($id)
    {
        return Order::findOrFail($id);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->all());
    }

    public function destroy(Order $order)
    {
        $order->delete();
    }
}
