<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Site Metas -->
        <meta name="keywords" content="sri lanka cake, cakes in sri lanka, cakes in srilanka, srilanka cakes, gift in srilanka, srilanka gifts, flower in sri lanka" />
        <meta name="description" content="Buy locally. Support small businesses." />
        <meta name="author" content="Lavisco" />

        <!-- Google Metas -->
        <meta
            name="google-site-verification"
            content="DCi4K5tMWaWwK6p2UUIGmerGoUFGKHzIoBqhffxD2fg"
        />

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

        <!-- Icons -->
        <link
            href="{{
                asset('argon')
            }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
            rel="stylesheet"
        />

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
    <body>
        <div id="app">
            <main>
                <div>
                    <!-- navbar section starts -->
                    <navbar-component-static></navbar-component-static>
                    <navbar-category></navbar-category>
                    <!-- navbar section ends -->

                    <div>@yield('content')</div>
                </div>
                <!-- footer section starts -->
                <footer-component-static></footer-component-static>
                <!-- footer section ends -->
            </main>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script> -->
        <script>
            function showPasswordFunction() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </body>
</html>
