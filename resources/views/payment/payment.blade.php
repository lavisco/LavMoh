@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid shipping">
    <div class="progress-bar mb-3 mb-md-5">
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
                Order Complete
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h1 class="text-left mb-4">Enter your Shipping Details</h1>
            <div class="card">
                <form method="POST" action="/payment" class="input-form">
                    @csrf
                    <div class="input-form-compact">
                        <!-- Contact Info -->
                        <div class="cart-items-card">
                            <h3 class="text-left">Your Contact Details</h3>
                            <hr />
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="first_name"
                                        >First Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="first_name"
                                        value="{{ old('first_name') }}"
                                        type="text"
                                        name="first_name"
                                        class="
                                            form-control
                                            @error('amount')
                                            is-invalid
                                            @enderror
                                        "
                                    />

                                    @error('first_name')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="last_name"
                                        >Last Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="last_name"
                                        value="{{ old('last_name') }}"
                                        type="text"
                                        name="last_name"
                                        class="form-control"
                                    />
                                    @error('last_name')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="email"
                                        >Email
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="email"
                                        value="{{ old('email') }}"
                                        type="email"
                                        name="email"
                                        class="form-control"
                                    />
                                    @error('email')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="phone"
                                        >Phone
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="phone"
                                        value="{{ old('phone') }}"
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                    />
                                    @error('phone')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="cart-items-card mt-5">
                            <h3 class="text-left">Your Address</h3>
                            <p class="mb-0 note">
                                This is the billing address.
                            </p>
                            <hr />

                            <div class="form-group">
                                <label
                                    class="col-form-label"
                                    for="billing_address_line_one"
                                    >Billing Address Line 1
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="billing_address_line_one"
                                    value="{{
                                        old('billing_address_line_one')
                                    }}"
                                    type="text"
                                    name="billing_address_line_one"
                                    class="form-control"
                                />
                                @error('billing_address_line_one')
                                <span class="error-msg">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label
                                    class="col-form-label"
                                    for="billing_address_line_two"
                                    >Billing Address Line 2
                                </label>
                                <input
                                    id="billing_address_line_two"
                                    value="{{
                                        old('billing_address_line_two')
                                    }}"
                                    type="text"
                                    name="billing_address_line_two"
                                    class="form-control"
                                />
                                @error('billing_address_line_two')
                                <span class="error-msg">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="billing_state"
                                        >Billing Province/ State
                                    </label>
                                    <input
                                        id="billing_state"
                                        value="{{ old('billing_state') }}"
                                        type="text"
                                        name="billing_state"
                                        class="form-control"
                                    />
                                    @error('billing_state')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="billing_district"
                                        >Billing District
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="billing_district"
                                        value="{{ old('billing_district') }}"
                                        type="text"
                                        name="billing_district"
                                        class="form-control"
                                    />
                                    @error('billing_district')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="billing_city"
                                        >Billing City
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="billing_city"
                                        value="{{ old('billing_city') }}"
                                        type="text"
                                        name="billing_city"
                                        class="form-control"
                                    />
                                    @error('billing_city')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="billing_zipcode"
                                        >Billing Zip Code
                                    </label>
                                    <input
                                        id="billing_zipcode"
                                        value="{{ old('billing_zipcode') }}"
                                        type="text"
                                        name="billing_zipcode"
                                        class="form-control"
                                    />
                                    @error('billing_zipcode')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Self delivery -->
                        <div class="cart-items-card mt-5">
                            <h3 class="text-left">Are you the recipient?</h3>
                            <hr />

                            <div class="form-group">
                                <label
                                    class="col-form-label"
                                    for="self_delivery"
                                    >Billing and Shipping information will be
                                    the same.
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <div class="custom-control custom-radio">
                                    <input
                                        class="custom-control-input"
                                        type="radio"
                                        name="self_delivery"
                                        id="self_delivery"
                                        value="true"
                                    />
                                    <label
                                        class="custom-control-label"
                                        for="self_delivery"
                                        >Yes
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input
                                        class="custom-control-input"
                                        type="radio"
                                        name="self_delivery"
                                        id="self_delivery"
                                        value="false"
                                    />

                                    <label
                                        class="custom-control-label"
                                        for="self_delivery"
                                        >No
                                    </label>
                                </div>
                                @error('self_delivery')
                                <span class="error-msg">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Recipient Contact info -->
                        <div class="cart-items-card mt-5">
                            <h3 class="text-left">
                                Recipient's Contact Details
                            </h3>
                            <hr />

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="recipient_first_name"
                                        >First Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="recipient_first_name"
                                        value="{{
                                            old('recipient_first_name')
                                        }}"
                                        type="text"
                                        name="recipient_first_name"
                                        class="form-control"
                                    />
                                    @error('recipient_first_name')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="recipient_last_name"
                                        >Last Name
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="recipient_last_name"
                                        value="{{ old('recipient_last_name') }}"
                                        type="text"
                                        name="recipient_last_name"
                                        class="form-control"
                                    />
                                    @error('recipient_last_name')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="recipient_email"
                                        >Email
                                    </label>
                                    <input
                                        id="recipient_email"
                                        value="{{ old('recipient_email') }}"
                                        type="email"
                                        name="recipient_email"
                                        class="form-control"
                                    />
                                    @error('recipient_email')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label
                                        class="col-form-label"
                                        for="recipient_phone"
                                        >Phone
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="recipient_phone"
                                        value="{{ old('recipient_phone') }}"
                                        type="text"
                                        name="recipient_phone"
                                        class="form-control"
                                    />
                                    @error('recipient_phone')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Recipient Address -->
                        <div class="cart-items-card mt-5">
                            <h3 class="text-left">
                                Recipient's Shipping Address
                            </h3>
                            <p class="mb-0 note">
                                This is the recipients address, the product will
                                be delivered here.
                            </p>
                            <hr />

                            <div class="form-group">
                                <label
                                    class="col-form-label"
                                    for="address_line_one"
                                    >Address line 1
                                    <strong class="text-danger"> * </strong>
                                </label>
                                <input
                                    id="address_line_one"
                                    value="{{ old('address_line_one') }}"
                                    type="text"
                                    name="address_line_one"
                                    class="form-control"
                                />
                                @error('address_line_one')
                                <span class="error-msg">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label
                                    class="col-form-label"
                                    for="address_line_two"
                                    >Address line 2
                                </label>
                                <input
                                    id="address_line_two"
                                    value="{{ old('address_line_two') }}"
                                    type="text"
                                    name="address_line_two"
                                    class="form-control"
                                />
                                @error('address_line_two')
                                <span class="error-msg">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="state"
                                        >Province/ State
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="state"
                                        value="{{ old('state') }}"
                                        type="text"
                                        name="state"
                                        class="form-control"
                                    />
                                    @error('state')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="district"
                                        >District
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="district"
                                        value="{{ old('district') }}"
                                        type="text"
                                        name="district"
                                        class="form-control"
                                    />
                                    @error('district')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="city"
                                        >City
                                        <strong class="text-danger"> * </strong>
                                    </label>
                                    <input
                                        id="city"
                                        value="{{ old('city') }}"
                                        type="text"
                                        name="city"
                                        class="form-control"
                                    />
                                    @error('city')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="zipcode"
                                        >Zip Code
                                    </label>
                                    <input
                                        id="zipcode"
                                        value="{{ old('zipcode') }}"
                                        type="text"
                                        name="zipcode"
                                        class="form-control"
                                    />
                                    @error('zipcode')
                                    <span class="error-msg">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <shipping-option></shipping-option>
                    </div>

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
