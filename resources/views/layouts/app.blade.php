<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - PeopleCore</title>

    {{--
        Set data-theme on <html> SYNCHRONOUSLY, before any stylesheet paints.
        This must be an inline script (not an external file) placed before
        the CSS links, because inline head scripts block rendering until
        they finish — that's what prevents the light->dark flash on load.
        An external script (like app.js at the bottom of body) runs far too
        late: by then the page has already painted in the default theme.
    --}}
    <script>
        (function() {
            var theme = localStorage.getItem("peoplecore:theme") ||
                (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
            document.documentElement.setAttribute("data-theme", theme);
        })();
    </script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- App shell styles (sidebar + topbar) -->
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>

    <div class="app-shell">

        @include('admin.partials.sidebar')

        <div class="app-main">

            @include('admin.partials.topbar')

            <main class="app-content">
                {{-- Page-level heading/breadcrumb slot, optional per page --}}
                @hasSection('page-header')
                    <div class="page-header mb-4">
                        @yield('page-header')
                    </div>
                @endif

                {{-- Main page content --}}
                @yield('content')
            </main>

        </div>

    </div>

    <!-- Bootstrap 5 JS bundle (includes Popper, needed for dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- App shell behaviour: sidebar collapse + dark mode -->
    <script src="{{ asset('admin/js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>
