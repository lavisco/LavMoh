@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid shipping">
    <div class="progress-bar mb-5 mb-md-5">
        <div class="progress-line">
            <div class="done"></div>
            <div class="now"></div>
            <div class=""></div>
            <div class=""></div>
        </div>
        <div class="d-flex align-items-center progress-content">
            <div class="part completed">
                <div class="check-sign">1</div>
                Choose Cart
            </div>
            <div class="part activated">
                <div class="check-sign">2</div>
                Shipping
            </div>
            <div class="part">
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
                <form method="POST" action="/payment" class="input-form">
                    @csrf

                        <shipping-option 
                            :init-form="{{ json_encode(old()) }}"
                            
                            @error('first_name')
                                error_msg_first_name='{{ $message }}'
                            @enderror 
                            @error('last_name')
                                error_msg_last_name='{{ $message }}'
                            @enderror 
                            @error('email')
                                error_msg_email='{{ $message }}'
                            @enderror 
                            @error('phone')
                                error_msg_phone='{{ $message }}'
                            @enderror 
                            @error('address_line_one')
                                error_msg_address_line_one='{{ $message }}'
                            @enderror 
                            @error('address_line_two')
                                error_msg_address_line_two='{{ $message }}'
                            @enderror 
                            @error('zipcode')
                                error_msg_zipcode='{{ $message }}'
                            @enderror 
                            @error('city')
                                error_msg_city='{{ $message }}'
                            @enderror 
                            @error('district')
                                error_msg_district='{{ $message }}'
                            @enderror 
                            @error('state')
                                error_msg_state='{{ $message }}'
                            @enderror 
                            @error('recipient_first_name')
                                error_msg_recipient_first_name='{{ $message }}'
                            @enderror 
                            @error('recipient_last_name')
                                error_msg_recipient_last_name='{{ $message }}'
                            @enderror 
                            @error('recipient_email')
                                error_msg_recipient_email='{{ $message }}'
                            @enderror 
                            @error('recipient_phone')
                                error_msg_recipient_phone='{{ $message }}'
                            @enderror 
                            @error('billing_address_line_one')
                                error_msg_billing_address_line_one='{{ $message }}'
                            @enderror 
                            @error('billing_address_line_two')
                                error_msg_billing_address_line_two='{{ $message }}'
                            @enderror 
                            @error('billing_zipcode')
                                error_msg_billing_zipcode='{{ $message }}'
                            @enderror 
                            @error('billing_city')
                                error_msg_billing_city='{{ $message }}'
                            @enderror 
                            @error('billing_district')
                                error_msg_billing_district='{{ $message }}'
                            @enderror 
                            @error('billing_state')
                                error_msg_billing_state='{{ $message }}'
                            @enderror 
                            @error('delivery_date')
                                error_msg_delivery_date='{{ $message }}'
                            @enderror 
                            @error('shipping_id')
                                error_msg_shipping_id='{{ $message }}'
                            @enderror
                        >
                        </shipping-option>

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
                        <div
                            class="
                                d-flex
                                justify-content-center
                                align-items-center
                                flex-column
                                flex-md-row
                                w-100
                            "
                        >
                            <a href="/cart" class="btn-md-full mr-md-2 mb-md-0 mb-2">
                                <button type="button" class="btn-md-full btn-secondary">
                                    Edit Cart
                                </button> 
                            </a>
                            <button type="submit" class="checkout-btn btn-md-full">
                                Proceed to Payment
                            </button>
                        </div>
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
