<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderState;
use Illuminate\Http\Request;

class OrderStateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        return OrderState::where('id', '!=', 1)->latest()->get();
    }
}
