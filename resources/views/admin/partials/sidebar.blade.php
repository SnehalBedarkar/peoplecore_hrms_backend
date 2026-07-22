{{--
    Sidebar partial.

    Active-state logic: request()->routeIs('pattern.*') checks the CURRENT
    route name against a pattern — this is the Blade equivalent of checking
    `Route::currentRouteName()` in a controller, just declarative. The '*'
    wildcard means "this nav item is active for any route under this group"
    (e.g. employees.index, employees.create, employees.edit all light up
    "Employees" in the sidebar). This is why route *naming* discipline
    (employees.index, employees.create...) pays off later — the sidebar
    highlighting is free once routes are named consistently.
--}}
<aside class="app-sidebar" id="appSidebar">

    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <span class="brand-mark"><i class="bi bi-hexagon-fill"></i></span>
            <span class="brand-text">PeopleCore</span>
        </a>
        {{-- Collapse toggle lives in the sidebar itself on desktop --}}
        <button type="button" class="sidebar-collapse-btn" id="sidebarCollapseBtn" aria-label="Toggle sidebar">
            <i class="bi bi-chevron-left"></i>
        </button>
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section-label">Overview</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" title="Dashboard">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-label">People</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('employees.index') }}"
                    class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" data-bs-toggle="tooltip"
                    data-bs-placement="right" title="Employees">
                    <i class="bi bi-people-fill"></i>
                    <span class="nav-text">Employees</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Departments">
                    <i class="bi bi-diagram-3-fill"></i>
                    <span class="nav-text">Departments</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-label">Attendance</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Attendance">
                    <i class="bi bi-calendar-check-fill"></i>
                    <span class="nav-text">Attendance</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('leaves.*') ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Leave Requests">
                    <i class="bi bi-calendar-x-fill"></i>
                    <span class="nav-text">Leave Requests</span>
                    <span class="nav-badge">4</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-label">Payroll</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('payroll.*') ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Payroll">
                    <i class="bi bi-cash-stack"></i>
                    <span class="nav-text">Payroll</span>
                </a>
            </li>
        </ul>

        <div class="nav-section-label">System</div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Settings">
                    <i class="bi bi-gear-fill"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>

    </nav>

</aside>
