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

    

    public function paymentProcess(Request $request)
    {
        // unique_order_id|total_amount
        $plaintext = '525|10';
        $publickey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6nVc/ykIWsT1ktI8/49nfBUOQ
IHCCu9bC+pxEYbPvUth28MWitvm7y2u2nX/3/nVXMdvl2yiAbB7aBw4dGnAhXoAM
9WB8nw3AZS1VGqBBEKFs23EqUvjsBxrj+QasVkeZwC+oxvGuuprCIFW9o7w290c0
pJ28AUyd0dWx1YWu1wIDAQAB
-----END PUBLIC KEY-----";
        //load public key for encrypting
        openssl_public_encrypt($plaintext, $encrypt, $publickey);

        //encode for data passing
        $payment = base64_encode($encrypt);


        $response = Http::post('https://webxpay.com/index.php?route=checkout/billing', [
            'first_name' => "Mohorima",
            'last_name' => "Islam",
            'email' => "islammohrima@gmail.com",
            'phone' => "0215214578",
            'address_line_one' => "flat f3",
            
            'secret_key' => "f94682c3-c986-426e-b68f-9cbdd5f8d904",
            'cms' => "PHP",
            'payment' => "$payment",
        ]);

        return $response;
    }
}
