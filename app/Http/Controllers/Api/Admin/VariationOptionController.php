<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariationOptionRequest;
use App\Models\VariationOption;
use Illuminate\Http\Request;

class VariationOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', VariationOption::class);

        return VariationOption::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(VariationOptionRequest $request)
    {
        ///$this->authorize('create', VariationOption::class);
        return VariationOption::create($request->all());
    }

    public function show($productId)
    {
        ///$this->authorize('view', $variationoption);
        return VariationOption::where('product_id', $productId)->latest()->get();
    }

    public function update(VariationOptionRequest $request, VariationOption $variationoption)
    {
        ///$this->authorize('update', $variationoption);
        $variationoption->update($request->all());
    }

    public function destroy($id)
    {
        ///$this->authorize('delete', $variationoption);
        $variationoption = VariationOption::findOrFail($id);
        $variationoption->delete();
    }
}
