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

    <div class="row">
        <div class="col d-flex align-items-center flex-column">
            <h1 class="text-left mb-4">Payment Successful</h1>
        </div>
    </div>
</div>
@endsection
