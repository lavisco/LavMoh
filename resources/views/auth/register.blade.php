@extends('layouts.masterNonVue') @section('content')
<div class="container-fluid login">
    <h1>Sign Up</h1>
    <h5>To unlock exclusive drops and discounts!</h5>
    <div class="card">
        <form class="input-form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="col-form-label" for="name"
                    >Name
                    <strong class="text-danger"> * </strong>
                </label>
                <input
                    id="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    placeholder="Name"
                />

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="col-form-label" for="email"
                    >Email
                    <strong class="text-danger"> * </strong>
                </label>
                <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
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

            <div class="form-group">
                <label class="col-form-label" for="password"
                    >Password
                    <strong class="text-danger"> * </strong>
                </label>
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
                    <i class="fas fa-eye" onclick="showPasswordFunction()"></i>
                </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="col-form-label" for="password"
                    >Confirm Password
                    <strong class="text-danger"> * </strong>
                </label>
                <input
                    id="password-confirm"
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm Password"
                />
            </div>

            <div class="d-flex justify-content-center my-5">
                <button type="submit" class="btn-full">Sign up</button>
            </div>
        </form>
    </div>
</div>
@endsection
