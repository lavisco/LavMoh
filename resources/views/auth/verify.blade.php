@extends('layouts.master') @section('content')
<div class="container-fluid login mb-5">
    <h1 class="pb-2">Verify Your Email Address</h1>
    <div class="card px-4 border-grey">
        @if (session('message'))
        <div class="alert alert-success" role="alert">
            A fresh verification link has been sent to your email address.
        </div>
        @endif Before proceeding, please check your email for a verification
        link. If you did not receive the
        email,
        <a href="{{ route('verification.send') }}" class="pink">
            click here to request another
        </a>
    </div>
</div>
@endsection
