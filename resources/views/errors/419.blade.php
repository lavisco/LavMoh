@extends('layouts.error_master') @section('content')

<div class="container-fluid min-vh-100">
    <div
        class="
            p-4
            min-vh-100
            d-flex
            justify-content-center
            align-items-center
            flex-column
        "
    >
        <h1 class="title black mb-4">Session timeout</h1>
        <h1>Your login session has expired</h1>
        <h3><a href="/login" class="pink">Login</a> again to continue</h3>
    </div>
</div>

@endsection
