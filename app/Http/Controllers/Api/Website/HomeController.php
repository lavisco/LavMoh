<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\Recipient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id', 'title', 'base_price', 'user_id', 'category_id')
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
