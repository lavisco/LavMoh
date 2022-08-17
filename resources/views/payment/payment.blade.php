@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid shipping">
    <div class="progress-bar mb-5 mb-md-5">
        <div class="progress-line">
            <div class="done"></div>
            <div class="done"></div>
            <div class="now"></div>
            <div class=""></div>
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
            <div class="part activated">
                <div class="check-sign">3</div>
                Payment
            </div>
            <div class="part">
                <div class="check-sign">4</div>
                Order Placed
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h1 class="text-left mb-4">Enter your Shipping Details</h1>
            <div class="card">
                <form
                    method="POST"
                    action="https://webxpay.com/index.php?route=checkout/billing"
                    class="input-form"
                >
                    @csrf
                    <input
                        type="hidden"
                        name="secret_key"
                        value="f94682c3-c986-426e-b68f-9cbdd5f8d904"
                    />
                    <p>
                        {{ $total }}
                    </p>

                    <!-- order summary mobile -->
                    <div
                        class="
                            d-flex
                            flex-column
                            justify-content-center
                            align-items-center
                            mt-5
                        "
                    >
                        <order-summary class="hide-content"></order-summary>
                        <button type="submit" class="checkout-btn">
                            Proceed to Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- order summary desktop -->
        <div class="col-lg-4 hide-content-sm">
            <order-summary></order-summary>
        </div>
    </div>
</div>

@endsection
