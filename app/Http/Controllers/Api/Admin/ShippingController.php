<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Shipping::class);

        return Shipping::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(ShippingRequest $request)
    {
        ///$this->authorize('create', Shipping::class);
        return Shipping::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $shipping);
        return Shipping::findOrFail($id);
    }

    public function update(ShippingRequest $request, Shipping $shipping)
    {
        ///$this->authorize('update', $shipping);
        $shipping->update($request->all());
    }

    public function destroy(Shipping $shipping)
    {
        ///$this->authorize('delete', $shipping);
        $shipping->delete();
    }
}
