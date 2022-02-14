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
        $countryid = Country::select('id')->where('id', $country)->orWhere('name', $country)->first();
        return Province::where('country_id', $countryid->id)->latest()->get();
    }
    public function indexDistrict($province)
    {
        $provinceid = Province::select('id')->where('id', $province)->orWhere('name', $province)->first();
        return District::where('province_id', $provinceid->id)->latest()->get();
    }
    public function indexCity($district)
    {
        $districtid = District::select('id')->where('id', $district)->orWhere('name', $district)->first();
        return City::where('district_id', $districtid->id)->latest()->get();
    }
    public function indexArea($city)
    {
        $cityid = City::select('id')->where('id', $city)->orWhere('name', $city)->first();
        return Area::where('city_id', $cityid->id)->latest()->get();
    }
}
