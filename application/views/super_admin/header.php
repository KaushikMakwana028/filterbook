<?php
$CI = &get_instance();
$superAdminSession = $CI->session->userdata('super_admin');

if (!isset($user_data) || !is_object($user_data)) {
    $user_data = $super_admin ?? null;

    if (!$user_data && is_array($superAdminSession) && !empty($superAdminSession['id'])) {
        $user_data = $CI->db->get_where('users', ['id' => (int) $superAdminSession['id']])->row();
    }
}

$headerProfileImage = base_url('assets/images/avatars/avatar-2.png');
$headerProfilePath = null;
$activeSuperPage = $active_super_page ?? 'dashboard';

if (!empty($user_data->profile_image)) {
    $headerProfilePath = FCPATH . ltrim($user_data->profile_image, '/\\');

    if (file_exists($headerProfilePath)) {
        $headerProfileImage = base_url($user_data->profile_image) . '?v=' . filemtime($headerProfilePath);
    } else {
        $headerProfileImage = base_url($user_data->profile_image);
    }
}
?>
<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('assets/images/app icon.png') ?>" type="image/png">
    <link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/sass/dark-theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/sass/semi-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/sass/bordered-theme.css') ?>">
    <title>Filter Book - Super Admin</title>
    <style>
        .logo-icon {
            width: 74% !important;
        }

        .super-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #ede9fe;
            color: #6d28d9;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
        }
    </style>
    <script>
        (function () {
            var savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="<?= base_url('assets/images/filtter-logo.png'); ?>" class="logo-icon" alt="logo icon">
                </div>
                <div class="mobile-toggle-icon ms-auto"><i class='bx bx-x'></i></div>
            </div>

            <ul class="metismenu" id="menu">

                <!-- Dashboard -->
                <li class="<?= $activeSuperPage === 'dashboard' ? 'mm-active' : ''; ?>">
                    <a href="<?= site_url('super-admin/dashboard'); ?>"
                        class="menu-link <?= $activeSuperPage === 'dashboard' ? 'active' : ''; ?>">

                        <div class="parent-icon">
                            <i class="fa-solid fa-gauge-high"></i>
                        </div>

                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <!-- Admin List -->
                <li class="<?= $activeSuperPage === 'admin_list' ? 'mm-active' : ''; ?>">
                    <a href="<?= site_url('super-admin/admin-list'); ?>"
                        class="menu-link <?= $activeSuperPage === 'admin_list' ? 'active' : ''; ?>">

                        <div class="parent-icon">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>

                        <div class="menu-title">Admin List</div>
                    </a>
                </li>

                <!-- Plan Manage -->
                <li class="<?= $activeSuperPage === 'plan_manage' ? 'mm-active' : ''; ?>">
                    <a href="<?= site_url('super-admin/plan'); ?>"
                        class="menu-link <?= $activeSuperPage === 'plan_manage' ? 'active' : ''; ?>">

                        <div class="parent-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                        <div class="menu-title">Plan Manage</div>
                    </a>
                </li>

                <!-- Logout -->
                <li>
                    <a href="<?= site_url('admin/login/logout') ?>" class="menu-link logout">

                        <div class="parent-icon">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </div>

                        <div class="menu-title">Logout</div>
                    </a>
                </li>

            </ul>
        </div>

        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
                    <div class="ms-3">
                        <span class="super-badge"><i class='bx bx-shield-quarter'></i> Super Admin</span>
                    </div>

                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center"></ul>
                    </div>

                    <div class="user-box dropdown px-3">
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $headerProfileImage; ?>" class="user-img" alt="user avatar">
                            <div class="user-info">
                                <p class="user-name mb-0">
                                    <?= html_escape($user_data->store_name ?? 'Filter Book HQ'); ?>
                                </p>
                                <p class="designattion mb-0"><?= html_escape($user_data->name ?? 'Super Admin'); ?></p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item d-flex align-items-center text-danger"
                                    href="<?= site_url('admin/login/logout') ?>">
                                    <i class="bx bx-log-out me-2 fs-5"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>


                    </div>
                </nav>
            </div>
        </header>
        <div class="page-wrapper">
            <div class="page-content">