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

        <!-- Google Tag Manager -->
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    "gtm.start": new Date().getTime(),
                    event: "gtm.js",
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "GTM-TQ78DH2");
        </script>
        <!-- End Google Tag Manager -->

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
        <!-- Google Tag Manager (noscript) -->
        <noscript
            ><iframe
                src="https://www.googletagmanager.com/ns.html?id=GTM-TQ78DH2"
                height="0"
                width="0"
                style="display: none; visibility: hidden"
            ></iframe
        ></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
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
