<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Role::class);

        return Role::latest()->filter(request(['searchText']))->get();
    }

    public function store(RoleRequest $request)
    {
        ///$this->authorize('create', Role::class);
        return Role::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $role);
        return Role::findOrFail($id);
    }

    public function update(RoleRequest $request, Role $role)
    {
        ///$this->authorize('update', $role);
        $role->update($request->all());
    }

    public function destroy(Role $role)
    {
        ///$this->authorize('delete', $role);
        $role->delete();
    }
}
