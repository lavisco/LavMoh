@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid shipping">
    <div class="progress-bar mb-3 mb-md-5">
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
                Order Complete
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col d-flex align-items-center flex-column">
            <h1 class="text-left mb-4">Proceed to Payment Gateway</h1>
            <div class="price-card mb-5">
                <h4 class="mb-2">Total Payment</h4>
                <p>
                    Subtotal
                    <span class="bold"> </span>
                </p>
                <hr />
                <p>
                    Discount
                    <span class="bold"> </span>
                </p>
                <p>
                    Shipping
                    <span class="bold"> </span>
                </p>
                <p>
                    Total
                    <span class="bold"> </span>
                </p>
            </div>
            <form method="POST" action="{{ route('paymentgate') }}">
                @csrf
                <button type="submit" class="checkout-btn">
                    Proceed to Payment
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
