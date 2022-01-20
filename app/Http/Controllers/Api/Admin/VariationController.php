<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariationRequest;
use App\Models\Variation;
use App\Models\VariationOption;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        ///$this->authorize('viewAny', Variation::class);

        return Variation::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function getOptions()
    {
        ///$this->authorize('viewAny', Variation::class);

        return VariationOption::where('variation_id', request('variation_id'))->get();
    }

    public function store(VariationRequest $request)
    {
        ///$this->authorize('create', Variation::class);
        return Variation::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $variation);
        return Variation::findOrFail($id);
    }

    public function update(VariationRequest $request, Variation $variation)
    {
        ///$this->authorize('update', $variation);
        $variation->update($request->all());
    }

    public function destroy(Variation $variation)
    {
        ///$this->authorize('delete', $variation);
        $variation->delete();
    }
}
