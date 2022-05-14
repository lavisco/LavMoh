<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Models\TransactionState;
use Illuminate\Http\Request;

class TransactionStateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }

    public function index()
    {
        return TransactionState::latest()->get();
    }
}
