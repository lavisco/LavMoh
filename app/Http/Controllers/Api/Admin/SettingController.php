<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', Setting::class);

        return Setting::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(SettingRequest $request)
    {
        ///$this->authorize('create', Setting::class);
        return Setting::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $setting);
        return Setting::findOrFail($id);
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        ///$this->authorize('update', $setting);
        $setting->update($request->all());
    }

    public function destroy(Setting $setting)
    {
        ///$this->authorize('delete', $setting);
        $setting->delete();
    }
}
