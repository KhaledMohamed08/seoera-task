<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.index') ? '' : 'collapsed' }} {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('users.*') ? '' : 'collapsed' }} {{ request()->routeIs('users.*') ? 'active' : '' }}" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-bounding-box"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>All Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.create') }}" class="{{ request()->routeIs('users.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Create User</span>
                    </a>
                </li>
            </ul>
        </li><!-- End User Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('posts.*') ? '' : 'collapsed' }} {{ request()->routeIs('posts.*') ? 'active' : '' }}" data-bs-target="#posts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-postcard-heart"></i><span>Posts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="posts-nav" class="nav-content collapse {{ request()->routeIs('posts.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>All Posts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('posts.create') }}" class="{{ request()->routeIs('posts.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Create Post</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Posts Nav -->

        {{-- <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav --> --}}

    </ul>

</aside><!-- End Sidebar-->
