<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequest;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Province::class);

        return Province::with('country')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(ProvinceRequest $request)
    {
        ///$this->authorize('create', Province::class);
        return Province::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $province);
        return Province::findOrFail($id);
    }

    public function update(ProvinceRequest $request, Province $province)
    {
        ///$this->authorize('update', $province);
        $province->update($request->all());
    }

    public function destroy(Province $province)
    {
        ///$this->authorize('delete', $province);
        $province->delete();
    }
}
