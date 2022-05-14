<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStateRequest;
use App\Models\OrderState;
use Illuminate\Http\Request;

class OrderStateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return OrderState::latest()->paginate(25);
    }

    public function store(OrderStateRequest $request)
    {
        return OrderState::create($request->all());
    }

    public function show($id)
    {
        return OrderState::findOrFail($id);
    }

    public function update(OrderStateRequest $request, OrderState $orderState)
    {
        $orderState->update($request->all());
    }

    public function destroy(OrderState $orderState)
    {
        $orderState->delete();
    }
}
