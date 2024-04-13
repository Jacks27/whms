<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/f22eaece1b.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/util.css') }}" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        @if(count(Auth::user()->getRoleNames()) > 0)
        {{-- nav bar start  --}}
        <aside class="main-sidebar  elevation-4">

            <hr>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-1 pb-1 mb- d-flex">
                        <div class="image">
                            <img src="{{ Storage::url(Auth::user()->profile->image) }}" class="img-prof" alt="Profile Image">
                        </div>
                    </div>
                    <a href="{{route('home')}}">
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="{{route('doctor.dashboard')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p class="text-small">Dashboard</p>

                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ route('role.index') }}" class="nav-link">
                                    <i class="fa-solid fa-building"></i>
                                    <p class="text-small">Admin</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ route('permissions.index') }}" class="nav-link">
                                    <i class="fa-solid fa-user-check"></i>
                                    <p class="text-small">permissions</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{ route('department.index') }}" class="nav-link">
                                    <i class="fa-solid fa-building"></i>
                                    <p class="text-small">Department</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="{{route('doctor.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-user-md"></i>
                                    <p class="text-small">Staff</p>
                                </a>
                            </

                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                    <form action="{{route('logout')}}" method="POST" id="logout-form">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        </ul>
                </div>
                <!-- /.sidebar -->
            </aside>
        {{-- nav bar end --}}
                                @else
                                    false
            <div class="content-wrapper mt-5">
                <h4>@yield('content-header')</h4>
            </div>
        @endif

        <div class="resp">
            @include('layouts.alerts.success')
            @include('layouts.alerts.error')
        </div>

        <div class="main">
            @yield('content-actions')
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>
</body>
</html>
