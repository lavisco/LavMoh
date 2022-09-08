@component('mail::message')

<h1>Requested transaction {{ $transaction->code }}</h1>
<p>
    Dear {{ $transaction->user->name }}, you requested transaction
    {{ $transaction->code }} clearance on
    {{ $transaction->request_withdrawal_date }}.
</p>
<p class="mb-4">
    The amount {{ $transaction->payable_amount }} will be deposited into your
    bank account by our agent soon. You will be notified once the deposit has
    been made.
</p>

<h2>Summary</h2>

<div class="flex-container mb-2">
    <div class="w-50 mb-sm-2">
        <h3 class="mb-1">Transaction code</h3>
        <p>{{ $transaction->code }}</p>
    </div>
    <div class="w-50">
        <h3 class="mb-1">Requested withdrawal on</h3>
        <p>{{ $transaction->request_withdrawal_date }}</p>
    </div>
</div>
<div class="flex-container mb-4">
    <div class="w-50 mb-sm-2">
        <h3 class="mb-1">Amount Paid</h3>
        <p>{{ $transaction->payable_amount }}</p>
    </div>
    <div class="w-50">
        <h3 class="mb-1">Order Code</h3>
        <p>{{ $transaction->order->code }}</p>
    </div>
</div>

<div class="mb-4">
    <h3 class="mb-2">Please sign into your account to view full details.</h3>
    <a href="https://lavisco.lk/merchant/login">
        <button class="button button-primary">Sign in</button>
    </a>
</div>

Regards,<br />
Lavisco Team @endcomponent
