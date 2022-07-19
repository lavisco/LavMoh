@component('mail::message') # Welcome to Lavisco.lk

<p>Thank you for registering with Lavisco, {{ $receiverEmailAddress }}</p>

@component('mail::button', ['url' => 'https://lavisco.lk/merchant/login']) Login
@endcomponent Regards,<br />
Lavisco Team @endcomponent
