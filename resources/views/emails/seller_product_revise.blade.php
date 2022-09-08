@component('mail::message')

<h1>Product {{ $product->code }} under review</h1>
<p>
    Dear {{ $product->user->name }}, the product listing {{ $product->code }} you added on {{ $product->created_at }} is currently being reviewed by Lavisco.
</p>
<p class="mb-4">
    Your product will display on the website if it meets our policy. You will be notified once we complete the review.
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

<h2>Details</h2>

<div class="w-100 mb-2 card-grey">
    <h3 class="mb-1">Title</h3>
    <p class="mb-2">
        {{ $product->title }}
    </p>
    <h3 class="mb-1">Base Price</h3>
    <p class="mb-2">
        {{ $product->base_price }}
    </p>
    <h3 class="mb-1">Category</h3>
    <p class="mb-2">
        {{ $product->category->name }}
    </p>
    <h3 class="mb-1">Short Description</h3>
    <p>
        {{ $product->short_description }}
    </p>
</div>

<div class="mb-4">
    <h3 class="mb-2">
        Please sign into your account to view the product.
    </h3>
    <a href="https://lavisco.lk/merchant/login">
        <button class="button button-primary">Sign in</button>
    </a>
</div>

Regards,<br />
Lavisco Team @endcomponent
