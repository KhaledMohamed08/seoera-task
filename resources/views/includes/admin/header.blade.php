<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.index') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/seoera-logo.png') }}" width="200" alt="logo">
            {{-- <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span> --}}
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown">
                <a class="nav-link nav-icon position-relative" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false" aria-haspopup="true">
                    <i class="bi bi-bell"></i>
                    <span id="notification-badge"
                        class="badge bg-primary rounded-pill position-absolute top-0 start-100 translate-middle"
                        style="display:none; font-size: 0.75rem; padding: 0.25em 0.4em;">
                        0
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"
                    style="min-width: 320px; max-height: 400px; overflow-y: auto; padding: 0.5rem;">
                    <li id="notification-header" class="dropdown-header">
                        No new notifications
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <ul id="notification-items-container" class="list-unstyled mb-0 px-3">
                        <!-- Notifications will be dynamically appended here -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    </ul>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <div class="image">
                        <span class="bg-dark text-white fw-bold w-100 h-100 d-flex justify-content-center align-items-center">{{ strtoupper(substr(explode(' ', auth()->user()->name)[0], 0, 2)) }}</span>
                    </div>
                    <span
                        class="d-none d-md-block dropdown-toggle ps-2"><strong>{{ 'Hi, ' . explode(' ', auth()->user()->name)[0] }}</strong></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->name }}</h6>
                        <span>{{ auth()->user()->type }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    {{-- <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li> --}}
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

@push('styles')
    <style>
        .image {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            overflow: hidden;
        }
    </style>
@endpush
