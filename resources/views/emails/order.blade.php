@component('mail::message')

<h1>Thank you for your order</h1>
<p class="mb-4">
    Hello {{ $order->first_name }},
    <br />
    Your order has been confirmed, and will be shipped by
    {{ $order->delivery_date }}
</p>

<h2>Order Summary</h2>

<div class="flex-container mb-2">
    <div class="w-50 mb-sm-2">
        <h3 class="mb-1">Order code</h3>
        <p>{{ $order->code }}</p>
    </div>
    <div class="w-50">
        <h3 class="mb-1">Order Date</h3>
        <p>{{ $order->created_at }}</p>
    </div>
</div>
<div class="flex-container mb-4">
    <div class="w-50 mb-sm-2">
        <h3 class="mb-1">Delivery Date</h3>
        <p>{{ $order->delivery_date }}</p>
    </div>
    <div class="w-50">
        <h3 class="mb-1">Store</h3>
        <p>{{ $order->shop->name }}</p>
    </div>
</div>

<h2>Here is what you ordered</h2>

<table class="card-product mb-4">
    <thead class="card-header">
        <tr>
            <td>Item</td>
            <td class="card-price">Price</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->order_products as $order_product)
        <tr class="card-body">
            <td>
                <div class="card-row-compact">
                    <img
                        class="img-box mr-2"
                        src="{{ $order_product->product->product_image->path ? $order_product->product->product_image->path : '/images/lavisco/img-bg.jpg' }}"
                    />
                    <div class="mr-3">
                        <h3>{{ $order_product->product->title }}</h3>
                        <br />
                        @isset($order_product->order_product_variations)
                        @foreach ($order_product->order_product_variations as
                        $variation)
                        <div class="text-sm grey">
                            {{ $variation->variation_option->name }},
                        </div>
                        @endforeach @endisset
                    </div>
                </div>
            </td>
            <td>
                <div class="card-price">
                    <h3>Rs {{$order_product->total}}</h3>
                    <div class="text-sm grey">
                        {{ $order_product->quantity }}
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        <tr class="card-sub-footer">
            <td>Sub total</td>
            <td>Rs {{ $order->subtotal }}</td>
        </tr>
        <tr class="card-sub-footer">
            <td>Shipping</td>
            <td>Rs {{ $order->shipping_price }}</td>
        </tr>
    </tbody>
    <tfoot class="card-footer">
        <tr>
            <td class="grey">Total</td>
            <td class="card-price">Rs {{ $order->total }}</td>
        </tr>
    </tfoot>
</table>

<h2>Shipping Details</h2>

<div class="w-100 mb-2 card-grey">
    <h3 class="mb-2">Shipping Address</h3>
    <p>
        {{ $order->recipient_first_name }}
        {{ $order->recipient_last_name }} <br />
        {{ $order->recipient_email }} <br />
        {{ $order->recipient_phone }}
    </p>
    <p>
        {{ $order->address_line_one }}, {{ $order->address_line_two }}
        <br />
        {{ $order->city }}, {{ $order->district }}, {{ $order->state }},
        {{ $order->country }}
    </p>
</div>
<div class="w-100 card-grey mb-4">
    <h3 class="mb-2">Billing Address</h3>
    <p>
        {{ $order->first_name }}
        {{ $order->last_name }} <br />
        {{ $order->phone }}
    </p>
    <p>
        {{ $order->billing_address_line_one }},
        {{ $order->billing_address_line_two }} <br />
        {{ $order->billing_city }}, {{ $order->billing_district }},
        {{ $order->billing_state }},
        {{ $order->billing_country }}
    </p>
</div>

<div class="mb-4">
    <a href="{{ url('https://lavisco.lk/order/'.$order->code) }}">
        <button class="button button-primary">View Order</button>
    </a>
</div>

Regards,<br />
Lavisco Team @endcomponent
