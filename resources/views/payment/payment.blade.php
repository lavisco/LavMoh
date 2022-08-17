@extends('layouts.masterNonVue') @section('content')
@php
$plaintext = '525|5';
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
//checkout URL
$url = 'https://webxpay.com/index.php?route=checkout/billing';
@endphp

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
        <div class="col-12">
            <h1 class="mb-4">Proceed to payment page</h1>
            <div class="card">
                <form
                    method="POST"
                    action="<?php echo $url; ?>"
                    class="
                        input-form
                        d-flex
                        flex-column
                        justify-content-center
                        align-items-center
                    "
                >
                    @csrf
                    <input
                        type="hidden"
                        name="first_name"
                        value="{{ $data->first_name }}"
                    />
                    <input
                        type="hidden"
                        name="last_name"
                        value="{{ $data->last_name }}"
                    />
                    <input
                        type="hidden"
                        name="email"
                        value="{{ $data->email }}"
                    />
                    <input
                        type="hidden"
                        name="contact_number"
                        value="{{ $data->phone }}"
                    />
                    <input
                        type="hidden"
                        name="address_line_one"
                        value="{{ $data->address_line_one }}"
                    />
                    <input
                        type="hidden"
                        name="process_currency"
                        value="{{ $data->currency_code }}"
                    />
                    
                    <input type="hidden" name="cms" value="PHP" />
                    
                    <input type="text" name="enc_method" value="JCs3J+6oSz4V0LgE0zi/Bg==">
                    <input
                        type="hidden"
                        name="secret_key"
                        value="f94682c3-c986-426e-b68f-9cbdd5f8d904"
                    />
                    <input
                        type="hidden"
                        name="payment"
                        value="<?php echo $payment; ?>"
                    />
                    <order-summary></order-summary>
                    <button type="submit" class="checkout-btn">
                        Proceed to Payment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
