@extends('layouts.master') @section('content')
<div class="container-fluid login">
    <h1>Sign In</h1>
    <h5>Welcome back</h5>
    <p>
        Don't have an account?
        <a class="pink" href="/seller_register">Become a Seller</a>
    </p>
    <div class="card">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <div class="">
                    <input
                        id="email"
                        type="email"
                        class="
                            form-control
                            @error('email')
                            is-invalid
                            @enderror
                        "
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="Email"
                    />

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <div class="password-input">
                        <input
                            id="password"
                            type="password"
                            class="
                                form-control
                                @error('password')
                                is-invalid
                                @enderror
                            "
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Password"
                        />
                        <i
                            class="fas fa-eye"
                            onclick="showPasswordFunction()"
                        ></i>
                    </div>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"
                    name="remember" id="remember"
                    {{ old("remember") ? "checked" : "" }}>

                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
                @endif
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn-full">Sign in</button>
            </div>
        </form>
    </div>
</div>
@endsection
