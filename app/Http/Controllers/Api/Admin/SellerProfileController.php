<?php

namespace App\Http\Controllers\Api\Admin;

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

        return SellerProfile::with('user')->latest()->filter(request(['searchText']))->paginate(25);
    }

    public function store(SellerProfileRequest $request)
    {
        ///$this->authorize('create', SellerProfile::class);
        return SellerProfile::create($request->all());
    }

    public function show($id)
    {
        ///$this->authorize('view', $sellerprofile);
        return SellerProfile::findOrFail($id);
    }

    public function update(SellerProfileRequest $request, SellerProfile $sellerprofile)
    {
        ///$this->authorize('update', $sellerprofile);
        $sellerprofile->update($request->all());
    }

    public function destroy(SellerProfile $sellerprofile)
    {
        ///$this->authorize('delete', $sellerprofile);
        $sellerprofile->delete();
    }
}
