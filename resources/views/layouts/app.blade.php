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
        <nav class="navbar navbar-expand-lg bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <i class="bi-back"></i>
                    <span class="text-white">WHMS</span>
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">Browse Services</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">How it works</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">FAQs</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_5">Contact</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blogs</a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="topics-listing.html">Services Listing</a></li>

                                <li><a class="dropdown-item" href="contact.html">Contact Form</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="d-none d-lg-block">
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                    </div>
                </div>
            </div>
        </nav>

        <div class="content-wrapper">

                        <div class="card-header">
                            <h4>@yield('content-header')</h4>
                        </div>
                        <div class="">
                            @yield('content-actions')
                        </div>
                    </div>

        <main class="">
            @yield('content')
        </main>
    </div>
    <footer class=" mt-2 bg-default" >
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3">
                <div class="col">
                  <div class="card shadow">

                    <div class="card-body">
                      <h5 class="card-title text-info"><b>FOLLOW US</b> </h5>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item "><i class="fa-brands fa-facebook-f" style="color: #1520b7;"></i>&nbsp; Facebook</li>
                        <li class="list-group-item"><i class="fa-brands fa-whatsapp" style="color: #0a9438;" ></i> &nbsp; Whatsapp</li>
                        <li class="list-group-item"><i class="fa-brands fa-instagram" style="color: #d60e1ecb;"></i> &nbsp; Instagram</li>
                        <li class="list-group-item"><i class="fa-brands fa-youtube" style="color: #b71515;"></i>&nbsp; Youtube</li>

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 shadow">

                    <div class="card-body">
                      <h5 class="card-title text-info"><b>RESOURCES </b></h5>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item ">Home</li>
                        <li class="list-group-item ">Blogs</li>
                        <li class="list-group-item ">Contact Us</li>
                    </ul>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 shadow">

                    <div class="card-body">
                        <h5 class="card-title text-info"><b>CONTACT US </b></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item "><i class="fa-solid fa-phone" style="color: #1520b7;"></i> +254 7243456789</li>
                            <li class="list-group-item "> <i class="fa-solid fa-envelope" style="color: #1520b7;"></i> &nbsp; info@whms.com</li>
                            <li class="list-group-item ">P.O Box 231 Kisumu</li>
                        </ul>
                      </div>
                  </div>
                </div>
            </div>
        </div>

    </footer>
    <p class="text-center">Copyright © 2048 Topic Listing Center. All rights reserved.
        <br>Design: <a rel="nofollow" href="#" target="_blank">WinTech</a></p>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
