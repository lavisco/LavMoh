@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid shipping">
    <div class="progress-bar mb-5">
        <div class="progress-line">
            <div class="done"></div>
            <div class="done"></div>
            <div class="done"></div>
            <div class="now"></div>
        </div>
        <div class="d-flex align-items-center progress-content">
            <div class="part completed">
                <div class="check-sign">1</div>
                Choose Cart
            </div>
            <div class="part completed">
                <div class="check-sign">2</div>
                Shipping
            </div>
            <div class="part completed">
                <div class="check-sign">3</div>
                Payment
            </div>
            <div class="part activated">
                <div class="check-sign">4</div>
                Order Complete
            </div>
        </div>
    </div>

    <div class="card-big container no-padding-sm">
        <div class="card-big-header">
            <h1>Order {{ $order->code }} Details</h1>
            <div class="row">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <h6>Date placed</h6>
                    <div>
                        {{ $order_time }}
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <h6>Arrival Date</h6>
                    <div>
                        {{ $order->delivery_date }}
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <h6>Total</h6>
                    <div>Rs. {{ $order->total }}</div>
                </div>
                <div class="col-md-3 col-6">
                    <h6>Delivery Service</h6>
                    <div>
                        {{ $order->shipping->type }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-big-body">
            <div class="col-lg-6 card-big-col">
                <h3>Order Summary</h3>
                <div class="row-content">
                    <div class="row my-4">
                        <div class="col">
                            <h6>Store</h6>
                            <div class="d-flex flex-row align-items-center">
                                <img
                                    class="cart-shop-banner mr-2"
                                    src="{{ $order->shop->path ? $order->shop->path : '/images/lavisco/img-bg.jpg'}}"
                                />
                                {{ $order->shop->name }}
                            </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <h6>Contact Details</h6>
                            <div>
                                {{ $order->first_name }}
                                {{ $order->last_name }} <br />
                                {{ $order->email }} <br />
                                {{ $order->phone }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <h6>Shipping Address</h6>
                            <div>
                                {{ $order->address_line_one }}
                                {{ $order->address_line_two }},
                                {{ $order->zipcode }}, {{ $order->city }}
                                <br />
                                {{ $order->district }}, {{ $order->state }}
                                <br />
                                {{ $order->country }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <h6>Delivery Method</h6>
                            <div>
                                {{ $order->shipping->type }}
                                <br />
                                Rs. {{ $order->shipping_price }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 card-big-col card-big-col-2">
                <h3>Order Items</h3>
                <div class="cart-items-card bg-white">
                    <div class="row-content">
                        @foreach ($order->order_products as $order_product)
                        <div class="row my-2">
                            <div class="col-md-7 d-flex flex-row">
                                <img
                                    class="banner-container-xs mr-3"
                                    src="{{ $order_product->product->product_image->path ? $order_product->product->product_image->path : '/images/lavisco/img-bg.jpg' }}"
                                />
                                <div>
                                    <h6 class="text-left">
                                        {{ $order_product->product->title }}
                                    </h6>

                                    @if(count($order_product->order_product_variations)
                                    > 0)
                                    @foreach($order_product->order_product_variations
                                    as $vre)
                                    <div class="text-xs">
                                        {{$vre->variation_option->name}}
                                    </div>
                                    @endforeach @endif
                                </div>
                            </div>
                            <hr class="hide-content w-100" />
                            <div class="col-md-1 col-6">
                                {{ $order_product->quantity }}
                            </div>
                            <div class="col-md-4 col-6">
                                <h6 class="text-right mb-1">
                                    Rs. {{$order_product->total}}
                                </h6>
                                <div class="darkgrey text-xs text-right">
                                    each Rs.
                                    {{ $order_product->total/$order_product->quantity }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <h6
                        class="
                            row-content
                            d-flex
                            flex-row
                            justify-content-between
                            mb-0
                            bg-pale-grey
                        "
                    >
                        <span class="skinny-txt"> Sub-total </span>
                        Rs. {{ $order->subtotal }}
                    </h6>
                    <h6
                        class="
                            row-content
                            d-flex
                            flex-row
                            justify-content-between
                            mb-0
                            bg-pale-grey
                            pb-2
                        "
                    >
                        <span class="skinny-txt"> Shipping </span>
                        Rs. {{ $order->shipping_price }}
                    </h6>
                    <h4
                        class="
                            row-content
                            d-flex
                            flex-row
                            justify-content-between
                            mb-0
                            py-3
                        "
                    >
                        <span class=""> Total </span>
                        <spav class="red">Rs. {{ $order->total }}</spav>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <cart-clear></cart-clear>
    <order-email
        order-id="{{ $order->id }}"
        order-email="{{ $order->email }}"
        order-recipientemail="{{ $order->recipient_email }}"
    ></order-email>
</div>
@endsection
