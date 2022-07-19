@component('mail::message') # Welcome!

<p>
    Thank you for joining us! We are excited to have you and your business
    onboard our platform.
</p>
<p>
    We want to ensure you have a smooth experience in setting up your store,
    click the link below to login to your seller dashboard. You can manage your
    products, orders, finances all in one place. Your user name:
    {{ $email }}
</p>

@component('mail::button', ['url' => 'https://lavisco.lk/merchant/login']) Sign
In @endcomponent

<p>
    If you didn't register an account at lavisco.lk, please ignore this email.
    <br />
    If you have any questions just reply to this message. A real human reads all
    the feedback sent to this email address.
</p>

Regards,<br />
Lavisco Team @endcomponent
