<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Sitetext;
use Illuminate\Http\Request;

class SitetextController extends Controller
{
    public function index()
    {
        return Sitetext::latest()->filter(request(['searchText']))->paginate(25);
    }

    public function show($key)
    {
        ///$this->authorize('view', $sitetext);
        return Sitetext::where('key', $key)->findOrFail();
    }
}
