@php
    $fullName = Auth::user()->name;
    $parts = explode(' ', $fullName);
    $initials = '';
    foreach ($parts as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }
@endphp

<!-- Sidebar (25%) -->
<nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed">
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="p-4">
        <h4 class="logo-text fw-bold mb-0">{{ Auth::user()->name }}</h4>
        <h4 class="logo-text sk fw-bold mb-0">{{ $initials }}</h4>
    </div>
    <div class="nav flex-column">
        <a href="{{ route('home') }}" class="sidebar-link text-decoration-none p-3 {{set_active(['home'])}}">
            <i class="fas fa-home me-3"></i>
            <span class="hide-on-collapse">Dashboard</span>
        </a>
        <a href="{{ route('listing/page') }}" class="sidebar-link text-decoration-none p-3 {{set_active(['listing/page'])}}">
            <i class="fas fa-chart-bar me-3"></i>
            <span class="hide-on-collapse">Data Listing</span>
        </a>
        <a href="{{ route('page/blank') }}" class="sidebar-link text-decoration-none p-3 {{set_active(['page/blank'])}}">
            <i class="fa-solid fa-pager me-3"></i>
            <span class="hide-on-collapse">Page Blank</span>
        </a>
    </div>
</nav>

<!-- Top Navbar (75%) -->
<div class="main-content">
    <div class="row justify-content-end">
        <nav class="navbar navbar-expand navbar-light py-3">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Dark mode -->
                        <li class="nav-item">
                            <a class="nav-link p-0 d-flex text-white align-items-center justify-content-center me-2 rounded-3 icon-circle" href="#" id="darkModeToggle">
                              <i class="fa-regular fa-moon fs-5"></i>
                            </a>
                        </li>
                        <!--  Flag -->
                        <li class="nav-item">
                            <a id="language-switch" class="nav-link p-0 d-flex text-white align-items-center justify-content-center me-2 rounded-3 icon-circle" href="#">
                                <img id="language-flag" src="https://flagcdn.com/w40/us.png" class="rounded-1" alt="KH" width="24" height="20">
                            </a>
                        </li>
                        <!-- Notifications -->
                        <li class="nav-item position-relative">
                            <a class="nav-link p-0 d-flex align-items-center justify-content-center me-2 rounded-3 icon-circle" href="#">
                                <i class="fa-solid fa-bell text-white fs-5"></i>
                            </a>
                            <span class="position-absolute top-0 start-50 translate-middle bg-danger border border-white rounded-circle notification-dot"></span>
                        </li>
                        <!-- Profile dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link p-0 d-flex text-white align-items-center justify-content-center rounded-3 icon-circle" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUYrF904TxxOkQsdkq486-C2rMZ0f4oAZa1g&s" class="rounded-2" alt="Profile" width="26" height="26">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <div class="profile-card">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUYrF904TxxOkQsdkq486-C2rMZ0f4oAZa1g&s" class="rounded" width="48" height="48" alt="Avatar">
                                        <div class="ms-3">
                                            <h6 class="mb-0 fw-bold">{{ Auth::user()->name }} <span class="pro-badge">Pro</span></h6>
                                            <small class="text-muted">{{ Auth::user()->email }}</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mb-3">
                                        <li class="mb-2">
                                            <a class="dropdown-item" href="">
                                                <i class="fa-solid fa-user me-2 fs-6"></i> <strong>Profile</strong>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a class="dropdown-item" href="">
                                                <i class="fa-solid fa-envelope me-2 fs-6"></i> <strong>Inbox</strong>
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a class="dropdown-item" href="{{ route('setting/page') }}">
                                                <i class="fa-solid fa-gear me-2 fs-6"></i> <strong>Settings</strong>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="border-top pt-2" data-bs-toggle="modal" data-bs-target="#modalLogout">
                                        <i class="fa-solid fa-right-from-bracket me-2 text-danger"></i>
                                        <a href="#" class="sign-out">Sign Out</a>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    

    <!-- Main Content -->
    <div class="p-4">
        @yield('content')
    </div>
</div>

<!-- Modal for Logout -->
<div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteUserLabel">Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                Are you sure you want to Logout ?
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('logout') }}">
                    <button type="button" class="btn btn-outline-danger" id="confirmDeleteUser">Logout</button>
                </a>
            </div>
        </div>
    </div>
</div>

