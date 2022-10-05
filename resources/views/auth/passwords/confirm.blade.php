@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid login">
    <h1 class="pb-2">Confirm Password</h1>
    <h5>Please confirm your password before continuing</h5>
    <div class="card">
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group row">
                <label
                    for="password"
                    class="col-md-3 col-form-label text-md-right"
                    >Password
                </label>

                <div class="col-md-9">
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
                            autocomplete="current-password"
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

            <div class="d-flex justify-content-center flex-column mt-3">
                <button type="submit" class="btn-full">Confirm Password</button>

                @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
