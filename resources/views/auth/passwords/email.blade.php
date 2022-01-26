@extends('layouts.master') @section('content')
<div class="container-fluid login">
    <h1 class="pb-2">Password Reset Email</h1>
    <h5>Provide your email to send the password reset link</h5>

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session("status") }}
    </div>
    @endif @if (session('info'))
    <div class="alert alert-info" role="alert">
        {{ session("info") }}
    </div>
    @endif

    <div class="card">
        <form role="form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div
                class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3"
            >
                <input
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                />
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn-full">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
