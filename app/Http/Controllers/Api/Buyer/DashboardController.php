<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Models\BuyerProfile;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_buyer']);
    }
    
    public function index()
    {
        return response()->json([
            'buyerprofile' => BuyerProfile::where('user_id', auth()->id())->first(),
            'user' => User::where('id', auth()->id())->first(),
            'orderCount' => Order::where('buyer_id', auth()->id())->orWhere('email', auth()->user()->email)->whereMonth('created_at', Carbon::now()->month)->count(),
            'orders' => Order::where('buyer_id', auth()->id())->where('order_state_id', '!=', 1)->orWhere('email', auth()->user()->email)->select('id', 'code', 'delivery_date', 'total')->latest()->paginate(10),
        ]);
    }
}
