<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return Transaction::with(['order', 'user', 'user.shop'])->orderBy('request_withdrawal_date')->paginate(25);
    }

    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());
        $transaction->update([
            'code' => 'LT'.str_pad($transaction->id,5,"0",STR_PAD_LEFT),
        ]);
    }

    public function show($id)
    {
        return Transaction::findOrFail($id);
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
    }
}
