@component('mail::message')

<h1>Product {{ $product->code }} has been suspended</h1>
<p>
    Dear {{ $product->user->name }}, the product listing {{ $product->code }} you added on {{ $product->created_at }} has been suspended by Lavisco.
</p>
<p class="mb-4">
    Your product will no longer display on the website as it doesn't meet our policy. Please try to add a new product.
</p>

<h2>Product Summary</h2>

<div class="flex-container mb-4">
    <div class="w-50 mb-sm-2">
        <h3 class="mb-1">Product code</h3>
        <p>{{ $product->code }}</p>
    </div>
    <div class="w-50">
        <h3 class="mb-1">Created Date</h3>
        <p>{{ $product->created_at }}</p>
    </div>
</div>

<div class="mb-4">
    <h3 class="mb-2">
        Please sign into your account.
    </h3>
    <a href="https://lavisco.lk/merchant/login">
        <button class="button button-primary">Sign in</button>
    </a>
</div>

Regards,<br />
Lavisco Team @endcomponent
