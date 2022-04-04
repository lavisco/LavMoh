<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductVariation;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\If_;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $guestUser = User::select('id')->where('email', User::GUEST_USER_MAIL)->first();

        if (auth('api')->check()) {
            if(auth('api')->user()->role_id == Role::IS_BUYER){
                $userId = auth('api')->user()->id;
            } else {
                $userId = $guestUser->id;
            }
        } else {
            $userId = $guestUser->id;
        }
        
        $request->merge([
            'status' => "not acknowledged",
            'tax' => 0.00,
            'buyer_id' => $userId,
            'country' => "Sri Lanka",
            'billing_country' => "Sri Lanka",
            'seller_id' => $request->input('products.0.seller_id'),
            'shop_id' => $request->input('products.0.shop_id'),
        ]);

        $order = Order::create($request->all());

        $order->update([
            'code' => 'LO'.str_pad($order->id,5,"0",STR_PAD_LEFT),
        ]);

        $products = $request->input('products.*');

        for($i = 0; $i < count($products); $i++){

            $variations = $products[$i]['variations'];
            
            $orderProduct = new OrderProduct([
                'base_price' => $products[$i]['base_price'],
                'quantity' => $products[$i]['quantity'],
                'total' => $products[$i]['price'],
                'custom_text' => $products[$i]['custom_text'],
                'has_variations' => count($variations) > 0 ? true : false,
                'order_id' => $order->id,
                'product_id' => $products[$i]['id'],
            ]);

            $orderProduct->save();

            if ($products[$i]['variations'] && count($variations)>0) {
                for($j = 0; $j < count($variations); $j++){
                    OrderProductVariation::create([
                        'price' => $variations[$j]['price'],
                        'variation_option_id' => $variations[$j]['id'],
                        'order_product_id' => $orderProduct->id,
                    ]);
                }
            }
        }

        return $order;
    }

    /**
     * Get data from other tables, that are needed
     */
    public function getShippings($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        return response()->json([
            'shippings' => $shop->shippings()->get(),
        ]);
    }
}
