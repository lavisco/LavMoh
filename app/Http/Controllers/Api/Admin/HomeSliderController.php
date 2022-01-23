<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeSliderRequest;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', HomeSlider::class);

        return HomeSlider::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(HomeSliderRequest $request)
    {
        ///$this->authorize('create', HomeSlider::class);
        return HomeSlider::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $homeslider);
        return HomeSlider::findOrFail($id);
    }

    public function update(HomeSliderRequest $request, HomeSlider $homeslider)
    {
        ///$this->authorize('update', $homeslider);
        $homeslider->update($request->all());
    }

    public function destroy(HomeSlider $homeslider)
    {
        ///$this->authorize('delete', $homeslider);
        $homeslider->delete();
    }
}
