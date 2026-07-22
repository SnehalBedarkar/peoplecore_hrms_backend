{{--
    Topbar partial.

    Auth user access: in Blade, auth()->user() (or the @auth directive) is
    available in any view rendered through a route behind the 'auth'
    middleware — same Guard concept as $request->user() in a Controller,
    just exposed as a global helper inside views so you don't have to pass
    $user down from every controller method manually.
--}}
<header class="app-topbar">

    <div class="topbar-left">
        <button type="button" class="mobile-sidebar-toggle d-lg-none" id="mobileSidebarToggle" aria-label="Open sidebar">
            <i class="bi bi-list"></i>
        </button>

        <form class="topbar-search d-none d-md-flex" role="search"
            action="{{ Route::has('search') ? route('search') : '#' }}" method="GET">
            <i class="bi bi-search search-icon"></i>
            <input type="search" name="q" class="search-input" placeholder="Search employees, departments..."
                value="{{ request('q') }}">
        </form>
    </div>

    <div class="topbar-right">

        {{-- Dark mode toggle: just flips data-theme on <body>, see app-shell.js --}}
        <button type="button" class="topbar-icon-btn" id="darkModeToggle" aria-label="Toggle dark mode">
            <i class="bi bi-moon-stars-fill theme-icon-dark"></i>
            <i class="bi bi-sun-fill theme-icon-light"></i>
        </button>

        {{-- Notifications dropdown --}}
        <div class="dropdown topbar-dropdown">
            <button type="button" class="topbar-icon-btn position-relative" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-bell-fill"></i>
                <span class="notification-dot"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end notification-panel">
                <div class="notification-panel-header">
                    <span>Notifications</span>
                    <a href="#" class="mark-read-link">Mark all as read</a>
                </div>
                <a href="#" class="notification-item">
                    <span class="notif-icon bg-primary-soft"><i class="bi bi-person-plus-fill"></i></span>
                    <span class="notif-body">
                        <span class="notif-title">New employee onboarded</span>
                        <span class="notif-time">2 hours ago</span>
                    </span>
                </a>
                <a href="#" class="notification-item">
                    <span class="notif-icon bg-warning-soft"><i class="bi bi-calendar-x-fill"></i></span>
                    <span class="notif-body">
                        <span class="notif-title">3 leave requests pending approval</span>
                        <span class="notif-time">5 hours ago</span>
                    </span>
                </a>
                <a href="#" class="notification-item">
                    <span class="notif-icon bg-success-soft"><i class="bi bi-cash-stack"></i></span>
                    <span class="notif-body">
                        <span class="notif-title">Payroll processed for June</span>
                        <span class="notif-time">1 day ago</span>
                    </span>
                </a>
                <a href="#" class="notification-panel-footer">View all notifications</a>
            </div>
        </div>

        {{-- User dropdown --}}
        <div class="dropdown topbar-dropdown">
            <button type="button" class="user-menu-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </span>
                <span class="user-meta d-none d-md-flex">
                    <span class="user-name">{{ auth()->user()->name ?? 'User' }}</span>
                    <span class="user-role">{{ auth()->user()->role ?? 'Admin' }}</span>
                </span>
                <i class="bi bi-chevron-down user-caret d-none d-md-inline"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end user-menu-panel">
                <li><a class="dropdown-item" href="{{ Route::has('profile.edit') ? route('profile.edit') : '#' }}"><i
                            class="bi bi-person"></i> My Profile</a></li>
                <li><a class="dropdown-item"
                        href="{{ Route::has('settings.index') ? route('settings.index') : '#' }}"><i
                            class="bi bi-gear"></i> Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i>
                            Logout</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>

</header>
