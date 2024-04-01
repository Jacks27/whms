<!-- Main Sidebar Container -->
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
