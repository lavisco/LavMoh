@component('mail::message') # Order Placed

<p>
    You have recieved an order.
    <br />
    Please sign into your dashboard to view the order and complete its delivery
    on time.
</p>

@component('mail::button', ['url' => 'https://lavisco.lk/merchant/login']) Sign In
@endcomponent Regards,<br />
Lavisco Team @endcomponent
