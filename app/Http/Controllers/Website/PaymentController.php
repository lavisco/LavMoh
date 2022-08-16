<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductGiftboxVariation;
use App\Models\OrderProductVariation;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\Role;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VariationOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function show()
    {
        return view('payment.payment');
    }

    public function paymentProcess(OrderRequest $request)
    {
        // unique_order_id|total_amount
//         $plaintext = '525|10';
//         $publickey = "-----BEGIN PUBLIC KEY-----
// MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6nVc/ykIWsT1ktI8/49nfBUOQ
// IHCCu9bC+pxEYbPvUth28MWitvm7y2u2nX/3/nVXMdvl2yiAbB7aBw4dGnAhXoAM
// 9WB8nw3AZS1VGqBBEKFs23EqUvjsBxrj+QasVkeZwC+oxvGuuprCIFW9o7w290c0
// pJ28AUyd0dWx1YWu1wIDAQAB
// -----END PUBLIC KEY-----";
//         //load public key for encrypting
//         openssl_public_encrypt($plaintext, $encrypt, $publickey);

//         //encode for data passing
//         $payment = base64_encode($encrypt);


//         $response = Http::post('https://webxpay.com/index.php?route=checkout/billing', [
//             'first_name' => "Mohorima",
//             'last_name' => "Islam",
//             'email' => "islammohrima@gmail.com",
//             'phone' => "0215214578",
//             'address_line_one' => "flat f3",
            
//             'secret_key' => "f94682c3-c986-426e-b68f-9cbdd5f8d904",
//             'cms' => "PHP",
//             'payment' => "$payment",
//         ]);

        //$products = json_decode($request->cartItems);
        //return $products[1]->variations[0]->id;

        //return count($products[0]->variations);

        return $this->storeOrder($request);

    }

    /*
    * order store methods start
    */
    public function storeOrder(Request $request)
    {       
        /*
        * User ID
        */
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

        $products = json_decode($request->cartItems);
        $exchange_rate = $request->exchange_rate;
        $shipping = Shipping::FindOrFail($request->shipping_id);

        $defaultProduct = Product::findOrFail($products[0]->id);
      
        $request->merge([
            'status' => "not acknowledged",
            'tax' => 0.00,
            'buyer_id' => $userId,
            'country' => "Sri Lanka",
            'billing_country' => "Sri Lanka",
            'shipping_price' => $shipping->price,
            'seller_id' => $defaultProduct->user_id,
            'shop_id' => $defaultProduct->user->shop->id,
        ]);

        $order = Order::create($request->all());

        $order->update([
            'code' => 'LO'.str_pad($order->id,5,"0",STR_PAD_LEFT),
        ]);

        $total = $this->storeOrderProduct($products, $exchange_rate, $order->id);
        //return $total;

        $order->update([
            'total' => $total,
        ]);

        $this->storeReceipt($request, $order->id);
        $this->storeTransaction($request, $total, $defaultProduct->user_id, $order->id);
    }

    public function storeOrderProduct($products, $exchange_rate, $orderId)
    {
        $total = 0;

        for($i = 0; $i < count($products); $i++){

            $currentProduct = Product::findOrFail($products[$i]->id);

            $variations = $products[$i]->variations;

            $subtotal = 0;
            $subtotal += $currentProduct->base_price;
            
            $orderProduct = new OrderProduct([
                'base_price' => $currentProduct->base_price * $exchange_rate,
                'quantity' => $products[$i]->quantity,
                'total' => $subtotal * $exchange_rate,
                'custom_text' => $products[$i]->custom_text,
                'has_variations' => count($variations) > 0 ? true : false,
                'order_id' => $orderId,
                'product_id' => $currentProduct->id,
            ]);

            $orderProduct->save();

            if ($products[$i]->variations && count($variations)>0) {
                for($j = 0; $j < count($variations); $j++){

                    $currentVariation = VariationOption::findOrFail($variations[$j]->id);

                    $subtotal += $currentVariation->price; 

                    OrderProductVariation::create([
                        'price' => $currentVariation->price * $exchange_rate,
                        'variation_option_id' => $currentVariation->id,
                        'order_product_id' => $orderProduct->id,
                    ]);
                }
            }

            $subtotal *= $products[$i]->quantity; 
            $total += $subtotal;

            $orderProduct->update([
                'total' => $subtotal,
            ]);
        }
        
        return $total;
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

    public function storeTransaction($request, $total, $user_id, $orderId)
    {
        $request->merge([
            'status' => "customer cleared payment",
            'order_id' => $orderId,
            'user_id' => $user_id,
            'total_amount' => $total,
            'bank_charge' => 0.00,
            'platform_charge' => 0.00,
            'shop_discount' => 0.00,
            'payable_amount' => $total,
        ]);

        $transaction = Transaction::create($request->all());

        $transaction->update([
            'code' => 'LT'.str_pad($transaction->id,5,"0",STR_PAD_LEFT),
        ]);
    }
    /*
    * order store methods end
    */

    public function paymentResponse(Request $request)
    {
        //decode & get POST parameters
        // $payment = base64_decode($_POST ["payment"]);
        // $signature = base64_decode($_POST ["signature"]);
        // //load public key for signature matching
        // $publickey = "-----BEGIN PUBLIC KEY-----
        // MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6nVc/ykIWsT1ktI8/49nfBUOQ
        // IHCCu9bC+pxEYbPvUth28MWitvm7y2u2nX/3/nVXMdvl2yiAbB7aBw4dGnAhXoAM
        // 9WB8nw3AZS1VGqBBEKFs23EqUvjsBxrj+QasVkeZwC+oxvGuuprCIFW9o7w290c0
        // pJ28AUyd0dWx1YWu1wIDAQAB
        // -----END PUBLIC KEY-----";
        // openssl_public_decrypt($signature, $value, $publickey);

        // $signature_status = false ;

        // if($value == $payment)
        // {
        //     $signature_status = true ;
        // }

        // //get payment response in segments
        // //payment format: order_id|order_refference_number|date_time_transaction|payment_gateway_used|status_code|comment;
        // $responseVariables = explode('|', $payment);      

        // if($signature_status == true)
        // {
        //     //display values
        //     echo $signature_status;
        //     echo '<br/>';
        //     var_dump($responseVariables);
        // } else
        // {
        //     echo 'Error Validation'; 
        // }

        echo $request;
    }
}
