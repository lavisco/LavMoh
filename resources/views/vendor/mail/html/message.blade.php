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
<div class="social-links">
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
</div>

<h4>Get in touch</h4>

<p>+94 77 700 9826</p>
<p>71, Kurunegala Rd,Katugastota 20000 Kandy, Sri Lanka</p>
<p class="copyright">
    © {{ date("Y") }} @lang('Lavisco. All rights reserved.')
</p>
@endcomponent @endslot @endcomponent
