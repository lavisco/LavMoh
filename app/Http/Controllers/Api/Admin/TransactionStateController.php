<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStateRequest;
use App\Models\TransactionState;
use Illuminate\Http\Request;

class TransactionStateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return TransactionState::get();
    }

    public function store(TransactionStateRequest $request)
    {
        return TransactionState::create($request->all());
    }

    public function show($id)
    {
        return TransactionState::findOrFail($id);
    }

    public function update(TransactionStateRequest $request, TransactionState $transactionState)
    {
        $transactionState->update($request->all());
    }

    public function destroy(TransactionState $transactionState)
    {
        $transactionState->delete();
    }
}
