<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make(Str::random(12)),
            'status' => 0,
            'role_id' => Role::IS_BUYER,
        ]);

        $request->merge([
            'code' => Str::random(12),
            'status' => "pending",
            'tax' => 0.00,
            'buyer_id' => $user->id,
        ]);

        $order = Order::create($request->all());

        $request->merge([
            'order_id' => $order->id,
            'product_id' => "1",
            'total' => $request->input('product_total'),
        ]);

        $order_product = OrderProduct::create($request->all());
    }
}
