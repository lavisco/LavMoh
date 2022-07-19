@component('mail::layout')
{{-- Header --}}
@slot('header') @component('mail::header', ['url' => config('app.url')])
{{ config("app.name") }}
@endcomponent @endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy) @slot('subcopy') @component('mail::subcopy')
{{ $subcopy }}
@endcomponent @endslot @endisset

{{-- Footer --}}
@slot('footer') @component('mail::footer')
<p>
    <a href="https://www.instagram.com/lavisco.lk/" class="social-link">
        <img
            src="{{ Storage::disk('s3')->temporaryUrl('public/images/instagram.png', '+2 minutes') }}"
            class="footer-logo"
            alt="Lavisco Instagram"
        />
    </a>
    <a href="https://www.facebook.com/laviscosl">
        <img
            src="{{ Storage::disk('s3')->temporaryUrl('public/images/facebook.png', '+2 minutes') }}"
            class="footer-logo"
            alt="Lavisco Facebook"
        />
    </a>
</p>

<h4>Lavisco Global Private Limited</h4>

<p>+94 77 700 9826</p>
<p>71, Kurunegala Road, Katugastota, Kandy, Sri Lanka 20800</p>
<p class="copyright">
    Copyright © {{ date("Y") }} lavisco.lk <br />All Rights Reserved.
</p>
@endcomponent @endslot @endcomponent
