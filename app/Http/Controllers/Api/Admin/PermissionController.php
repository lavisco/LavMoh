<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        ///$this->authorize('viewAny', Permission::class);

        return Permission::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(PermissionRequest $request)
    {
        ///$this->authorize('create', Permission::class);
        return Permission::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $permission);
        return Permission::findOrFail($id);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        ///$this->authorize('update', $permission);
        $permission->update($request->all());
    }

    public function destroy(Permission $permission)
    {
        ///$this->authorize('delete', $permission);
        $permission->delete();
    }
}
