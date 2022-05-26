<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Recipient::with('latestProducts.product_image')
        ->latest()->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($recipientId)
    {
        $recipient = Recipient::findOrFail($recipientId);

        $sortParameter = request('sortValue');

        $query = $recipient->products()->where('product_state_id', '1')->with(['category:id,name', 'user.shop', 'product_image']);

        return response()->json([
            'products' => $sortParameter == 'base_price_low' ? $query->oldest('base_price')->paginate(25) : $query->latest(request('sortValue'))->paginate(25),
            'recipient' => $recipient,
        ]);
    }
}
