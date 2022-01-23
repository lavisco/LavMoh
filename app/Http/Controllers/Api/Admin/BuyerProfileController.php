<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyerProfileRequest;
use App\Models\BuyerProfile;
use Illuminate\Http\Request;

class BuyerProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ///$this->authorize('viewAny', BuyerProfile::class);

        return BuyerProfile::with('user')->latest()->filter(request(['searchText']))->paginate(25);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuyerProfileRequest $request)
    {
        ///$this->authorize('create', BuyerProfile::class);
        return BuyerProfile::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        ///$this->authorize('view', $buyerprofile);
        return BuyerProfile::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuyerProfileRequest $request, BuyerProfile $buyerprofile)
    {
        ///$this->authorize('update', $buyerprofile);
        $buyerprofile->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuyerProfile $buyerprofile)
    {
        ///$this->authorize('delete', $buyerprofile);
        $buyerprofile->delete();
    }
}
