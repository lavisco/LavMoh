<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function websiteIndex()
    {
        $tags = [
            'og:name' => 'Lavisco',
            'og:image' => '/images/lavisco/logo.jpg',
            'og:description' => 'Buy locally. Support small businesses.',
            'og:keywords' => 'sri lanka cake, cakes in sri lanka, cakes in srilanka, srilanka cakes, gift in srilanka, srilanka gifts, flower in sri lanka'
        ];

        return view('layouts.master', compact('tags'));
    }

    public function websiteProductIndex(Product $productId)
    {
        $product_img = $productId->product_thumbnail ? $productId->product_thumbnail->path : $productId->product_image->path;
        $tags = [
            'og:name' => $productId->title,
            'og:image' => $product_img,
            'og:description' => $productId->short_description,
            'og:keywords' => $productId->title.', sri lanka cake, cakes in sri lanka, cakes in srilanka, srilanka cakes, gift in srilanka, srilanka gifts, flower in sri lanka'
        ];

        return view('layouts.master', compact('tags'));
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
