<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function websiteIndex()
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

    public function currencyConverter()
    {
        $req_url = 'https://api.exchangerate.host/latest?base=LKR&symbols=USD,AUD';
        $response_json = file_get_contents($req_url);

        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
                    return $response->rates;
                }
            } catch(Exception $e) {
                var_dump($e);
            }
        }  
    }
}
