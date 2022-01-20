<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerProfileRequest;
use App\Models\SellerProfile;
use Illuminate\Http\Request;

class SellerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        ///$this->authorize('viewAny', SellerProfile::class);
        return SellerProfile::where('user_id', auth()->id())->first();
    }

    public function store(SellerProfileRequest $request)
    {
    }

    public function update(SellerProfileRequest $request, SellerProfile $sellerprofile)
    {
        ///$this->authorize('update', $sellerprofile);
        $sellerprofile->update($request->all());
    }
}
