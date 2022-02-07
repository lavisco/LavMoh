<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Country::class);

        return Country::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(CountryRequest $request)
    {
        ///$this->authorize('create', Country::class);
        return Country::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $country);
        return Country::findOrFail($id);
    }

    public function update(CountryRequest $request, Country $country)
    {
        ///$this->authorize('update', $country);
        $country->update($request->all());
    }

    public function destroy(Country $country)
    {
        ///$this->authorize('delete', $country);
        $country->delete();
    }
}
