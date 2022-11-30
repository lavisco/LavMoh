<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopProductRequest;
use App\Models\TopProduct;
use Illuminate\Http\Request;

class TopProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return TopProduct::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(TopProductRequest $request)
    {
        ///$this->authorize('create', TopProduct::class);
        return TopProduct::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $topProduct);
        return TopProduct::findOrFail($id);
    }

    public function update(TopProductRequest $request, TopProduct $topProduct)
    {
        ///$this->authorize('update', $topProduct);
        $topProduct->update($request->all());
    }

    public function destroy(TopProduct $topProduct)
    {
        ///$this->authorize('delete', $topProduct);
        $topProduct->delete();
    }
}
