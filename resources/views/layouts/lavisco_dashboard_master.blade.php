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
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,800;1,400&display=swap"
            rel="stylesheet"
        />

        <!-- Icons -->
        <link
            href="{{
                asset('argon')
            }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
            rel="stylesheet"
        />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    </head>
    <body class="{{ $class ?? '' }}">
        <div id="app">
            @auth()

            <div class="main-dashboard">
                @include('layouts.laviscoDashboard.sideNav')

                <div class="main-content main-dashboard-content">
                    @include('layouts.laviscoDashboard.topNav')
                    <router-view></router-view>
                    @include('layouts.laviscoDashboard.footer')
                </div>
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
        --}} @stack('js')

        <script>
            function showPasswordFunction() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
            function showOldPasswordFunction() {
                var x = document.getElementById("old_password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }

            //SIDE-NAV
            let sidenav = document.querySelector(".dashboard-side-nav");
            let openbtn = document.querySelector("#toggle-sidenav");
            let closebtn = document.querySelector("#close-sidenav");

            openbtn.addEventListener("click", () => {
                sidenav.classList.toggle("show-nav");
            });
            closebtn.addEventListener("click", () => {
                sidenav.classList.toggle("show-nav");
            });
            document.querySelectorAll(".dashboard-link").forEach((button) => {
                button.onclick = function () {
                    sidenav.classList.toggle("show-nav");
                };
            });

            //Usetiful script start
            (function (w, d, s) {
                var a = d.getElementsByTagName("head")[0];
                var r = d.createElement("script");
                r.async = 1;
                r.src = s;
                r.setAttribute("id", "usetifulScript");
                r.dataset.token = "a927c0fe10f0c1e70e837ef472b68edd";
                a.appendChild(r);
            })(window, document, "https://www.usetiful.com/dist/usetiful.js");
            //Usetiful script end
        </script>
    </body>
</html>
