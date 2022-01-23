<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVideoRequest;
use App\Models\ProductVideo;
use Illuminate\Http\Request;

class ProductVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', ProductVideo::class);

        return ProductVideo::latest()->paginate(25);
    }

    public function store(ProductVideoRequest $request)
    {
        ///$this->authorize('create', ProductVideo::class);
        return ProductVideo::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $productvideo);
        return ProductVideo::findOrFail($id);
    }

    public function update(ProductVideoRequest $request, ProductVideo $productvideo)
    {
        ///$this->authorize('update', $productvideo);
        $productvideo->update($request->all());
    }

    public function destroy(ProductVideo $productvideo)
    {
        ///$this->authorize('delete', $productvideo);
        $productvideo->delete();
    }
}
