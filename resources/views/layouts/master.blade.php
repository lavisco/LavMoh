<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Basic -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Site Metas -->
        <meta name="author" content="Lavisco" />

        @foreach($tags as $key => $value)
            <meta property="{{$key}}" content="{{$value}}">
        @endforeach

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
        <link
            rel="stylesheet"
            href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"
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
                    <navbar-component></navbar-component>
                    <navbar-category></navbar-category>
                    <!-- navbar section ends -->

                    <Transition name="pages">
                        <router-view></router-view>
                    </Transition>
                    <!-- <div>@yield('content')</div> -->
                </div>
                <!-- footer section starts -->
                <footer-component></footer-component>
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
        <script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    </body>
</html>
