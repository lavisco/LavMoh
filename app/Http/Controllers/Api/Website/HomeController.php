<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Occasion;
use App\Models\Product;
use App\Models\Recipient;
use App\Models\Role;
use App\Models\Shop;
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
        $products = Product::select('id', 'title', 'base_price', 'user_id', 'category_id', 'product_state_id', 'slug')
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
            'occasions' => Occasion::select('id', 'name', 'slug')->latest()->get(),
            'recipients' => Recipient::select('id', 'name', 'slug')->latest()->get(),
            'categories' => Category::with('homePageProducts.product_image')->latest()->get(),
            'homesliders' => HomeSlider::orderBy('order')->get(),
            'icon_cake' => Storage::disk('s3')->temporaryUrl('public/images/cake.png', '+2 minutes'),
            'icon_delivery' => Storage::disk('s3')->temporaryUrl('public/images/door-delivery.png', '+2 minutes'),
            'icon_money' => Storage::disk('s3')->temporaryUrl('public/images/send-money.png', '+2 minutes'),
            'icon_surprise' => Storage::disk('s3')->temporaryUrl('public/images/surprise.png', '+2 minutes'),
        ]);
    }

    public function getNavbarData()
    {
        if (auth('api')->check() && auth('api')->user()->role_id == Role::IS_BUYER) {
                $userName = auth('api')->user()->name;
        } else $userName = "Account";

        return response()->json([
            'occasions' => Occasion::select('id', 'name', 'slug')->latest()->get(),
            'recipients' => Recipient::select('id', 'name', 'slug')->latest()->get(),
            'categories' => Category::select('id', 'name', 'slug')->latest()->get(),
            'user' => $userName,
        ]);
    }

    /**
     * Display a listing of the search result resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchIndex()
    {
        $products = Product::where('product_state_id', '1')->with(['category:id,name', 'user.shop', 'product_image'])->latest()->filter(request(['searchText']))->get();
        $shop = Shop::latest()->filter(request(['searchText']))->get();

        return response()->json([
            'products' => $products,
            'occasions' => Occasion::filter(request(['searchText']))->latest()->get(),
            'recipients' => Recipient::latest()->filter(request(['searchText']))->get(),
            'categories' => Category::latest()->filter(request(['searchText']))->get(),
            'shops' => Shop::latest()->filter(request(['searchText']))->get(),
            //'all' => [$products, $shop],
        ]);
    }

    public function searchSuggestion($searchText)
    {
        $products = Product::where('product_state_id', '1')->where('title', 'like', '%' . $searchText . '%')->select('id', 'slug', 'title')->latest()->take(8)->get();

        return response()->json([
            'products' => $products,
        ]);
    }
}
