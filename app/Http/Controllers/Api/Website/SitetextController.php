<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Sitetext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function sellerPictures()
    {
        return response()->json([
            'banner' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_banner.png', '+2 minutes'),
            'icon_1' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon1.png', '+2 minutes'),
            'icon_2' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon2.png', '+2 minutes'),
            'icon_3' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon3.png', '+2 minutes'),
            'icon_4' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon4.png', '+2 minutes'),
            'icon_5' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon5.png', '+2 minutes'),
            'icon_6' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon6.png', '+2 minutes'),
            'icon_7' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon7.png', '+2 minutes'),
            'icon_8' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon8.png', '+2 minutes'),
            'review_1' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_review1.jpeg', '+2 minutes'),
        ]);
    }
}
