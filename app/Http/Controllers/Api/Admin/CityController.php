<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', City::class);

        return City::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(CityRequest $request)
    {
        ///$this->authorize('create', City::class);
        return City::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $city);
        return City::findOrFail($id);
    }

    public function update(CityRequest $request, City $city)
    {
        ///$this->authorize('update', $city);
        $city->update($request->all());
    }

    public function destroy(City $city)
    {
        ///$this->authorize('delete', $city);
        $city->delete();
    }
}
