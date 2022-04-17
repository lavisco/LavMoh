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
            'banner' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_banner_sm.jpg', '+2 minutes'),
            'icon_1' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon1sm.png', '+2 minutes'),
            'icon_2' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon2sm.png', '+2 minutes'),
            'icon_3' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon3sm.png', '+2 minutes'),
            'icon_4' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon4sm.png', '+2 minutes'),
            'icon_5' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon5sm.png', '+2 minutes'),
            'icon_6' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon6sm.png', '+2 minutes'),
            'icon_7' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon7sm.png', '+2 minutes'),
            'icon_8' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_icon8sm.png', '+2 minutes'),
            'review_1' => Storage::disk('s3')->temporaryUrl('public/images/sellerOnboard/seller_onboard_review1sm.jpeg', '+2 minutes'),
        ]);
    }

    public function aboutusPictures()
    {
        return response()->json([
            'about_us_image_1' => Sitetext::where('key', 'about_us_image_1')->select('content')->get(),
            'about_us_image_2' => Sitetext::where('key', 'about_us_image_2')->select('content')->get(),
        ]);
    }
}
