<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', District::class);

        return District::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(DistrictRequest $request)
    {
        ///$this->authorize('create', District::class);
        return District::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $district);
        return District::findOrFail($id);
    }

    public function update(DistrictRequest $request, District $district)
    {
        ///$this->authorize('update', $district);
        $district->update($request->all());
    }

    public function destroy(District $district)
    {
        ///$this->authorize('delete', $district);
        $district->delete();
    }
}
