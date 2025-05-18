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
    {{-- Sidebar Toggle Button --}}
    <button class="toggle-btn">
        <i class="fas fa-chevron-left"></i>
    </button>

    {{-- User Info --}}
    <div class="p-4">
        <h4 class="logo-text fw-bold mb-0">{{ Auth::user()->name }}</h4>
        <h4 class="logo-text sk fw-bold mb-0">{{ $initials }}</h4>
    </div>

    {{-- Navigation Links --}}
    <div class="nav flex-column">

        {{-- Dashboard --}}
        <a href="{{ route('home') }}" class="sidebar-link text-decoration-none p-3 {{ set_active(['home']) }}">
            <i class="fas fa-home me-3"></i>
            <span class="hide-on-collapse">Dashboard</span>
        </a>

        {{-- Admin CRUD Forms --}}
        <a href="#adminCrudSubmenu" data-bs-toggle="collapse"
            aria-expanded="{{ set_expanded(['user/data/listing']) }}"
            class="sidebar-link text-decoration-none p-3 d-flex justify-content-between align-items-center {{ set_active(['user/data/listing']) }}">
            <div>
                <i class="fa fa-lock me-3"></i>
                <span class="hide-on-collapse">Admin CRUD Forms</span>
            </div>
            <i class="fa fa-caret-right toggle-caret"></i>
        </a>
        <div class="collapse ps-4 {{ set_show(['user/data/listing']) }}" id="adminCrudSubmenu">
            <a href="{{ route('user/data/listing') }}" class="sidebar-link text-decoration-none p-2 d-block {{ set_active(['user/data/listing']) }}">
                <i class="fa fa-list-ol me-2"></i> Users Listing
            </a>
        </div>

        {{-- Upload Forms --}}
        <a href="#uploadFormsSubmenu" data-bs-toggle="collapse"
            aria-expanded="{{ set_expanded(['form/upload/page','form/upload/listing']) }}"
            class="sidebar-link text-decoration-none p-3 d-flex justify-content-between align-items-center {{ set_active(['form/upload/page','form/upload/listing']) }}">
            <div>
                <i class="fa fa-upload me-3"></i>
                <span class="hide-on-collapse">Upload Forms</span>
            </div>
            <i class="fa fa-caret-right toggle-caret"></i>
        </a>
        <div class="collapse ps-4 {{ set_show(['form/upload/page','form/upload/listing']) }}" id="uploadFormsSubmenu">
            <a href="{{ route('form/upload/page') }}" class="sidebar-link text-decoration-none p-2 d-block {{ set_active(['form/upload/page']) }}">
                <i class="fa fa-file-upload me-2"></i> Upload File
            </a>
            <a href="{{ route('form/upload/listing') }}" class="sidebar-link text-decoration-none p-2 d-block {{ set_active(['form/upload/listing']) }}">
                <i class="fa fa-list-ol me-2"></i> Listing Upload File
            </a>
        </div>

        {{-- Wizard Forms --}}
        <a href="#wizardFormsSubmenu" data-bs-toggle="collapse"
            class="sidebar-link text-decoration-none p-3 d-flex justify-content-between align-items-center">
            <div>
                <i class="fa fa-magic me-3"></i>
                <span class="hide-on-collapse">Wizard Forms</span>
            </div>
            <i class="fa fa-caret-right toggle-caret"></i>
        </a>
        <div class="collapse ps-4" id="wizardFormsSubmenu">
            <a href="#" class="sidebar-link text-decoration-none p-2 d-block">
                <i class="fa fa-fast-forward me-2"></i> Multi-Step
            </a>
        </div>

        {{-- Authentication Forms --}}
        <a href="#authFormsSubmenu" data-bs-toggle="collapse"
            class="sidebar-link text-decoration-none p-3 d-flex justify-content-between align-items-center">
            <div>
                <i class="fa fa-shield me-3"></i>
                <span class="hide-on-collapse">Authentication Forms</span>
            </div>
            <i class="fa fa-caret-right toggle-caret"></i>
        </a>
        <div class="collapse ps-4" id="authFormsSubmenu">
            <a href="#" class="sidebar-link text-decoration-none p-2 d-block">
                <i class="fa fa-sign-in me-2"></i> Login
            </a>
        </div>

        {{-- Blank Page --}}
        <a href="{{ route('page/blank') }}" class="sidebar-link text-decoration-none p-3 {{ set_active(['page/blank']) }}">
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
                            @if(!empty(Auth::user()->avatar))
                                <a class="nav-link p-0 d-flex text-white align-items-center justify-content-center rounded-3 icon-circle" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}" class="rounded-2" alt="Profile" width="26" height="26">
                                </a>
                            @else
                                <a class="nav-link p-0 d-flex text-white align-items-center justify-content-center rounded-3 icon-circle" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $initials }}
                                </a>
                            @endif
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <div class="profile-card">
                                    <div class="d-flex align-items-center mb-3">
                                        @if(!empty(Auth::user()->avatar))
                                            <img src="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}" class="rounded" width="48" height="48" alt="Avatar">
                                        @else
                                            <span class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-2 fw-bold image-profile">{{ $initials }}</span>
                                        @endif
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