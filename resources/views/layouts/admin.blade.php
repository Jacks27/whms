<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/f22eaece1b.js" crossorigin="anonymous"></script>
    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/util.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        <div class="mt-5">
            @extends('layouts.sidebar')
                        <div class="content-wrapper">
                            <h4>@yield('content-header')</h4>
                        </div>
                        <div class="resp">
                            @include('layouts.alerts.success')
                            @include('layouts.alerts.error')
                        </div>
                        <div class="main">
                            @yield('content-actions')

                        </div>
                    </div> --}}

        <main class="">
            @yield('content')
        </main>
    </div>
    @include('layouts.footer')
</body>
</html>
