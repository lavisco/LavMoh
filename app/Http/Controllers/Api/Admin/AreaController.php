<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Area::class);

        return Area::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(AreaRequest $request)
    {
        ///$this->authorize('create', Area::class);
        return Area::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $area);
        return Area::findOrFail($id);
    }

    public function update(AreaRequest $request, Area $area)
    {
        ///$this->authorize('update', $area);
        $area->update($request->all());
    }

    public function destroy(Area $area)
    {
        ///$this->authorize('delete', $area);
        $area->delete();
    }
}
