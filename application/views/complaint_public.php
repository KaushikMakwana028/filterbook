<?php
$selectedOrderId = (int) ($this->input->post('order_id') ?: $this->input->get('order_id'));
$selectedModel = '';
foreach ($orders as $order) {
    if ((int) $order->id === $selectedOrderId) {
        $selectedModel = (string) $order->product_modal;
        break;
    }
}
$customerInitials = '';
$nameParts = explode(' ', trim($customer->name));
$customerInitials .= !empty($nameParts[0]) ? strtoupper($nameParts[0][0]) : '';
$customerInitials .= !empty($nameParts[1]) ? strtoupper($nameParts[1][0]) : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($vendor->store_name ?? 'Complaint Form') ?> — Register Complaint</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-deeper: #3730a3;
            --primary-light: #eef2ff;
            --primary-glow: rgba(99, 102, 241, .15);
            --success: #059669;
            --success-light: #ecfdf5;
            --success-border: #a7f3d0;
            --danger: #dc2626;
            --danger-light: #fef2f2;
            --danger-border: #fecaca;
            --warning: #d97706;
            --warning-light: #fffbeb;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --white: #ffffff;
            --radius-sm: 8px;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
            --radius-full: 9999px;
            --shadow-xs: 0 1px 2px rgba(0, 0, 0, .05);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, .07), 0 2px 4px -2px rgba(0, 0, 0, .05);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, .08), 0 4px 6px -4px rgba(0, 0, 0, .05);
            --shadow-lg: 0 20px 40px -4px rgba(0, 0, 0, .08);
            --shadow-glow: 0 8px 32px rgba(99, 102, 241, .18);
            --transition: all .2s cubic-bezier(.4, 0, .2, 1);
            --transition-slow: all .35s cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--gray-800);
            background: var(--gray-50);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* ═══════════════════════════════════════
           BACKGROUND PATTERN
           ═══════════════════════════════════════ */
        .bg-pattern {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .bg-pattern::before {
            content: '';
            position: absolute;
            top: -30%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, .08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .bg-pattern::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(20, 184, 166, .06) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* ═══════════════════════════════════════
           PAGE WRAPPER
           ═══════════════════════════════════════ */
        .page-wrapper {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        /* ═══════════════════════════════════════
           HERO SECTION
           ═══════════════════════════════════════ */
        .hero-section {
            background: linear-gradient(135deg, #4338ca 0%, #6366f1 40%, #818cf8 70%, #14b8a6 100%);
            border-radius: var(--radius-2xl);
            padding: 40px 36px;
            color: var(--white);
            position: relative;
            overflow: hidden;
            margin-bottom: 28px;
            box-shadow: var(--shadow-lg), 0 0 80px rgba(99, 102, 241, .12);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -60px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(255, 255, 255, .08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: 20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, .04) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: var(--radius-full);
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, .9);
            margin-bottom: 16px;
            letter-spacing: .3px;
            text-transform: uppercase;
        }

        .hero-badge .pulse-dot {
            width: 8px;
            height: 8px;
            background: #34d399;
            border-radius: 50%;
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(52, 211, 153, .4);
            }

            50% {
                box-shadow: 0 0 0 6px rgba(52, 211, 153, 0);
            }
        }

        .hero-title {
            font-size: clamp(26px, 4vw, 38px);
            font-weight: 900;
            letter-spacing: -.5px;
            margin-bottom: 8px;
            line-height: 1.15;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, .75);
            font-size: 15px;
            max-width: 650px;
            line-height: 1.7;
        }

        .hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(255, 255, 255, .12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: var(--radius-full);
            font-size: 13px;
            font-weight: 600;
            color: var(--white);
            transition: var(--transition);
        }

        .hero-chip:hover {
            background: rgba(255, 255, 255, .2);
        }

        .hero-chip .chip-icon {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, .15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-chip .chip-icon svg {
            width: 14px;
            height: 14px;
        }

        /* ═══════════════════════════════════════
           LAYOUT
           ═══════════════════════════════════════ */
        .main-layout {
            display: grid;
            grid-template-columns: 340px minmax(0, 1fr);
            gap: 24px;
            align-items: start;
        }

        /* ═══════════════════════════════════════
           SIDEBAR PANEL
           ═══════════════════════════════════════ */
        .sidebar-panel {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            position: sticky;
            top: 24px;
        }

        .sidebar-header {
            padding: 24px 24px 0;
        }

        .sidebar-header .section-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .sidebar-header .section-label svg {
            width: 14px;
            height: 14px;
        }

        .sidebar-header h3 {
            font-size: 20px;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 6px;
            letter-spacing: -.3px;
        }

        .sidebar-header p {
            font-size: 13.5px;
            color: var(--gray-500);
            line-height: 1.65;
        }

        /* Customer Card */
        .customer-card-section {
            padding: 20px 24px;
        }

        .customer-profile {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            background: linear-gradient(135deg, var(--primary-light), #ede9fe);
            border-radius: var(--radius-lg);
            margin-bottom: 16px;
        }

        .customer-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 18px;
            color: var(--white);
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(99, 102, 241, .3);
            letter-spacing: .5px;
        }

        .customer-meta .cust-name {
            font-weight: 700;
            font-size: 16px;
            color: var(--gray-900);
            line-height: 1.3;
        }

        .customer-meta .cust-phone {
            font-size: 13px;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 2px;
        }

        .customer-meta .cust-phone svg {
            width: 13px;
            height: 13px;
            color: var(--gray-400);
        }

        /* Info Items */
        .info-items {
            display: grid;
            gap: 4px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px;
            border-radius: var(--radius);
            transition: var(--transition);
        }

        .info-item:hover {
            background: var(--gray-50);
        }

        .info-item-icon {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-item-icon.icon-blue {
            background: #eff6ff;
            color: #3b82f6;
        }

        .info-item-icon.icon-green {
            background: #ecfdf5;
            color: #059669;
        }

        .info-item-icon.icon-purple {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .info-item-icon.icon-amber {
            background: #fffbeb;
            color: #d97706;
        }

        .info-item-icon svg {
            width: 18px;
            height: 18px;
        }

        .info-item-text .info-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--gray-400);
            margin-bottom: 2px;
        }

        .info-item-text .info-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-800);
            line-height: 1.45;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 16px 24px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-100);
        }

        .sidebar-footer .trust-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--gray-400);
        }

        .sidebar-footer .trust-row svg {
            width: 14px;
            height: 14px;
            color: var(--success);
        }

        /* ═══════════════════════════════════════
           FORM CARD
           ═══════════════════════════════════════ */
        .form-section {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .form-header {
            padding: 28px 32px 0;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .form-header-left h3 {
            font-size: 22px;
            font-weight: 800;
            color: var(--gray-900);
            letter-spacing: -.3px;
            margin-bottom: 4px;
        }

        .form-header-left p {
            font-size: 13.5px;
            color: var(--gray-500);
        }

        .form-step-indicator {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .step-dot {
            width: 32px;
            height: 5px;
            border-radius: var(--radius-full);
            background: var(--gray-200);
            transition: var(--transition);
        }

        .step-dot.active {
            background: var(--primary);
            width: 48px;
        }

        .step-dot.completed {
            background: var(--success);
        }

        /* Alerts */
        .form-alert {
            margin: 20px 32px 0;
            padding: 14px 18px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: alertSlide .35s ease;
        }

        .form-alert svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .form-alert.alert-success {
            background: var(--success-light);
            color: var(--success);
            border: 1px solid var(--success-border);
        }

        .form-alert.alert-danger {
            background: var(--danger-light);
            color: var(--danger);
            border: 1px solid var(--danger-border);
        }

        @keyframes alertSlide {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form Body */
        .form-body {
            padding: 24px 32px 32px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 700;
            color: var(--gray-700);
        }

        .form-label .required {
            color: var(--danger);
            font-size: 14px;
        }

        .form-label .label-icon {
            width: 16px;
            height: 16px;
            color: var(--gray-400);
        }

        .form-label .label-tag {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 2px 8px;
            border-radius: var(--radius-full);
            background: var(--gray-100);
            color: var(--gray-500);
            margin-left: auto;
        }

        .form-label .label-tag.auto {
            background: var(--primary-light);
            color: var(--primary);
        }

        /* Inputs */
        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius);
            padding: 13px 16px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-800);
            background: var(--white);
            outline: none;
            transition: var(--transition);
            -webkit-appearance: none;
            appearance: none;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .form-input:hover:not(:focus):not([readonly]),
        .form-select:hover:not(:focus),
        .form-textarea:hover:not(:focus) {
            border-color: var(--gray-300);
        }

        .form-input[readonly] {
            background: var(--gray-50);
            color: var(--gray-600);
            cursor: not-allowed;
            border-style: dashed;
        }

        .form-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 18px;
            padding-right: 42px;
            cursor: pointer;
        }

        .form-textarea {
            min-height: 150px;
            resize: vertical;
            line-height: 1.65;
        }

        .input-hint {
            font-size: 12px;
            color: var(--gray-400);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .input-hint svg {
            width: 13px;
            height: 13px;
        }

        /* Character Counter */
        .char-counter {
            text-align: right;
            font-size: 12px;
            color: var(--gray-400);
            font-weight: 600;
            font-variant-numeric: tabular-nums;
            transition: var(--transition);
        }

        .char-counter.warning {
            color: var(--warning);
        }

        .char-counter.danger {
            color: var(--danger);
        }

        /* Divider */
        .form-divider {
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 4px 0;
        }

        .form-divider::before,
        .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        .form-divider span {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray-400);
            white-space: nowrap;
        }

        /* ═══════════════════════════════════════
           FORM FOOTER
           ═══════════════════════════════════════ */
        .form-footer {
            padding: 20px 32px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .form-footer-hint {
            font-size: 13px;
            color: var(--gray-400);
            display: flex;
            align-items: center;
            gap: 6px;
            max-width: 400px;
            line-height: 1.5;
        }

        .form-footer-hint svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: var(--gray-400);
        }

        /* Submit Button */
        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: var(--radius-full);
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(99, 102, 241, .3);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, .1));
            opacity: 0;
            transition: var(--transition);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .btn-submit:hover::before {
            opacity: 1;
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(99, 102, 241, .25);
        }

        .btn-submit svg {
            width: 18px;
            height: 18px;
            transition: var(--transition);
        }

        .btn-submit:hover svg {
            transform: translateX(2px) translateY(-2px);
        }

        /* ═══════════════════════════════════════
           PRODUCT PREVIEW
           ═══════════════════════════════════════ */
        .product-preview {
            grid-column: 1 / -1;
            display: none;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
            border: 1px solid var(--success-border);
            border-radius: var(--radius);
            animation: fadeIn .3s ease;
        }

        .product-preview.visible {
            display: flex;
        }

        .product-preview-icon {
            width: 42px;
            height: 42px;
            background: var(--white);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: var(--shadow-xs);
        }

        .product-preview-icon svg {
            width: 22px;
            height: 22px;
            color: var(--success);
        }

        .product-preview-text .pp-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--success);
            margin-bottom: 1px;
        }

        .product-preview-text .pp-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-800);
        }

        .product-preview-text .pp-model {
            font-size: 12px;
            color: var(--gray-500);
            font-weight: 500;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
           ═══════════════════════════════════════ */
        @media (max-width: 960px) {
            .main-layout {
                grid-template-columns: 1fr;
            }

            .sidebar-panel {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .page-wrapper {
                padding: 14px;
            }

            .hero-section {
                padding: 28px 22px;
                border-radius: var(--radius-xl);
            }

            .hero-title {
                font-size: 24px;
            }

            .form-header,
            .form-body,
            .form-footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .sidebar-panel,
            .form-section {
                border-radius: var(--radius-lg);
            }

            .form-footer {
                flex-direction: column;
                text-align: center;
            }

            .form-footer-hint {
                justify-content: center;
                text-align: center;
            }
        }

        /* ═══════════════════════════════════════
           CUSTOM SCROLLBAR
           ═══════════════════════════════════════ */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* Selection */
        ::selection {
            background: rgba(99, 102, 241, .15);
            color: var(--primary-deeper);
        }
    </style>
</head>

<body>

    <div class="bg-pattern"></div>

    <div class="page-wrapper">

        <!-- ═══════ HERO ═══════ -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="pulse-dot"></span>
                    Complaint Portal
                </div>
                <!-- <h1 class="hero-title">Register Your Complaint</h1> -->
                <!-- <p class="hero-subtitle">
                    This form is linked to your customer ID. Your details are pre-filled — simply select your purchased
                    product and describe the issue.
                </p> -->
                <div class="hero-chips">
                    <div class="hero-chip">
                        <span class="chip-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                        </span>
                        <?= htmlspecialchars($vendor->store_name ?? 'Store') ?>
                    </div>
                    <div class="hero-chip">
                        <span class="chip-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </span>
                        <?= htmlspecialchars($customer->name) ?>
                    </div>
                    <div class="hero-chip">
                        <span class="chip-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                        </span>
                        <?= htmlspecialchars($customer->mobile) ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════ MAIN LAYOUT ═══════ -->
        <!-- <div class="main-layout"> -->

        <!-- ── Sidebar ── -->
        <!-- <aside class="sidebar-panel">
                <div class="sidebar-header">
                    <div class="section-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                        Verified Customer
                    </div>
                    <h3>Auto-Fetched Profile</h3>
                    <p>Your identity is verified via unique QR code. No manual entry needed.</p>
                </div>

                <div class="customer-card-section">
                    <div class="customer-profile">
                        <div class="customer-avatar"><?= $customerInitials ?></div>
                        <div class="customer-meta">
                            <div class="cust-name"><?= htmlspecialchars($customer->name) ?></div>
                            <div class="cust-phone">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                                <?= htmlspecialchars($customer->mobile) ?>
                            </div>
                        </div>
                    </div>

                    <div class="info-items">
                        <div class="info-item">
                            <div class="info-item-icon icon-blue">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </div>
                            <div class="info-item-text">
                                <div class="info-label">Address</div>
                                <div class="info-value"><?= htmlspecialchars($customer->address) ?></div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon icon-purple">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                            </div>
                            <div class="info-item-text">
                                <div class="info-label">Products Owned</div>
                                <div class="info-value"><?= count($orders) ?>
                                    product<?= count($orders) === 1 ? '' : 's' ?> registered</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon icon-amber">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div class="info-item-text">
                                <div class="info-label">Note</div>
                                <div class="info-value">Only purchased products are available for complaint.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-footer">
                    <div class="trust-row">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        Your data is secure and encrypted
                    </div>
                </div>
            </aside> -->

        <!-- ── Form ── -->
        <section class="form-section">
            <div class="form-header">
                <div class="form-header-left">
                    <h3>Complaint Details</h3>
                    <p>Fill in the issue details below. Product model auto-fills on selection.</p>
                </div>
                <div class="form-step-indicator">
                    <div class="step-dot completed"></div>
                    <div class="step-dot completed"></div>
                    <div class="step-dot active"></div>
                    <div class="step-dot"></div>
                </div>
            </div>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="form-alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <?= htmlspecialchars($this->session->flashdata('success')) ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="form-alert alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126Z" />
                    </svg>
                    <?= htmlspecialchars($this->session->flashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form id="complaintForm" method="post" action="<?= site_url('complaint/save/' . (int) $customer_id) ?>">
                <div class="form-body">
                    <div class="form-grid">

                        <!-- Read-Only Fields -->
                        <div class="form-group">
                            <label class="form-label">
                                <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Customer Name
                                <span class="label-tag auto">Auto-filled</span>
                            </label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($customer->name) ?>"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                                Mobile Number
                                <span class="label-tag auto">Auto-filled</span>
                            </label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($customer->mobile) ?>"
                                readonly>
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">
                                <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                Address
                                <span class="label-tag auto">Auto-filled</span>
                            </label>
                            <input type="text" class="form-input"
                                value="<?= htmlspecialchars($customer->address) ?>" readonly>
                        </div>

                        <!-- Divider -->
                        <div class="form-divider">
                            <span>Complaint Information</span>
                        </div>

                        <!-- Product Select -->
                        <div class="form-group">
                            <label class="form-label" for="order_id">
                                <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                                Product Name
                                <span class="required">*</span>
                            </label>
                            <select id="order_id" name="order_id" class="form-select" required>
                                <option value="">— Select your product —</option>
                                <?php foreach ($orders as $order): ?>
                                    <option value="<?= (int) $order->id ?>"
                                        data-model="<?= htmlspecialchars((string) $order->product_modal) ?>"
                                        data-name="<?= htmlspecialchars($order->product_name) ?>"
                                        <?= $selectedOrderId === (int) $order->id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($order->product_name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="input-hint">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                Only your purchased products are listed
                            </span>
                        </div>

                        <!-- Product Model -->
                        <div class="form-group">
                            <label class="form-label" for="product_model">
                                <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                </svg>
                                Product Model
                                <span class="label-tag auto">Auto-detected</span>
                            </label>
                            <input type="text" id="product_model" class="form-input"
                                value="<?= htmlspecialchars($selectedModel) ?>" readonly
                                placeholder="Select a product first">
                        </div>

                        <!-- Product Preview -->
                        <div class="product-preview" id="productPreview">
                            <div class="product-preview-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div class="product-preview-text">
                                <div class="pp-label">Selected Product</div>
                                <div class="pp-value" id="ppName">—</div>
                                <div class="pp-model" id="ppModel">—</div>
                            </div>
                        </div>

                        <!-- Issue Type -->
                        <div class="form-group">
                            <label class="form-label" for="issue">
                                <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                                Issue Type
                                <span class="required">*</span>
                            </label>
                            <select id="issue" name="issue" class="form-select" required>
                                <option value="">— Select issue category —</option>
                                <?php foreach ($issue_options as $issueOption): ?>
                                    <option value="<?= htmlspecialchars($issueOption) ?>"
                                        <?= $this->input->post('issue') === $issueOption ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($issueOption) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Empty spacer for grid alignment -->
                        <div class="form-group" style="visibility: hidden;">
                            <label class="form-label">&nbsp;</label>
                            <input type="text" class="form-input" style="visibility: hidden;">
                        </div>

                        <!-- Complaint Details -->
                        <div class="form-group full-width">
                            <label class="form-label" for="complain_details">
                                <svg class="label-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                                Complaint Details
                                <span class="required">*</span>
                            </label>
                            <textarea id="complain_details" name="complain_details" class="form-textarea"
                                placeholder="Describe the issue clearly — what happened, when it started, and what symptoms you're experiencing..."
                                required
                                maxlength="1500"><?= htmlspecialchars((string) $this->input->post('complain_details')) ?></textarea>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span class="input-hint">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                    </svg>
                                    Be as detailed as possible for faster resolution
                                </span>
                                <span class="char-counter" id="charCounter">0 / 1500</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-footer">
                    <div class="form-footer-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        Product model is auto-detected. Your complaint will be recorded and tracked.
                    </div>
                    <button type="submit" class="btn-submit" id="submitComplaintBtn">
                        Submit Complaint
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>
        </section>

        <!-- </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            const complaintForm = document.getElementById('complaintForm');
            const orderSelect = document.getElementById('order_id');
            const modelInput = document.getElementById('product_model');
            const preview = document.getElementById('productPreview');
            const ppName = document.getElementById('ppName');
            const ppModel = document.getElementById('ppModel');
            const textarea = document.getElementById('complain_details');
            const charCounter = document.getElementById('charCounter');
            const submitButton = document.getElementById('submitComplaintBtn');
            const maxChars = 1500;
            const lockDurationMs = 30 * 60 * 1000;
            const storageKey = 'complaint_submit_lock_<?= (int) $customer_id ?>';
            const defaultButtonHtml = submitButton.innerHTML;
            let lockTimer = null;

            function formatRemainingTime(milliseconds) {
                const totalSeconds = Math.max(0, Math.ceil(milliseconds / 1000));
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;

                return minutes + ':' + String(seconds).padStart(2, '0');
            }

            function clearSubmitLock() {
                localStorage.removeItem(storageKey);
                submitButton.disabled = false;
                submitButton.innerHTML = defaultButtonHtml;

                if (lockTimer) {
                    clearInterval(lockTimer);
                    lockTimer = null;
                }
            }

            function applySubmitLock(expiresAt) {
                const remainingMs = expiresAt - Date.now();

                if (remainingMs <= 0) {
                    clearSubmitLock();
                    return;
                }

                submitButton.disabled = true;
                submitButton.textContent = 'Submit again in ' + formatRemainingTime(remainingMs);

                if (lockTimer) {
                    clearInterval(lockTimer);
                }

                lockTimer = setInterval(function() {
                    const timeLeft = expiresAt - Date.now();

                    if (timeLeft <= 0) {
                        clearSubmitLock();
                        return;
                    }

                    submitButton.textContent = 'Submit again in ' + formatRemainingTime(timeLeft);
                }, 1000);
            }

            function initializeSubmitLock() {
                const savedExpiry = parseInt(localStorage.getItem(storageKey), 10);

                if (!savedExpiry) {
                    return;
                }

                applySubmitLock(savedExpiry);
            }

            // ── Sync product model on select change ──
            function syncModel() {
                const selected = orderSelect.options[orderSelect.selectedIndex];
                const model = selected ? (selected.getAttribute('data-model') || '') : '';
                const name = selected ? (selected.getAttribute('data-name') || '') : '';

                modelInput.value = model;

                if (selected && selected.value) {
                    preview.classList.add('visible');
                    ppName.textContent = name || selected.textContent.trim();
                    ppModel.textContent = model ? 'Model: ' + model : 'No model info';
                } else {
                    preview.classList.remove('visible');
                }
            }

            orderSelect.addEventListener('change', syncModel);
            syncModel();

            // ── Character counter ──
            function updateCounter() {
                const len = textarea.value.length;
                charCounter.textContent = len.toLocaleString() + ' / ' + maxChars.toLocaleString();

                charCounter.classList.remove('warning', 'danger');
                if (len > maxChars * 0.9) {
                    charCounter.classList.add('danger');
                } else if (len > maxChars * 0.7) {
                    charCounter.classList.add('warning');
                }
            }

            textarea.addEventListener('input', updateCounter);
            updateCounter();

            // ── Auto-dismiss alerts ──
            document.querySelectorAll('.form-alert').forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity .4s ease, transform .4s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-8px)';
                    setTimeout(function() {
                        alert.remove();
                    }, 400);
                }, 6000);
            });

            // ── Update step indicator based on form completion ──
            function updateSteps() {
                const dots = document.querySelectorAll('.step-dot');
                const hasProduct = orderSelect.value !== '';
                const hasIssue = document.getElementById('issue').value !== '';
                const hasDetails = textarea.value.trim().length > 10;

                // Step 1 & 2 always completed (customer info)
                dots[0].className = 'step-dot completed';
                dots[1].className = 'step-dot completed';

                if (hasProduct && hasIssue) {
                    dots[2].className = 'step-dot completed';
                    dots[3].className = hasDetails ? 'step-dot completed' : 'step-dot active';
                } else if (hasProduct || hasIssue) {
                    dots[2].className = 'step-dot active';
                    dots[3].className = 'step-dot';
                } else {
                    dots[2].className = 'step-dot active';
                    dots[3].className = 'step-dot';
                }
            }

            orderSelect.addEventListener('change', updateSteps);
            document.getElementById('issue').addEventListener('change', updateSteps);
            textarea.addEventListener('input', updateSteps);
            updateSteps();

            complaintForm.addEventListener('submit', function() {
                submitButton.disabled = true;
                submitButton.textContent = 'Submitting...';
            });

            initializeSubmitLock();

            <?php if ($this->session->flashdata('success')): ?>
                const successLockExpiresAt = Date.now() + lockDurationMs;
                localStorage.setItem(storageKey, String(successLockExpiresAt));
                applySubmitLock(successLockExpiresAt);

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Complaint Submitted',
                        text: 'Your complaint has been submitted successfully.',
                        confirmButtonText: 'OK'
                    });
                }
            <?php endif; ?>
        })();
    </script>
</body>

</html>