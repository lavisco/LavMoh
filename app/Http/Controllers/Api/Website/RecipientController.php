<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
                ->where('status', 1)
                ->latest()->paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($recipientId, $location)
    {
        $recipient = Recipient::findOrFail($recipientId);
        $recipientName = $recipient->name;

        $sortParameter = request('sortValue');

        $products = Product::where('product_state_id', '1')
                    ->with(['category:id,name', 'user.shop', 'product_image'])
                    ->where(function($q) use($location, $recipientName) {
                        $q->where('category_id', '=', '1')
                        ->whereRelation('recipients', 'name', $recipientName)
                        ->whereRelation('user.shop', 'status', 1)
                        ->whereRelation('user.districts', 'name', $location);
                    })
                    ->orWhere(function($q) use ($recipientName) {
                        $q->where('category_id', '!=', '1')
                            ->whereRelation('user.shop', 'status', 1)
                           ->whereRelation('recipients', 'name', $recipientName);
                    })
                    ->when($sortParameter == 'base_price_low', function ($query) {
                        return $query->oldest('base_price');
                    })
                    ->when($sortParameter == 'base_price', function ($query) {
                        return $query->latest('base_price');
                    })
                    ->when($sortParameter == 'created_at', function ($query) {
                        return $query->latest();
                    })
                    ->latest()
                    ->paginate(25);

        return response()->json([
            'products' => $products,
            'recipient' => $recipient,
        ]);
    }
}
