</div><!-- /.adm-page-content -->

</div><!-- /.adm-wrapper -->

<!-- ============================================================
     SCRIPTS
     ============================================================ -->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/front_end/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/simplebar/js/simplebar.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/metismenu/js/metisMenu.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
<script src="https://unpkg.com/libphonenumber-js@1.10.14/bundle/libphonenumber-js.min.js"></script>
<!-- FA JS removed: using FA CSS (in header) only to avoid icon rendering conflicts -->
<script src="<?= base_url('assets/js/app.js') . '?v=' . @filemtime(FCPATH . 'assets/js/app.js') ?>"></script>

<script>
    (function() {
        'use strict';

        var sidebar = document.getElementById('admSidebar');
        var sidebarToggle = document.getElementById('admSidebarToggle');
        var mobileToggle = document.getElementById('admMobileToggle');
        var overlay = document.getElementById('admOverlay');
        var themeToggle = document.getElementById('admThemeToggle');
        var themeIcon = document.getElementById('admThemeIcon');
        var userMenu = document.getElementById('admUserMenu');
        var userBtn = document.getElementById('admUserBtn');
        var html = document.documentElement;

        /* THEME */
        function applyTheme(theme) {
            html.setAttribute('data-theme', theme);
            localStorage.setItem('adm_theme', theme);
            if (theme === 'dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }
        applyTheme(localStorage.getItem('adm_theme') || 'light');

        themeToggle.addEventListener('click', function() {
            applyTheme(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        });

        /* SIDEBAR COLLAPSE - desktop */
        function isMobile() {
            return window.innerWidth <= 1024;
        }

        if (!isMobile() && localStorage.getItem('adm_sidebar_collapsed') === '1') {
            sidebar.classList.add('collapsed');
        }

        sidebarToggle.addEventListener('click', function() {
            if (isMobile()) return;
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('adm_sidebar_collapsed', sidebar.classList.contains('collapsed') ? '1' : '0');
        });

        /* SIDEBAR - mobile */
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                sidebar.classList.add('mobile-open');
                overlay.classList.add('active');
            });
        }
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });

        /* SUBMENU */
        document.querySelectorAll('.adm-nav-item.has-submenu > .adm-nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                var item = this.closest('.adm-nav-item');
                document.querySelectorAll('.adm-nav-item.has-submenu.open').forEach(function(other) {
                    if (other !== item) other.classList.remove('open');
                });
                item.classList.toggle('open');
            });
        });

        /* USER DROPDOWN */
        userBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userMenu.classList.toggle('open');
        });
        document.addEventListener('click', function() {
            userMenu.classList.remove('open');
        });

        /* AUTO-CLOSE ALERTS */
        document.querySelectorAll('.alert-success, .alert-danger, .alert-warning').forEach(function(el) {
            setTimeout(function() {
                el.style.transition = 'opacity 0.4s ease';
                el.style.opacity = '0';
                setTimeout(function() {
                    el.remove();
                }, 400);
            }, 3500);
        });

    })();
</script>

</body>

</html>