<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariationRequest;
use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Variation::class);

        return Variation::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(VariationRequest $request)
    {
        ///$this->authorize('create', Variation::class);
        return Variation::create($request->all());
    }

    public function show($productId)
    {
        ///$this->authorize('view', $variation);
        return Variation::where('product_id', $productId)->latest()->get();
    }

    public function update(VariationRequest $request, Variation $variation)
    {
        ///$this->authorize('update', $variation);
        $variation->update($request->all());
    }

    public function destroy($id)
    {
        ///$this->authorize('delete', $variation);
        $variation = Variation::findOrFail($id);
        $variation->delete();
    }
}
