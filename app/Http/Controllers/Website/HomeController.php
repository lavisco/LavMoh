<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function websiteIndex()
    {
        return view('layouts.master');
    }

    public function adminIndex()
    {
        return view('layouts.admin_dashboard_master');
    }

    public function sellerIndex()
    {
        return view('layouts.lavisco_dashboard_master');
    }

    public function buyerIndex()
    {
        return view('layouts.lavisco_dashboard_master');
    }
}
