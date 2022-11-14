<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Currency;
use App\Models\District;
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
        $location = request('location');
        $products = Product::select('id', 'title', 'base_price', 'user_id', 'category_id', 'product_state_id', 'slug', 'has_variations')
                    ->with(['user' => function($query){
                        $query->select('id', 'name');
                        }, 'user.shop' => function ($query){
                            $query->select('id', 'name', 'user_id');
                    },
                    'category:id,name',
                    'product_image'
                    ])
                    ->where(function($q) use($location) {
                        $q->where('category_id', '=', '1')
                            ->where('product_state_id', '1')
                            ->whereRelation('user.shop', 'status', 1)
                            ->whereRelation('user.cities', 'name', $location);
                    })
                    ->orWhere(function($q){ 
                        $q->where('category_id', '!=', '1')
                            ->where('product_state_id', '1')
                            ->whereRelation('user.shop', 'status', 1);
                    })
                    ->latest()->take(15)->get();

        return response()->json([
            'products' => $products,
            'occasions' => Occasion::where('status', 1)->latest()->get(),
            'recipients' => Recipient::where('status', 1)->select('id', 'name', 'slug')->latest()->get(),
            'categories' => Category::where('status', 1)->where('id', '!=', '11')->latest()->get(),
            'homesliders' => HomeSlider::orderBy('order')->get(),
            'img_occasion' => Storage::disk('s3')->temporaryUrl('public/images/occasion-card.webp', '+2 minutes'),
            'img_recipient' => Storage::disk('s3')->temporaryUrl('public/images/recipient-card.webp', '+2 minutes'),
            'img_instruction' => Storage::disk('s3')->temporaryUrl('public/images/instruction-banner.webp', '+2 minutes'),
        ]);
    }

    public function getNavbarData()
    {
        if (auth('api')->check() && auth('api')->user()->role_id == Role::IS_BUYER) {
                $userName = auth('api')->user()->name;
        } else $userName = "Account";

        return response()->json([
            'occasions' => Occasion::where('status', 1)->select('id', 'name', 'slug')->latest()->get(),
            'recipients' => Recipient::where('status', 1)->select('id', 'name', 'slug')->latest()->get(),
            'categories' => Category::where('status', 1)->where('id', '!=', '11')->select('id', 'name', 'slug')->latest()->get(),
            'currencies' => Currency::select('exchange_rate', 'code', 'symbol')->where('status', 1)->get(),
            'user' => $userName,
        ]);
    }

    /**
     * Display a listing of the search result resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchIndex($searchText)
    {
        $request = $searchText;

        $products = $request ? 
                        Product::whereHas('user.shop', function($q) {
                            return $q->where('status', 1);
                        })
                        ->where('product_state_id', '1')
                        ->with(['category:id,name', 'user.shop', 'product_image'])
                        ->latest()
                        ->where('title', 'like', '%' . $searchText . '%')->get() : 
                        '';

        return response()->json([
            'products' => $products,
            'occasions' => $request ? Occasion::where('status', 1)->where('name', 'like', '%' . $searchText . '%')->latest()->get() : '',
            'recipients' => $request ? Recipient::where('status', 1)->latest()->where('name', 'like', '%' . $searchText . '%')->get() : '',
            'categories' => $request ? Category::where('status', 1)->where('id', '!=', '11')->latest()->where('name', 'like', '%' . $searchText . '%')->get() : '',
            'shops' => $request ? Shop::latest()->where('name', 'like', '%' . $searchText . '%')->get() : '',
        ]);
    }

    public function searchSuggestion($searchText)
    {
        $products = Product::whereHas('user.shop', function($q) {
                        return $q->where('status', 1);
                    })
                    ->where('product_state_id', '1')
                    ->where('title', 'like', '%' . $searchText . '%')
                    ->select('id', 'slug', 'title')
                    ->latest()->take(8)->get();

        return response()->json([
            'products' => $products,
        ]);
    }
}
