<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptRequest;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }

    public function index()
    {
        return Receipt::latest()->paginate(25);
    }

    public function store(ReceiptRequest $request)
    {
        return Receipt::create($request->all());
    }

    public function show($id)
    {
        return Receipt::findOrFail($id);
    }

    public function update(ReceiptRequest $request, Receipt $receipt)
    {
        $receipt->update($request->all());
    }

    public function destroy(Receipt $receipt)
    {
        $receipt->delete();
    }
}
