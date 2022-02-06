<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Site Metas -->
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Lavisco") }}</title>

        <!-- Icons -->
        <link
            rel="icon"
            href="{{ asset('/images/lavisco/favicon.ico') }}"
            type="image/x-icon"
        />

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,800;1,400&display=swap"
            rel="stylesheet"
        />

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link
            rel="stylesheet"
            href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
        />

        <!-- Icons -->
        <link
            href="{{
                asset('argon')
            }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
            rel="stylesheet"
        />
    </head>
    <body>
        <div id="app">
            <main>
                <div>
                    <div class="top-ribbon">
                        Good News! We are shipping worldwide now
                    </div>
                    <!-- navbar section starts -->
                    <navbar-component></navbar-component>
                    <!-- navbar section ends -->

                    <router-view></router-view>
                    @yield('content')
                </div>
                <!-- footer section starts -->
                <footer-component></footer-component>
                <!-- footer section ends -->
            </main>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script> -->
    </body>
</html>
