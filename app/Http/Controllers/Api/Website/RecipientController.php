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
        $products = $recipient->products()->where('product_state_id', '1')->with(['category:id,name', 'user.shop', 'product_image'])->latest()->paginate(25);

        return response()->json([
            'products' => $products,
            'recipient' => $recipient,
        ]);
    }
}
