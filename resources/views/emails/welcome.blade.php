@component('mail::message')
# Welcome to Lavisco.lk

Thank you for registering with Lavisco.

@component('mail::button', ['url' => ''])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
