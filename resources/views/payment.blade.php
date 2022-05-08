@extends('layouts.error_master') @section('content')
<div class="container-fluid login">
    <form method="POST" action="{{ route('paymenttest') }}">
        @csrf First name:
        <input
            type="text"
            name="first_name"
            value="Customer First Name"
        /><br />
        Last name:
        <input type="text" name="last_name" value="Customer Last Name" /><br />
        Email:
        <input
            type="text"
            name="email"
            value="customer_email@email.com"
        /><br />
        Contact Number:
        <input type="text" name="contact_number" value="0773606370" /><br />
        Address Line 1:
        <input
            type="text"
            name="address_line_one"
            value="46/46, Green Lanka Building"
        /><br />
        Address Line 2:
        <input
            type="text"
            name="address_line_two"
            value="Nawam Mawatha"
        /><br />
        City: <input type="text" name="city" value="Colombo" /><br />
        State: <input type="text" name="state" value="Western" /><br />
        Zip/Postal Code:
        <input type="text" name="postal_code" value="10300" /><br />
        Country: <input type="text" name="country" value="Sri Lanka" /><br />
        currency:
        <input type="text" name="process_currency" value="LKR" /><br />
        <!-- currency value must be LKR or USD -->
        CMS : <input type="text" name="cms" value="PHP" /> custom:
        <input type="text" name="custom_fields" value="custom_fields" />
        Mechanism:
        <input type="text" name="enc_method" value="JCs3J+6oSz4V0LgE0zi/Bg==" />
        <br />
        <!-- POST parameters -->
        <input
            type="hidden"
            name="secret_key"
            value="630be963-59e2-447a-8f3b-93b3d7a3bf25"
        />
        <input type="hidden" name="payment" value="payment" />
        <input type="submit" value="Pay Now" />
    </form>
</div>
@endsection
