<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStateRequest;
use App\Models\ProductState;
use Illuminate\Http\Request;

class ProductStateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', ProductState::class);

        return ProductState::latest()->filter(request(['searchText']))->get();
    }

    public function store(ProductStateRequest $request)
    {
        ///$this->authorize('create', ProductState::class);
        return ProductState::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $productstate);
        return ProductState::findOrFail($id);
    }

    public function update(ProductStateRequest $request, ProductState $productstate)
    {
        ///$this->authorize('update', $productstate);
        $productstate->update($request->all());
    }

    public function destroy(ProductState $productstate)
    {
        ///$this->authorize('delete', $productstate);
        $productstate->delete();
    }
}
