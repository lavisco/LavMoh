@extends('layouts.master') @section('content')
<div class="container-fluid login">
    <h1 class="pb-2">Password Reset</h1>
    <h5>Provide new Password</h5>

    <div class="card">
        <form role="form" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}" />

            <div
                class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}"
            >
                <input
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    placeholder="Email"
                    type="email"
                    name="email"
                    value="{{ $email ?? old('email') }}"
                    required
                    autofocus
                />
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div
                class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}"
            >
                <div class="password-input">
                    <input
                        id="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password"
                        placeholder="Password"
                        type="password"
                        required
                    />
                    <i class="fas fa-eye" onclick="showPasswordFunction()"></i>
                </div>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <input
                    id="password-confirm"
                    class="form-control"
                    placeholder="Confirm Password"
                    type="password"
                    name="password_confirmation"
                    required
                />
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn-full">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
