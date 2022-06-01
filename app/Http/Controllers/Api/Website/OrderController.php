<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductVariation;
use App\Models\Receipt;
use App\Models\Role;
use App\Models\Shop;
use App\Models\Transaction;
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

        $this->storeOrderProduct($request, $order->id);
        $this->storeReceipt($request, $order->id);
        $this->storeTransaction($request, $order->id);

        return $order;
    }

    public function storeOrderProduct($request, $orderId)
    {
        $products = $request->input('products.*');
        $exchange_rate = $request->input('current_exchange_rate');

        for($i = 0; $i < count($products); $i++){

            $variations = $products[$i]['variations'];
            
            $orderProduct = new OrderProduct([
                'base_price' => $products[$i]['base_price'] * $exchange_rate,
                'quantity' => $products[$i]['quantity'],
                'total' => $products[$i]['price'] * $exchange_rate,
                'custom_text' => $products[$i]['custom_text'],
                'has_variations' => count($variations) > 0 ? true : false,
                'order_id' => $orderId,
                'product_id' => $products[$i]['id'],
            ]);

            $orderProduct->save();

            if ($products[$i]['variations'] && count($variations)>0) {
                for($j = 0; $j < count($variations); $j++){
                    OrderProductVariation::create([
                        'price' => $variations[$j]['price'] * $exchange_rate,
                        'variation_option_id' => $variations[$j]['id'],
                        'order_product_id' => $orderProduct->id,
                    ]);
                }
            }
        }
    }

    public function storeReceipt($request, $orderId)
    {
        $request->merge([
            'status' => "success",
            'process_currency' => "currency_code",
            'cms' => "PHP",
            'payment_method' => "visa",
            'order_id' => $orderId,
            'contact_number' => $request->input('phone'),
            'postal_code' => $request->input('zipcode'),
        ]);

        Receipt::create($request->all());
    }

    public function storeTransaction($request, $orderId)
    {
        $request->merge([
            'status' => "customer cleared payment",
            'order_id' => $orderId,
            'user_id' => $request->input('products.0.seller_id'),
            'total_amount' => $request->input('total'),
            'bank_charge' => 0.00,
            'platform_charge' => 0.00,
            'shop_discount' => 0.00,
            'payable_amount' => $request->input('total'),
        ]);

        $transaction = Transaction::create($request->all());

        $transaction->update([
            'code' => 'LT'.str_pad($transaction->id,5,"0",STR_PAD_LEFT),
        ]);
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
