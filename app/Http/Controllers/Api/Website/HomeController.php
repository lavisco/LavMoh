<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id', 'title', 'base_price', 'user_id', 'category_id', 'product_state_id')
                    ->where('product_state_id', '1')
                    ->with(['user' => function($query){
                        $query->select('id', 'name');
                    }, 'user.shop' => function ($query){
                        $query->select('id', 'name', 'user_id');
                    },
                    'category:id,name',
                    'product_image'
                    ])
                    ->latest()->take(10)->get();

        return response()->json([
            'products' => $products,
            'occasions' => Occasion::select('id', 'name')->latest()->get(),
            'recipients' => Recipient::select('id', 'name')->latest()->get(),
            'categories' => Category::select('id', 'name')->latest()->get(),
            'homesliders' => HomeSlider::orderBy('order')->get(),
            'icon_cake' => Storage::disk('s3')->temporaryUrl('public/images/cake.png', '+2 minutes'),
            'icon_delivery' => Storage::disk('s3')->temporaryUrl('public/images/door-delivery.png', '+2 minutes'),
            'icon_money' => Storage::disk('s3')->temporaryUrl('public/images/send-money.png', '+2 minutes'),
            'icon_surprise' => Storage::disk('s3')->temporaryUrl('public/images/surprise.png', '+2 minutes'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
