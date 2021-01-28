<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="topbar">
            <div class="container">
                <div class="d-flex">
                    <div class="logo item">
                        <a class="" href="{{ url('/') }}">
                            <img src="{{ asset('images/app/logo.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="delivery item">
                        <h5>Pizza delivery Bishkek</h5>
                        <p>60 minutes or pizza for free</p>
                    </div>
                    <div class="phone item">
                        <div class="">
                            <span>Call By</span>
                            <img src="{{ asset('images/app/call1.svg') }}" alt="">
                            <img src="{{ asset('images/app/call2.svg') }}" alt="">
                            <img src="{{ asset('images/app/call3.svg') }}" alt="">
                        </div>
                        <div class="">
                            <h5>0 (551) 550-550</h5>
                        </div>
                    </div>
                    <div class="button item">
                        <button class="btn">To come in</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="nav">
            <div class="container" style='background:#F8FAFC'>

                <nav>

                    <ul>
                        <li>
                            <a href="">Pizza</a>
                        </li>
                        <li>
                            <a href="">Combo</a>
                            </li>
                        <li>
                            <a href="">Snacks</a>
                        </li>
                        <li>
                            <a href="">Dessert</a>
                        </li>
                        <li>
                            <a href="">Beverages</a>
                        </li>
                        <li>
                            <a href="">Other goods</a>
                        </li>
                        <li>
                            <a href="">Promotions</a>
                        </li>
                        <li>
                            <a href="">Contacts</a>
                        </li>
                        <li>
                            <a href="">About Us</a>
                        </li>
                        
                    </ul>

                </nav>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
</body>
</html>
