<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Site Metas -->
        <meta name="keywords" content="lavisco" />
        <meta name="description" content="lavisco" />
        <meta name="author" content="lavisco" />

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Lavisco") }}</title>

        <!-- Favicon -->
        <link
            href="{{ asset('/images/lavisco/favicon.ico') }}"
            rel="icon"
            type="image/x-icon"
        />

        <!-- Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
            rel="stylesheet"
        />

        <!-- Icons -->
        <link
            href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css"
            rel="stylesheet"
        />
        <link
            href="{{
                asset('argon')
            }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
            rel="stylesheet"
        />

        <!-- Argon CSS -->
        <link
            type="text/css"
            href="{{ asset('argon') }}/css/argon.css?v=1.0.0"
            rel="stylesheet"
        />

        <!-- Styles -->
        {{--
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        --}}

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=G-SYY3G21Q5S"
        ></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());

            gtag("config", "G-SYY3G21Q5S");
        </script>
    </head>

    <body class="{{ $class ?? '' }}">
        <div id="app">
            @auth()

            <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display: none"
            >
                @csrf
            </form>

            @include('layouts.navbars.sidebar')

            <div class="main-content">
                @include('layouts.navbars.navbar')
                <router-view></router-view>
                @include('layouts.navbars.footer')
            </div>

            @endauth @guest()

            <div class="container">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="mt-5 mb-3">Session Expired</h1>
                    <h4 class="mb-4">Please login again to continue</h4>
                    <a href="/login">
                        <button type="button" class="btn btn-primary">
                            Login
                        </button>
                    </a>
                </div>
            </div>

            @endguest
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        {{--
        <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        --}}

        <!-- Argon JS -->
        <script src="/assets/js/argon.min.js"></script>
        @stack('js')
    </body>
</html>
