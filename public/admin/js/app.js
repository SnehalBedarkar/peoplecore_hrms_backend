/**
 * PeopleCore App Shell behaviour.
 *
 * Two independent pieces of UI state live here, each persisted separately
 * to localStorage so a reload doesn't reset the user's preference:
 *   1. sidebar collapsed / expanded   -> key: "peoplecore:sidebarCollapsed"
 *   2. theme light / dark             -> key: "peoplecore:theme"
 *
 * Theme is applied TWICE in this app, deliberately:
 *   - Once synchronously via an inline <script> in app.blade.php's <head>,
 *     before any CSS paints, to avoid a flash of the wrong theme on load.
 *   - Again here, only in response to the toggle button click.
 * This file does NOT re-apply the stored theme on load — that would be
 * redundant (the inline script already did it earlier and correctly).
 */
(function () {
    "use strict";

    const SIDEBAR_KEY = "peoplecore:sidebarCollapsed";
    const THEME_KEY = "peoplecore:theme";

    const body = document.body;
    const sidebar = document.getElementById("appSidebar");
    const collapseBtn = document.getElementById("sidebarCollapseBtn");
    const mobileToggleBtn = document.getElementById("mobileSidebarToggle");
    const darkModeToggle = document.getElementById("darkModeToggle");

    /* ---------- Sidebar collapse (desktop icon-rail) ---------- */

    function applySidebarState(collapsed) {
        body.classList.toggle("sidebar-collapsed", collapsed);
    }

    // Restore on load
    const storedCollapsed = localStorage.getItem(SIDEBAR_KEY) === "true";
    applySidebarState(storedCollapsed);

    if (collapseBtn) {
        collapseBtn.addEventListener("click", function () {
            const isCollapsed = !body.classList.contains("sidebar-collapsed");
            applySidebarState(isCollapsed);
            localStorage.setItem(SIDEBAR_KEY, String(isCollapsed));
        });
    }

    /* ---------- Mobile off-canvas sidebar ---------- */

    if (mobileToggleBtn && sidebar) {
        mobileToggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("mobile-open");
        });

        document.addEventListener("click", function (event) {
            const isOpen = sidebar.classList.contains("mobile-open");
            const clickedInsideSidebar = sidebar.contains(event.target);
            const clickedToggleBtn = mobileToggleBtn.contains(event.target);

            if (isOpen && !clickedInsideSidebar && !clickedToggleBtn) {
                sidebar.classList.remove("mobile-open");
            }
        });
    }

    /* ---------- Dark mode ---------- */
    // NOTE: theme attribute lives on <html> (document.documentElement),
    // set synchronously by the inline script in <head> on first paint.
    // We only need to handle the toggle click here, not re-apply on load.

    function applyTheme(theme) {
        document.documentElement.setAttribute("data-theme", theme);
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener("click", function () {
            const nextTheme =
                document.documentElement.getAttribute("data-theme") === "dark"
                    ? "light"
                    : "dark";
            applyTheme(nextTheme);
            localStorage.setItem(THEME_KEY, nextTheme);
        });
    }

    /* ---------- Bootstrap tooltips ---------- */

    const tooltipTriggerEls = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]',
    );
    tooltipTriggerEls.forEach(function (el) {
        new bootstrap.Tooltip(el);
    });
})();
