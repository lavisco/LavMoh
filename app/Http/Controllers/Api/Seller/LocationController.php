<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function indexCity()
    {
        return City::select('id', 'name')->orderBy('name')->get();
    }
}
