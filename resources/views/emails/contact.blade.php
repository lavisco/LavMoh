@component('mail::message') # Support request from {{$msg->name}}

<h3>Sender Name</h3>
<p>{{ $msg->name }}</p>
<h3>Email</h3>
<p>{{ $msg->email }}</p>
<h3>Phone</h3>
<p>{{ $msg->phone }}</p>
<h3>Message</h3>
<p>{{ $msg->msg_body }}</p>

@endcomponent
