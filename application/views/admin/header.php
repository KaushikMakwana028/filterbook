<?php
$CI = &get_instance();
$adminSession = $CI->session->userdata('admin');

if (!isset($user_data) || !is_object($user_data)) {
	$user_data = null;
	if (is_array($adminSession) && !empty($adminSession['id'])) {
		$user_data = $CI->db->get_where('users', ['id' => (int) $adminSession['id']])->row();
	} elseif (is_object($adminSession) && !empty($adminSession->id)) {
		$user_data = $CI->db->get_where('users', ['id' => (int) $adminSession->id])->row();
	}
}

if (!isset($profile) || !is_object($profile)) {
	$profile = $user_data;
}

$headerProfileImage = base_url('assets/images/avatars/avatar-2.png');
if (!empty($user_data->profile_image)) {
	$headerProfilePath = FCPATH . ltrim($user_data->profile_image, '/\\');
	if (file_exists($headerProfilePath)) {
		$headerProfileImage = base_url($user_data->profile_image) . '?v=' . filemtime($headerProfilePath);
	} else {
		$headerProfileImage = base_url($user_data->profile_image);
	}
}

$currentController = strtolower((string) $CI->router->fetch_class());
$currentMethod     = strtolower((string) $CI->router->fetch_method());

$isDashboardMenu = $currentController === 'dashboard';
$isCustomerMenu  = $currentController === 'orders' && in_array($currentMethod, ['index', 'customer', 'edit_customer'], true);
$isOrderMenu     = $currentController === 'orders' && in_array($currentMethod, ['new_order', 'add_order', 'save_order', 'edit', 'view', 'update_order', 'update_order_emi'], true);
$isServiceMenu   = $currentController === 'service';
$isEmiMenu       = $currentController === 'emi';
$isAmcMenu       = $currentController === 'amc';
$isComplaintMenu = $currentController === 'complaint';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="icon" href="<?= base_url('assets/images/app icon.png') ?>" type="image/png">
	<link rel="manifest" href="<?= base_url('assets/manifest.json') ?>">
	<meta name="theme-color" content="#6366F1">

	<!-- Poppins Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

	<!-- Existing plugins -->
	<link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet">
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
	<script src="<?= base_url('assets/js/pace.min.js') ?>"></script>


	<title>
		<?= isset($user_data->store_name) ? strtoupper(htmlspecialchars($user_data->store_name)) : 'ADMIN' ?>
	</title>

	<style>
		/* ============================================================
           CSS VARIABLES & THEME
           ============================================================ */
		:root {
			--primary: #6366F1;
			--primary-dark: #4f46e5;
			--primary-light: #818cf8;
			--secondary: #8B5CF6;
			--success: #10B981;
			--warning: #F59E0B;
			--danger: #EF4444;

			--bg-primary: #ffffff;
			--bg-secondary: #f8fafc;
			--bg-tertiary: #f1f5f9;
			--text-primary: #0f172a;
			--text-secondary: #64748b;
			--text-tertiary: #94a3b8;
			--border-color: #e2e8f0;
			--shadow: rgba(0, 0, 0, 0.07);
			--shadow-lg: rgba(0, 0, 0, 0.15);

			--sidebar-bg: #ffffff;
			--sidebar-width: 272px;
			--sidebar-collapsed-width: 72px;

			--sp-xs: 0.5rem;
			--sp-sm: 0.75rem;
			--sp-md: 1rem;
			--sp-lg: 1.5rem;
			--sp-xl: 2rem;

			--r-sm: 8px;
			--r-md: 12px;
			--r-lg: 16px;

			--t: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			--t-fast: all 0.15s ease;
		}

		[data-theme="dark"] {
			--bg-primary: #0f172a;
			--bg-secondary: #1e293b;
			--bg-tertiary: #334155;
			--text-primary: #f1f5f9;
			--text-secondary: #cbd5e1;
			--text-tertiary: #94a3b8;
			--border-color: rgba(255, 255, 255, 0.08);
			--shadow: rgba(0, 0, 0, 0.3);
			--shadow-lg: rgba(0, 0, 0, 0.5);
			--sidebar-bg: #1e293b;
		}

		/* ============================================================
           RESET & BASE
           ============================================================ */
		*,
		*::before,
		*::after {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: var(--bg-secondary);
			color: var(--text-primary);
			font-size: 14px;
			line-height: 1.6;
			overflow-x: hidden;
			transition: background 0.3s, color 0.3s;
		}

		::-webkit-scrollbar {
			width: 6px;
			height: 6px;
		}

		::-webkit-scrollbar-track {
			background: var(--bg-secondary);
		}

		::-webkit-scrollbar-thumb {
			background: var(--border-color);
			border-radius: 4px;
		}

		::-webkit-scrollbar-thumb:hover {
			background: var(--text-tertiary);
		}

		/* ============================================================
           SIDEBAR
           ============================================================ */
		.adm-sidebar {
			position: fixed;
			left: 0;
			top: 0;
			height: 100vh;
			width: var(--sidebar-width);
			background: var(--sidebar-bg);
			border-right: 1px solid var(--border-color);
			display: flex;
			flex-direction: column;
			transition: var(--t);
			z-index: 1050;
			overflow: hidden;
		}

		.adm-sidebar.collapsed {
			width: var(--sidebar-collapsed-width);
		}

		/* Sidebar Header */
		.adm-sidebar-header {
			padding: 0 var(--sp-lg);
			display: flex;
			align-items: center;
			justify-content: space-between;
			border-bottom: 1px solid var(--border-color);
			height: 70px;
			flex-shrink: 0;
		}

		.adm-logo {
			display: flex;
			align-items: center;
			gap: 10px;
			overflow: hidden;
			text-decoration: none;
		}

		.adm-logo-icon {
			flex-shrink: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			overflow: hidden;
		}

		/* Full logo: visible when sidebar is expanded */
		.adm-logo-icon .logo-full {
			height: 36px;
			max-width: 150px;
			object-fit: contain;
			display: block;
		}

		/* Mini icon: visible only when collapsed */
		.adm-logo-icon .logo-mini {
			width: 34px;
			height: 34px;
			object-fit: contain;
			border-radius: var(--r-sm);
			display: none;
		}

		.adm-sidebar.collapsed .adm-logo-icon .logo-full {
			display: none;
		}

		.adm-sidebar.collapsed .adm-logo-icon .logo-mini {
			display: block;
		}

		/* logo-text no longer used — logo is image based */
		.adm-logo-text {
			display: none;
		}

		.adm-sidebar.collapsed .adm-logo-text {
			display: none;
		}

		.adm-sidebar-toggle {
			background: transparent;
			border: none;
			color: var(--text-secondary);
			cursor: pointer;
			width: 32px;
			height: 32px;
			border-radius: var(--r-sm);
			display: flex;
			align-items: center;
			justify-content: center;
			transition: var(--t-fast);
			flex-shrink: 0;
		}

		.adm-sidebar-toggle:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
		}

		.adm-sidebar-toggle i {
			font-size: 18px;
		}

		/* Sidebar Nav */
		.adm-sidebar-nav {
			flex: 1;
			padding: var(--sp-lg) var(--sp-md);
			overflow-y: auto;
			overflow-x: hidden;
		}

		.adm-nav-item {
			margin-bottom: 2px;
		}

		.adm-nav-link {
			display: flex;
			align-items: center;
			gap: var(--sp-sm);
			padding: 12px var(--sp-md);
			border-radius: var(--r-md);
			color: var(--text-secondary);
			cursor: pointer;
			transition: var(--t-fast);
			font-weight: 500;
			font-size: 0.875rem;
			text-decoration: none;
			white-space: nowrap;
			position: relative;
		}

		.adm-nav-link:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
			text-decoration: none;
		}

		.adm-nav-item.active>.adm-nav-link,
		.adm-nav-link.active {
			background: linear-gradient(135deg, rgba(99, 102, 241, 0.12), rgba(139, 92, 246, 0.12));
			color: var(--primary);
		}

		.adm-nav-link .nav-icon,
		.adm-nav-link i.nav-icon {
			width: 20px;
			min-width: 20px;
			font-size: 16px;
			text-align: center;
			flex-shrink: 0;
		}

		.adm-nav-label {
			flex: 1;
			transition: var(--t);
		}

		.adm-sidebar.collapsed .adm-nav-label,
		.adm-sidebar.collapsed .adm-chevron {
			display: none;
		}

		.adm-chevron {
			font-size: 11px;
			color: var(--text-tertiary);
			transition: transform 0.25s ease;
		}

		.adm-nav-item.open>.adm-nav-link .adm-chevron {
			transform: rotate(180deg);
		}

		/* Submenu */
		.adm-submenu {
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.3s ease;
			padding-left: 14px;
		}

		.adm-nav-item.open>.adm-submenu {
			max-height: 400px;
		}

		.adm-sidebar.collapsed .adm-submenu {
			display: none;
		}

		.adm-submenu-item {
			display: flex;
			align-items: center;
			gap: var(--sp-sm);
			padding: 10px var(--sp-md);
			border-radius: var(--r-md);
			color: var(--text-secondary);
			cursor: pointer;
			transition: var(--t-fast);
			font-size: 0.825rem;
			font-weight: 500;
			text-decoration: none;
			margin-top: 2px;
		}

		.adm-submenu-item:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
			text-decoration: none;
		}

		.adm-submenu-item.active {
			background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.15));
			color: var(--primary);
		}

		.adm-submenu-item i {
			font-size: 13px;
			width: 16px;
			flex-shrink: 0;
		}

		/* Collapsed tooltip */
		.adm-sidebar.collapsed .adm-nav-link[data-tip]:hover::after {
			content: attr(data-tip);
			position: absolute;
			left: calc(100% + 14px);
			top: 50%;
			transform: translateY(-50%);
			background: var(--bg-tertiary);
			color: var(--text-primary);
			font-size: 0.75rem;
			padding: 5px 10px;
			border-radius: var(--r-sm);
			white-space: nowrap;
			pointer-events: none;
			box-shadow: 0 4px 12px var(--shadow-lg);
			z-index: 2000;
		}

		/* ============================================================
           TOPBAR
           ============================================================ */
		.adm-topbar {
			position: sticky;
			top: 0;
			background: var(--bg-primary);
			border-bottom: 1px solid var(--border-color);
			padding: 0 var(--sp-xl);
			height: 70px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			z-index: 1000;
			box-shadow: 0 1px 3px var(--shadow);
			transition: background 0.3s, border-color 0.3s;
		}

		.adm-topbar-left {
			display: flex;
			align-items: center;
			gap: var(--sp-md);
		}

		/* Mobile hamburger — hidden on desktop */
		.adm-mobile-toggle {
			display: none;
			background: transparent;
			border: none;
			color: var(--text-primary);
			cursor: pointer;
			font-size: 22px;
			padding: 4px;
		}

		/* Topbar Right */
		.adm-topbar-right {
			display: flex;
			align-items: center;
			gap: var(--sp-sm);
		}

		/* Icon button */
		.adm-icon-btn {
			position: relative;
			width: 40px;
			height: 40px;
			background: var(--bg-secondary);
			border: 1px solid var(--border-color);
			border-radius: var(--r-md);
			color: var(--text-secondary);
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			transition: var(--t-fast);
			font-size: 17px;
		}

		.adm-icon-btn:hover {
			background: var(--bg-tertiary);
			color: var(--text-primary);
			border-color: var(--text-tertiary);
		}

		/* User Menu */
		.adm-user-menu {
			position: relative;
		}

		.adm-user-btn {
			display: flex;
			align-items: center;
			gap: var(--sp-sm);
			padding: 6px 12px;
			background: var(--bg-secondary);
			border: 1px solid var(--border-color);
			border-radius: var(--r-md);
			color: var(--text-primary);
			font-family: 'Poppins', sans-serif;
			font-size: 0.85rem;
			cursor: pointer;
			transition: var(--t-fast);
		}

		.adm-user-btn:hover {
			background: var(--bg-tertiary);
			border-color: var(--text-tertiary);
		}

		.adm-user-btn img {
			width: 30px;
			height: 30px;
			border-radius: 50%;
			object-fit: cover;
			border: 2px solid var(--primary-light);
		}

		.adm-user-btn .u-name {
			font-weight: 600;
			max-width: 130px;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}

		.adm-user-btn .u-chevron {
			font-size: 11px;
			color: var(--text-tertiary);
			transition: transform 0.2s;
		}

		.adm-user-menu.open .adm-user-btn .u-chevron {
			transform: rotate(180deg);
		}

		/* Dropdown */
		.adm-user-dropdown {
			position: absolute;
			top: calc(100% + 10px);
			right: 0;
			background: var(--bg-primary);
			border: 1px solid var(--border-color);
			border-radius: var(--r-lg);
			box-shadow: 0 10px 40px var(--shadow-lg);
			min-width: 210px;
			opacity: 0;
			visibility: hidden;
			transform: translateY(-8px);
			transition: var(--t-fast);
			z-index: 2000;
			overflow: hidden;
		}

		.adm-user-menu.open .adm-user-dropdown {
			opacity: 1;
			visibility: visible;
			transform: translateY(0);
		}

		.adm-dropdown-header {
			padding: var(--sp-md);
			border-bottom: 1px solid var(--border-color);
			display: flex;
			align-items: center;
			gap: var(--sp-sm);
		}

		.adm-dropdown-header img {
			width: 38px;
			height: 38px;
			border-radius: 50%;
			object-fit: cover;
			border: 2px solid var(--primary-light);
		}

		.adm-dropdown-header .dh-name {
			font-size: 0.85rem;
			font-weight: 600;
			color: var(--text-primary);
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			max-width: 130px;
		}

		.adm-dropdown-header .dh-sub {
			font-size: 0.72rem;
			color: var(--text-secondary);
		}

		.adm-user-dropdown a {
			display: flex;
			align-items: center;
			gap: var(--sp-sm);
			padding: 10px var(--sp-md);
			color: var(--text-secondary);
			font-size: 0.85rem;
			font-weight: 500;
			text-decoration: none;
			transition: var(--t-fast);
		}

		.adm-user-dropdown a:hover {
			background: var(--bg-secondary);
			color: var(--text-primary);
		}

		.adm-user-dropdown a i {
			font-size: 15px;
			width: 18px;
		}

		.adm-user-dropdown a.logout-link {
			color: var(--danger);
		}

		.adm-user-dropdown a.logout-link:hover {
			background: rgba(239, 68, 68, 0.08);
			color: var(--danger);
		}

		.adm-dropdown-divider {
			border: none;
			border-top: 1px solid var(--border-color);
			margin: 4px 0;
		}

		/* ============================================================
           WRAPPER & PAGE CONTENT
           ============================================================ */
		.adm-wrapper {
			margin-left: var(--sidebar-width);
			min-height: 100vh;
			transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			flex-direction: column;
		}

		.adm-sidebar.collapsed~.adm-wrapper {
			margin-left: var(--sidebar-collapsed-width);
		}

		.adm-page-content {
			padding: var(--sp-lg) var(--sp-lg);
			flex: 1;
		}

		/* Mobile overlay */
		.adm-overlay {
			display: none;
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.45);
			z-index: 1040;
		}

		/* ============================================================
           RESPONSIVE
           ============================================================ */
		@media (max-width: 1024px) {
			.adm-sidebar {
				transform: translateX(-100%);
				width: var(--sidebar-width) !important;
			}

			.adm-sidebar.mobile-open {
				transform: translateX(0);
			}

			.adm-overlay.active {
				display: block;
			}

			.adm-wrapper {
				margin-left: 0 !important;
			}

			.adm-mobile-toggle {
				display: flex;
			}
		}

		@media (max-width: 576px) {
			.adm-topbar {
				padding: 0 var(--sp-md);
			}

			.adm-user-btn .u-name {
				display: none;
			}

			.adm-page-content {
				padding: var(--sp-md);
			}
		}

		/* ============================================================
   GLOBAL DARK THEME - applies to ALL pages
   ============================================================ */

		/* Fix page wrapper backgrounds */
		[data-theme="dark"] .page-wrapper,
		[data-theme="dark"] .page-content {
			background: var(--bg-primary) !important;
		}

		/* All white card surfaces */
		[data-theme="dark"] .s-card,
		[data-theme="dark"] .tbl-card,
		[data-theme="dark"] .qr-section,
		[data-theme="dark"] .analytics,
		[data-theme="dark"] .plan-warning-card,
		[data-theme="dark"] .card,
		[data-theme="dark"] .box,
		[data-theme="dark"] .panel,
		[data-theme="dark"] .widget,
		[data-theme="dark"] .modal-content,
		[data-theme="dark"] .dropdown-menu,
		[data-theme="dark"] .popover,
		[data-theme="dark"] .list-group-item {
			background: var(--bg-secondary) !important;
			border-color: var(--border-color) !important;
			color: var(--text-primary) !important;
		}

		/* Table headers */
		[data-theme="dark"] .tbl-card-header,
		[data-theme="dark"] .analytics-head,
		[data-theme="dark"] .a-footer,
		[data-theme="dark"] .card-header,
		[data-theme="dark"] .card-footer,
		[data-theme="dark"] thead,
		[data-theme="dark"] thead th,
		[data-theme="dark"] .tbl-card thead th,
		[data-theme="dark"] .table thead th {
			background: var(--bg-tertiary) !important;
			border-color: var(--border-color) !important;
			color: var(--text-secondary) !important;
		}

		/* All tables */
		[data-theme="dark"] table,
		[data-theme="dark"] .table {
			color: var(--text-primary) !important;
			border-color: var(--border-color) !important;
		}

		[data-theme="dark"] tbody td,
		[data-theme="dark"] .table tbody td,
		[data-theme="dark"] .tbl-card tbody td {
			color: var(--text-secondary) !important;
			border-color: var(--border-color) !important;
		}

		[data-theme="dark"] tbody tr:hover,
		[data-theme="dark"] .table tbody tr:hover,
		[data-theme="dark"] .tbl-card tbody tr:hover {
			background: var(--bg-tertiary) !important;
		}

		/* All inputs, selects, textareas */
		[data-theme="dark"] input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="range"]),
		[data-theme="dark"] select,
		[data-theme="dark"] textarea,
		[data-theme="dark"] .form-control,
		[data-theme="dark"] .form-select,
		[data-theme="dark"] .select2-container--default .select2-selection--single,
		[data-theme="dark"] .select2-container--default .select2-selection--multiple {
			background: var(--bg-tertiary) !important;
			border-color: var(--border-color) !important;
			color: var(--text-primary) !important;
		}

		/* Select2 dropdown */
		[data-theme="dark"] .select2-dropdown,
		[data-theme="dark"] .select2-results__option {
			background: var(--bg-secondary) !important;
			color: var(--text-primary) !important;
			border-color: var(--border-color) !important;
		}

		[data-theme="dark"] .select2-results__option--highlighted {
			background: var(--bg-tertiary) !important;
			color: var(--text-primary) !important;
		}

		[data-theme="dark"] .select2-container--default .select2-selection__rendered {
			color: var(--text-primary) !important;
		}

		/* All text */
		[data-theme="dark"] h1,
		[data-theme="dark"] h2,
		[data-theme="dark"] h3,
		[data-theme="dark"] h4,
		[data-theme="dark"] h5,
		[data-theme="dark"] h6,
		[data-theme="dark"] .s-card-val,
		[data-theme="dark"] .tbl-card-header h4,
		[data-theme="dark"] .tbl-customer-name,
		[data-theme="dark"] .sec-header h3,
		[data-theme="dark"] .qr-info h3,
		[data-theme="dark"] .a-val,
		[data-theme="dark"] .analytics-head h5,
		[data-theme="dark"] label,
		[data-theme="dark"] .form-label {
			color: var(--text-primary) !important;
		}

		[data-theme="dark"] p,
		[data-theme="dark"] span:not(.badge):not(.tbl-badge):not(.s-card-badge):not(.a-badge),
		[data-theme="dark"] .s-card-label,
		[data-theme="dark"] .tbl-customer-phone,
		[data-theme="dark"] .tbl-detail-row,
		[data-theme="dark"] .a-lbl,
		[data-theme="dark"] .a-time,
		[data-theme="dark"] .a-legend-item,
		[data-theme="dark"] .text-muted,
		[data-theme="dark"] small,
		[data-theme="dark"] .form-text {
			color: var(--text-secondary) !important;
		}

		/* Buttons - ghost/outline only, keep colored buttons as-is */
		[data-theme="dark"] .btn-light,
		[data-theme="dark"] .btn-outline-secondary,
		[data-theme="dark"] .btn-secondary,
		[data-theme="dark"] .q-btn.ghost {
			background: var(--bg-tertiary) !important;
			border-color: var(--border-color) !important;
			color: var(--text-primary) !important;
		}

		/* Navigation/tabs */
		[data-theme="dark"] .nav-tabs,
		[data-theme="dark"] .nav-tabs .nav-link,
		[data-theme="dark"] .nav-pills .nav-link {
			border-color: var(--border-color) !important;
			color: var(--text-secondary) !important;
		}

		[data-theme="dark"] .nav-tabs .nav-link.active,
		[data-theme="dark"] .nav-pills .nav-link.active {
			background: var(--bg-secondary) !important;
			color: var(--primary) !important;
			border-color: var(--border-color) !important;
		}

		/* Pagination */
		[data-theme="dark"] .page-link {
			background: var(--bg-secondary) !important;
			border-color: var(--border-color) !important;
			color: var(--text-primary) !important;
		}

		[data-theme="dark"] .page-item.active .page-link {
			background: var(--primary) !important;
			border-color: var(--primary) !important;
			color: #fff !important;
		}

		/* Dividers and borders */
		[data-theme="dark"] hr,
		[data-theme="dark"] .adm-dropdown-divider,
		[data-theme="dark"] .sec-line,
		[data-theme="dark"] .border,
		[data-theme="dark"] .border-bottom,
		[data-theme="dark"] .border-top {
			border-color: var(--border-color) !important;
		}

		/* Dashboard-specific */
		[data-theme="dark"] .s-card-bar {
			background: var(--bg-tertiary) !important;
		}

		[data-theme="dark"] .a-toggle {
			background: var(--bg-tertiary) !important;
			border-color: var(--border-color) !important;
		}

		[data-theme="dark"] .a-toggle .a-btn {
			color: var(--text-secondary) !important;
		}

		[data-theme="dark"] .a-toggle .a-btn.active {
			background: var(--bg-secondary) !important;
			color: var(--primary) !important;
		}

		[data-theme="dark"] .a-refresh,
		[data-theme="dark"] .a-summary-cell:hover {
			background: var(--bg-tertiary) !important;
			border-color: var(--border-color) !important;
			color: var(--text-secondary) !important;
		}

		[data-theme="dark"] .qr-img-box {
			background: var(--bg-secondary) !important;
			border-color: var(--border-color) !important;
		}

		[data-theme="dark"] .tbl-empty-state .empty-icon {
			background: var(--bg-tertiary) !important;
		}

		/* Fix page-content padding - reduce left/right space on all pages */
		.adm-page-content {
			padding: var(--sp-md) var(--sp-md) !important;
		}

		@media (min-width: 1025px) {
			.adm-page-content {
				padding: 20px 24px !important;
			}
		}
	</style>

	<!-- Prevent theme flash -->
	<script>
		(function() {
			var t = localStorage.getItem('adm_theme') || 'light';
			document.documentElement.setAttribute('data-theme', t);
		})();
	</script>
