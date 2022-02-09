<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function indexCountry()
    {
        return Country::latest()->get();
    }
    public function indexProvince($country)
    {
        return Province::where('country_id', $country)->latest()->get();
    }
    public function indexDistrict($province)
    {
        return District::where('province_id', $province)->latest()->get();
    }
    public function indexCity($district)
    {
        return City::where('district_id', $district)->latest()->get();
    }
    public function indexArea($city)
    {
        return Area::where('city_id', $city)->latest()->get();
    }
}
