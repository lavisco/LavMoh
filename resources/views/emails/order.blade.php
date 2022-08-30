@component('mail::message')

<h1>Thank you for your order</h1>
<p class="mb-4">
    Hello {{ $order->first_name }},
    <br />
    Your order has been confirmed, and will be shipped by
    {{ $order->delivery_date }}
</p>

<h2>Order Summary</h2>

<div class="flex-container">
    <div class=" w-50 mr-3 mb-2">
        <h3 class="mb-1">Order code</h3>
        {{ $order->code }}
    </div>
    <div class="w-50 mb-2">
        <h3 class="mb-1">Order Date</h3>
        {{ $order->created_at }}
    </div>
</div>
<div class="flex-container mb-4">
    <div class="w-50 mr-3 mb-1">
        <h3 class="mb-1">Delivery Date</h3>
        {{ $order->delivery_date }}
    </div>
    <div class="w-50">
        <h3 class="mb-1">Store</h3>
        {{ $order->shop->name }}
    </div>
</div>

<h2>Here is what you ordered</h2>

<div class="card mb-4">
    <div class="card-row card-header">
        <div>Item</div>
        <div class="card-price">Price</div>
    </div>
    @foreach ($order->order_products as $order_product)
    <div class="card-row card-body">
        <div class="card-row-compact">
            <img
                class="img-box mr-2"
                src="{{ $order_product->product->product_image->path ? $order_product->product->product_image->path : '/images/lavisco/img-bg.jpg' }}"
            />
            <div class="card-col mr-3">
                <h3>{{ $order_product->product->title }}</h3>
                @foreach ($order_product->order_product_variations as
                $variation)
                <div class="text-sm grey">
                    {{ $variation->variation_option->name }}
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-price">
            <h3>Rs {{$order_product->total}}</h3>
            <div class="text-sm grey">
                {{ $order_product->quantity }}
            </div>
        </div>
    </div>
    @endforeach
    <div class="card-sub-footer">
        <div class="grey mr-2">Sub total</div>
        <div class="card-price"><h3>Rs 5300</h3></div>
    </div>
    <div class="card-footer">
        <div class="grey mr-2">Total</div>
        <div class="card-price">Rs 5300</div>
    </div>
</div>

<h2>Shipping Details</h2>

<div class="flex-container mb-4">
    <div class="w-50 mb-2 mr-3">
        <h3 class="mb-1">Contact</h3>
        {{ $order->recipient_first_name }}
        {{ $order->recipient_last_name }} <br />
        {{ $order->recipient_email }} <br />
        {{ $order->recipient_phone }}
    </div>
    <div class="w-50">
        <h3 class="mb-1">Shipping Address</h3>
        {{ $order->address_line_one }}, {{ $order->address_line_two }} <br />
        {{ $order->city }}, {{ $order->district }}, {{ $order->state }},
        {{ $order->country }}
    </div>
</div>

<h2>Billing Details</h2>

<div class="flex-container mb-4">
    <div class="w-50 mb-2 mr-3">
        <h3 class="mb-1">Contact</h3>
        {{ $order->first_name }}
        {{ $order->last_name }} <br />
        {{ $order->email }} <br />
        {{ $order->phone }}
    </div>
    <div class="w-50">
        <h3 class="mb-1">Billing Address</h3>
        {{ $order->billing_address_line_one }},
        {{ $order->billing_address_line_two }} <br />
        {{ $order->billing_city }}, {{ $order->billing_district }},
        {{ $order->billing_state }},
        {{ $order->billing_country }}
    </div>
</div>

Regards,<br />
Lavisco Team @endcomponent
