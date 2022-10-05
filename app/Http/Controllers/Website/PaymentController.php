<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
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
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function showShipping()
    {
        return view('payment.shipping');
    }

    /*
    * order store methods start
    */
    public function storeOrder(OrderRequest $request)
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

        /*
        * extract data from request
        */
        $products = json_decode($request->cartItems);
        $exchange_rate = $request->exchange_rate;

        /*
        * find product & shipping data from db, merge to request
        */
        $shipping = Shipping::FindOrFail($request->shipping_id);

        $defaultProduct = Product::findOrFail($products[0]->id);
      
        $request->merge([
            'order_state_id' => 1,
            'tax' => 0.00,
            'discount_price' => 0.00,
            'giftwrap_price' => 0.00,
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

        /*
        * store order items via storeOrderProduct method
        * get the returned total value and update order table
        */
        $total = $this->storeOrderProduct($products, $exchange_rate, $order->id);

        $newtotal = $total+$shipping->price;

        $order->update([
            'total' => $newtotal,
            'subtotal' => $total,
        ]);

        // store receipt & transaction
        $this->storeReceipt($request, $order->id);
        $this->storeTransaction($request, $newtotal, $defaultProduct->user_id, $order->id);

        
        /*
        * payment proccessing
        */
        $data = $request;
        $plaintext = $order->id.'|'.$newtotal;

        $publickey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6nVc/ykIWsT1ktI8/49nfBUOQ
IHCCu9bC+pxEYbPvUth28MWitvm7y2u2nX/3/nVXMdvl2yiAbB7aBw4dGnAhXoAM
9WB8nw3AZS1VGqBBEKFs23EqUvjsBxrj+QasVkeZwC+oxvGuuprCIFW9o7w290c0
pJ28AUyd0dWx1YWu1wIDAQAB
-----END PUBLIC KEY-----";
        //load public key for encrypting
        openssl_public_encrypt($plaintext, $encrypt, $publickey);

        //encode for data passing
        $payment = base64_encode($encrypt);
        //secret key for integration
        $secret_key = "f94682c3-c986-426e-b68f-9cbdd5f8d904";

        /*
        * return payment view (contains webxpay payment form) with required parameters
        */
        return view('payment.payment', compact('data', 'secret_key', 'payment'));
    }

    public function storeOrderProduct($products, $exchange_rate, $orderId)
    {
        /*
        * store order items in OrderProduct table
        * store relevant order item variation in OrderProductVariation table
        * loop through the items sent in request
        */

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

        /*
        * return total to be stored in order table
        */
        
        return $total;
    }

    public function storeReceipt($request, $orderId)
    {
        /*
        * store order receipt
        */
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
        /*
        * store order transaction
        */
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

    /*
    * payment response page and data returned by payment gateway
    */
    public function paymentResponse(Request $request)
    {
        //decode & get POST parameters
        $payment = base64_decode($_POST ["payment"]);
        $signature = base64_decode($_POST ["signature"]);
        //load public key for signature matching
        $publickey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6nVc/ykIWsT1ktI8/49nfBUOQ
IHCCu9bC+pxEYbPvUth28MWitvm7y2u2nX/3/nVXMdvl2yiAbB7aBw4dGnAhXoAM
9WB8nw3AZS1VGqBBEKFs23EqUvjsBxrj+QasVkeZwC+oxvGuuprCIFW9o7w290c0
pJ28AUyd0dWx1YWu1wIDAQAB
-----END PUBLIC KEY-----";
        openssl_public_decrypt($signature, $value, $publickey);

        $signature_status = false ;

        if($value == $payment)
        {
            $signature_status = true ;
        }

        //get payment response in segments
        //payment format: order_id|order_refference_number|date_time_transaction|payment_gateway_used|status_code|comment;
        $responseVariables = explode('|', $payment); 

        //find order
        $order = Order::with(['order_products', 'order_products.product', 'order_products.product.product_image', 'order_products.order_product_variations.variation_option', 'shipping', 'shop'])->findOrFail($responseVariables[0]);

        //show date_time_transaction
        $order_time = $responseVariables[2];

        if($signature_status == true)
        {
            $order->update([
                'order_state_id' => 2,
            ]);
        }

        if($signature_status == true)
        {
            //return payment successful page
            return view('payment.payment-response', compact('order', 'order_time'));

        } else
        {
            //delete order record if payment fails
            Transaction::where('order_id', $order->id)->delete();
            Receipt::where('order_id', $order->id)->delete();
            $orderProducts = OrderProduct::where('order_id', $order->id)->get();
    
            foreach ($orderProducts as $orderProduct) {
                OrderProductVariation::where('order_product_id', $orderProduct->id)->delete();
                $orderProduct->delete();
            }
           
            $order->delete();

            //return payment failed page
            return view('payment.payment-error');
        }
    }

    /*
    * test method for get route /payment-resp-test - payment response page and data returned by payment gateway
    */
    public function paymentResponseTest(Request $request)
    {
        //find order
        $order = Order::with(['order_products', 'order_products.product', 'order_products.product.product_image', 'order_products.order_product_variations.variation_option', 'shipping', 'shop'])->findOrFail(41);

        //show date_time_transaction
        $order_time = '22-05-2022';

        return view('payment.payment-response', compact('order', 'order_time'));
    }
}