</head>

<body>

	<!-- Mobile overlay -->
	<div class="adm-overlay" id="admOverlay"></div>

	<!-- ============================================================
     SIDEBAR
     ============================================================ -->
	<aside class="adm-sidebar" id="admSidebar">

		<!-- Sidebar Header: logo + toggle -->
		<div class="adm-sidebar-header">
			<a href="<?= site_url('admin/dashboard') ?>" class="adm-logo">
				<div class="adm-logo-icon">
					<img src="<?= base_url('assets/images/filtter-logo.png') ?>" class="logo-full" alt="FilterBook">
					<img src="<?= base_url('assets/images/app icon.png') ?>" class="logo-mini" alt="FilterBook">
				</div>
			</a>
			<button class="adm-sidebar-toggle" id="admSidebarToggle" title="Toggle sidebar">
				<i class="fa-solid fa-bars-staggered"></i>
			</button>
		</div>

		<!-- Navigation -->
		<nav class="adm-sidebar-nav">

			<!-- Dashboard -->
			<div class="adm-nav-item <?= $isDashboardMenu ? 'active' : '' ?>">
				<a href="<?= site_url('admin/dashboard') ?>" class="adm-nav-link" data-tip="Dashboard">
					<i class="fa-solid fa-gauge-high nav-icon"></i>
					<span class="adm-nav-label">Dashboard</span>
				</a>
			</div>

			<!-- Customer -->
			<div class="adm-nav-item <?= $isCustomerMenu ? 'active' : '' ?>">
				<a href="<?= site_url('admin/orders') ?>" class="adm-nav-link" data-tip="Customer">
					<i class="fa-solid fa-users nav-icon"></i>
					<span class="adm-nav-label">Customer</span>
				</a>
			</div>

			<!-- Order -->
			<div class="adm-nav-item <?= $isOrderMenu ? 'active' : '' ?>">
				<a href="<?= site_url('admin/orders/new_order') ?>" class="adm-nav-link" data-tip="Order">
					<i class="fa-solid fa-cart-plus nav-icon"></i>
					<span class="adm-nav-label">Order</span>
				</a>
			</div>

			<!-- Services -->
			<div class="adm-nav-item <?= $isServiceMenu ? 'active' : '' ?>">
				<a href="<?= site_url('admin/service') ?>" class="adm-nav-link" data-tip="Services">
					<i class="fa-solid fa-screwdriver-wrench nav-icon"></i>
					<span class="adm-nav-label">Services</span>
				</a>
			</div>

			<!-- EMI -->
			<div class="adm-nav-item <?= $isEmiMenu ? 'active' : '' ?>">
				<a href="<?= site_url('admin/emi') ?>" class="adm-nav-link" data-tip="EMI">
					<i class="fa-solid fa-credit-card nav-icon"></i>
					<span class="adm-nav-label">EMI</span>
				</a>
			</div>

			<!-- AMC Customer -->
			<div class="adm-nav-item <?= $isAmcMenu ? 'active' : '' ?>">
				<a href="<?= site_url('admin/amc') ?>" class="adm-nav-link" data-tip="AMC Customer">
					<i class="fa-solid fa-file-signature nav-icon"></i>
					<span class="adm-nav-label">AMC Customer</span>
				</a>
			</div>

			<!-- Complain -->
			<div class="adm-nav-item <?= $isComplaintMenu ? 'active' : '' ?>">
				<a href="<?= site_url('admin/complaint') ?>" class="adm-nav-link" data-tip="Complain">
					<i class="fa-solid fa-comments nav-icon"></i>
					<span class="adm-nav-label">Complain</span>
				</a>
			</div>

		</nav>
		<!-- NO sidebar footer / user block -->

	</aside>

	<!-- ============================================================
     MAIN WRAPPER
     ============================================================ -->
	<div class="adm-wrapper" id="admWrapper">

		<!-- TOPBAR: only mobile toggle + theme toggle + user menu -->
		<header class="adm-topbar">

			<div class="adm-topbar-left">
				<button class="adm-mobile-toggle" id="admMobileToggle">
					<i class="fa-solid fa-bars"></i>
				</button>
			</div>

			<div class="adm-topbar-right">

				<!-- Theme toggle -->
				<button class="adm-icon-btn" id="admThemeToggle" title="Toggle theme">
					<i class="fa-solid fa-moon" id="admThemeIcon"></i>
				</button>

				<!-- User menu -->
				<div class="adm-user-menu" id="admUserMenu">
					<button class="adm-user-btn" id="admUserBtn">
						<img src="<?= $headerProfileImage ?>" alt="avatar">
						<span class="u-name"><?= htmlspecialchars($user_data->store_name ?? $user_data->name ?? 'Admin') ?></span>
						<i class="fa-solid fa-chevron-down u-chevron"></i>
					</button>

					<div class="adm-user-dropdown">
						<div class="adm-dropdown-header">
							<img src="<?= $headerProfileImage ?>" alt="avatar">
							<div>
								<div class="dh-name"><?= htmlspecialchars($user_data->store_name ?? '') ?></div>
								<div class="dh-sub"><?= htmlspecialchars($user_data->name ?? '') ?></div>
							</div>
						</div>
						<a href="<?= site_url('admin/profile') ?>"><i class="fa-solid fa-user"></i> Profile</a>
						<a href="<?= base_url('change_password') ?>"><i class="fa-solid fa-lock"></i> Change Password</a>
						<a href="<?= site_url('admin/plan') ?>"><i class="fa-solid fa-layer-group"></i> Plan</a>
						<hr class="adm-dropdown-divider">
						<a href="<?= site_url('admin/login/logout') ?>" class="logout-link">
							<i class="fa-solid fa-right-from-bracket"></i> Logout
						</a>
					</div>
				</div>

			</div>
		</header>

		<!-- Page content starts here -->
		<div class="adm-page-content">