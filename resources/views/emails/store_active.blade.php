@component('mail::message') # Approval for Selling on Lavisco

<p>
    Your request for selling on Lavisco has been approved by our team.
    <br />
    Your journey on Lavisco starts from now! Sign into your dashboard and list your first product today. We are excited to have you on our platform and hope to work with you for years to come.
</p>

@component('mail::button', ['url' => 'https://lavisco.lk/merchant/login']) Sign In @endcomponent 

Regards,<br />
Lavisco Team 

@endcomponent
