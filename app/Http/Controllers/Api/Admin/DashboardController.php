<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuyerProfile;
use App\Models\Product;
use App\Models\SellerProfile;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return response()->json([
            'buyers' => BuyerProfile::count(),
            'sellers' => SellerProfile::count(),
            'products' => Product::count(),
            'users' => User::count(),
            'inactiveShops' => Shop::where('status', false)->with('user')->latest()->get(),
            'latestProducts' => Product::with('user')->latest()->take(10)->get(),
        ]);
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
