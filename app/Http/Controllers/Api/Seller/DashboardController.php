<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        $user = User::FindOrFail(auth()->id());

        $shopActive = false;
        if($user->shop()->exists()){
            $user->shop->status === false ? $shopActive = false : $shopActive = true;
        }
        
        return response()->json([
            'user' => $user,
            'revenue' => Order::where('seller_id', auth()->id())->whereMonth('created_at', Carbon::now()->month)->sum('total'),
            'orderCount' => Order::where('seller_id', auth()->id())->whereMonth('created_at', Carbon::now()->month)->count(),
            'orders' => Order::where('seller_id', auth()->id())->select('id', 'code', 'delivery_date', 'total')->latest()->paginate(10),
            'productCount' => Product::where('user_id', auth()->id())->count(),
            'products' => Product::where('user_id', auth()->id())->select('id', 'code', 'title', 'base_price')->latest()->paginate(10),
            'sellerShop' => Shop::where('user_id', auth()->id())->get(),
            'hasShop' => $user->shop()->exists(),
            'shopActive' => $shopActive,
        ]);
    }

    public function indexComingSoon()
    {
        return response()->json([
            'image_path' => Storage::disk('s3')->temporaryUrl('public/images/Flag_perspective_matte_s.png', '+2 minutes')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
