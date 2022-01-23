<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Material::class);

        return Material::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(MaterialRequest $request)
    {
        ///$this->authorize('create', Material::class);
        return Material::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $material);
        return Material::findOrFail($id);
    }

    public function update(MaterialRequest $request, Material $material)
    {
        ///$this->authorize('update', $material);
        $material->update($request->all());
    }

    public function destroy(Material $material)
    {
        ///$this->authorize('delete', $material);
        $material->delete();
    }
}
