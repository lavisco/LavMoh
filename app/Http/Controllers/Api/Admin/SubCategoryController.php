<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return SubCategory::with('category')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(SubCategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        SubCategory::create($request->all());
    }

    public function show($id)
    {
        return SubCategory::findOrFail($id);
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update($request->all());
    }

    public function destroy(SubCategory $subCategory)
    {
        ///$this->authorize('delete', $subCategory);
        $subCategory->delete();
    }
}
