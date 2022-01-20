@extends('main') @section('content')
<div class="container">
    <h1>Buyer</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __("Buyer Dashboard") }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    @endif

                    {{ __("Hello Buyer, You are logged in!") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
