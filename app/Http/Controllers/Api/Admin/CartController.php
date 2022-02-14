<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return Cart::with(['seller.seller_profile', 'buyer', 'shop', 'giftwrap', 'products', 'receipt'])->latest()->paginate(25);
    }

    public function store(CartRequest $request)
    {
        return Cart::create($request->all());
    }

    public function show($id)
    {
        return Cart::findOrFail($id);
    }

    public function update(CartRequest $request, Cart $cart)
    {
        $cart->update($request->all());
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
    }
}
