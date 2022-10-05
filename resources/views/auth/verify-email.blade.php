@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid login mb-5">
    <h1 class="pb-2">Verify Your Email Address</h1>
    @if (session('message'))
    <div
        class="card px-4 border-grey bg-green white text-center mb-4"
        role="alert"
    >
        A fresh verification link has been sent to your email address.
    </div>
    @endif
    <div class="card px-4 border-grey text-center">
        <p>
            Before proceeding, please check your email for a verification link.
            If you did not receive the email:
        </p>
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button class="link-type-btn" type="submit">
                Request a new link
            </button>
        </form>
    </div>
</div>
@endsection
