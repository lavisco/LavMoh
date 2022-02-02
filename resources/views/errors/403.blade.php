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
        <h1 class="title black mb-4">403</h1>
        <h1>You are forbidden here</h1>
        <h3>
            Go back to
            <a href="/lavisco/home" class="pink">Home</a>
        </h3>
    </div>
</div>

@endsection
