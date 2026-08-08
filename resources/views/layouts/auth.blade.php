    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign in · PeopleCore</title>

        <!-- Bootstrap 5.3 (native data-bs-theme dark mode) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fonts: Sora for display, Inter for body -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link
            href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
            rel="stylesheet">

        <style>
            :root {
                --pc-accent: #E8A33D;
                /* badge-clip amber */
                --pc-accent-soft: #F4D9A6;
                --pc-ink: #14161F;
            }

            [data-bs-theme="light"] {
                --pc-bg: #F5F6F8;
                --pc-panel: #FFFFFF;
                --pc-border: #E3E6EC;
                --pc-text-muted: #5B6472;
            }

            [data-bs-theme="dark"] {
                --pc-bg: #14161F;
                --pc-panel: #1B1E2A;
                --pc-border: #2A2E3D;
                --pc-text-muted: #9AA1B2;
            }

            body {
                font-family: 'Inter', sans-serif;
                background-color: var(--pc-bg);
                min-height: 100vh;
                transition: background-color .2s ease;
            }

            .display-font {
                font-family: 'Sora', sans-serif;
            }

            .auth-shell {
                min-height: 100vh;
            }

            /* ---- Left: form panel ---- */
            .form-panel {
                background-color: var(--pc-bg);
            }

            .form-card {
                max-width: 380px;
                width: 100%;
            }

            .brand-mark {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: var(--pc-ink);
                color: var(--pc-accent);
                font-weight: 800;
                font-family: 'Sora', sans-serif;
            }

            [data-bs-theme="dark"] .brand-mark {
                background: var(--pc-accent);
                color: var(--pc-ink);
            }

            .form-control {
                background-color: var(--pc-panel);
                border-color: var(--pc-border);
                color: inherit;
                padding-top: .65rem;
                padding-bottom: .65rem;
            }

            .form-control:focus {
                border-color: var(--pc-accent);
                box-shadow: 0 0 0 .2rem rgba(232, 163, 61, .25);
                background-color: var(--pc-panel);
            }

            .form-label {
                font-size: .85rem;
                font-weight: 600;
                color: var(--pc-text-muted);
            }

            .btn-accent {
                background-color: var(--pc-ink);
                color: #fff;
                font-weight: 600;
                padding: .65rem 1rem;
                border: none;
            }

            .btn-accent:hover {
                background-color: #000;
                color: #fff;
            }

            [data-bs-theme="dark"] .btn-accent {
                background-color: var(--pc-accent);
                color: var(--pc-ink);
            }

            [data-bs-theme="dark"] .btn-accent:hover {
                background-color: #f0b25c;
            }

            .theme-toggle {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                border: 1px solid var(--pc-border);
                background: var(--pc-panel);
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .text-muted-pc {
                color: var(--pc-text-muted);
            }

            .divider-text {
                font-size: .75rem;
                color: var(--pc-text-muted);
            }

            /* ---- Right: signature panel — attendance punch-clock strip ---- */
            .visual-panel {
                background: var(--pc-ink);
                position: relative;
                overflow: hidden;
            }

            .punch-strip {
                position: absolute;
                inset: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 0;
            }

            .punch-row {
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: .55rem 3rem;
                border-top: 1px dashed rgba(255, 255, 255, .08);
                font-family: 'Sora', sans-serif;
                color: rgba(255, 255, 255, .35);
                font-size: .8rem;
                letter-spacing: .04em;
                white-space: nowrap;
            }

            .punch-row:first-child {
                border-top: none;
            }

            .punch-row .dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--pc-accent);
                flex: none;
            }

            .punch-row.active {
                color: #fff;
                background: rgba(232, 163, 61, .08);
            }

            .visual-copy {
                position: relative;
                z-index: 2;
                padding: 4rem 3rem;
                color: #fff;
            }

            .visual-copy h2 {
                font-size: 2rem;
                line-height: 1.2;
            }

            @media (max-width: 991.98px) {
                .visual-panel {
                    display: none;
                }
            }
        </style>
    </head>

    <body data-bs-theme="light">

        <div class="auth-shell d-flex">

            <!-- Left: Login form -->
            <div class="form-panel col-lg-5 col-12 d-flex flex-column justify-content-between p-4 p-lg-5">

                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="brand-mark">P</span>
                        <span class="display-font fw-bold fs-5">PeopleCore</span>
                    </div>

                    <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle dark mode">
                        <svg id="iconSun" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path
                                d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41">
                            </path>
                        </svg>
                        <svg id="iconMoon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="d-none">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79z"></path>
                        </svg>
                    </button>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="form-card py-5">

                        <h1 class="display-font fw-bold mb-1" style="font-size: 1.75rem;">Welcome back</h1>
                        <p class="text-muted-pc mb-4">Sign in to clock in and manage your team.</p>

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 small">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Work email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="you@company.com" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="small text-decoration-none"
                                            style="color: var(--pc-accent);">Forgot?</a>
                                    @endif
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="••••••••" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small text-muted-pc" for="remember">
                                    Keep me signed in
                                </label>
                            </div>

                            <button type="submit" class="btn btn-accent w-100 rounded-2">
                                Sign in
                            </button>
                        </form>

                    </div>
                </div>

                <p class="text-center divider-text mb-0">&copy; {{ date('Y') }} PeopleCore HRMS</p>
            </div>

            <!-- Right: Signature visual — attendance punch strip -->
            <div class="visual-panel col-lg-7 d-none d-lg-flex flex-column">
                <div class="punch-strip">
                    <div class="punch-row"><span class="dot"></span> MON&nbsp;&nbsp;09:01&nbsp;&nbsp;IN</div>
                    <div class="punch-row"><span class="dot"></span> MON&nbsp;&nbsp;18:12&nbsp;&nbsp;OUT</div>
                    <div class="punch-row active"><span class="dot"></span> TUE&nbsp;&nbsp;08:57&nbsp;&nbsp;IN</div>
                    <div class="punch-row"><span class="dot"></span>
                        TUE&nbsp;&nbsp;—&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OUT</div>
                    <div class="punch-row"><span class="dot"></span> WED&nbsp;&nbsp;09:04&nbsp;&nbsp;IN</div>
                    <div class="punch-row"><span class="dot"></span> WED&nbsp;&nbsp;17:48&nbsp;&nbsp;OUT</div>
                    <div class="punch-row"><span class="dot"></span> THU&nbsp;&nbsp;08:49&nbsp;&nbsp;IN</div>
                    <div class="punch-row"><span class="dot"></span> THU&nbsp;&nbsp;18:30&nbsp;&nbsp;OUT</div>
                </div>
                <div class="visual-copy mt-auto">
                    <h2 class="display-font fw-bold">Every clock-in,<br>accounted for.</h2>
                    <p class="text-white-50 mt-2 mb-0" style="max-width: 380px;">
                        Attendance, leave, and payroll — one panel for your whole team.
                    </p>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            (function() {
                const root = document.body;
                const toggleBtn = document.getElementById('themeToggle');
                const iconSun = document.getElementById('iconSun');
                const iconMoon = document.getElementById('iconMoon');

                function applyTheme(theme) {
                    root.setAttribute('data-bs-theme', theme);
                    iconSun.classList.toggle('d-none', theme === 'dark');
                    iconMoon.classList.toggle('d-none', theme === 'light');
                    localStorage.setItem('pc-theme', theme);
                }

                const saved = localStorage.getItem('pc-theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                applyTheme(saved || (prefersDark ? 'dark' : 'light'));

                toggleBtn.addEventListener('click', function() {
                    const current = root.getAttribute('data-bs-theme');
                    applyTheme(current === 'dark' ? 'light' : 'dark');
                });
            })();
        </script>

    </body>

    </html>
