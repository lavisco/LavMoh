<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_seller']);
    }
    public function index()
    {
        return Transaction::where('user_id', auth()->id())->with('order')->latest()->paginate(25);
    }

    public function store(Request $request)
    {
        for ($i=0; $i < count($request->transaction_ids); $i++) { 
            $transactionn = Transaction::findOrFail($request->transaction_ids[$i]);
            $transactionn->update([
                'request_withdrawal_date' => date("Y-m-d"),
            ]);
        }
    }
}
