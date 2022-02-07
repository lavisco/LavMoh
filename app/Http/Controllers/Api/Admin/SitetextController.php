<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SitetextRequest;
use App\Models\Sitetext;
use Illuminate\Http\Request;

class SitetextController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Sitetext::class);

        return Sitetext::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(SitetextRequest $request)
    {
        ///$this->authorize('create', Sitetext::class);
        return Sitetext::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $sitetext);
        return Sitetext::findOrFail($id);
    }

    public function update(SitetextRequest $request, Sitetext $sitetext)
    {
        ///$this->authorize('update', $sitetext);
        $sitetext->update($request->all());
    }

    public function destroy(Sitetext $sitetext)
    {
        ///$this->authorize('delete', $sitetext);
        $sitetext->delete();
    }
}
