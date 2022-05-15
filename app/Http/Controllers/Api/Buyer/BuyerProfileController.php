<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyerProfileRequest;
use App\Models\BuyerProfile;
use Illuminate\Http\Request;

class BuyerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_buyer']);
    }

    public function index()
    {
        ///$this->authorize('viewAny', BuyerProfile::class);
        return BuyerProfile::where('user_id', auth()->id())->first();
    }

    public function store(BuyerProfileRequest $request)
    {
        ///$this->authorize('create', BuyerProfile::class);
        return BuyerProfile::create($request->all());
    }

    public function update(BuyerProfileRequest $request, BuyerProfile $id)
    {
        ///$this->authorize('update', $buyerprofile);

        $buyerprofile = BuyerProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            $request->all(),
        );
    }
}
