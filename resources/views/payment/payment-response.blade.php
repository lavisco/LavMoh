@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid shipping">
    <div class="progress-bar mb-3 mb-md-5">
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

    <h1 class="text-left mb-4">Your order is confirmed</h1>
    <div class="row">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="cart-items-card">
                <h4 class="text-left header mb-0">
                    Order Summary of {{ $order->code }}
                </h4>
                <div class="row-content">
                    <div class="row my-4">
                        <div class="col-6">
                            <h6>Total</h6>
                            <div>Rs. {{ $order->total }}</div>
                            <a
                                class="dashboard-link-sm mt-2"
                                data-toggle="collapse"
                                href="#collapsePrice"
                                role="button"
                            >
                                More
                            </a>
                            <div class="collapse mt-2" id="collapsePrice">
                                <div class="my-2">
                                    Subtotal: Rs. {{ $order->subtotal }}
                                </div>
                                <div class="my-2">
                                    Tax: Rs. {{ $order->tax }}
                                </div>
                                <div class="my-2">
                                    Shipping: Rs. {{ $order->shipping_price }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h6>Date placed</h6>
                            <div>
                                {{ $order_time }}
                            </div>
                        </div>
                    </div>
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
                                {{ $order->zipcode }}, {{ $order->city }} <br />
                                {{ $order->district }}, {{ $order->state }}
                                <br />
                                {{ $order->country }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <h6>Shipping Option</h6>
                            <div>
                                {{ $order->shipping->type }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="cart-items-card">
                <h4 class="text-left header mb-0">Order Items</h4>
                <div class="row-content mt-4">
                    @foreach ($order->order_products as $order_product)
                    <div class="row mb-4">
                        <div class="col-md-8 d-flex flex-row">
                            <img
                                class="banner-container-xs mr-3"
                                src="{{ $order_product->product->product_image->path ? $order_product->product->product_image->path : '/images/lavisco/img-bg.jpg' }}"
                            />
                            <div>
                                <h6 class="text-left">
                                    {{ $order_product->product->title }}
                                </h6>

                                @foreach
                                ($order_product->order_product_variations as
                                $variation)
                                <div class="darkgrey text-xs">
                                    {{ $variation->variation_option->name }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr class="hide-content w-100" />
                        <div class="col-md-1 col-6">
                            {{ $order_product->quantity }}
                        </div>
                        <div class="col-md-3 col-6">
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
                <h4 class="bottom d-flex flex-row justify-content-between mb-0">
                    <span class="darkgrey"> Total </span>
                    Rs. {{ $order->total }}
                </h4>
            </div>
        </div>
    </div>
</div>
@endsection
