<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function websiteIndex()
    {
        return view('layouts.master');
    }

    public function nonVueWebsiteIndex()
    {
        return view('layouts.master');
    }

    public function employeeIndex()
    {
        return view('layouts.employee_master');
    }    

    public function merchantIndex()
    {
        return view('layouts.merchant_master');
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
